<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Section title preset catalog for the checkout form builder.
 *
 * Returns resolved strings for the current admin locale via _x().
 * Keys are stable identifiers stored in config; never store the resolved string.
 *
 * Legacy presets (P1-P3): context checkout_form_section_title
 * New presets  (P3.1+):   context checkout_form_builder
 * Domain: mybooking-reservation-engine
 */
function mybooking_checkout_form_section_title_presets() {
  return [
    // Legacy presets (checkout_form_section_title context)
    'customer_details'       => _x( "Customer's details",    'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'customer_address'       => _x( 'Customer address',       'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'arrival_flight'         => _x( 'Arrival flight',         'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'departure_flight'       => _x( 'Departure flight',       'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'driver_details'         => _x( 'Driver details',         'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_driver_1'    => _x( 'Additional driver 1',    'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_driver_2'    => _x( 'Additional driver 2',    'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_information' => _x( 'Additional information', 'checkout_form_section_title', 'mybooking-reservation-engine' ),

    // New presets P3.1+ (checkout_form_builder context)
    'customer_classification'   => _x( 'Customer classification',  'checkout_form_builder', 'mybooking-reservation-engine' ),
    'customer_identity'         => _x( 'Customer identity',        'checkout_form_builder', 'mybooking-reservation-engine' ),
    'company_details'           => _x( 'Company details',          'checkout_form_builder', 'mybooking-reservation-engine' ),
    'accommodation_details'     => _x( 'Accommodation details',    'checkout_form_builder', 'mybooking-reservation-engine' ),
    'driver_identity'           => _x( 'Driver identity',          'checkout_form_builder', 'mybooking-reservation-engine' ),
    'driver_address'            => _x( 'Driver address',           'checkout_form_builder', 'mybooking-reservation-engine' ),
    'license_permit_number'     => _x( 'License / permit number',  'checkout_form_builder', 'mybooking-reservation-engine' ),
    'driver_license'            => _x( 'Driver license',           'checkout_form_builder', 'mybooking-reservation-engine' ),
    'skipper_navigation'        => _x( 'Skipper / navigation',     'checkout_form_builder', 'mybooking-reservation-engine' ),
    'activity_customer_vehicle' => _x( 'Activity customer vehicle','checkout_form_builder', 'mybooking-reservation-engine' ),
    'transfer_outbound_details' => _x( 'Transfer outbound details','checkout_form_builder', 'mybooking-reservation-engine' ),
    'transfer_return_details'   => _x( 'Transfer return details',  'checkout_form_builder', 'mybooking-reservation-engine' ),
  ];
}

function mybooking_checkout_form_section_title_preset_keys() {
  return array_keys( mybooking_checkout_form_section_title_presets() );
}

/**
 * Known translations of "Customer's details" across all supported locales.
 * Used by the normalizer to migrate legacy string titles to preset schema.
 */
function mybooking_checkout_form_customer_details_strings() {
  return [
    "Customer's details",
    "Dades del client",
    "Kundendaten",
    "Datos del cliente",
    "Kliendi andmed",
    "Asiakkaan tiedot",
    "Informations du client",
    "Dati del cliente",
    "Klantgegevens",
    "Dane klienta",
    "Dados do cliente",
    "Данные клиента",
  ];
}
