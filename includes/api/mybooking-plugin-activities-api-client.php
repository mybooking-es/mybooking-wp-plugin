<?php
  /**
   * Mybooking Activities API Client
   */
  class MyBookingActivitiesApiClient
  {

    const GET_ACTIVITIES = '/api/booking-activities/frontend/activities';
    const GET_ACTIVITY = '/api/booking-activities/frontend/activities/';
    
    private $url_prefix;
    private $api_key;
		

	  public function __construct($the_url_prefix, $the_api_key)
	  {
       $this->url_prefix = $the_url_prefix;
       $this->api_key = $the_api_key;
	  }

    /**
     * Get the activities
     *
     * @param number $offset The offset on pagination
     * @param number $limit The number of records on pagination
     */
    public function get_activities($offset=0, $limit=20) {

          $url = $this->url_prefix.MyBookingActivitiesApiClient::GET_ACTIVITIES.'?offset='.$offset.'&limit='.$limit;

          if ( isset($this->api_key) && !empty($this->api_key)) {
            $url = $url.'&api_key='.$this->api_key;
          }

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
     * Get an activity detail
     *
     * @param string $id the activity id
     */
    public function get_activity($id) {

          $url = $this->url_prefix.MyBookingActivitiesApiClient::GET_ACTIVITY.$id;

          if ( isset($this->api_key) && !empty($this->api_key)) {
            $url = $url.'?api_key='.$this->api_key;
          }
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