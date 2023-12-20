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

      $family_id = null;
      $key_characteristic_1 = null;
      $key_characteristic_2 = null;
      $key_characteristic_3 = null;
      $key_characteristic_4 = null;
      $key_characteristic_5 = null;
      $key_characteristic_6 = null;
      $price_range = null;

      // Get the query parameter
      if ( isset( $_GET[ 'products_wponce'] ) && wp_verify_nonce( $_GET['products_wponce'], 'products_list' ) ) {

        // Family
        if ( isset( $_GET[ 'family_id'] ) ) {
          $family_id = filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT);
        }

        // Key characteristics
        if ( isset( $_GET[ 'key_characteristic_1'] ) ) {
          $key_characteristic_1 = filter_input(INPUT_GET, 'key_characteristic_1', FILTER_VALIDATE_INT);
        }
        if ( isset( $_GET[ 'key_characteristic_2'] ) ) {
          $key_characteristic_2 = filter_input(INPUT_GET, 'key_characteristic_2', FILTER_VALIDATE_INT);
        }
        if ( isset( $_GET[ 'key_characteristic_3'] ) ) {
          $key_characteristic_3 = filter_input(INPUT_GET, 'key_characteristic_3', FILTER_VALIDATE_INT);
        }
        if ( isset( $_GET[ 'key_characteristic_4'] ) ) {
          $key_characteristic_4 = filter_input(INPUT_GET, 'key_characteristic_4', FILTER_VALIDATE_INT);
        }
        if ( isset( $_GET[ 'key_characteristic_5'] ) ) {
          $key_characteristic_5 = filter_input(INPUT_GET, 'key_characteristic_5', FILTER_VALIDATE_INT);
        }                
        if ( isset( $_GET[ 'key_characteristic_6'] ) ) {
          $key_characteristic_6 = filter_input(INPUT_GET, 'key_characteristic_6', FILTER_VALIDATE_INT);
        }

        // Price range
        if ( isset( $_GET[ 'price_range'] ) ) {
          $price_range = filter_input(INPUT_GET, 'price_range', FILTER_VALIDATE_REGEXP,
                                      array("options" => array("regexp" => "/^[0-9]+-?[0-9]+?$/" )));
        }

      }

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

      $destination_id = null;
      $family_id = null;
      $q = '';
      
      // Get the query parameter
      if ( isset( $_GET[ 'activities_wponce'] ) && wp_verify_nonce( $_GET['activities_wponce'], 'activities_list' ) ) {
        // Destination         
        if ( isset( $_GET[ 'destination_id'] ) ) {
          $destination_id = filter_input(INPUT_GET, 'destination_id', FILTER_VALIDATE_INT);
        }
        // Family
        if ( isset( $_GET[ 'family_id'] ) ) {
          $family_id = filter_input(INPUT_GET, 'family_id', FILTER_VALIDATE_INT);
        }
        // Query
        if ( isset( $_GET[ 'q'] ) ) {
          $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_ENCODED);
        }
      }

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