<?php

namespace WC_Location_Picker;

defined('ABSPATH') || exit;

class Map
{
    public function __construct()
    {
        add_action('init', [$this, 'show_map'], 1);
    }

    public function show_map()
    {
        if (
            ! isset($_GET['showMap']) ||
            ! is_user_logged_in()
        ) {
            return;
        }

        header('X-Robots-Tag: noindex');

        $plugin_url  = trailingslashit(WC_LOCATION_PICKER_URL);
        $plugin_path = trailingslashit(WC_LOCATION_PICKER_PATH);

        $leaflet_js = $plugin_url . 'assets/leaflet/leaflet.js';
        $leaflet_css = $plugin_url . 'assets/leaflet/leaflet.css';

        include $plugin_path . 'template/map.php';

        exit;
    }
}
