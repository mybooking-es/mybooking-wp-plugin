=== MyBooking Reservation Engine ===
Contributors: juanmiqueo
Donate link: https://mybooking.es/
Tags: reservation engine
Requires at least: 5.2
Tested up to: 5.4
Stable tag: trunk
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mybooking reservation engine WordPress plugin. 

== Description ==

Mybooking Reservation Engine WordPress plugin. Build a reservation engine connected to your mybooking account.

Mybooking plugin can be used to create reservation engine for:

- Car rental
- Kayak/Surf/Paddle surf rental
- Boats rental
- Accommodation
- Activities or tours

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Mybooking screen to configure the plugin

A mybooking account is required. The plugin connects to mybooking API to get product availability and prices
and to perform the checkout process. Please visit <a href="http://mybooking.es">mybooking.es</a>

== Frequently Asked Questions ==

= Is mybooking free? =

Yes, it is free. But you need a mybooking account.

= Can I use the plugin to sell an activity/tours ? =

Yes, there is activity shortcode that you can insert in your activity page to show availability and 
sell activity/tour tickets.

= Does it connect to payment gateways? =

Yes, mybooking plugin can connect to Paypal, Redsys, Payment Addons, Cecebank and Transbank WebPay

== Screenshots ==

1. Activity/Tour checkout page
2. Activity/Tour calendar widget
3. Renting choose product page
4. Renting choose product page (multiple products)
5. Renting checkout page

== Changelog ==

= 0.5.18 =
* Spanish translations (contact form and wizard destinations)
* Better themes integration 
 * Compatibility with bootstrap $.modal (fixed conflict with jquery-modal)
 * Font awesome fonts added
 * Bootstrap 4.4.1

= 0.5.17 =
* Rent complete. Just pay now option not connecting to payment gateway
* Product calendar choose Just One Date

= 0.5.16 =
* First release.

== Upgrade Notice ==

= 0.5.17 =
* JS Engine Library: complete and product calendar

= 0.5.16 =
* First release
