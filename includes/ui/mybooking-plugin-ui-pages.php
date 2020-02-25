<?php
  /**
   * Mybooking UI Pages
   */
  class MyBookingUIPages
  {

     /**
      * Builds and loads the product page
      *
      * @param code The product code
      */
     public function product($code) {

				  $registry = Mybooking_Registry::getInstance();

          // Call the API 
          $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
          	                                   $registry->mybooking_rent_plugin_api_key);
          $data =$api_client->get_product($code);
          if ( $data == null) {
          	$this->routes_not_found();
          }
          
          // Build the page
          mybooking_engine_get_template('mybooking-plugin-routes-product.php', $data);
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