# Changelog

## [1.3.2]

### Added

- Product calendar check hourly occupation

## [1.3.1]

### Fixed

- Renting Complete: Show deposit when no supplements
- Renting Calendar Widget: Container style

## [1.3.0]

### Fixed

- Phone Prefix default Country was not working in some scenarios

### Added

- Renting Selector : Fixed Category Code
- New CPT : Product Slider + Content Slider
- Product Calendar: Show prices and min days + Start calendar on first date
- Activity performances: Start calendar on first date

## [1.2.0]

### Added

- Test on 5.9

### Fixed

- Ms Edge get current page language

## [1.1.1]

### Added

- Renting Checkout Form : Phone dial code
- Activities Checkout Form : Phone dial code
- Transfer Checkout Form : Phone dial code
- Transfer Selector : Autocomplete destination points

## [1.1.0]

### Added

- Transfer supplements
- Transfer billing address => Payment integration

### Fixed

- Product detail: Show gallery + info
- Extra detail: Show gallery + info

## [1.0.2]

### Fixed

- Removed Font awesome
- Calendar styles
- Customize product cards

## [1.0.1]

### Added

- Vertical layout to Selector widgets and shortcodes

### Fixed

- Renting my reservation when no reservation form

## [1.0.0]

### Added

- Transfer process

### Updated

- Theme compatibility : Removed Bootstrap and fontawesome libraries

## [0.12.0]

### Fixed

- Renting: Product Calendar - Multiple Rental locations occupation
- Renting: Summary and MyReservation - Use customer full name

### Added

- Renting: Complete step - Manage customer type individual/company
- Renting: Manage renting setup without prices: For internal reservations
- Renting: Customer classifier

## [0.11.1]

### Fixed

- Activities: Cyclic calendar dates - prior dates style

## [0.11.0]

### Added

- Product Search (Price range)

### Fixed

- Renting complete reservation: redirect to summary page with query string
- Renting Complete Form: Extra country fields selector
- Activities: Shopping cart multiple payment methods redirect to payment gateway

## [0.10.0]

### Added

- Product Search (for product catalog navigation)
- Profile / Customer
  - Shortcodes for password forgotten and change password
- Multiple branch offices  

### Fixed

- Input custom delivery/collection address
- Mybooking Library Init with JS dependencies

## [0.9.0]

### Added

- Renting
  - Added Login/Signup user on complete reservation data
- Reservation Engine : Russian translation

### Fixed

- Renting
  - Products navigation URL with multi-language
- Activities
  - Activities navigation URL with multi-language

## [0.8.2]

### Fixed

- Renting
  - Fixed payment method validation when multiple methods are available

## [0.8.1]

### Fixed

- Renting
  - French translation
  - Pay on delivery / Pay now literals
  - Avoid editing booking data when renting in progress
  - Not available context: Not available vs Contact by phone

## [0.8.0]

### Added

- Renting
  - Key characteristics and characteristics translations
  - Product navigation by slug instead of code
- Reservation Engine Library : Allow engine extension
- New custom post types to manage catalog of products and activities

## [0.7.12]

### Fixed

- Fixed Reservation Engine Library : Edit selector dates

## [0.7.11]

### Fixed

- Fixed Terms and conditions translated page

### Added

- Renting
  - Selector Form custom control to manage offers

## [0.7.10] 

### Fixed

- Renting
  - Myreservation Form: Fixed maxlength issues

## [0.7.9]

### Fixed

- Selector
  - Datepicker expand clickable area

### Added

- Contact Form 
  - recaptcha integration
  - added subject, source, rental location and sales channel attributes

## [0.7.8]

### Fixed

- Renting calendar
  - Fixed error on dates when Google Translate in active on page
  - Range selector

## [0.7.7]

### Added

- Catala translation

### Fixed

- Renting 
  - Form selector date to disabled when changed return place
- Renting Calendar
  - Next and Previous arrows in a button
- Date selector with Google Translation

## [0.7.6]

### Added

- Renting: Avoid creating a reservation that exceeds the max/min duration both in reservation wizard
  and in calendar widget

## [0.7.5]

### Updated

- Renting : Business context translations

## [0.7.4]

### Fixed

- Renting search specifically delivery/collection date/times
- Renting wizard select form include sales channel code

## [0.7.3]

### Added

- Renting select product: Show info icon
- Caravaning key characteristic icons

### Fixed

- Modify reservation modal : Removed fade for theme compatibility

## [0.7.2]

### Added

- Custom form possibility in renting checkout

## [0.7.1]

### Updated

- MyBooking Templates Review

### Fixed

- Wizard container and modify reservation select dates render is reponsability of the plugin.
  It allows a better integration with themes

## [0.7.0]

### Updated

- Settings
  - Plugin settings now are in a top level menu
  - CSS tab renamed to Advanced

### Added

- Settings
  - New tab Complements for testimonials, popup ads and cookies warning control

## [0.6.1]

### Fixed

- Renting module
  - Select Form family selector

## [0.6.0]

- Review for WordPress 5.5.1

### Added
- Renting module
  - Select Product with only one product

- Translations
  - French translation added
  - German translation added
  - Italian translation added

### Fixed

- Styles:
  - Changed .btn-success to .btn-primary for color coherence
  - Buttons are bigger like theme ones
  - Little tweaks on card elements
  - Realigned lists inside cards

## [0.5.25]

### Fixed

- Activities module
  - Payment setup with only one payment method
- Neve Theme integration on product browser


## [0.5.24]

### Fixed

- Activities module
  - Buy Tickets Fixed

## [0.5.23]

### Added

- Renting module
  - Choose product:
    - Show promotion code discount
  - Complete:
    - Apply promotion code
  - Summary :
    - Show promotion code / offer discount
  - My Reservation
    - Show promotion code / offer discount

- Activities module
  - Buy full activity

## [0.5.22]

### Added

- Renting module:
  - My reservation: Fill driver, additional driver and flight data

- Activities/Appointment module:
  - Pay pending amount.

## [0.5.21]

### Added

- Renting:
  - Affiliates integration.
  - Default start time and end time depending on business configuration
  - My reservation: Fill data
  - Choose products: Multiple products literals and units
  - Boats integration

- Activities/Appointments modules:
  - Search by destination and category (two classifiers)
  - My reservation: Fill data

### Fixed

- Renting:
  - Show promotion code on inline form without pickup place / time

## [0.5.20]

### Added

- Activities/Appointments module:
  - Terms and conditions link
  - One or multiple items reservation
  - Adjust product cards css/style
  - Access activity/appointment calendar page by slug
  - Cancel reservation
  - Activities search
- Renting
  - Selected coverage / extras

### Fixed

- Activities/Appointments module:
  - Activities Api: Error management when then activity is not found by id or slug
  - Shopping cart/Summary/Reservation. Show empty photo if it does not exist
- Renting module
  - Products Api: Error management when then activity is not found by id or slug
- Bootstrap Modal
  - Backdrop compatibility for some themes -> Use backdrop false when showing a modal

## [0.5.19]

### Added

- Renting module
  - Wizard steps title translations
  - Wizard collection point
  - Terms and conditions link
- Activities module (now Activities and Appointments module)
  - Activities module is now Activities and Appointments module.
    Implemented appointments characteristics on Activity module with use_rates and allow_select_places_for_reservation
	- Translations to the activities/appointment module.

## [0.5.18]

### Updated

- Translations
	- Contact form translations
  - Selector wizard

### Fixed

- Better themes integration.
  - Compatibility with themes that overrides bootstrap $.modal (fixed conflict with jquery-modal)
  - Common use of buttons instead of a mix of buttons/input.
  - Review of CSS
- Fontawesome fonts added
- Bootstrap 4.4.1

## [0.5.17]

### Fixed

- Renting module. Complete step. Just pay now (without request reservation) not connecting to payment gateway

### Updated

- Product calendar. JS Library. Single date => Just one month

## [0.5.16]

### Updated

- JS integration. Use of jquery and jquery-ui built in libraries

## [0.5.15]

### Fixed

- Engine support coverage in choose product. Allow uncheck a coverage

## [0.5.14]

### Updated

- Engine to support coverage in choose product

## [0.5.13]

### Updated

- Product calendar : Updated engine library + translations

## [0.5.12]

### Added

- Selector form micro-templates integration. Selector form adapts fields
depending on the instance configuration.

## [0.5.11]

### Fixed

- Use get_queried_object() in order to get the current page in order
  to prepare it for mybooking-js-engine library. (check shortcodes)

## [0.5.10]

### Fixed

- Custom JS and CSS enqueue version adjust : Use get_file_data

## [0.5.9]

### Added

- Custom JS and CSS enqueue version

## [0.5.8]

### Added

- Integration WMPL slugs

## [0.5.7]

### Added

- Renting translations

## [0.5.6]

### Added

- Wizard integration

### Fixed

- Multiple quantities

## [0.5.5]

### Added

- Bootstrap Javascript integration

## [0.5.4]

### Added

- Activities module: Activities Api client
- Activities module: Activities list and pagination shortcode
- Activities module: Activity detail page route

## [0.5.3] 2020-02-10

### Added

- Activities module: Shopping cart new templates
- Activities module: Summary page new templates
- Activities module: Order page shortcode and templates

### Updated

- Reservation Engine JS

## [0.5.2] 2020-02-07

### Fixed

- Storing activities workflow pages in settings. Incorrect name in mybooking_plugin_settings_activities

## [0.5.1] 2020-02-03

### Fixed

- Updated reservation engine. Extract two characters language code from five characters one.
