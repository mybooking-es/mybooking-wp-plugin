<?php
  /**
   * Mybooking UI Activities Pages
   */
  class MyBookingUIActivitiesPages
  {

     /**
      * Builds and loads the activity page
      *
      * @param id The activity id
      */
     public function activity($id) {

				  $registry = Mybooking_Registry::getInstance();

          // Call the API 
          $api_client = new MyBookingActivitiesApiClient($registry->mybooking_rent_plugin_api_url_prefix,
          	                                             $registry->mybooking_rent_plugin_api_key);
          $data =$api_client->get_activity($id);
          if ( $data == null || empty($data) ) {
          	$this->routes_not_found();
          }
          // Build the page
          mybooking_engine_get_template('mybooking-plugin-routes-activity.php', $data);
          die;

     }     

	   /**
	    * Page not found
	    */
		private function routes_not_found() {
	        status_header(404);
	        nocache_headers();
	        include( get_query_template( '404' ) );		
	        die;	
		}


  }
?>