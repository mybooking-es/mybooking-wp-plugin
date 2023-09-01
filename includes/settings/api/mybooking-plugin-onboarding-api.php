<?php
  require_once( 'class-mybooking-create-pages.php' );
  require_once( 'class-mybooking-create-renting-pages.php' );
  require_once( 'class-mybooking-create-activities-pages.php' );
  require_once( 'class-mybooking-create-transfer-pages.php' );

  class MyBookingOnboardingApi extends WP_REST_Controller {
    const GET_SETTINGS = '/api/booking/frontend/wizard-info';
    
    public function __construct() {}

    /**
    * Register the routes for the objects of the controller.
    */
    public function register_routes() {
      $version = '1';
      $namespace = 'api/v'.$version;
      
      // GET /login
      register_rest_route($namespace, '/login', array(
        array(
          'methods'               => WP_REST_Server::EDITABLE,
          'callback'              => array($this, 'login'),
          'permission_callback'   => array($this, 'get_mybooking_permissions_check'),
          'args'                  => array(),
        ),
      ), false);

      // GET /login
      register_rest_route($namespace, '/setupOnboarding', array(
        array(
          'methods'               => WP_REST_Server::EDITABLE,
          'callback'              => array($this, 'setupOnboarding'),
          'permission_callback'   => array($this, 'get_mybooking_permissions_check'),
          'args'                  => array(),
        ),
      ), false);
    }

    /**
     * Login
     * 
     * It connects to mybooking instance to retrieve the basic settings and store them 
     * on Wordpress option "mybooking_plugin_onboarding_business_info"
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function login($request) {
      // Pase Body as JSON
      $data = json_decode($request->get_body(), true);

      // Check valid JSON
      if ( json_last_error() !== JSON_ERROR_NONE ) {
        return new WP_REST_Response(array("message" => "Invalid JSON parameters"), 400); 
      }

      // Extract parameters
      $clientId = $data['client_id'];
      $apiKey = $data['api_key'];

      // Check parameters
      if ( empty($clientId) || empty($apiKey) ) {
        return new WP_REST_Response(array("message" => "Required parameters not found or empty"), 400); 
      } 
      else {
        
        $urlPrefix = '';

        // Check if the clientId is an id or a full URL
        if (filter_var($clientId, FILTER_VALIDATE_URL)) {
          $urlPrefix = $clientId;
        }
        else {
          $urlPrefix = 'https://'.$clientId.'.mybooking.es';
        }

        // Build the URL
        $url = $urlPrefix.MyBookingOnboardingApi::GET_SETTINGS;
        $url .= '?api_key='.$apiKey;

        // Make the request to mybooking
        $res = wp_safe_remote_request($url, array(
          'headers'     => array(
            'Content-Type' => 'application/json; charset=utf-8',
            'reject_unsafe_urls' => true
          ),
          'method'      => 'GET',
          'timeout'    => 30,
        ));

        // Validate error
        if(!is_wp_error($res)) {
          if ($res['response']['code'] == 200 || $res['response']['code'] == 201 ) {

            // Decode response into an associate array
            $onboarding_data = json_decode($res['body'], true);

            // Store information in settings (add_option) - mybooking_plugin_onboarding_finished
            update_option("mybooking_plugin_onboarding_business_info", $onboarding_data);

            // Update connection settings (TODO if does not exist)
            $connection_settings = (array) get_option("mybooking_plugin_settings_connection");
            $connection_settings['mybooking_plugin_settings_account_id'] = $clientId; 
            $connection_settings['mybooking_plugin_settings_api_key'] = $apiKey;
            update_option("mybooking_plugin_settings_connection", $connection_settings);

            return new WP_REST_Response($connection_settings, 200);
          } else {
            return new WP_REST_Response($res['response'], 401);
          }
        } else {
          return new WP_REST_Response($res, 500);
        }

      }
    
    }

    /**
     * Set onboarding setup
     * 
     * Details:
     * --------
     * 
     * The login endpoint must be called before calling this endpoint in order to create/update
     * the wordpress option "mybooking_plugin_onboarding_business_info" so the process
     * 
     * 
     * @param WP_REST_Request $request Full data about the request.
     * 
     * Associative Array with the following attributes
     * 
     * 'navigation' => 'selector' (renting or transfer) - Create test page with selector
     *              => 'page' (renting or activies)
     * 
     * @return WP_Error|WP_REST_Response
     */
    public function setupOnboarding($request) {
      
      // Retrieve the business info stored in login
      //$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');
      // return 400 if no $onboarding_settings

      // Pase Body as JSON
      $data = json_decode($request->get_body(), true);

      // Check valid JSON
      if ( json_last_error() !== JSON_ERROR_NONE ) {
        return new WP_REST_Response(array("message" => "Invalid JSON parameters"), 400); 
      }

      // Extract parameters (values : 'selector' or 'page')
      $navigation = $data['navigation'];

      // Check parameters
      if ( empty($navigation) ) {
        return new WP_REST_Response(array("message" => "Required parameters not found or empty"), 400); 
      } else {

        // Retrieve the business info stored in login
        $onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

        $pages = array();

        if ( $onboarding_settings ) {
          // Renting
          if ( array_key_exists('module_rental', $onboarding_settings) && $onboarding_settings['module_rental'] ) {
            // Create the pages
            $create_renting_pages = new MybookingCreateRentingPages();
            $pages['renting'] = $create_renting_pages->createRentingPages($navigation);
            // Configure renting module in settings
            $settings = (array) get_option("mybooking_plugin_settings_configuration");
            $settings['mybooking_plugin_settings_renting_selector'] = "1";
            update_option("mybooking_plugin_settings_configuration", $settings);            
          } else {
            // Remove the renting module
            $settings = (array) get_option("mybooking_plugin_settings_configuration");
            $settings['mybooking_plugin_settings_renting_selector'] = "0";
            update_option("mybooking_plugin_settings_configuration", $settings);            
            // Clear the link to the renting pages
            $settings_renting = (array) get_option("mybooking_plugin_settings_renting");
            unset($settings_renting['mybooking_plugin_settings_home_test_page']);
            unset($settings_renting['mybooking_plugin_settings_choose_products_page']);
            unset($settings_renting['mybooking_plugin_settings_checkout_page']);
            unset($settings_renting['mybooking_plugin_settings_summary_page']);
            unset($settings_renting['mybooking_plugin_settings_my_reservation_page']);
            update_option( "mybooking_plugin_settings_renting", $settings_renting );            
          }

          // Activities
          if ( array_key_exists('module_activities', $onboarding_settings) && $onboarding_settings['module_activities'] ) {
            $create_activities_pages = new MybookingCreateActivitiesPages();
            $pages['activities'] = $create_activities_pages->createActivitiesPages($navigation);
          }

          // Transfer
          if ( array_key_exists('module_transfer', $onboarding_settings) && $onboarding_settings['module_transfer'] ) {
            $create_transfer_pages = new MybookingCreateTransferPages();
            $pages['transfer'] = $create_transfer_pages->createTransferPages($navigation);
          }
        }

        if ($pages !== null) {
          return new WP_REST_Response($pages, 200);
        }
        else {
          return new WP_REST_Response(array(
            'message' => 'Error in pages creation',
            'code' => 401
          ), 401);
        }
      }
    }

    /**
    * Check if a given request has access to get items
    *
    * @param WP_REST_Request $request Full data about the request.
    * @return WP_Error|bool
    */
    public function get_mybooking_permissions_check($request) {
      return true;
    }
}

/*
// Instance
$instance = new MyBookingOnboardingApi();
// Routes
$instance->register_routes();
*/