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
            return new WP_REST_Response(json_decode($res['body'], true), 200);
          } else {
            return new WP_REST_Response($res['response'], 401);
          }
        } else {
          return new WP_REST_Response($res, 500);
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