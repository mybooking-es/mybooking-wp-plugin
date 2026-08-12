<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Section template catalog for the checkout form builder.
 *
 * Returns 20 templates covering all 102 ordinary catalog fields exactly once.
 * Engine specials (slot_time_from, with_optional_external_driver) appear zero times here;
 * they are accessible only via the Custom Section picker.
 *
 * Each template:
 *   title_preset  : key into mybooking_checkout_form_section_title_presets()
 *   parent_group  : UI taxonomy key (not persisted in config, not saved with sections)
 *   rows          : array of rows; each row is an array of 1 or 2 field keys
 *
 * Parent groups (UI only — never written to config):
 *   general | accommodation | driver | vehicles | boats | activities | transfers
 *
 * No template_id is ever persisted in checkout config: inserted sections become
 * ordinary config sections immediately.
 */
if ( ! function_exists( 'mybooking_checkout_form_section_templates' ) ) {
  function mybooking_checkout_form_section_templates() {
    return [

      // ── General ─────────────────────────────────────────────────────────
      'customer_details' => [
        'title_preset' => 'customer_details',
        'parent_group' => 'general',
        'rows'         => [
          [ 'customer_name',          'customer_surname'        ],
          [ 'customer_email',         'confirm_customer_email'  ],
          [ 'customer_phone',         'customer_mobile_phone'   ],
        ],
      ],

      'customer_classification' => [
        'title_preset' => 'customer_classification',
        'parent_group' => 'general',
        'rows'         => [
          [ 'customer_type', 'customer_classifier_id' ],
        ],
      ],

      'customer_identity' => [
        'title_preset' => 'customer_identity',
        'parent_group' => 'general',
        'rows'         => [
          [ 'customer_date_of_birth',       'customer_nacionality'         ],
          [ 'customer_document_id_type_id', 'customer_document_id'         ],
          [ 'customer_origin_country'                                       ],
        ],
      ],

      'company_details' => [
        'title_preset' => 'company_details',
        'parent_group' => 'general',
        'rows'         => [
          [ 'customer_company_name',          'customer_company_contact_name' ],
          [ 'customer_company_document_id'                                    ],
        ],
      ],

      'customer_address' => [
        'title_preset' => 'customer_address',
        'parent_group' => 'general',
        'rows'         => [
          [ 'street',  'number' ],
          [ 'complement'        ],
          [ 'city',    'state'  ],
          [ 'country', 'zip'    ],
        ],
      ],

      'arrival_flight' => [
        'title_preset' => 'arrival_flight',
        'parent_group' => 'general',
        'rows'         => [
          [ 'fligth_airport_origin', 'flight_company' ],
          [ 'flight_number',         'flight_time'    ],
        ],
      ],

      'departure_flight' => [
        'title_preset' => 'departure_flight',
        'parent_group' => 'general',
        'rows'         => [
          [ 'fligth_airport_destination', 'flight_company_departure'   ],
          [ 'flight_number_departure',    'flight_time_departura'      ],
        ],
      ],

      'additional_information' => [
        'title_preset' => 'additional_information',
        'parent_group' => 'general',
        'rows'         => [
          [ 'comments' ],
        ],
      ],

      // ── Accommodation ────────────────────────────────────────────────────
      'accommodation_details' => [
        'title_preset' => 'accommodation_details',
        'parent_group' => 'accommodation',
        'rows'         => [
          [ 'number_of_adults', 'destination_accommodation' ],
        ],
      ],

      // ── Driver / renter ──────────────────────────────────────────────────
      'driver_details' => [
        'title_preset' => 'driver_details',
        'parent_group' => 'driver',
        'rows'         => [
          [ 'driver_name',        'driver_surname'    ],
          [ 'driver_email',       'driver_phone'      ],
          [ 'driver_date_of_birth', 'driver_nacionality' ],
        ],
      ],

      'driver_identity' => [
        'title_preset' => 'driver_identity',
        'parent_group' => 'driver',
        'rows'         => [
          [ 'driver_document_id_type_id', 'driver_document_id'              ],
          [ 'driver_origin_country',      'driver_document_id_date'          ],
          [ 'driver_document_id_expiration_date'                              ],
        ],
      ],

      'driver_address' => [
        'title_preset' => 'driver_address',
        'parent_group' => 'driver',
        'rows'         => [
          [ 'driver_address_street',  'driver_address_number'     ],
          [ 'driver_address_complement'                           ],
          [ 'driver_address_city',    'driver_address_state'      ],
          [ 'driver_address_country', 'driver_address_zip'        ],
        ],
      ],

      'driver_license_number' => [
        'title_preset' => 'license_permit_number',
        'parent_group' => 'driver',
        'rows'         => [
          [ 'driver_driving_license_number' ],
        ],
      ],

      // ── Vehicles ─────────────────────────────────────────────────────────
      'vehicle_driver_license' => [
        'title_preset' => 'driver_license',
        'parent_group' => 'vehicles',
        'rows'         => [
          [ 'driver_driving_license_type_id'                                                ],
          [ 'driver_driving_license_date',       'driver_driving_license_country'           ],
          [ 'driver_driving_license_expiration_date'                                        ],
        ],
      ],

      'additional_driver_1' => [
        'title_preset' => 'additional_driver_1',
        'parent_group' => 'vehicles',
        'rows'         => [
          [ 'additional_driver_1_name',                          'additional_driver_1_surname'                        ],
          [ 'additional_driver_1_nacionality',                   'additional_driver_1_date_of_birth'                  ],
          [ 'additional_driver_1_document_id_type_id',           'additional_driver_1_document_id'                    ],
          [ 'additional_driver_1_origin_country',                'additional_driver_1_document_id_date'               ],
          [ 'additional_driver_1_document_id_expiration_date'                                                         ],
          [ 'additional_driver_1_driving_license_type_id',       'additional_driver_1_driving_license_number'         ],
          [ 'additional_driver_1_driving_license_date',          'additional_driver_1_driving_license_country'        ],
          [ 'additional_driver_1_driving_license_expiration_date'                                                      ],
        ],
      ],

      'additional_driver_2' => [
        'title_preset' => 'additional_driver_2',
        'parent_group' => 'vehicles',
        'rows'         => [
          [ 'additional_driver_2_name',                          'additional_driver_2_surname'                        ],
          [ 'additional_driver_2_nacionality',                   'additional_driver_2_date_of_birth'                  ],
          [ 'additional_driver_2_document_id_type_id',           'additional_driver_2_document_id'                    ],
          [ 'additional_driver_2_origin_country',                'additional_driver_2_document_id_date'               ],
          [ 'additional_driver_2_document_id_expiration_date'                                                         ],
          [ 'additional_driver_2_driving_license_type_id',       'additional_driver_2_driving_license_number'         ],
          [ 'additional_driver_2_driving_license_date',          'additional_driver_2_driving_license_country'        ],
          [ 'additional_driver_2_driving_license_expiration_date'                                                      ],
        ],
      ],

      // ── Boats / skipper ──────────────────────────────────────────────────
      'skipper_navigation' => [
        'title_preset' => 'skipper_navigation',
        'parent_group' => 'boats',
        'rows'         => [
          [ 'driver_driving_license_type' ],
        ],
      ],

      // ── Activities ───────────────────────────────────────────────────────
      'activity_customer_vehicle' => [
        'title_preset' => 'activity_customer_vehicle',
        'parent_group' => 'activities',
        'rows'         => [
          [ 'customer_stock_brand', 'customer_stock_model' ],
          [ 'customer_stock_plate', 'customer_stock_color' ],
        ],
      ],

      // ── Transfers ────────────────────────────────────────────────────────
      'transfer_outbound_details' => [
        'title_preset' => 'transfer_outbound_details',
        'parent_group' => 'transfers',
        'rows'         => [
          [ 'detailed_origin_address'                                                       ],
          [ 'detailed_origin_flight_number',      'detailed_origin_flight_estimated_time'  ],
          [ 'detailed_destination_address'                                                  ],
          [ 'detailed_destination_flight_number', 'detailed_destination_flight_estimated_time' ],
        ],
      ],

      'transfer_return_details' => [
        'title_preset' => 'transfer_return_details',
        'parent_group' => 'transfers',
        'rows'         => [
          [ 'detailed_return_origin_address'                                                          ],
          [ 'detailed_return_origin_flight_number',      'detailed_return_origin_flight_estimated_time'  ],
          [ 'detailed_return_destination_address'                                                     ],
          [ 'detailed_return_destination_flight_number', 'detailed_return_destination_flight_estimated_time' ],
        ],
      ],

    ];
  }
}
