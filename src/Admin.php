<?php

namespace Iran_Map_Field;

defined('ABSPATH') || exit;

class Admin
{
    public function __construct()
    {
        add_action(
            'woocommerce_admin_order_data_after_billing_address',
            [$this, 'show_location']
        );
    }

    public function show_location($order)
    {
        $coordinate = $order->get_meta('location', true);

        if (empty($coordinate)) {
            return;
        }

        $coordinate = json_decode(stripslashes($coordinate));

        if (
            ! $coordinate ||
            ! isset($coordinate->lat, $coordinate->lng)
        ) {
            return;
        }

        $url = sprintf(
            'https://www.google.com/maps?q=%s,%s',
            rawurlencode($coordinate->lat),
            rawurlencode($coordinate->lng)
        );

        echo '<p>';
        echo '<strong>' . esc_html__('Location on map', 'iran-map-field') . '</strong><br>';
        echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener">';
        echo esc_html($url);
        echo '</a>';
        echo '</p>';
    }
}
