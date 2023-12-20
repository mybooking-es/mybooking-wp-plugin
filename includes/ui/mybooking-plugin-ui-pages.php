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
          if ( !empty( $registry->mybooking_rent_plugin_sales_channel_code ) ) {
            $data->sales_channel_code = $registry->mybooking_rent_plugin_sales_channel_code;
          }
          // Create a "simulated" post with the data to best integration with themes
          $this->product_content( $data );
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

    /**
     * Create a "simulated" post with the product detail
     */
    private function product_content($data) {

          global $wp, $wp_query;

          $post_id = -99; // negative ID, to avoid clash with a valid post
          $post = new stdClass();
          $post->ID = $post_id;
          $post->post_author = 1;
          $post->post_date = current_time( 'mysql' );
          $post->post_date_gmt = current_time( 'mysql', 1 );
          $post->post_title = $data->name;
          $post->post_content = $data->short_description;
          $post->post_status = 'publish';
          $post->comment_status = 'closed';
          $post->ping_status = 'closed';
          $post->post_name = 'product-page-' . wp_rand( 1, 99999 ); // append random number to avoid clash
          $post->post_type = 'page';
          $post->filter = 'raw'; // important!

          // Convert to WP_Post object
          $wp_post = new WP_Post( $post );

          // Add the product "simulated" post to the cache
          wp_cache_add( $post_id, $wp_post, 'posts' );
  
          // Update the main query
          $wp_query->post = $wp_post;
          $wp_query->posts = array( $wp_post );
          $wp_query->queried_object = $wp_post;
          $wp_query->queried_object_id = $post_id;
          $wp_query->found_posts = 1;
          $wp_query->post_count = 1;
          $wp_query->max_num_pages = 1; 
          $wp_query->is_page = true;
          $wp_query->is_singular = true; 
          $wp_query->is_single = false; 
          $wp_query->is_attachment = false;
          $wp_query->is_archive = false; 
          $wp_query->is_category = false;
          $wp_query->is_tag = false; 
          $wp_query->is_tax = false;
          $wp_query->is_author = false;
          $wp_query->is_date = false;
          $wp_query->is_year = false;
          $wp_query->is_month = false;
          $wp_query->is_day = false;
          $wp_query->is_time = false;
          $wp_query->is_search = false;
          $wp_query->is_feed = false;
          $wp_query->is_comment_feed = false;
          $wp_query->is_trackback = false;
          $wp_query->is_home = false;
          $wp_query->is_embed = false;
          $wp_query->is_404 = false; 
          $wp_query->is_paged = false;
          $wp_query->is_admin = false; 
          $wp_query->is_preview = false; 
          $wp_query->is_robots = false; 
          $wp_query->is_posts_page = false;
          $wp_query->is_post_type_archive = false;

          $GLOBALS['wp_query'] = $wp_query;
          $wp->register_globals();

    }

  }
?>