=== MyBooking Reservation Engine ===
Contributors: juanmiqueo
Donate link: https://mybooking.es/
Tags: reservation engine
Requires at least: 5.2
Tested up to: 5.7
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
- Appointments
- Sport courts

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

= 0.10.0 =
* Renting: Multiple Branch offices
* Renting: Renting product catalog => Search component
* Fixed: Renting selector custom address delivery/collection point 
* Profile/Customer: Password forgotten and change password

= 0.9.0 =
* Renting : Added login/signup customer on complete step
* Reservation Engine: Added russian translation
* Renting/Activities : Products navigation with multi-language
* Fixed: Promotion code with API Key

= 0.8.2 =
* Fixed payment method validation when multiple payment methods are available

= 0.8.1 =
* Renting : Avoid edit reservation data when reservation in progress/finished
* Renting : Translations improvement Payment
* Renting : Not available context: Contact by phone vs Not available

= 0.8.0 =
* Renting : Key characteristics and characteristics alt text
* Renting : Product navigation through slug instead of code
* Reservation Engine Library: Allow engine extension
* New CPT to manage catalog of products and activities

= 0.7.12 =
* Fixed Reservation Engine Library : Edit selector dates

= 0.7.11 =
* Fixed Terms and conditions translated page
* Renting
  * Selector Form custom control to manage offers

= 0.7.10 =
* Renting
  * Myreservation Form: Fixed maxlength issues

= 0.7.9 =
* Contact Form
  * ReCaptcha integration
  * Added subject, source, rental location and sales channel attributes
* Renting
  * Fixed selector expand datepicker clickable area

= 0.7.8 =
* Renting Range Calendar
  * Date selector with Google Translation
  * Date range selection

= 0.7.7 =
* Catala translation
* Renting
  * Form selector date to disabled when changed return place
* Renting Calendar
  * Next and Previous arrows in a button
* Date selector with Google Translation

= 0.7.6 =
* Renting
  * Avoid creating a reservation if exceeds the Max/Min duration. Show an alert

= 0.7.5 =
* Renting
  * Business context translations

= 0.7.4 =
* Renting
  * Fixed deliveries/collections dates/times search
  * Added sales channel code to wizard selector form

= 0.7.3 =
* Renting
  * Fixed modify reservation modal form on some themes
  * Added info icon on product selection card

= 0.7.2 =
* Custom form possibility in renting checkout

= 0.7.1 =
* Templates review
* Better integration with themes

= 0.7.0 =
* Complements:
  * Testimonials
  * Popup
  * Cookies message

= 0.6.1 =
* Renting module
  * FIXED Selector Form -> Family selector 

= 0.6.0 =
* Review for WordPress 5.5.1
* Renting module:
  * Choose product -> Select only one product
* French, German, Italian engine translations

= 0.5.25 =
* Renting module:
  * Countries selector in multiple languages
  * Use of select2 or browser select on countries
  * Product calendar -> Configure sales channel
* Activities module:
  * Fix: Payment with only one payment method
* Translations review in order to match mybooking theme

= 0.5.24 =
* Activities module:
  * Fix: Buy tickets "Book Now"

= 0.5.23 =
* Renting module:
  * Promotion code on complete step
  * Show offer/promotion code discount on renting process pages
* Activities module:
  * Full activity buy (not only tickets) -> Escape Room, Custom tours

= 0.5.22 =
* Renting module:
  * My reservation: Fill driver, additional driver and flight data
* Activities/Appointments module:
  * Allow to pay pending amount

= 0.5.21 =
* Renting:
  * Affiliates integration.
  * My reservation: Fill-in contract data

* Activities/Appointments modules:
  * Search by destination and category (two classifiers)
  * My reservation: Fill-in contract data

= 0.5.20 =
* Appointments/Activities
  * Cancel reservation
  * Terms and conditions link
  * Mybooking/Activity integration : access activity by slug
  * Appointments/Activities search shortcode
* Renting
  * Terms and conditions link
* UX
  * Improve bootstrap modal integration: backdrop

= 0.5.19 =
* Appointments capacity on Activities & Appointments module
* Renting module:
  * Terms and conditions link on complete step
  * Selector wizard: Collection Point & steps title translations

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

= 0.10.0 =
* Renting: Multiple branch offices + password forgotten/change password

= 0.9.0 =
* Renting : Added login/signup customer on complete step + Added reservation engine russian translation

= 0.8.2 =
* Fixed payment method validation when multiple payment methods are available

= 0.8.1 =
* Renting : Avoid edit reservation when in progress / finished + Payment Translations / Not available message

= 0.8.0 =
* Renting Engine Library extension & Key characteristics and characteristics alt text

= 0.7.12 =
* Fixed Reservation Engine Library : Edit selector dates

= 0.7.11 =
* Fixed terms and conditions page and Renting Selector for offers

= 0.7.10 =
* Fixed renting my reservation maxlength issues

= 0.7.9 =
* Contact Form: reCaptcha integration + added attributes

= 0.7.8 =
* Renting date range calendar issues with Google Translate and date range selection

= 0.7.7 =
* Catala translation and Renting module fixes

= 0.7.6 =
* Renting - Avoid creating a reservation if exceeds the Max/Min duration.

= 0.7.5 =
* Renting - Business context translations

= 0.7.4 =
* Fixed reservation engine search specifically delivery/collection dates

= 0.7.3 =
* Fixed themes compatibility on modify reservation form

= 0.7.2 =
* Custom form possibility in renting checkout

= 0.7.1 =
* Templates review and better integration with themes

= 0.7.0 =
* Complements: Testimonials, popup Ads and cookies message

= 0.6.1 =
* Fix: Renting Selector Form family selector

= 0.6.0 =
* Review for WordPress 5.5.1 + Renting module improvements + IT|FR|DE engine translations

= 0.5.25 =
* Fix: Activities payment with only one payment method and countries selector

= 0.5.24 =
* Fix: Buy tickets "Book Now"

= 0.5.23 =
* Promotion code on renting and full activity buy

= 0.5.22 =
* Fill-in contract data and activities allow pay pending amount.

= 0.5.21 =
* Affiliates, filters and fill-in my reservation data.

= 0.5.20 =
* Terms and conditions link and improve appointments integration

= 0.5.19 =
* Appointments capacity on Activities & Appointments module

= 0.5.18 =
* Better themes integration and completed translations to Spanish

= 0.5.17 =
* JS Engine Library: complete and product calendar

= 0.5.16 =
* First release
