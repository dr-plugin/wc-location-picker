<?php

namespace Iran_Map_Field;

defined('ABSPATH') || exit;

class Map
{
    public function __construct()
    {
        add_action('init', [$this, 'show_map'], 1);
    }

    public function show_map()
    {
        if (! isset($_GET['showMap'])) {
            return;
        }

        header('X-Robots-Tag: noindex');

        $plugin_url  = trailingslashit(Iran_Map_Field_URL);
        $plugin_path = trailingslashit(Iran_Map_Field_PATH);

        wp_enqueue_style(
            'leaflet',
            $plugin_url . 'assets/leaflet/leaflet.css',
            [],
            '1.9.4'
        );

        wp_enqueue_style(
            'iran-map',
            $plugin_url . 'assets/css/map.css',
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'leaflet',
            $plugin_url . 'assets/leaflet/leaflet.js',
            [],
            '1.9.4',
            true
        );

        wp_enqueue_script(
            'iran-map',
            $plugin_url . 'assets/js/map.js',
            ['leaflet'],
            '1.0.0',
            true
        );

        include $plugin_path . 'template/map.php';

        exit;
    }
}
