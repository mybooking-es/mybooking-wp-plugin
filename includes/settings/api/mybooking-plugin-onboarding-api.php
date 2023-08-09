<?php
  class MyBookingOnboardingApi extends WP_REST_Controller {
    const GET_SETTINGS = '/api/booking/frontend/wizard-info';
    
    private $url_prefix;
    private $api_key;

    public function __construct() {}

    /**
    * Register the routes for the objects of the controller.
    */
    public function register_routes() {
      $version = '1';
      $namespace = 'mybooking/v'.$version;
      $base = 'onboarding';
      
      // Login
      register_rest_route($namespace, '/'.$base.'/login', array(
        array(
          'methods'                      => WP_REST_Server::EDITABLE,
          'callback'                       => array($this, 'login'),
          'permission_callback'   => array($this, 'get_mybooking_permissions_check'),
          'args'                              => array(),
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
      $clientId = urlencode_deep($request->get_param('client_id'));
      $apiKey = urlencode_deep($request->get_param('api_key'));

      if (!$clientId || !$apiKey) {
        $response = array(
            'code'=>400,
            'message'=>'Bad Request'
        );
        
        return new WP_REST_Response($response, 400);
      } else {
        $this->$url_prefix = 'https://'.$clientId.'.mybooking.es';
        $this->$api_key = urlencode_deep($apiKey);

        $settings = $this->getSettings();
        return $settings;
      }
    }

    /**
     * Get settings
     * 
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */ 
    function getSettings() {
			$url = $this->$url_prefix.MyBookingOnboardingApi::GET_SETTINGS;
			
      $url_args = [];
			// API Key
			if ( isset($this->api_key) && !empty($this->api_key)) {
				$url_args[] = 'api_key='.$this->api_key;
			}
			// Language
			$language = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
			if ( isset( $language ) ) {
				$url_args[] = 'lang='.$language;
			}
			if ( count($url_args) > 0 ) {
				$url = $url.'?'.implode( '&', $url_args );
			}

      // Query data
      $res = wp_safe_remote_request($url, array(
        'headers'     => array(
          'Content-Type' => 'application/json; charset=utf-8',
          'reject_unsafe_urls' => true
        ),
        'method'      => 'GET',
        'timeout'    => 30,
      ));
  
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

// Instance
$instance = new MyBookingOnboardingApi();
// Routes
$instance->register_routes();