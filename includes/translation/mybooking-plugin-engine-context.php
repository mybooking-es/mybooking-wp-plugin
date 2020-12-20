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

  }