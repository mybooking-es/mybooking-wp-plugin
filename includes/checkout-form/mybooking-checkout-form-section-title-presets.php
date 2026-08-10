<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Section title preset catalog for the checkout form builder.
 *
 * Returns resolved strings for the current admin locale via _x().
 * Keys are stable identifiers stored in config; never store the resolved string.
 *
 * Context: checkout_form_section_title
 * Domain:  mybooking-reservation-engine
 */
function mybooking_checkout_form_section_title_presets() {
  return [
    'customer_details'       => _x( "Customer's details",   'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'customer_address'       => _x( 'Customer address',      'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'arrival_flight'         => _x( 'Arrival flight',        'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'departure_flight'       => _x( 'Departure flight',      'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'driver_details'         => _x( 'Driver details',        'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_driver_1'    => _x( 'Additional driver 1',   'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_driver_2'    => _x( 'Additional driver 2',   'checkout_form_section_title', 'mybooking-reservation-engine' ),
    'additional_information' => _x( 'Additional information','checkout_form_section_title', 'mybooking-reservation-engine' ),
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
