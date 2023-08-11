<?php
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

            // Override settings
            // $settings = (array) get_option("mybooking_plugin_settings_connection");

            return new WP_REST_Response(array(
              'message' => 'Data saved successfully',
              'code' => 200
            ), 200);
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
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function setupOnboarding($request) {
      // Pase Body as JSON
      $data = json_decode($request->get_body(), true);

      // Check valid JSON
      if ( json_last_error() !== JSON_ERROR_NONE ) {
        return new WP_REST_Response(array("message" => "Invalid JSON parameters"), 400); 
      }

      // Extract parameters
      $navigation = $data['navigation'];

      // Check parameters
      if ( empty($navigation) ) {
        return new WP_REST_Response(array("message" => "Required parameters not found or empty"), 400); 
      } else {
        $pages = $this->createPages($navigation);

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
    * Create pages
    */
    function createPages($navigation) {
      // Create pages
      $pages = array();

      $title = 'Title';
      $content = wpautop(do_shortcode('[mybooking_rent_engine_selector]'));
      $post_id = $this->createPage($title, $content);
      if ($post_id) {
        array_push($pages, $post_id);
      }

      if (count($pages) > 0) {
        $pages_info = array(
          "navigation" => $navigation,
          "pages" => $pages
        );

        // Store pages data in options
        // update_option("mybooking_plugin_onboarding_pages_info", $pages_info);

        return $pages_info;
      } else {
        return null;
      }
    }

    /*
    * Create page
    */
    function createPage($title, $content, $template = '') {
      $check = get_page_by_title($title);

      $page = array(
        'post_type' => 'page',
        'post_title' => $title,
        'post_content' => $content,
      );

      if(!isset($check->ID)){
        $page_id = wp_insert_post($page);

        if(!empty($template)){
          update_post_meta($page_id, '_wp_page_template', $template);
        }

        return $page_id;
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