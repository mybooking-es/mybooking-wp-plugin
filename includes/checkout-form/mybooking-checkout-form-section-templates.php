<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Section template catalog for the checkout form builder.
 *
 * Returns an array of templates, each with a title_preset and rows of field keys.
 * No translated labels are stored here — labels are resolved at render time via
 * mybooking_checkout_form_section_title_presets() and mybooking_checkout_form_fields().
 *
 * No template_id is ever persisted in the checkout config: inserted sections become
 * ordinary config sections immediately.
 */
if ( ! function_exists( 'mybooking_checkout_form_section_templates' ) ) {
  function mybooking_checkout_form_section_templates() {
    return [

      'customer_details' => [
        'title_preset' => 'customer_details',
        'rows'         => [
          [ 'customer_name',          'customer_surname'     ],
          [ 'customer_email',         'confirm_customer_email' ],
          [ 'customer_phone',         'customer_mobile_phone' ],
        ],
      ],

      'customer_address' => [
        'title_preset' => 'customer_address',
        'rows'         => [
          [ 'street',  'number' ],
          [ 'complement' ],
          [ 'city',    'state'  ],
          [ 'country', 'zip'    ],
        ],
      ],

      'arrival_flight' => [
        'title_preset' => 'arrival_flight',
        'rows'         => [
          [ 'fligth_airport_origin', 'flight_company' ],
          [ 'flight_number',         'flight_time'    ],
        ],
      ],

      'departure_flight' => [
        'title_preset' => 'departure_flight',
        'rows'         => [
          [ 'fligth_airport_destination', 'flight_company_departure'   ],
          [ 'flight_number_departure',    'flight_time_departura'      ],
        ],
      ],

      'driver_details' => [
        'title_preset' => 'driver_details',
        'rows'         => [
          [ 'driver_name',                       'driver_surname'                        ],
          [ 'driver_document_id',                'driver_date_of_birth'                  ],
          [ 'driver_driving_license_number',     'driver_driving_license_date'           ],
          [ 'driver_driving_license_country',    'driver_driving_license_expiration_date' ],
        ],
      ],

      'additional_driver_1' => [
        'title_preset' => 'additional_driver_1',
        'rows'         => [
          [ 'additional_driver_1_name',                       'additional_driver_1_surname'                        ],
          [ 'additional_driver_1_document_id',                'additional_driver_1_date_of_birth'                  ],
          [ 'additional_driver_1_driving_license_number',     'additional_driver_1_driving_license_date'           ],
          [ 'additional_driver_1_driving_license_country',    'additional_driver_1_driving_license_expiration_date' ],
        ],
      ],

      'additional_driver_2' => [
        'title_preset' => 'additional_driver_2',
        'rows'         => [
          [ 'additional_driver_2_name',                       'additional_driver_2_surname'                        ],
          [ 'additional_driver_2_document_id',                'additional_driver_2_date_of_birth'                  ],
          [ 'additional_driver_2_driving_license_number',     'additional_driver_2_driving_license_date'           ],
          [ 'additional_driver_2_driving_license_country',    'additional_driver_2_driving_license_expiration_date' ],
        ],
      ],

      'additional_information' => [
        'title_preset' => 'additional_information',
        'rows'         => [
          [ 'comments' ],
        ],
      ],

    ];
  }
}
