# Changelog

## [0.5.20]

### Added

- Activities/Appointments module:
  - Terms and conditions link
  - One or multiple items reservation
  - Adjust product cards css/style
  - Access activity/appointment calendar page by slug
  - Cancel reservation
  - Activities search

### Fixed

- Activities/Appointments module:
  - Activities Api: Error management when then activity is not found by id or slug
  - Shopping cart/Summary/Reservation. Show empty photo if it does not exist
- Renting module
  - Products Api: Error management when then activity is not found by id or slug

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