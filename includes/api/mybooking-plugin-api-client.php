<?php
  /**
   * Mybooking API Client
   */
  class MyBookingApiClient
  {

    const GET_PRODUCTS = '/api/booking/frontend/products';
    const GET_PRODUCT = '/api/booking/frontend/products/';
    private $url_prefix;
    private $api_key;
		

	  public function __construct($the_url_prefix, $the_api_key)
	  {
       $this->url_prefix = $the_url_prefix;
       $this->api_key = $the_api_key;
	  }

    /**
     * Get the renting products
     *
     * @param number $offset The offset on pagination
     * @param number $limit The number of records on pagination
     */
    public function get_products($offset=0, $limit=10) {

          $url = $this->url_prefix.MyBookingApiClient::GET_PRODUCTS;

          // Query data
					$request = wp_remote_get( $url );
					if( is_wp_error( $request ) ) {
						return null; // TODO
					}
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

          // Query data
					$request = wp_remote_get( $url );
					if( is_wp_error( $request ) ) {
						return null; // TODO
					}
					$body = wp_remote_retrieve_body( $request );
					$data = json_decode( $body );
					return $data;	

    }


  }
?>