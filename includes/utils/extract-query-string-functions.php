<?php
    /**
     * Extract Query String parameters for products
     *
     * @returns [Array] with the following elements:
     *
     *  - family_id
     *  - key_characteristic_1
     *  - key_characteristic_2
     *  - key_characteristic_3
     *  - key_characteristic_4
     *  - key_characteristic_5
     *  - key_characteristic_6
     *
     */
    function mybooking_engine_products_extract_query_string() {

      // Get the query parameter
      $family_id = array_key_exists('family_id', $_GET) ? filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT) : null;
      $key_characteristic_1 = array_key_exists('key_characteristic_1', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_1', FILTER_VALIDATE_INT) : null;
      $key_characteristic_2 = array_key_exists('key_characteristic_2', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_2', FILTER_VALIDATE_INT) : null;
      $key_characteristic_3 = array_key_exists('key_characteristic_3', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_3', FILTER_VALIDATE_INT) : null;
      $key_characteristic_4 = array_key_exists('key_characteristic_4', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_4', FILTER_VALIDATE_INT) : null;
      $key_characteristic_5 = array_key_exists('key_characteristic_5', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_5', FILTER_VALIDATE_INT) : null;
      $key_characteristic_6 = array_key_exists('key_characteristic_6', $_GET) ? filter_input(INPUT_GET, 'key_characteristic_6', FILTER_VALIDATE_INT) : null;
      $price_range = array_key_exists('price_range', $_GET) ? filter_input(INPUT_GET, 'price_range', FILTER_VALIDATE_REGEXP,
        array("options" => array("regexp" => "/^[0-9]+-?[0-9]+?$/" ))) : null;
      // Build the result
      $data = array( );
      if ( !empty($family_id) ) {
        $data['family_id'] = $family_id;
      }
      if ( !empty($key_characteristic_1) ) {
        $data['key_characteristic_1'] = $key_characteristic_1;
      }
      if ( !empty($key_characteristic_2) ) {
        $data['key_characteristic_2'] = $key_characteristic_2;
      }
      if ( !empty($key_characteristic_3) ) {
        $data['key_characteristic_3'] = $key_characteristic_3;
      }
      if ( !empty($key_characteristic_4) ) {
        $data['key_characteristic_4'] = $key_characteristic_4;
      }
      if ( !empty($key_characteristic_5) ) {
        $data['key_characteristic_5'] = $key_characteristic_5;
      }
      if ( !empty($key_characteristic_6) ) {
        $data['key_characteristic_6'] = $key_characteristic_6;
      }
      if ( !empty($price_range) ) {
        $data['price_range'] = $price_range;
      }

      return $data;

    }

    /**
     * Extract Query String parameters for activities
     *
     * @returns [Array] with the following elements:
     *
     *  - destination_id
     *  - family_id
     *  - q
     *
     */
    function mybooking_engine_activities_extract_query_string() {

      // Get the query parameter
      $destination_id = array_key_exists('destination_id', $_GET) ? filter_input(INPUT_GET, 'destination_id', FILTER_VALIDATE_INT) : null;
      $family_id = array_key_exists('family_id', $_GET) ? filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT) : null;
      $q = array_key_exists('q', $_GET) ? filter_input(INPUT_GET, 'q', FILTER_SANITIZE_ENCODED) : '';
      // Build the result
      $data = array( 'q' => urldecode($q) );
      if ( !empty($family_id) ) {
        $data['family_id'] = $family_id;
      }
      if ( !empty($destination_id) ) {
        $data['destination_id'] = $destination_id;
      }

      return $data;

    }