<?php

/**
 * Plugin Name: Iran Map Field
 * Description: Adds an interactive map location picker to the WooCommerce checkout form, allowing customers to select their delivery location.
 * Version: 1.0.0
 * Plugin URI: https://github.com/dr-plugin/iran-map-field
 * Author: Ayoob Zare
 * Author URI: https://drplugin.ir
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * Requires Plugins: woocommerce
 * Text Domain: ayoob-checkout-location-picker
 * Email: zare2868@gmail.com
 * License: GPL-2.0-or-later
 */

defined('ABSPATH') || exit;

define('Iran_Map_Field_PATH', plugin_dir_path(__FILE__));
define('Iran_Map_Field_URL', plugin_dir_url(__FILE__));

if (is_admin()) {

    require_once Iran_Map_Field_PATH . 'src/Admin.php';

    new Iran_Map_Field\Admin();
} else {

    require_once Iran_Map_Field_PATH . 'src/Checkout.php';
    require_once Iran_Map_Field_PATH . 'src/Map.php';

    new Iran_Map_Field\Checkout();
    new Iran_Map_Field\Map();
}
