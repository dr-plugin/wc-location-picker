<?php

/**
 * Plugin Name: WooCommerce Checkout Location Picker
 * Description: Adds an interactive map location picker to the WooCommerce checkout form, allowing customers to select their delivery location.
 * Version: 1.0.0
 * Plugin URI: https://github.com/dr-plugin/wc-location-picker
 * Author: Ayoob Zare
 * Author URI: https://drplugin.ir
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Requires Plugins: woocommerce
 * Text Domain: wc-location-picker
 * Email: zare2868@gmail.com
 * License: GPL-2.0-or-later
 */

defined('ABSPATH') || exit;

define('WC_LOCATION_PICKER_PATH', plugin_dir_path(__FILE__));
define('WC_LOCATION_PICKER_URL', plugin_dir_url(__FILE__));

if (is_admin()) {

    require_once WC_LOCATION_PICKER_PATH . 'src/Admin.php';
    new WC_Location_Picker\Admin();
} else {

    require_once WC_LOCATION_PICKER_PATH . 'src/Checkout.php';
    require_once WC_LOCATION_PICKER_PATH . 'src/Map.php';
    new WC_Location_Picker\Checkout();
    new WC_Location_Picker\Map();
}
