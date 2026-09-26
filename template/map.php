<?php

/**
 * Template for show map
 * 
 * @var string $leaflet_css
 * @var string $leaflet_js
 */

defined('WC_LOCATION_PICKER_PATH') || exit;

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select map</title>

    <link rel="stylesheet" href="<?= esc_url($leaflet_css); ?>">
    <script src="<?= esc_url($leaflet_js); ?>"></script>

    <style>
        @media (max-width:550px) {
            .button-wrap {
                width: 100% !important;
            }

            .button-wrap button {
                flex: 1;
            }
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        * {
            box-sizing: border-box;
        }

        #jbMap {
            height: 100%;
            min-height: 400px;
        }

        .button-wrap {
            display: flex;
            gap: 10px;
            position: fixed;
            bottom: 3px;
            left: 0;
            padding: 5px;
            z-index: 10000;
            width: 200px;
        }

        .button-wrap button,
        #myLocation {
            padding: 8px;
            font-family: inherit;
            background: #becdf8;
            color: #275df1;
            border: none;
            box-shadow: 0 0 5px 1px #3a4c95;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-wrap button#cancel {
            background-color: #e0e0e0;
            color: black;
        }

        button#myLocation {
            position: fixed;
            top: 5px;
            right: 5px;
            z-index: 10000;
        }

        .leaflet-control-container {
            position: fixed;
            top: 0;
            z-index: 10000;
        }
    </style>
</head>

<body>
    <div id="jbMap"></div>
    <button id="myLocation">
        <?php esc_html_e('My location', 'wc-location-picker'); ?>
    </button>

    <div class="button-wrap">
        <button id="saveLocation"><?php esc_html_e('Save location', 'wc-location-picker'); ?></button>
        <button id="cancel"><?php esc_html_e('Cancel', 'wc-location-picker'); ?></button>
    </div>

    <script>
        var marker;
        var myLockBtn = document.getElementById('myLocation');
        var saveBtn = document.getElementById('saveLocation');
        var cancelBtn = document.getElementById('cancel');

        cancelBtn.onclick = () => {
            var parent = window.frameElement.parentElement ?? false;
            if (parent)
                parent.classList.remove('show');
        }

        var map = L.map('jbMap').setView([35.6952, 51.4064], 10);

        map.scrollWheelZoom.disable();
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //    tileSize: 512,
            //     zoomOffset: -1,
            attribution: 'ayoobzare',
            maxZoom: 19
        }).addTo(map);

        marker = new L.Marker([35.79235, 51.41647], {
            draggable: true
        });
        map.addLayer(marker);

        saveBtn.onclick = function() {
            var latLong = marker.getLatLng();
            //send message to parent
            window.parent.postMessage(latLong, "*");
        }

        map.on('click', function(e) {
            var newLatLng = new L.LatLng(e.latlng.lat, e.latlng.lng);
            //set marker
            marker.setLatLng(newLatLng);
        });

        myLockBtn.onclick = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    var myLat = position.coords.latitude;
                    var myLng = position.coords.longitude;

                    newLatLng = new L.LatLng(myLat, myLng);
                    marker.setLatLng(newLatLng);

                    //set map view to marker
                    map.setView([myLat, myLng]);
                });
            } else {
                //x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
    </script>
</body>

</html>