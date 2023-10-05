<?php
  require_once( 'class-mybooking-create-pages.php' );
  require_once( 'class-mybooking-renting-module.php' );
  require_once( 'class-mybooking-activities-module.php' );
  require_once( 'class-mybooking-transfer-module.php' );

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
     *              => 'page' (renting or activies)
     * 
     * @return WP_Error|WP_REST_Response
     */
    public function setupOnboarding($request) {
      
      // Retrieve the business info stored in login
      $onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

      $pages = array();

      if ( $onboarding_settings ) {

        // Set the locale to the store locale to ensure pages are created in the correct language.
        mybooking_switch_to_site_locale();

        // Renting
        $renting_module = new MybookingRentingModule();
        if ( array_key_exists('module_rental', $onboarding_settings) && $onboarding_settings['module_rental'] ) {
          // Create the pages
          $pages['renting'] = $renting_module->createRentingPages($onboarding_settings['wc_rent_selector']);
          // Configure renting module in settings
          $renting_module->setupRentingModule();
        } else {
          // Clear the renting module
          $renting_module->clearRentingModule();            
        }

        // Activities
        $activities_module = new MybookingActivitiesModule();
        if ( array_key_exists('module_activities', $onboarding_settings) && $onboarding_settings['module_activities'] ) {
          // Create the pages
          $pages['activities'] = $activities_module->createActivitiesPages();
          // Configure activities module in settings
          $activities_module->setupActivitiesModule();
        } else {
          // Clear the activities module
          $activities_module->clearActivitiesModule();            
        }

        // Transfer
        $transfer_module = new MybookingTransferModule();
        if ( array_key_exists('module_transfer', $onboarding_settings) && $onboarding_settings['module_transfer'] )  {
          // Create the pages
          $pages['transfer'] = $transfer_module->createTransferPages();
          // Configure transfer module in settings
          $transfer_module->setupTransferModule();
        } else {
          // Clear the transfer module
          $transfer_module->clearTransferModule();            
        }

        // Restore the locale to the default locale.
        mybooking_restore_locale();

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