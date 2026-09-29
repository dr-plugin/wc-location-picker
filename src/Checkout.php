<?php

namespace Iran_Map_Field;

defined('ABSPATH') || exit;

class Checkout
{
    public function __construct()
    {
        add_action(
            'woocommerce_before_order_notes',
            [$this, 'field']
        );

        add_action(
            'woocommerce_checkout_create_order',
            [$this, 'save_location'],
            10,
            2
        );

        add_action(
            'woocommerce_after_checkout_validation',
            [$this, 'validate_location'],
            10,
            2
        );
    }

    public function field()
    {
        wp_enqueue_script(
            'iran-map-field',
            Iran_Map_Field_URL . 'assets/js/checkout.js',
            ['jquery'],
            '1.0.0',
            true
        );

        wp_enqueue_style(
            'iran-map-field',
            Iran_Map_Field_URL . 'assets/css/checkout.css',
            [],
            '1.0.0'
        );

        $iframe_url = add_query_arg(
            'showMap',
            '1',
            home_url('/')
        );

?>

        <p class="form-row" id="location_field">
            <label for="location">
                <?php esc_html_e('Location', 'iran-map-field'); ?>
            </label>

            <span class="woocommerce-input-wrapper">
                <input
                    type="text"
                    class="input-text"
                    name="location"
                    id="location"
                    placeholder="<?php esc_attr_e('Click to show map', 'iran-map-field'); ?>"
                    value=""
                    readonly>
            </span>
        </p>

        <div id="mapWrap">
            <iframe
                src=""
                data-src="<?php echo esc_url($iframe_url); ?>"
                title="<?php esc_attr_e('Map', 'iran-map-field'); ?>"
                allow="geolocation">
            </iframe>
        </div>

<?php
    }

    public function save_location($order, $data)
    {
        if (
            isset($_POST['location']) &&
            ! empty($_POST['location'])
        ) {
            $order->update_meta_data(
                'location',
                sanitize_text_field(wp_unslash($_POST['location']))
            );
        }
    }

    public function validate_location($data, $errors)
    {
        if (empty($_POST['location'])) {
            $errors->add(
                'validation',
                __('Location is required.', 'iran-map-field')
            );
        }
    }
}
