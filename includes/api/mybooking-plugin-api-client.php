<?php
  /**
   * Mybooking API Client
   */
  class MyBookingApiClient
  {

    const GET_PRODUCTS = '/api/booking/frontend/products';
    const GET_PRODUCT = '/api/booking/frontend/products/';
    const GET_DESTINATIONS = '/api/booking/frontend/destinations';
    const GET_CATEGORIES = '/api/booking/frontend/categories';

    private $url_prefix;
    private $api_key;
		

	  public function __construct($the_url_prefix, $the_api_key)
	  {
       $this->url_prefix = $the_url_prefix;
       $this->api_key = $the_api_key;
	  }

    /**
     * Get the destinations
     */
    public function get_destinations() {

          $url = $this->url_prefix.MyBookingApiClient::GET_DESTINATIONS;
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
          $request = wp_remote_get( $url );
          if( is_wp_error( $request ) ) {
            return null; // TODO
          }

          // Check status code
          $status_code = wp_remote_retrieve_response_code( $request );
          if ( $status_code == 404 || $status_code == 500) {
            return null;
          }

          // Get the response body
          $body = wp_remote_retrieve_body( $request );
          $data = json_decode( $body );
          return $data; 

    }

    /**
     * Get the destinations
     */
    public function get_categories() {

          $url = $this->url_prefix.MyBookingApiClient::GET_CATEGORIES;
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
          $request = wp_remote_get( $url );
          if( is_wp_error( $request ) ) {
            return null; // TODO
          }

          // Check status code
          $status_code = wp_remote_retrieve_response_code( $request );
          if ( $status_code == 404 || $status_code == 500) {
            return null;
          }

          // Get the response body
          $body = wp_remote_retrieve_body( $request );
          $data = json_decode( $body );
          return $data; 

    }

    /**
     * Get the renting products
     *
     * @param Array $data The filter
     * @param number $offset The offset on pagination
     * @param number $limit The number of records on pagination
     */
    public function get_products( $offset=0, $limit=20, $data=array() ) {

          $url = $this->url_prefix.MyBookingApiClient::GET_PRODUCTS.'?offset='.$offset;

          if ( $limit != 0) {
            $url = $url.'&limit='.$limit;
          }

          // Append the filter parameters
          foreach($data as $filter_name => $filter_value) {
            $url= $url.'&'.$filter_name.'='.$filter_value;
          }

          // API Key
          if ( isset($this->api_key) && !empty($this->api_key)) {
            $url = $url.'&api_key='.$this->api_key;
          }

          // Language
          $language = MyBookingEngineContext::getInstance()->getCurrentLanguageCode();
          if ( isset( $language ) ) {
           $url = $url.'&lang='.$language;
          }          

          // Query data
					$request = wp_remote_get( $url );
					if( is_wp_error( $request ) ) {
						return null; // TODO
					}

          // Check status code
          $status_code = wp_remote_retrieve_response_code( $request );
          if ( $status_code == 404 || $status_code == 500) {
            return null;
          }

          // Get the response body
					$body = wp_remote_retrieve_body( $request );
					$data = json_decode( $body );
					return $data;	

    }

    /**
     * Get a product detail
     *
     * @param string $code the product code
     */
    public function get_product($code) {

          $url = $this->url_prefix.MyBookingApiClient::GET_PRODUCT.$code;
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
					$request = wp_remote_get( $url );
					if( is_wp_error( $request ) ) {
						return null; // TODO
					}

          // Check status code
          $status_code = wp_remote_retrieve_response_code( $request );
          if ( $status_code == 404 || $status_code == 500) {
            return null;
          }

          // Get the response body
					$body = wp_remote_retrieve_body( $request );
					$data = json_decode( $body );
					return $data;	

    }


  }
?>