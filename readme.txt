=== MyBooking Reservation Engine ===
Donate link: https://mybooking.es/
Tags: online booking system, booking system, online booking engine, booking engine, car rental reservation
Requires at least: 5.2
Tested up to: 6.6
Stable tag: 2.3.8
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mybooking Reservation Engine WordPress plugin. 

== Description ==

Mybooking Reservation Engine WordPress plugin is designed for your vehicle, boats, properties or material rental. 
It also can be used for accommodation, transfers or tour and activities business. 

It's easy to use and very powerful. You can manage offers, promotion codes and connect a payment gateway to charge
for your reservations. You can insert a search widget on your home page to start the reservation process. You can
also include a calendar in each of your products pages.

This plugin provides a booking engine frontend in your Wordpress site connecting to your mybooking account.

It is very easy to set up:
 
- Create your products and prices on your mybooking account.
- Install and configure the plugin on your Wordpress website.
- Start receiving and charging reservations.

It has three modules for different reservation needs:

- Renting/Accommation
- Activities/Appointments
- Transfer

The reservation engine includes:

- Search widgets to start the reservation process
- Calendar shortcodes to add a calendar to your product page
- Language context adapted to the different business
- Prices by hours and days (defined on your mybooking account)
- Prices by seasons (defined on your mybooking account)
- Offers (defined on your mybooking account)
- Promotion Code (defined on your mybooking accoount)
- Stop sales (defined on your mybooking account)
- Min and max reservation duration (defined on your mybooking account)
- Calendar to define delivery and collection times (defined on your mybooking account)
- Payment gateway connection. Paypal, Redsys and Addon Payments

The reservation engine can be used for the following businesses:

- Vehicles rental (car rental, autocaravanning, motorcycle, scooters, bike)
- Boats rental
- Properties rental
- Sports material rental (Kayak, surf, paddle surf)
- Accommodation (hostels and hotels)
- Sport courts
- Coworking
- Escape Rooms
- Activities
- Tours
- Appointments
- Transfers

Notes:

- The plugin does not use iframes to build the reservation process. It works directly on your Wordpress installation.
- It is ready to use in any theme. But you can customize the components to match your website look and feel

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Mybooking screen to configure the plugin

A mybooking account is required. The plugin connects to mybooking API to get product availability and prices
and to perform the checkout process. Please visit <a href="http://mybooking.es/en">mybooking.es</a>

== Frequently Asked Questions ==

= How does it work? =

You can think of Wordpress as the frontend and <a href="https://mybooking.es/en">Mybooking</a> as the backend.
You manage your products, prices and availability from within Mybooking and use Wordpress to allow your customers
to make reservations.

= Is it SEO friendly? =

We do not use iframes. All the reservation steps are built with regular pages with shortcodes

= Can I use the plugin to sell an activity/tours ? =

Yes, there is activity shortcode that you can insert in your activity page to show availability and 
sell activity/tour tickets.

= Does it connect to payment gateways? =

Yes, mybooking plugin can connect to Paypal, Redsys, Payment Addons, Cecebank and Transbank WebPay

== Screenshots ==

1. Renting/accommodation search widget
2. Renting/accommodation select page
3. Renting/accommodation checkout page
4. Renting/accommodation checkout page / payment
5. Renting/accommodation summary page
6. Renting/accommodation product calendar component
7. Tours/appointments calendar component
8. Tours/appointments checkout page
9. Tours/appointments checkout page / payment
10. Tours/appointments summary page
11. Transfer search widget
12. Transfer choose vehicle page
13. Transfer checkout page
14. Transfer summary page

== Changelog ==

= 2.3.8 =
* New :  My reservation - Hospedajes and alquileres de vehiculos required fields

= 2.3.7 =
* New :  Renting choose product - Reduced card + Filters + Progressive loading + selector styles

= 2.3.6 =
* New :  Franchise and deposit management

= 2.3.5 =
* Fixed : My reservation - Payment texts

= 2.3.4 =
* Fixed : Setup permalink on websites without translation plugin

= 2.3.3 =
* Fixed : My reservation : Select2 null fields error on update

= 2.3.2 =
* Fixed : My reservation - Select2 error in list structure fixed

= 2.3.1 =
* Fixed : My reservation - Fix customer phone prefix 

= 2.3.0 =
* New : My reservation - Form validation and electronic management integration 

= 2.2.11 =
* Fixed: Modify dates - Preload durations
* New : Shift picker component - Setup minimun units

= 2.2.10 =
* Fixed: Checkout - Multiple products table with no price option
* Fixed: Planning - Reservations that start before first date
* Fixed: Selector - Driver age literal translation

= 2.2.9 =
* Fixed: Checkout - Duration hours/days based on extra duration

= 2.2.8 =
* New: Improve checkout process allowing customization

= 2.2.7 =
* Fixed: Checkout, Summary, My reservation - Product details not shown

= 2.2.6 =
* Fixed: Selector with rental location and duration - rental_location_code param was not used

= 2.2.5 =
* Fixed: Product calendar min days check on select dates

= 2.2.4 =
* Fixed: Product calendar min days warning message

= 2.2.3 =
* New: Product calendar performance_id shortcode parameter

= 2.2.2 =
* Fixed: Product calendar without performances just allowed to select one day

= 2.2.1 =
* Fixed: Progressive loading of search results

= 2.2.0 =
* New: Complete form : Validate of radio controls - element placement
* New: Renting optimization by avoiding one API call to get settings
* New: Shortcode products add new parameter to show a sublist of products
* Updated: Selector form : Literal for Estimated time of arrival
* Fixed: Product list shortcode : Take into account that external_detail_url can be empty if edited in the UI

= 2.1.0 =
* Fixed: Product Calendar column fixed on iOS
* Fixed: Rent Selector - Date and duration. Duration was not activated on select date

= 2.0.1 =
* Added: Extra code on select product
* Fixed: Fixed simple_location_id in modify reservation
* Fixed error in product gallery buttons
* Fixed duration errors in modify selector
* Fixed detail loader in preset values calendar and cell width error
* Detail page error fixed

= 2.0.0 =
* Added: Onboarding
* Added: Reservation process templates review

= 1.10.5 =
* Fixed: Renting - Promotion code 100% allow request reservation

= 1.10.4 =
* Fixed: Renting - Extras availability

= 1.10.3 =
* Fixed: Renting - Complete - Country
* Fixed: Renting - Reservation - Template
* Added: Renting - Selector Wizard driver age
* Added: Contact - Privacy policy
* Added: Checkout - Privacy policy

= 1.10.2 =
* Fixed: Renting - Calendar - Preselection when collection different month
* Added: Renting - Selector driver age
* Added: Renting - My reservation expiration dates

= 1.10.1 =
* Added: Renting - Boat skipper and license management
* Added: Renting - Shift picker component

= 1.10.0 =
* Added: Renting - Simple Location
* Fixed: Renting - Select product - Variants : Price in modal
* Fixed: Renting - My reservation - Passengers validation
* Fixed: Renting - My reservation update with resources
* Fixed: Activities - My reservation update with resources
* Fixed: Renting - Summary and My reservation - Do not show offer is price is higher

= 1.9.0 =
* Added: Renting - My reservation - Passengers
* Fixed: Login : Encode URI component for special characters
* Fixed: Renting - Password forgotten
* Added: Renting - Choose product category filter arguments
* Fixed: Renting - Planning
* Fixed: Renting - Variants translations
* Fixed: Renting - Selector when clear starting date
* Added: Renting - Products shortcode add filter attributes
* Fixed: Activities multiple dates and one time selector

= 1.8.5 =
* Fixed: Renting - Selector with pickup places and not pickup time

= 1.8.4 =
* Fixed: Renting - Duration selector without pickup time

= 1.8.3 =
* Fixed: Activities components

= 1.8.2 =
* Fixed: Renting - Planning and Weekly planning shortcodes preview on Elementor

= 1.8.1 =
* Fixed: Renting - Product calendar load dates

= 1.8.0 =
* Added: Renting - Product variants
* Added: Renting - Occupation Planning
* Added: Renting - Week planning with reservation
* Fixed: Renting - Modify reservation dates when duration time_from was not showing

= 1.7.1 =
* Added: Renting select product - Hide price if not available control
* Fixed: Renting duration hours and minutes management on selector

= 1.7.0 =
* Fixed: CSS Fixes + Complete reservation pay on delivery
* Fixed: Renting update reservation form on update
* Fixed: Customer telephone prefix : Use company custom code
* Fixed: Sign contract integration
* Fixed+Enhanced: Styles and themes integration
* Fixed: Select2 selector
* Fixed: Product Calendar: Rental location rental_location_code attribute do not show selector
* Added: Product calendar: Filter rental locations and delivery places based on product availability
* Fixed: Added missing paid and pending amount in Summary page
* Added: Renting select product - Go to detail page instead of complete
* Added: Renting complete - Slot and skipper
* Added: Renting my reservation - Sign contract
* Added: Renting my reservation - Additional drivers

= 1.6.0 =
* Product Calendar: Show only one month
* Product Calendar: Show selected period
* Product Calendar: Show rental location selector
* Fixed Activity summary and order : Do not reload the page based on the customer language
* Fixed styles for Twenty Twenty Two theme
* Fixed Renting: Calendar availability and min days

= 1.5.2 =
* Fixed Manage duplicate Tabs on iPhone and iPad

= 1.5.1 =
* Added AgentId extraction outside renting selector
* Fixed Manage duplicate Tabs during the renting reservation process
* Fixed Renting: Manage stock not available when creating renting reservation
* Fixed Avoid double click on create reservation form
* Fixed Apply promotion code in renting complete step

= 1.5.0 =
* Fixed renting calendar widget: Use rental location when loading turns
* Fixed renting calendar widget: Show not available turns in red
* Fixed renting calendar widget : Holiday days + delivery/collection applicable hours
* Fixed renting/activities my reservation : Select between two payment methods
* Fixed Activities templates (shopping cart and my reservation) : Payment method

= 1.4.1 =
* Fixed Renting Calendar Widget : multiple dates

= 1.4.0 =
* Renting Duration : Selector, choose product, complete, summary and my reservation
* Renting Calendar Widget : Turns and duration scope (in one day or days)

= 1.3.2 =
* Renting Calendar Widget : Check daily occupation
* Fixed CPT Product Slider on PHP < 7.3

= 1.3.1 =
* Renting Complete : Show deposit when no supplements
* Renting Calendar Widget : Fixed container style

= 1.3.0 =
* Renting Selector : Include fixed category code
* Renting Product Calendar: Show daily price + min days + Start on first available date
* Activity calendar: Start on first available date
* Fixed phone prefix default country get from document and navigator
* Added CPT : Product Slider and Content Slider

= 1.2.0 =
* Fixed: Ms Edge get current page language

= 1.1.1 =
* Added Renting Checkout Form : Phone dial code
* Added Activities Checkout Form : Phone dial code
* Added Transfer Checkout Form : Phone dial code
* Transfer Module: Autocomplete destination point

= 1.1.0 =
* Added Transfer: Supplements
* Added Transfer: Billing Address
* Added Renting: Product External URL Link
* Fixed Renting: Product/Extra modal layout

= 1.0.2 =
* Fixed Renting: Calendar colors
* Added Renting: Customize product cards

= 1.0.1 =
* Fixed Renting: My reservation when no reservation form
* Added: Vertical layout to selector widgets and shortcodes

= 1.0.0 =
* Added Transfer
* Improved themes compatibility

= 0.12.0 =
* Added Renting: Customer type (individual/company)
* Added Renting: Manage renting setup without prices + Customer classifier
* Fixed Renting: Summary/My Reservation - User customer full name
* Fixed Renting: Product Calendar - occupation when multiple rental locations

= 0.11.1 =
* Fixed Activities: Cyclic calendar prior dates style

= 0.11.0 =
* Added Renting: Product search => Price range
* Fixed Renting: Complete => Summary link with query string append id
* Fixed Renting: Complete => Extra country fields selector
* Fixed Activities: Multiple payment methods

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

= 2.3.8 =
* New :  My reservation - Hospedajes and alquileres de vehiculos required fields

= 2.3.7 =
* New :  Renting choose product - Reduced card + Filters + Progressive loading + selector styles

= 2.3.6 =
* New :  Franchise and deposit management

= 2.3.5 =
* Fixed : My reservation - Payment texts

= 2.3.4 =
* Fixed : Setup permalink on websites without translation plugin

= 2.3.3 =
* Fixed : My reservation : Select2 null fields error on update

= 2.3.2 =
* Fixed : My reservation - Select2 error in list structure fixed

= 2.3.1 =
* Fixed : My reservation - Fix customer phone prefix 

= 2.3.0 =
* New : My reservation - Form validation and electronic management integration 

= 2.2.11 =
* Fixed: Modify dates - Preload durations + New : Shift picker minimun units

= 2.2.10 =
* Fixed: Checkout - Multiple products table with no price option

= 2.2.9 =
* Fixed: Checkout - Duration hours/days based on extra duration

= 2.2.8 =
* New: Improve checkout process allowing customization

= 2.2.7 =
* Fixed: Checkout, Summary, My reservation - Product details not shown

= 2.2.6 =
* Fixed: Selector with rental location and duration - rental_location_code param was not used

= 2.2.5 =
* Fixed: Product calendar min days check on select dates

= 2.2.4 =
* Fixed: Product calendar min days warning message

= 2.2.3 =
* New: Product calendar performance_id shortcode parameter

= 2.2.2 =
* Fixed: Product calendar without performances just allowed to select one day

= 2.2.1 =
* Fixed: Progressive loading of search results

= 2.2.0 =
* New: Fixes and improvements for rental module

= 2.1.0 =
* Fixed: Rent Selector - Date and duration. Duration was not activated on select date + Fixed columns width on iOS

= 2.0.1 =
* Fixed: Renting selector and modify reservation selector issues

= 2.0.0 =
* Added: Onboarding + review reservation process templates

= 1.10.5 =
* Fixed: Renting - Promotion code 100% allow request reservation

= 1.10.4 =
* Fixed: Renting - Extras availability

= 1.10.3 =
* Fixed: Renting - Complete - Country + Reservation template + Privacy Policy + Selector wizard driver age

= 1.10.2 =
* Fixed: Renting - Calendar - Preselection when collection different month + New driver age and expiration date

= 1.10.1 =
* Renting : Added Boat skipper and license management + shift picker component

= 1.10.0 =
* Renting/Activities : Variants, simple location, passengers, customer data

= 1.9.0 =
* Fixed: - Login and review Renting reservation process + activities multiple dates and one time + Added passengers

= 1.8.5 =
* Fixed: Renting - Selector with pickup places and not pickup time

= 1.8.4 =
* Fixed: Renting - Duration selector without pickup time

= 1.8.3 =
* Fixed: Activities components

= 1.8.2 =
* Fixed: Renting - Planning and Weekly planning shortcodes preview on Elementor

= 1.8.1 =
* Fixed: Renting - Product calendar load dates

= 1.8.0 =
* Added: Renting - Product variants + Planning + Week planning + Fixes modify reservation dates

= 1.7.1 =
* Added: Renting select product - Hide price if not available control

= 1.7.0 =
* Fixed: CSS Fixes + Enhances including customer phone prefix + Improve reservation renting process

= 1.6.0 =
* Fixed styles, activity summary and renting product calendar improvement

= 1.5.2 =
* Fixed Manage duplicate Tabs on iPhone and iPad

= 1.5.1 =
* Fixed renting process : duplicateTab and not available stock response on create new reservation

= 1.5.0 =
* Fixed renting calendar widget + renting/activities my reservation (payment methods)

= 1.4.1 =
* Fixed Renting Calendar Widget : multiple dates

= 1.4.0 =
* Renting Duration and Renting Calendar Widget : Turns and duration scope (in one day or days)

= 1.3.2 =
* Renting Calendar Widget : Check daily occupation

= 1.3.1 =
* Renting Complete and Calendar Widget : Fixed UI

= 1.3.0 =
* Renting Selector : Include fixed category code + Fixed phone prefix default country + Added CPT Sliders + Product Calendar + Activity calendar

= 1.2.0 =
* Fixed: Ms Edge get current page language

= 1.1.1 =
* Added Renting, Activities, Transfer : Phone dial code. Autocomplete transfer selector

= 1.1.0 =
* Added Transfer: Supplements + Billing address / Renting: Product/Extra detailed info

= 1.0.2 =
* Fixed Renting: Calendar colors + Customize product cards

= 1.0.1 =
* Fixed Renting: My reservation when no reservation form + Added vertical layout to selector widgets and shortcodes

= 1.0.0 =
* Added Transfer module and improved themes compatibility

= 0.12.0 =
* Added Renting: Customer type (individual/company) + Fixes on Summary and My Reservation using customer full name + Manage setup with no prices + customer classifier

= 0.11.1 =
* Fixed Activities: Cyclic calendar prior dates style

= 0.11.0 =
* Fixes on renting complete step and activities with multiple payment methods

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
