=== Iran Map Field ===
Contributors: drplugin2868
Tags: checkout, map, location, address, delivery
Requires at least: 6.0
Requires PHP: 8.0
Tested up to: 7.1
Requires Plugins: woocommerce
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a map location field to the WooCommerce checkout page.

== Description ==

Iran Map Field allows customers to select their delivery location directly on an interactive map during checkout.

Customers can select a location by clicking on the map, dragging the marker, or using their browser's current location.

The selected latitude and longitude are saved as WooCommerce order metadata and can be viewed from the order administration page.

The map uses Leaflet and OpenStreetMap tiles. No Google Maps API key is required.

== Features ==

* Map location field on the checkout page
* Select a location by clicking on the map
* Drag the marker to adjust the location
* Use the browser's current location
* Save latitude and longitude to the order
* View the selected location in the order administration page
* Uses Leaflet and OpenStreetMap

== Requirements ==

* WordPress 6.0 or later
* WooCommerce
* PHP 8.0 or later

== Installation ==

1. Upload the `iran-map-field` folder to `/wp-content/plugins/`.
2. Activate the plugin from the Plugins menu.
3. Make sure WooCommerce is installed and active.
4. The map location field will be available on the checkout page.

== Frequently Asked Questions ==

= Does this plugin require WooCommerce? =

Yes. WooCommerce must be installed and active.

= Does it require a Google Maps API key? =

No. The plugin uses Leaflet with OpenStreetMap tiles.

= Where is the selected location stored? =

The latitude and longitude are stored as WooCommerce order metadata.

== Changelog ==

= 1.0.0 =

* Initial release.