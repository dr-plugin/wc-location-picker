<?php

/**
 * Template for displaying the map.
 */

defined('ABSPATH') || exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php esc_html_e('Select Location', 'ayoob-checkout-location-picker'); ?>
    </title>

    <?php wp_head(); ?>
</head>

<body id="iranMapField">

    <div id="jbMap"></div>

    <button id="myLocation">
        <?php esc_html_e('My location', 'ayoob-checkout-location-picker'); ?>
    </button>

    <div class="button-wrap">
        <button id="saveLocation">
            <?php esc_html_e('Save location', 'ayoob-checkout-location-picker'); ?>
        </button>

        <button id="cancel">
            <?php esc_html_e('Cancel', 'ayoob-checkout-location-picker'); ?>
        </button>
    </div>

    <?php wp_footer(); ?>

</body>

</html>