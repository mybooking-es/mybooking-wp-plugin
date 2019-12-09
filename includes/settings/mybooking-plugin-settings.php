<?php
  class MyBookingPluginSettings {

	  public function __construct()
	  {
	    	$this->wp_init();
	  }

    private function wp_init() {

			// Create menu in settings
			add_action( 'admin_menu', array($this,'wp_settings_page'));

			// Initialize settings
			add_action( 'admin_init', array($this,'wp_settings_init'));

    }


		// == Settings Page

		/**
		 * Settings page : Create new settings page
		 */
		public function wp_settings_page() {
		  add_options_page('Mybooking Plugin', // Page title
		                   'Mybooking', // Menu option title 
		                   'manage_options', // Capability
		                   'mybooking-plugin-configuration', // Slug 
		                   array($this, 'mybooking_plugin_settings_page')); // Callable 
		}

		/**
		 * Render Mybooking settings page
		 *
		 * setting_fields: Settings section id
		 * setting_sections :Plugin menu slug
		 *
		 * <?php settings_fields('mybooking_plugin_settings_group'); ?> 
		 * <?php do_settings_sections('mybooking-plugin-configuration'); ?>  
		 * 
		 * https://developer.wordpress.org/reference/functions/do_settings_fields/
		 */
		public function mybooking_plugin_settings_page() {
		?>
		  <div class="wrap">
		  	  <h1>Mybooking</h1>

					<?php
	            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'connection_options';
	        ?>

					<h2 class="nav-tab-wrapper">
					    <a href="?page=mybooking-plugin-configuration&tab=connection_options" class="nav-tab <?php echo $active_tab == 'connection_options' ? 'nav-tab-active' : ''; ?>">Connection</a>
					    <a href="?page=mybooking-plugin-configuration&tab=configuration_options" class="nav-tab <?php echo $active_tab == 'configuration_options' ? 'nav-tab-active' : ''; ?>">Configuration</a>
					    <a href="?page=mybooking-plugin-configuration&tab=renting_options" class="nav-tab <?php echo $active_tab == 'renting_options' ? 'nav-tab-active' : ''; ?>">Renting</a>
					    <a href="?page=mybooking-plugin-configuration&tab=activities_options" class="nav-tab <?php echo $active_tab == 'activities_options' ? 'nav-tab-active' : ''; ?>">Activities</a>
					    <a href="?page=mybooking-plugin-configuration&tab=google_api_places_options" class="nav-tab <?php echo $active_tab == 'google_api_places_options' ? 'nav-tab-active' : ''; ?>">Google Api Places</a>
					    <a href="?page=mybooking-plugin-configuration&tab=css_options" class="nav-tab <?php echo $active_tab == 'css_options' ? 'nav-tab-active' : ''; ?>">CSS</a>
					</h2>

		      <form action="options.php" method="POST">
               
	            <?php

               $renting_wizard_info = <<<EOF
                 <p>This settings allows to build a <em>reservation engine wizard</em> like a <em>car rental company</em> or <em>accommodation</em> using the following steps:</p>
                 <ol style="list-style:square; margin-left: 20px">
                   <li>Selector widget in home page</li>
                   <li><b>Choose vehicle/room/product</b> page</li>
                   <li><b>Choose extras</b> page (optional)</li>
                   <li><b>Complete reservation</b> page</li>
                   <li>Payment</li>
                   <li><b>Summary</b> page</li>
                 </ol>
                 <p>It is an option when having a few number of products 
                 and we want to show all them in a single page with avalability and price information</p> 
                 <hr>
EOF;

               $renting_navigation_info = <<<EOF
                 <p>This settings allows to build a <em>reservation engine</em> with a <u>detailed page for each product</u>.</p>
                 <p>It connects to <strong>mybooking API</strong> to retrieve the products, so it is not necessary to create a custom post type.</p>
                 <p>There is a <em>"products"</em> pages where the user can select a product and a detail page which shows the
                 availability calendar and from which the user can make a reservation.</p>
EOF;

               $activity_info = <<<EOF
                 <p>Build an activities reservation site.</p>
                 <ol style="list-style:square; margin-left: 20px">
                   <li><b>Selector widget</b> in any of the activities page</li>
                   <li><b>Shopping cart / Checkout</b> page</li>
                   <li>Payment</li>
                   <li><b>Summary</b> page</li>
                 </ol>
EOF;

	             if ($active_tab == 'connection_options') { 
			      	   settings_fields('mybooking_plugin_settings_group_connection'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_connection'); 
			           echo '</table>';
			         }	     
			         else if ($active_tab == 'configuration_options') {
			      	   settings_fields('mybooking_plugin_settings_group_configuration'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_configuration'); 
			           echo '</table>';
			         }  
			         else if ($active_tab == 'renting_options') {
			         	 echo $renting_wizard_info;
			      	   settings_fields('mybooking_plugin_settings_group_renting'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_renting'); 
			           echo '</table>';
			         }   			         
			         else if ($active_tab == 'activities_options') {
			         	 echo $activity_info;
			      	   settings_fields('mybooking_plugin_settings_group_activities'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_activities'); 
			           echo '</table>';
			         }  
			         else if ($active_tab == 'google_api_places_options') {
			      	   settings_fields('mybooking_plugin_settings_group_google_api_places'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_google_api_places'); 
			           echo '</table>';
			         }  
			         else if ($active_tab == 'css_options') {
			      	   settings_fields('mybooking_plugin_settings_group_css'); 
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_css'); 
			           echo '</table>';
			         }  			         
			        submit_button(); 
		        ?>
		      </form>
		  </div>
		<?php 
		}

    // == Settings Init

		/**
		 * Settings init : Initialize settings
		 * -------------------------------------------------
		 *
		 * setting:  mybooking_plugin_settings
     * sections:
     *   - connection
     *   - renting wizard
     *   - renting
     *   - activities
		 *
		 */ 
		public function wp_settings_init() {

		  // Register mybooking settings setting
		  register_setting('mybooking_plugin_settings_group_connection',
		                   'mybooking_plugin_settings_connection');

		  register_setting('mybooking_plugin_settings_group_configuration',
		                   'mybooking_plugin_settings_configuration');

		  register_setting('mybooking_plugin_settings_group_options',
		                   'mybooking_plugin_settings_options'); //

		  register_setting('mybooking_plugin_settings_group_renting',
		                   'mybooking_plugin_settings_renting');

		  register_setting('mybooking_plugin_settings_group_google_places',
		                   'mybooking_plugin_settings_google_places'); //

		  register_setting('mybooking_plugin_settings_group_activities',
		                   'mybooking_plugin_settings_activities');		  

		  register_setting('mybooking_plugin_settings_group_google_api_places',
		                   'mybooking_plugin_settings_google_api_places');	

		  register_setting('mybooking_plugin_settings_group_css',
		                   'mybooking_plugin_settings_css');		  

      // == Creates setting sections

      // Creates a connection settings section "mybooking_plugin_settings_section_connection"
		  add_settings_section('mybooking_plugin_settings_section_connection',
		                       'Connection',
		                       '',
		                       'mybooking-plugin-configuration');

      // Creates a connection settings section "mybooking_plugin_settings_section_configuration"
		  add_settings_section('mybooking_plugin_settings_section_configuration',
		                       'Configuration',
		                       '',
		                       'mybooking-plugin-configuration');

		  // Creates a renting wizard settings section "mybooking_plugin_settings_section_renting"
		  add_settings_section('mybooking_plugin_settings_section_renting',
		                       'Renting wizard',
		                       '',
		                       'mybooking-plugin-configuration');

		  // Creates an activities settings section "mybooking_plugin_settings_section_activities"
		  add_settings_section('mybooking_plugin_settings_section_activities',
		                       'Activities',
		                       '',
		                       'mybooking-plugin-configuration');


      // Creates a connection settings section "mybooking_plugin_settings_section_google_api_places"
		  add_settings_section('mybooking_plugin_settings_section_google_api_places',
		                       'Connection',
		                       '',
		                       'mybooking-plugin-configuration');

      // Creates a css settings section "mybooking_plugin_settings_css"
		  add_settings_section('mybooking_plugin_settings_css',
		                       'CSS',
		                       '',
		                       'mybooking-plugin-configuration');


      // == Creates connection fields
		  add_settings_field('mybooking_plugin_settings_account_id',
		                     'Mybooking Id',
		                     array($this, 'field_mybooking_plugin_settings_account_id_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

		  add_settings_field('mybooking_plugin_settings_api_key',
		                     'Mybooking API Key',
		                     array($this, 'field_mybooking_plugin_settings_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

      // == Creates configuration fields

		  add_settings_field('mybooking_plugin_settings_renting_selector',
		                     'Renting',
		                     array($this, 'field_mybooking_plugin_settings_renting_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');
		  add_settings_field('mybooking_plugin_settings_activities_selector',
		                     'Activities',
		                     array($this, 'field_mybooking_plugin_settings_activities_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');
		  add_settings_field('mybooking_plugin_settings_google_api_places_selector',
		                     'Google Api Places',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');

      // == Creates renting wizard fields
  
		  add_settings_field('mybooking_plugin_settings_choose_products_page',
		                     'Choose products page',
		                     array($this, 'field_mybooking_plugin_settings_choose_products_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_choose_extras_page',
		                     'Choose extras page',
		                     array($this, 'field_mybooking_plugin_settings_choose_extras_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_checkout_page',
		                     'Checkout page',
		                     array($this, 'field_mybooking_plugin_settings_checkout_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_summary_page',
		                     'Summary page',
		                     array($this, 'field_mybooking_plugin_settings_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_products_url',
		                     'Products URL',
		                     array($this, 'field_mybooking_plugin_settings_products_url_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');


      // == Creates activities section fields

		  add_settings_field('mybooking_plugin_settings_activities_shopping_cart_page',
		                     'Shopping cart page',
		                     array($this, 'field_mybooking_plugin_settings_activities_shopping_cart_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_order_page',
		                     'Summary page',
		                     array($this, 'field_mybooking_plugin_settings_activities_order_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

      // == Creates google api places fields

		  add_settings_field('mybooking_plugin_settings_google_api_places_api_key',
		                     'Api Key',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_restrict_country_code',
		                     'Country code restriction',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_restrict_country_code_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_restrict_bounds',
		                     'Restrict bounds',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_restrict_bounds_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_sw_lat',
		                     'SW Latitude',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_sw_lat_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_sw_lng',
		                     'SW Longitude',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_sw_lng_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_ne_lat',
		                     'NE Latitude',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_ne_lat_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_ne_lng',
		                     'NE Longitude',
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_ne_lng_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  // == Create css section fields

		  add_settings_field('mybooking_plugin_settings_custom_css',
		                     'Include plugin CSS',
		                     array($this, 'field_mybooking_plugin_settings_custom_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');  

		}

    // == Connection

		/**
		 * Render Mybooking Account Id
		 */
		public function field_mybooking_plugin_settings_account_id_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_connection");
		  $field = "mybooking_plugin_settings_account_id";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_connection[$field]' value='$value' class='regular-text' />";
		}

		/**
		 * Render Mybooking API Key 
		 */
		public function field_mybooking_plugin_settings_api_key_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_connection");
		  $field = "mybooking_plugin_settings_api_key";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_connection[$field]' value='$value' class='regular-text' />";
		}

    // == Configuration

		/**
		 * Render Mybooking Renting module
		 */
		public function field_mybooking_plugin_settings_renting_selector_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_configuration");
		  $field = "mybooking_plugin_settings_renting_selector";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  } 
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_configuration[$field]' value='1' $checked class='regular-text' />";
		}

		/**
		 * Render Mybooking Activities module
		 */
		public function field_mybooking_plugin_settings_activities_selector_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_configuration");
		  $field = "mybooking_plugin_settings_activities_selector";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  } 
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_configuration[$field]' value='1' $checked class='regular-text' />";
		}

		/**
		 * Render Mybooking Google Places API module
		 */
		public function field_mybooking_plugin_settings_google_api_places_selector_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_configuration");
		  $field = "mybooking_plugin_settings_google_api_places_selector";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  } 
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_configuration[$field]' value='1' $checked class='regular-text' />";
		}

    // == Renting 

		/**
		 * Render Mybooking Renting/Accommodation Choose products page
		 */
		public function field_mybooking_plugin_settings_choose_products_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_choose_products_page");

		}

		/**
		 * Render Mybooking Renting/Accommodation Choose extras page
		 */
		public function field_mybooking_plugin_settings_choose_extras_page_callback() {
		  
		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_choose_extras_page");

		}

		/**
		 * Render Mybooking Renting/Accommodation Checkout page
		 */
		public function field_mybooking_plugin_settings_checkout_page_callback() {
		  
		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_checkout_page");

		}

		/**
		 * Render Mybooking Renting/Accommodation Summary page
		 */
		public function field_mybooking_plugin_settings_summary_page_callback() {
		  
		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_summary_page");

		}

		/**
		 * Render Mybooking Products URL 
		 */
		public function field_mybooking_plugin_settings_products_url_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_products_url";
		  if (array_key_exists($field, $settings)) {
		    $value = $settings[$field] ? esc_attr( $settings[$field] ) : 'products';
		  }
		  else {
		  	$value = 'products';
		  }
		  echo "<input type='text' name='mybooking_plugin_settings_renting[$field]' value='$value' class='regular-text' />";
		  echo "<p class=\"description\">The URL prefix that will show the products. The default is <em>products</em> but you can replace it depending on the context. Use vehicles, rooms, ...</p>";
      echo "<p class=\"description\">A new route /the-value will be accessible and this url will show the products retrieved from <b>mybooking API</b></p>";
		}

    // == Activities

		/**
		 * Render Mybooking Activities Shopping cart page
		 */
		public function field_mybooking_plugin_settings_activities_shopping_cart_page_callback() {
		  
		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_activities_shopping_cart_page");

		}

		/**
		 * Render Mybooking Activities order/reservation page
		 */
		public function field_mybooking_plugin_settings_activities_order_page_callback() {
		  
		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_order_page");

		}

    // == Google API Places

		/**
		 * Render Mybooking Google Api Places Api Key
		 */
		public function field_mybooking_plugin_settings_google_api_places_api_key_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_api_key";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}

		/**
		 * Render Mybooking Google Api Places Restrict Country Code
		 */
		public function field_mybooking_plugin_settings_google_api_places_restrict_country_code_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_restrict_country_code";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}		

		/**
		 * Render Mybooking Custom CSS
		 */
		public function field_mybooking_plugin_settings_google_api_places_restrict_bounds_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_restrict_bounds";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  } 
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_google_api_places[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_google_api_places[$field]' value='1' $checked class='regular-text' />";
		}

		/**
		 * Render Mybooking Google Api Places Bounds SW lat
		 */
		public function field_mybooking_plugin_settings_google_api_places_bounds_sw_lat_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_bounds_sw_lat";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}	

		/**
		 * Render Mybooking Google Api Places Bounds SW lat
		 */
		public function field_mybooking_plugin_settings_google_api_places_bounds_sw_lng_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_bounds_sw_lng";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}	

		/**
		 * Render Mybooking Google Api Places Bounds NE lat
		 */
		public function field_mybooking_plugin_settings_google_api_places_bounds_ne_lat_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_bounds_ne_lat";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}	

		/**
		 * Render Mybooking Google Api Places Bounds NE lat
		 */
		public function field_mybooking_plugin_settings_google_api_places_bounds_ne_lng_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_google_api_places");
		  $field = "mybooking_plugin_settings_google_api_places_bounds_ne_lng";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  echo "<input type='text' name='mybooking_plugin_settings_google_api_places[$field]' value='$value' class='regular-text' />";
		}	

    // == CSS

		/**
		 * Render Mybooking Custom CSS
		 */
		public function field_mybooking_plugin_settings_custom_css_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_custom_css";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  } 
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";
		}

    // ------------------------

		private function field_mybooking_plugin_renting_settings_page($field) {

		  $my_pages = array();
		  $pages = get_pages();
		  foreach( $pages as $page ) {
		    $my_pages[$page->ID] = $page->post_title; // $page->post_name
		  }   

		  $settings = (array) get_option("mybooking_plugin_settings_renting_wizard");
		  if (array_key_exists($field, $settings)) {		  
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  $select = "<select name='mybooking_plugin_settings_renting_wizard[$field]'>";
		  $select .= "<option value=''>[Choose page]</option>";
		  foreach ($my_pages as $page => $title) {
		     if ($value == $page) {
		        $select .= "<option value='$page' selected>$title</option>";
		     }
		     else {
		        $select .= "<option value='$page'>$title</option>"; 
		     }
		  }
		  $select .= "</select>";

		  echo $select;

		}

		private function field_mybooking_plugin_activities_settings_page($field) {

		  $my_pages = array();
		  $pages = get_pages();
		  foreach( $pages as $page ) {
		    $my_pages[$page->ID] = $page->post_title; // $page->post_name
		  }   

		  $settings = (array) get_option("mybooking_plugin_settings_activities");
		  if (array_key_exists($field, $settings)) {		  
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }
		  
		  $select = "<select name='mybooking_plugin_settings_activities[$field]'>";
		  $select .= "<option value=''>[Choose page]</option>";
		  foreach ($my_pages as $page => $title) {
		     if ($value == $page) {
		        $select .= "<option value='$page' selected>$title</option>";
		     }
		     else {
		        $select .= "<option value='$page'>$title</option>"; 
		     }
		  }
		  $select .= "</select>";

		  echo $select;

		}


  }