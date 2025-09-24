<?php

/**
 * Plugin Name: wc-location-picker
 * Requires Plugins: ronakhamrah_plugin
 * Description: Add location to woocommerce form fields
 * Version: 1.0.0
 * Plugin URI: https://github.com/dr-plugin/wc-location-picker
 * Author: Ayoob Zare
 * Author Url: https://drplugin.ir 
 * Email: zare2868@gmail.com
 */

defined('ABSPATH') || exit;

if (is_admin()) {
    add_action('woocommerce_admin_order_data_after_billing_address', function ($order) {
        $coordinate = $order->get_meta('location', true) ?? '';

        if (empty($coordinate))
            return;

        $coordinate = json_decode(stripslashes($coordinate));
        $coordinate = 'https://www.google.com/maps?q=' . $coordinate->lat . ',' . $coordinate->lng;

        echo "<b>Locatin on map</b><br>" . esc_html($coordinate);
    });
} else {

    add_action('woocommerce_before_order_notes', function () {

        $pluginUrl = plugin_dir_url(__FILE__);

        echo '<p class="form-row" id="location_field" data-priority="">
        <label for="location" class="">Loation</label>
        <span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="location" id="location" 
        placeholder="click for show map" value="" readonly></span></p>';

        wp_enqueue_script('jblocation', $pluginUrl . 'assets/js/checkout.js', ['jquery']);

        echo '<style>
            body:has(#mapWrap.show){
                overflow:hidden
            }
            div#mapWrap {
                display:none;
                position: fixed;
                top: 0;
                left: 0;
                width:100%;
                height:100%;
                z-index:1000;
				justify-content: center;
    			align-items: center;
				background-color:#6262fd36;
				transition:all .05s;
            }
            #mapWrap.show{
                display:flex;
            }
            #mapWrap iframe{
                width:750px;
                height:500px;
				max-width:100%;
				max-height:100%;
            }
            </style>';

        $iframeUrl = home_url('?showMap');
        echo '<div id="mapWrap"><iframe src="" data-src="' . $iframeUrl . '" title="description" allow="geolocation" ></iframe></div>';
    }, 10, 2);

    /**
     * Create custom url for show map
     */
    add_action('init', function () {

        if (
            ! isset($_GET['showMap'])
            || ! is_user_logged_in()
        ) {
            return;
        }

        //noindex in show map
        header('X-Robots-Tag: noindex');

        $pluginUrl = trailingslashit(plugin_dir_url(__FILE__));
        $pluginPatch = trailingslashit(plugin_dir_path(__FILE__));


        $leafletJs  = $pluginUrl . 'assets/leaflet/leaflet.js';
        $leafletCss = $pluginUrl . 'assets/leaflet/leaflet.css';

        include $pluginPatch . 'template/map.php';

        exit;
    }, 1);

    add_action('woocommerce_checkout_create_order', function ($order, $data) {

        if (isset($_POST['location']) && ! empty($_POST['location'])) {
            $order->update_meta_data('location', sanitize_text_field($_POST['location']));
        }
    }, 10, 2);

    add_action('woocommerce_after_checkout_validation', function ($data, $errors) {

        if (empty($_POST['location'])) {
            $errors->add('validation', 'Location is need');
        }
    }, 10, 2);
}
