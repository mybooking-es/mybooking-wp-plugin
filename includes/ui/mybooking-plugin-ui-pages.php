<?php
  /**
   * Mybooking UI Pages
   */
  class MyBookingUIPages
  {

     /**
      * Builds and loads the products page
      *
      * @param page the page index
      * @param limit the number of products in the page
      */
     public function products($page, $limit) {

				  $registry = Mybooking_Registry::getInstance();
          $offset = ($page - 1) * $limit;

          // Call the API 
          $api_client = new MybookingApiClient($registry->mybooking_rent_plugin_api_url_prefix,
          	                                   $registry->mybooking_rent_plugin_api_key);
          $data =$api_client->get_products($offset, $limit);
          if ( $data == null) {
          	$this->routes_not_found();
          }

          // Calculate pagination
          $total_pages = ceil($data->total / $data->limit);
          $current_page = floor($data->offset / $data->limit) + 1; 
          $pagination = new MyBookingUIPagination();          
          $pages = $pagination->pages($total_pages, $current_page);

          // Build the pages
          $data = array('data' => $data,
          	            'total_pages' => $total_pages,
          	            'current_page' => $current_page,
          	            'pages' => $pages);

          mybooking_engine_get_template('mybooking-plugin-routes-products.php', $data);
          die;    

     }

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