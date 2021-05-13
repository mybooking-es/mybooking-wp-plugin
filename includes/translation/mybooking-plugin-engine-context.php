<?php
  /**
   * Mybooking Engine context
   */
  class MyBookingEngineContext
  {

    /**
     * Stores the translation object instance
     * 
     * @var MyBookingTranslationContext
     */
    private static $_instance = null;

    /**
     * Get the instance
     * 
     * @return void
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    /**
     * Get default language code
     * 
     * Take into account if it is configured Polylang or WPML
     *
     */
    public function getDefaultLanguageCode() {

      $language = get_bloginfo("language");

      // Polylang is active
      if ( function_exists('pll_default_language') ) {
        $language = pll_default_language();
      }
      // WPML is active
      else if ( function_exists('icl_object_id') ) {
        $language = apply_filters( 'wpml_default_language', NULL );
      }

      if ( isset( $language ) ) {
        $language = substr( $language, 0, 2 );
      }
      return $language;

    }
    /**
     * Get request language
     */
    public function getCurrentLanguageCode() {

      $language = get_locale();
      if ( isset( $language ) ) {
          $language = substr( $language, 0, 2);
      }

      return $language;

    }

    /**
     * Get the family
     */
    public function getFamily() {

        $registry = Mybooking_Registry::getInstance();
        $returnValue = '';

        switch ($registry->mybooking_rent_plugin_family_context) {
        	case 'product':
        	  $returnValue = esc_html_x( 'Type of product', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'family':
        	  $returnValue = esc_html_x( 'Family', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'vehicle':
        	  $returnValue = esc_html_x( 'Type of vehicle', 'engine_context', 'mybooking-wp-plugin' );
        	  break;        	  
        	case 'property':
        	  $returnValue = esc_html_x( 'Type of property', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'room':
        	  $returnValue = esc_html_x( 'Type of room', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	default:
        	  $returnValue = esc_html_x( 'Family', 'engine_context', 'mybooking-wp-plugin' );
        }
        return $returnValue;

    }

    /**
     * Get product
     */
    public function getProduct() {

        $registry = Mybooking_Registry::getInstance();
        $returnValue = '';

        switch ($registry->mybooking_rent_plugin_product_context) {
        	case 'vehicle':
        	  $returnValue = esc_html_x( 'Vehicle', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'product':
        	  $returnValue = esc_html_x( 'Product', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'property':
        	  $returnValue = esc_html_x( 'Property', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'room':
        	  $returnValue = esc_html_x( 'Room', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	default:
        	  $returnValue = esc_html_x( 'Vehicle', 'engine_context', 'mybooking-wp-plugin' );
        }
        return $returnValue;

    }

    /**
     * Get Duration
     */
    public function getDuration() {

        $registry = Mybooking_Registry::getInstance();
        $returnValue = '';

        switch ($registry->mybooking_rent_plugin_duration_context) {
        	case 'days':
        	  $returnValue = esc_html_x( 'day(s)', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'nights':
        	  $returnValue = esc_html_x( 'night(s)', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	default:
        	  $returnValue = esc_html_x( 'day(s)', 'engine_context', 'mybooking-wp-plugin' );
         }
        return $returnValue;

    }

    /**
     * Get the delivery point
     */
    public function getDeliveryDate() {

        $registry = Mybooking_Registry::getInstance();
        $returnValue = '';

        switch ($registry->mybooking_rent_plugin_dates_context) {
        	case 'pickup-return':
        	  $returnValue = esc_html_x( 'Pick-up date', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'checkin-checkout':
        	  $returnValue = esc_html_x( 'Check-in', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'start-end':
        	  $returnValue = esc_html_x( 'Start', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'arrive-depature':
        	  $returnValue = esc_html_x( 'Arrive', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	default:
        	  $returnValue = esc_html_x( 'Pick-up date', 'engine_context', 'mybooking-wp-plugin' );
         }
        return $returnValue;
		

    }

    /**
     * Get the collection point
     */
    public function getCollectionDate() {

        $registry = Mybooking_Registry::getInstance();
        $returnValue = '';

        switch ($registry->mybooking_rent_plugin_dates_context) {
        	case 'pickup-return':
        	  $returnValue = esc_html_x( 'Return date', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'checkin-checkout':
        	  $returnValue = esc_html_x( 'Check-out', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'start-end':
        	  $returnValue = esc_html_x( 'End', 'engine_context', 'mybooking-wp-plugin' );
        	  break;
        	case 'arrive-departure':
        	  $returnValue = esc_html_x( 'Departure', 'engine_context', 'mybooking-wp-plugin' );
        	  break;   
        	default: 
        	  $returnValue = esc_html_x( 'Return date', 'engine_context', 'mybooking-wp-plugin' );   		
        }
        return $returnValue;
    }

    public function getNotAvailableMessage( ) {

      $registry = Mybooking_Registry::getInstance();
      $returnValue = '';

      switch ($registry->mybooking_rent_plugin_not_available_context) {
        case 'not-available':
          $returnValue = esc_html_x( 'Not available', 'engine_context', 'mybooking-wp-plugin' );
          break;
        case 'check-by-phone':
          $returnValue = esc_html_x( 'Please, contact us by phone', 'engine_context', 'mybooking-wp-plugin' );
          break;
        default:
           $returnValue = esc_html_x( 'Not available', 'engine_context', 'mybooking-wp-plugin' );
      }

      return $returnValue;

    }

    /**
     * Get the characteristic description from the code
     */
    public function getCharacteristic( $code ) {

      $returnValue = '';

      switch ( $code ) {

        case 'length':
          $returnValue = esc_html_x('Length', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        default:
          $returnValue = $code;

      }

      return $returnValue;

    }

    /**
     * Get the key characteristic description from the code
     */
    public function getKeyCharacteristic( $code ) {

      $returnValue = '';

      switch ( $code ) {

        case 'air_conditioner':
          $returnValue = esc_html_x('Air conditioner', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'bathroom':
          $returnValue = esc_html_x('Bathroom', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'baths':
          $returnValue = esc_html_x('Baths', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'beds':
          $returnValue = esc_html_x('Beds', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'berths':
          $returnValue = esc_html_x('Berths', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'boat_license':
          $returnValue = esc_html_x('Boat License', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'cabin':
          $returnValue = esc_html_x('Cabin', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'doors':
          $returnValue = esc_html_x('Doors', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'driving_license':
          $returnValue = esc_html_x('Driving license', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'fuel':
          $returnValue = esc_html_x('Fuel', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'pets':
          $returnValue = esc_html_x('Pets', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'places':
          $returnValue = esc_html_x('Places', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'rooms':
          $returnValue = esc_html_x('Rooms', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'seats':
          $returnValue = esc_html_x('Seats', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'shower':
          $returnValue = esc_html_x('Shower', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'skipper':
          $returnValue = esc_html_x('Skipper', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'suitcases':
          $returnValue = esc_html_x('Suitcases', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'transmission':
          $returnValue = esc_html_x('Transmission', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'type':
          $returnValue = esc_html_x('Type', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'wc':
          $returnValue = esc_html_x('WC', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        case 'wifi':
          $returnValue = esc_html_x('Wifi', 'engine_context_key_characteristic', 'mybooking-wp-plugin' );
          break;
        default:
          $returnValue = $code;

      }

      return $returnValue;

    }

  }