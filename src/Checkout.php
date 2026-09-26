<?php

namespace WC_Location_Picker;

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
            'wc-location-picker',
            WC_LOCATION_PICKER_URL . 'assets/js/checkout.js',
            ['jquery'],
            '1.0.0',
            true
        );

        $iframe_url = add_query_arg(
            'showMap',
            '1',
            home_url('/')
        );
?>

        <p class="form-row" id="location_field">
            <label for="location">
                <?php esc_html_e('Location', 'wc-location-picker'); ?>
            </label>

            <span class="woocommerce-input-wrapper">
                <input
                    type="text"
                    class="input-text"
                    name="location"
                    id="location"
                    placeholder="<?php esc_attr_e('Click to show map', 'wc-location-picker'); ?>"
                    value=""
                    readonly>
            </span>
        </p>

        <style>
            body:has(#mapWrap.show) {
                overflow: hidden;
            }

            #mapWrap {
                display: none;
                position: fixed;
                inset: 0;
                width: 100%;
                height: 100%;
                z-index: 1000;
                justify-content: center;
                align-items: center;
                background-color: #6262fd36;
            }

            #mapWrap.show {
                display: flex;
            }

            #mapWrap iframe {
                width: 750px;
                height: 500px;
                max-width: 100%;
                max-height: 100%;
            }
        </style>

        <div id="mapWrap">
            <iframe
                src=""
                data-src="<?php echo esc_url($iframe_url); ?>"
                title="<?php esc_attr_e('Map', 'wc-location-picker'); ?>"
                allow="geolocation"></iframe>
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
                __('Location is required.', 'wc-location-picker')
            );
        }
    }
}
