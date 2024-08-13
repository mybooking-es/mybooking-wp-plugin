<?php

  /**
   * Manage plugin shortcodes
   * 
   * 2. Sort codes:
   *
   * 2.1 Renting
   *
   * 2.1.1 Reservation Wizard
   *
   * - Show renting selector: The starting point for a reservation
   *
   * [mybooking_rent_engine_selector sales_channel_code=String family_id=Number rental_location_code=String category_code="code" layout=vertical]
   * [mybooking_rent_engine_selector_wizard sales_channel_code=String family_id=Number category_code="code" rental_location_code=String]
   *
   * - Process:
   *
   * [mybooking_rent_engine_product_listing]
   * [mybooking_rent_engine_complete]
   * [mybooking_rent_engine_summary]
   * [mybooking_rent_engine_reservation]
   *
   * 2.1.2 Products explorer
   *
   * - Products
   *
   * [mybooking_rent_engine_products_search]
   * [mybooking_rent_engine_products]
   *
   * - Product availability and calendar
   *
   * [mybooking_rent_engine_product code=String]
   * 
   * 2.1.3 Planning
   * 
   * [mybooking_rent_engine_planning family=String category=String rental_location=String direction=String type=String days=String interval=String planning_id=String]
   * [mybooking_rent_engine_product_week_planning code=String interval=String planning_id=String]
   * 
   * 2.1.4 Shift picker
   * 
   * [mybooking_rent_engine_shift_picker rental_location_code=String sales_channel_code= String category_code=String shift_picker_id=String min_units=Number]
   *
   * 2.2 Activities
   *
   * [mybooking_activities_engine_search]
   * [mybooking_activities_engine_activities]
   * [mybooking_activities_engine_activity activity_id=Number]
   * [mybooking_activities_engine_shopping_cart]
   * [mybooking_activities_engine_summary]
   * [mybooking_activities_engine_order]
   *
   * 2.3 Transfer
   *
   * [mybooking_transfer_selector layout=vertical]
   * [mybooking_transfer_choose_vehicle]
   * [mybooking_transfer_checkout]
   * [mybooking_transfer_summary]
   * [mybooking_transfer_reservation]
   *
   * 2.4 Contact
   *
   * [mybooking_contact]
   *
   * 2.5 Complements
   *
   * [mybooking_testimonials]
   *
   * 2.6 Profile
   *
   * [mybooking_password_forgotten]
   * [mybooking_change_password]
   *
   * 2.7 Content Slider
   *
   * [mybooking_content_slider]
   *
   * 2.8 Product Slider
   *
   * [mybooking_product_slider]
   * 
   */
  class MybookingEngineShortcodes {

    public function __construct() {
      $this->wp_init();
    }

    /**
     * Initialize hooks
     */
    private function wp_init() {

      // Get the registry information
      $registry = Mybooking_Registry::getInstance();

      // -- Renting shortcodes

      // Shortcode Renting Selector
      add_shortcode( 'mybooking_rent_engine_selector', array( $this, 'wp_rent_selector_shortcode') );

      // Shortcode Renting Selector Wizard
      add_shortcode( 'mybooking_rent_engine_selector_wizard', array( $this, 'wp_rent_selector_wizard_shortcode') );

      // Shortcode Renting Wizard - Product listing
      add_shortcode( 'mybooking_rent_engine_product_listing', array( $this, 'wp_product_listing_shortcode' ) );

      // Shortcode Renting Wizard - Complete
      add_shortcode( 'mybooking_rent_engine_complete', array( $this, 'wp_complete_shortcode' ) );

      // Shortcode Renting Wizard - Summary
      add_shortcode( 'mybooking_rent_engine_summary', array( $this, 'wp_summary_shortcode' ) );

      // Shortcode Renting Reservation
      add_shortcode( 'mybooking_rent_engine_reservation', array( $this, 'wp_reservation_shortcode' ) );

      // Shortcode Activities Search
      add_shortcode( 'mybooking_rent_engine_products_search', array( $this, 'wp_rent_products_search_shortcode') );

      // Shortcode Renting products
      add_shortcode( 'mybooking_rent_engine_products', array( $this, 'wp_rent_products_shortcode' ) );

      // Shortcode Renting Product Calendar
      add_shortcode( 'mybooking_rent_engine_product', array( $this, 'wp_rent_product_shortcode' ) );
      
      // Shorcode Renting planning (diary or with a calendary)
      add_shortcode( 'mybooking_rent_engine_planning', array( $this, 'wp_rent_planning_shortcode' ) );
     
      // Shorcode Renting Product Week planning
      add_shortcode( 'mybooking_rent_engine_product_week_planning', array( $this, 'wp_rent_product_week_planning_shortcode' ) );

       // Shorcode Renting Shift Picker
       add_shortcode( 'mybooking_rent_engine_shift_picker', array( $this, 'wp_rent_shift_picker_shortcode' ) );

      // -- Activities shortcodes

      // Shortcode Activities - Search
      add_shortcode( 'mybooking_activities_engine_search', array( $this, 'wp_activities_search_shortcode') );

      // Shortcode Activities - Activities
      add_shortcode( 'mybooking_activities_engine_activities', array( $this, 'wp_activities_activities_shortcode' ) );

      // Shortcode Activities - Activity
      add_shortcode( 'mybooking_activities_engine_activity', array( $this, 'wp_activities_activity_shortcode' ) );

      // Shortcode Activities - Shopping Cart
      add_shortcode( 'mybooking_activities_engine_shopping_cart', array( $this, 'wp_activities_shopping_cart_shortcode' ) );

      // Shortcode Activities - Summary
      add_shortcode( 'mybooking_activities_engine_summary', array( $this, 'wp_activities_summary_shortcode') );

      // Shortcode Activities - Order
      add_shortcode( 'mybooking_activities_engine_order', array( $this, 'wp_activities_order_shortcode' ) );

      // -- Transfer shortcodes

      // Shortcode Transfer Selector
      add_shortcode('mybooking_transfer_selector', array($this, 'wp_transfer_selector_shortcode') );

      // Shortcode Transfer Select Vehicle
      add_shortcode('mybooking_transfer_choose_vehicle', array($this, 'wp_transfer_choose_vehicle_shortcode' ));

      // Shortcode Transfer Checkout
      add_shortcode('mybooking_transfer_checkout', array($this, 'wp_transfer_checkout_shortcode' ));

      // Shortcode Transfer Summary
      add_shortcode('mybooking_transfer_summary', array($this, 'wp_transfer_summary_shortcode' ));

      // Shortcode Transfer Summary
      add_shortcode('mybooking_transfer_reservation', array($this, 'wp_transfer_reservation_shortcode' ));

      // -- Contact shortcode

      // Shortcode Contact Form
      add_shortcode( 'mybooking_contact', array( $this, 'wp_contact_shortcode' ) );

      // -- Complements shortcodes

      // Shortcode testimonials
      if ( $registry->mybooking_rent_plugin_complements_testimonials == '1' ) {
        add_shortcode( 'mybooking_testimonials', array( $this, 'wp_testimonials_shortcode' ) );
      }

      // -- Content Slider shortcodes

      // Shortcode Content slider
      if ( $registry->mybooking_rent_plugin_complements_content_slider == '1' ) {
        add_shortcode( 'mybooking_content_slider', array( $this, 'wp_content_slider_shortcode' ) );
      }

      // -- Product carousel shortcodes

      // Shortcode Product Slider
      if ( $registry->mybooking_rent_plugin_complements_product_slider == '1' ) {
        add_shortcode( 'mybooking_product_slider', array( $this, 'wp_product_slider_shortcode' ) );
      }

      // -- Profile

      // Shortcode Password Forgotten
      add_shortcode( 'mybooking_password_forgotten', array( $this, 'wp_password_forgotten_shortcode') );

      // Shortcode Change Password
      add_shortcode( 'mybooking_change_password', array( $this, 'wp_change_password_shortcode') );

    }

    // == Shortcodes
    // @see https://konstantin.blog/2013/get_template_part-within-shortcodes/

    // -- Renting

    /**
     * Wizard selector shortcode
     */
    public function wp_rent_selector_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('sales_channel_code' => '',
                                     'family_id' => '',
                                     'category_code' => '',
                                     'rental_location_code' => '',
                                     'layout' => '' ), $atts ) );

      $data = array();


      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
        $data['family_id'] = $family_id;
      }

      if ( $category_code != '' ) {
        $data['category_code'] = $category_code;
      }

      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      if ( $layout != '' ) {
        $data['layout'] = $layout;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-selector-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Wizard selector wizard shortcode
     */
    public function wp_rent_selector_wizard_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('sales_channel_code' => '',
                                     'family_id' => '',
                                     'category_code' => '',
                                     'rental_location_code' => ''), $atts ) );

      $data = array();

      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $family_id != '' ) {
        $data['family_id'] = $family_id;
      }

      if ( $category_code != '' ) {
        $data['category_code'] = $category_code;
      }      

      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-selector-wizard-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Product Listing shortcode
     */
    public function wp_product_listing_shortcode($atts = [], $content = null, $tag = '') {

      extract( shortcode_atts( array('use_renting_detail_page' => '',
                                     'lazy_loading' => '',
                                     'filter' => ''), $atts ) );

      // Get the selector to apply in choose product
      $registry = Mybooking_Registry::getInstance();
      $data = array();
      $data['selector_in_process'] = $registry->mybooking_rent_plugin_selector_in_process;

      // Get the shortcode attributes
      if ( $use_renting_detail_page != '' ) {
        $data['use_renting_detail_page'] = $use_renting_detail_page;
      }
      if ( $filter != '' ) {
        $data['filter'] = $filter;
      }

      if ( $lazy_loading != '' ) {
        $data['lazy_loading'] = $lazy_loading;
      }

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-choose-product.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_complete_shortcode($atts = [], $content = null, $tag = '') {

      // Get the selector to apply in complete
      $registry = Mybooking_Registry::getInstance();
      $data = array();
      $data['selector_in_process'] = $registry->mybooking_rent_plugin_selector_in_process;

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-complete.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_summary_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-summary.php');
      return ob_get_clean();

    }

    /**
     * Mybooking rent engine Complete shortcode
     */
    public function wp_reservation_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-reservation.php');
      return ob_get_clean();

    }

    // ----- Products

    /**
     * Mybooking product
     */
    public function wp_rent_product_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('code' => '',
                                     'sales_channel_code' => '',
                                     'rental_location_code' => '',
                                     'check_hourly_occupation' => '',
                                     'performance_id' => ''), $atts ) );

      $data = array();
      $data['code'] = $code;
      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }
      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }
      if ( $check_hourly_occupation != '' ) {
        $data['check_hourly_occupation'] = $check_hourly_occupation;
      }
      if ( $performance_id != '' ) {
        $data['performance_id'] = $performance_id;
      } 

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-product-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking planning
     */
    public function wp_rent_planning_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array(
                                  'planning_id' => null,
                                  'family' => null,
                                  'category' => null,
                                  'rental_location'=>null,
                                  'direction'=>'rows',
                                  'type'=>'diary',
                                  'interval'=>'30',
                                  'days'=>'7'), $atts ) );

      $data = array();
      $data['planning_id'] = $planning_id;
      if ( $family != '' ) {
        $data['family'] = $family;
      }
      if ( $category != '' ) {
        $data['category'] = $category;
      }
      if ( $rental_location != '' ) {
        $data['rental_location'] = $rental_location;
      }
      $data['direction'] = $direction;
      $data['type'] = $type;
      $data['interval'] = $interval;
      if ( $days != '' ) {
        $data['days'] = $days;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-planning.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking product week planning
     */
    public function wp_rent_product_week_planning_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array(
                                      'category' => '',
                                      'interval'=>30,
                                      'planning_id' => ''), $atts ) );

      $data = array();
      $data['category'] = $category;
      $data['interval'] = $interval;
      if ( $planning_id != '' ) {
        $data['planning_id'] = $planning_id;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-product-week-planning.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking product shift picker
     */
    public function wp_rent_shift_picker_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array(
                                      'rental_location_code' => '',
                                      'sales_channel_code' => '',
                                      'category_code' => '',
                                      'shift_picker_id' => '',
                                      'min_units' => 1), $atts ) );

      $data = array();
      
      $data['category_code'] = $category_code;

      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      if ( $shift_picker_id != '' ) {
        $data['shift_picker_id'] = $shift_picker_id;
      }

      if ( $min_units != '' ) {
        $data['min_units'] =  intval($min_units);
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-shift-picker.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking products
     */
    public function wp_rent_products_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array(
                                      'family_id' => '',
                                      'key_characteristic_1' => '',
                                      'key_characteristic_2' => '',
                                      'key_characteristic_3' => '',
                                      'key_characteristic_4' => '',
                                      'key_characteristic_5' => '',
                                      'key_characteristic_6' => '',
                                      'codes' => '',
                                      'price_range' => ''                                  
                                      ), $atts ) );

      $search_filter = array();
      if ( $family_id != '' ) {
        $search_filter['family_id'] = $family_id;
      }
      if ( $key_characteristic_1 != '' ) {
        $search_filter['key_characteristic_1'] = $key_characteristic_1;
      }
      if ( $key_characteristic_2 != '' ) {
        $search_filter['key_characteristic_2'] = $key_characteristic_2;
      }
      if ( $key_characteristic_3 != '' ) {
        $search_filter['key_characteristic_3'] = $key_characteristic_3;
      }
      if ( $key_characteristic_4 != '' ) {
        $search_filter['key_characteristic_4'] = $key_characteristic_4;
      }
      if ( $key_characteristic_5 != '' ) {
        $search_filter['key_characteristic_5'] = $key_characteristic_5;
      }
      if ( $key_characteristic_6 != '' ) {
        $search_filter['key_characteristic_6'] = $key_characteristic_6;
      }                        
      if ( $price_range != '' ) {
        $search_filter['price_range'] = $price_range;
      }  
      if ( $codes != '' ) {
        $search_filter['codes'] = $codes;
        $codes = explode(',', $codes);
      }        
      $settingsConnection = (array) get_option('mybooking_plugin_settings_connection');
      if ($settingsConnection && array_key_exists('mybooking_plugin_settings_sales_channel_code', $settingsConnection)) {
        $search_filter['sales_channel_code'] = $settingsConnection['mybooking_plugin_settings_sales_channel_code'];
      }

      // Get the page and the limit from the request parameters
      $opts = mybooking_engine_products_extract_query_string();
      // Merge the parameters with shortcode attributes
      $opts = array_merge($search_filter, $opts);
      
      // Prepare the pagination

      $page = 1;
      $limit = 12;

      // Validate nonce before getting query string parameters
      if ( isset( $_GET[ 'products_wponce'] ) && wp_verify_nonce( $_GET['products_wponce'], 'products_list' ) ) {
        // Offset
        if ( isset( $_GET[ 'offsetpage'] ) ) {
          $page = filter_input( INPUT_GET, 'offsetpage', FILTER_VALIDATE_INT );
        }
        // Limit
        if ( isset( $_GET[ 'limit' ] ) ) {
          $limit = filter_input( INPUT_GET, 'limit', FILTER_VALIDATE_INT );
        }
      }

      if ( is_null($page) || $page === false ) {
        $page = 1;
      }
      if ( is_null($limit) || $limit === false || $limit > 12 ) {
        $limit = 12;
      }
      
      // Make sure that if passed a list of codes is no limit
      if ( !empty( $codes )) {
        $limit = 0;
      }

      // Build the offset
      $offset = ($page - 1) * $limit;

      // URL for pagination
      $url = get_site_url();
      $current_page = mybooking_engine_current_page();
      if ( $current_page != null ) {
        $translated_slug = mybooking_engine_translated_slug( $current_page->post_name );
        if ( filter_var( $translated_slug, FILTER_VALIDATE_URL ) ) {
          $url = $translated_slug;
        }
        else {
          $url = $url.'/'.$translated_slug;
        }
      }

      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
                                          $registry->mybooking_rent_plugin_api_key);
      
      $data = $api_client->get_products( $offset, $limit, $opts );

      if ( $data == null) {
        $data = (object) array('total' => 0,
                              'offset' => 0,
                              'data' => []);
      }

      // Prepare url_detail
      $current_locale = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
      $site_locale = MyBookingEngineContext::getInstance()->getDefaultLanguageCode();
      $url_detail = get_site_url();
      $url_detail = $url_detail.'/';
      if ($current_locale != $site_locale) {
        $url_detail = $url_detail.$current_locale.'/';
      }
      $url_detail = $url_detail.($registry->mybooking_rent_plugin_navigation_products_url ? $registry->mybooking_rent_plugin_navigation_products_url : 'products');

      // Pagination
      if ($limit == 0) {
        $total_pages = 1;
        $current_page = 1;
      }
      else {
        $total_pages = ceil($data->total / $limit);
        $current_page = floor($data->offset / $limit) + 1;
      }
      $pagination = new MyBookingUIPagination();
      $pages = $pagination->pages($total_pages, $current_page);
      $querystring = $this->wp_products_build_query_string();
      if ( !empty($querystring) ) {
        $querystring = '&'.$querystring;
      }

      $data = array('data' => $data,
                    'total_pages' => $total_pages,
                    'current_page' => $current_page,
                    'pages' => $pages,
                    'url' => $url,
                    'use_detail_pages' => $registry->mybooking_rent_plugin_detail_pages,
                    'url_detail' => $url_detail,
                    'codes' => $codes,
                    'querystring' => $querystring );
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-products.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking search shortcode
     */
    public function wp_rent_products_search_shortcode($atts = [], $content = null, $tag = '') {

      // Get the query parameters
      $data = mybooking_engine_products_extract_query_string();
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-products-search.php', $data);
      return ob_get_clean();

    }

    // ----- Activities

    /**
     * Mybooking search shortcode
     */
    public function wp_activities_search_shortcode($atts = [], $content = null, $tag = '') {

      // Get the query parameters
      $data = mybooking_engine_activities_extract_query_string();
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-search.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking activities shortcode
     */
    public function wp_activities_activities_shortcode($atts = [], $content = null, $tag = '') {

      $destination_id = null;
      $family_id = null;
      $q = '';
      $page = 1;
      $limit = 12;
      
      // Get the query, page and the limit from the request parameters
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
        // Page
        if ( isset( $_GET[ 'offsetpage'] ) ) {
          $page = filter_input( INPUT_GET, 'offsetpage', FILTER_VALIDATE_INT );
        }
        // Limit
        if ( isset( $_GET[ 'limit'] ) ) {
          $limit = filter_input( INPUT_GET, 'limit', FILTER_VALIDATE_INT );
        }
      }

      if ( is_null($page) || $page === false ) {
        $page = 1;
      }
      if ( is_null($limit) || $limit === false || $limit > 12 ) {
        $limit = 12;
      }
      // Build the offset
      $offset = ($page - 1) * $limit;

      // URL for pagination
      $url = get_site_url();
      $current_page = mybooking_engine_current_page();
      if ( $current_page != null ) {
        $translated_slug = mybooking_engine_translated_slug( $current_page->post_name );
        if ( filter_var( $translated_slug, FILTER_VALIDATE_URL ) ) {
          $url = $translated_slug;
        }
        else {
          $url = $url.'/'.$translated_slug;
        }
      }

      // Get the products from the API
      $registry = Mybooking_Registry::getInstance();
      $api_client = new MyBookingActivitiesApiClient($registry->mybooking_rent_plugin_api_url_prefix,
                                                     $registry->mybooking_rent_plugin_api_key);
      $data =$api_client->get_activities($destination_id, $family_id, $q, $offset, $limit);
      if ( $data == null) {
        $data = (object) array('total' => 0,
                               'offset' => 0,
                               'data' => []);
      }

      // Prepare url_detail
      $current_locale = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
      $site_locale = MyBookingEngineContext::getInstance()->getDefaultLanguageCode();
      $url_detail = get_site_url();
      $url_detail = $url_detail.'/';
      if ($current_locale != $site_locale) {
        $url_detail = $url_detail.$current_locale.'/';
      }
      $url_detail = $url_detail.($registry->mybooking_rent_plugin_navigation_activities_url ? $registry->mybooking_rent_plugin_navigation_activities_url : 'activities');

      // Pagination
      $total = $data->total;
      $total_pages = ceil($data->total / $limit);
      $current_page = floor($data->offset / $limit) + 1;
      $pagination = new MyBookingUIPagination();
      $pages = $pagination->pages($total_pages, $current_page);
      $querystring = $this->wp_activities_build_query_string();
      if ( !empty($querystring) ) {
        $querystring = '&'.$querystring;
      }

      $data = array('total' => $total,
                    'data' => $data,
                    'total_pages' => $total_pages,
                    'current_page' => $current_page,
                    'pages' => $pages,
                    'url' => $url,
                    'use_detail_pages' => $registry->mybooking_activities_plugin_detail_pages,
                    'url_detail' => $url_detail,
                    'querystring' => $querystring );
      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities.php', $data);
      return ob_get_clean();

    }

    // -- Activities

    /**
     * Mybooking activities engine Activity shortcode
     *
     * Attributes:
     * -----------
     * activity_id:: Show the activity selector for the activity Id
     */
    public function wp_activities_activity_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('activity_id' => '' ), $atts ) );

      // If the shortcode attributes include activity_id and it is not null load the data
      if ( $activity_id != '' ) {
        $data = array(
            'activity_id' => $activity_id,
        );
        ob_start();
        mybooking_engine_get_template('mybooking-plugin-activities-activity-widget.php', $data);
        return ob_get_clean();
      }

    }

    /**
     * Mybooking activities engine Shopping Cart shortcode
     */
    public function wp_activities_shopping_cart_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-shopping-cart.php');
      return ob_get_clean();

    }

    /**
     * Mybooking activities engine Summary shortcode
     */
    public function wp_activities_summary_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-summary.php');
      return ob_get_clean();

    }

    /**
     * Mybooking activities engine Order shortcode
     */
    public function wp_activities_order_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-activities-order.php');
      return ob_get_clean();

    }

    // -- Transfer

    /**
     * Mybooking Transfer selector shortcode
     */
    public function wp_transfer_selector_shortcode($atts = [], $content = null, $tag = '') {

      // Extract the shortcode attributes
      extract( shortcode_atts( array('layout' => '' ), $atts ) );

      $data = array();

      if ( $layout != '' ) {
        $data['layout'] = $layout;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-transfer-selector-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * Mybooking Transfer choose vehicle shortcode
     */
    public function wp_transfer_choose_vehicle_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_transfer_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-transfer-choose-vehicle.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Transfer checkout shortcode
     */
    public function wp_transfer_checkout_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_transfer_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-transfer-checkout.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Transfer summary shortcode
     */
    public function wp_transfer_summary_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      // Do an action to load specific content
      do_action('mybooking_plugin_transfer_reservation_process_header');
      mybooking_engine_get_template('mybooking-plugin-transfer-summary.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Transfer reservation shortcode
     */
    public function wp_transfer_reservation_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-transfer-reservation.php');
      return ob_get_clean();

    }


    // -- Contact

    /**
     * Mybooking Contact shortcode
     */
    public function wp_contact_shortcode($atts = [], $content = null, $tag = '') {

      // == Extract the shortcode attributes
      extract( shortcode_atts( array('subject' => '',
                                     'source' => '',
                                     'sales_channel_code' => '',
                                     'rental_location_code' => ''), $atts ) );
      $data = array();

      // Subject
      if ( $subject != '' ) {
        $data['subject'] = $subject;
      }

      // Source
      if ( $source != '' ) {
        $data['source'] = $source;
      }

      // Sales Channel
      if ( $sales_channel_code != '' ) {
        $data['sales_channel_code'] = $sales_channel_code;
      }

      // Rental location code
      if ( $rental_location_code != '' ) {
        $data['rental_location_code'] = $rental_location_code;
      }

      // Get Google API Captcha
      $registry = Mybooking_Registry::getInstance();
      if ( $registry->mybooking_rent_plugin_contact_form_use_google_captcha &&
           !empty( $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key ) ) {
        $data['google_captcha_api_key'] = $registry->mybooking_rent_plugin_contact_form_google_captcha_api_key;
      }

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-contact-widget.php', $data);
      return ob_get_clean();

    }

    /**
     * MyBooking Password Forgotten shortcode
     *
     */
    public function wp_password_forgotten_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-profile-password-forgotten.php');
      return ob_get_clean();

    }

    /**
     * MyBooking Change password shortcode
     */
    public function wp_change_password_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-profile-change-password.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Testimonials shortcode
     */
    public function wp_testimonials_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-testimonials.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Content Slider shortcode
     */
    public function wp_content_slider_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-content-slider.php');
      return ob_get_clean();

    }

    /**
     * Mybooking Product Slider shortcode
     */
    public function wp_product_slider_shortcode($atts = [], $content = null, $tag = '') {

      ob_start();
      mybooking_engine_get_template('mybooking-plugin-product-slider.php');
      return ob_get_clean();

    }

    // ------

    /**
     * Build query string from Query string
     *
     */
    private function wp_products_build_query_string() {

      $result = '';
      $data = mybooking_engine_products_extract_query_string();
      foreach($data as $key => $value) {
        if ( !empty($result) ) {
          $result.='&';
        }
        if ( !empty($value) && is_int( $value ) ) {
          $result.=$key.'='.$value;
        }
        else if ( !empty($value) && is_string( $value ) ) {
          $result.=$key.'='.urlencode($value);
        }
      }

      return $result;

    }
    
    /**
     * Build query string from Query string
     *
     */
    private function wp_activities_build_query_string() {

      $result = '';
      $data = mybooking_engine_activities_extract_query_string();
      foreach($data as $key => $value) {
        if ( !empty($result) ) {
          $result.='&';
        }
        if ( !empty($value) && is_int( $value ) ) {
          $result.=$key.'='.$value;
        }
        else if ( !empty($value) && is_string( $value ) ) {
          $result.=$key.'='.urlencode($value);
        }
      }

      return $result;

    }


}