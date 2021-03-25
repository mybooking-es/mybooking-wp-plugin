<?php
  /**
   * Mybooking Activities API Client
   */
  class MyBookingActivitiesApiClient
  {

    const GET_ACTIVITIES = '/api/booking-activities/frontend/activities';
    const GET_ACTIVITY = '/api/booking-activities/frontend/activities/';
    const GET_DESTINATIONS = '/api/booking-activities/frontend/destinations';
    const GET_CATEGORIES = '/api/booking-activities/frontend/categories';

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
     * Get the activities
     *
     * @param number $destination_id The destination
     * @param number $family_id The family
     * @param string $q The query
     * @param number $offset The offset on pagination
     * @param number $limit The number of records on pagination
     */
    public function get_activities($destination_id=null, $family_id=null, $q='', $offset=0, $limit=20) {

          $url = $this->url_prefix.MyBookingActivitiesApiClient::GET_ACTIVITIES.'?offset='.$offset.'&limit='.$limit;
          
          // Destination
          if ( $destination_id != null && !empty($destination_id) ) {
            $url.='&destination_id='.$destination_id;
          }
          // Family
          if ( $family_id != null && !empty($family_id) ) {
            $url.='&family_id='.$family_id;
          }
          // Query
          if ( $q != null && !empty($q) ) {
            $url.='&q='.urlencode( $q );
          }
          // Api Key
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
     * Get an activity detail
     *
     * @param string $id the activity id
     */
    public function get_activity($id) {

          $url = $this->url_prefix.MyBookingActivitiesApiClient::GET_ACTIVITY.$id;
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