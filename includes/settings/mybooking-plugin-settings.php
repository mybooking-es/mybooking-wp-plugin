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
		public function wp_settings_page()
    {
		  add_menu_page(
        'Mybooking Plugin', // Page title
        'Mybooking', // Menu option title
        'manage_options', // Capability
        'mybooking-plugin-configuration', // Slug
        array($this, 'mybooking_plugin_settings_page'),
        plugin_dir_url(__DIR__)."../assets/images/mybooking-logo-bn.png",
        4.1
      ); // Callable

      add_submenu_page(
		      'mybooking-plugin-configuration',
		    	_x('Settings', 'plugin_settings', 'mybooking-plugin'),
		    	_x('Settings', 'plugin_settings', 'mybooking-plugin'),
		    	'manage_options',
		    	'mybooking-plugin-configuration', // The same slug as the main menu so it will be the default option
		    	array($this, 'mybooking_plugin_settings_page'),
  		    -1
		    );
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
	            $active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_title( $_GET[ 'tab' ] ) : 'connection_options';
	            $tabs = array('connection_options', 'configuration_options', 'renting_options',
	            						  'activities_options', 'google_api_places_options', 'complements_options', 'css_options');
	            if ( !in_array( $active_tab, $tabs) ) {
	            	$active_tab = 'connection_options';
	            }
	        ?>

	        <?php
	           $settings = (array) get_option("mybooking_plugin_settings_configuration");
	           $renting = $settings && array_key_exists('mybooking_plugin_settings_renting_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_renting_selector"] )) == '1') : false;
	           $activities = $settings && array_key_exists('mybooking_plugin_settings_activities_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_activities_selector"] )) == '1') : false;
	           $google_api_places = $settings && array_key_exists('mybooking_plugin_settings_google_api_places_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_selector"] )) == '1') : false;
	         ?>

					<h2 class="nav-tab-wrapper">
					    <a href="?page=mybooking-plugin-configuration&tab=connection_options" class="nav-tab <?php echo $active_tab == 'connection_options' ? 'nav-tab-active' : ''; ?>">Connection</a>
					    <a href="?page=mybooking-plugin-configuration&tab=configuration_options" class="nav-tab <?php echo $active_tab == 'configuration_options' ? 'nav-tab-active' : ''; ?>">Configuration</a>
					    <?php if ($renting) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=renting_options" class="nav-tab <?php echo $active_tab == 'renting_options' ? 'nav-tab-active' : ''; ?>">Renting</a>
              <?php } ?>
					    <?php if ($activities) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=activities_options" class="nav-tab <?php echo $active_tab == 'activities_options' ? 'nav-tab-active' : ''; ?>">Activities or Appointments</a>
					    <?php } ?>
					    <?php if ($google_api_places) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=google_api_places_options" class="nav-tab <?php echo $active_tab == 'google_api_places_options' ? 'nav-tab-active' : ''; ?>">Google Api Places</a>
					    <?php } ?>
              <a href="?page=mybooking-plugin-configuration&tab=complements_options" class="nav-tab <?php echo $active_tab == 'complements_options' ? 'nav-tab-active' : ''; ?>">Complements</a>
					    <a href="?page=mybooking-plugin-configuration&tab=css_options" class="nav-tab <?php echo $active_tab == 'css_options' ? 'nav-tab-active' : ''; ?>">Advanced</a>
					</h2>

		      <form action="options.php" method="POST">

	            <?php

               $renting_wizard_info = <<<EOF
                 <p>The following settings allows to build a <em>reservation engine</em> for a <u>car rental company</u> or <u>accommodation</u> using the following steps:</p>
                 <ol style="list-style:square; margin-left: 20px">
                   <li><b>Choose vehicle/room/product</b> page</li>
                   <li><b>Choose extras</b> page (optional)</li>
                   <li><b>Complete reservation</b> page</li>
                   <li><b>Summary</b> page</li>
                 </ol>
                 <hr>
EOF;

               $activity_info = <<<EOF
                 <p>Build appointments or activities reservation site.</p>
                 <ol style="list-style:square; margin-left: 20px">
                   <li><b>Selector widget</b> in any of the activities page</li>
                   <li><b>Checkout</b> page</li>
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
               else if ($active_tab == 'complements_options') {
			      	   settings_fields('mybooking_plugin_settings_group_complements');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_complements');
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

      register_setting('mybooking_plugin_settings_group_complements',
                 		   'mybooking_plugin_settings_complements');

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
		                       'Activities or Appointments',
		                       '',
		                       'mybooking-plugin-configuration');


      // Creates a connection settings section "mybooking_plugin_settings_section_google_api_places"
		  add_settings_section('mybooking_plugin_settings_section_google_api_places',
		                       'Connection',
		                       '',
		                       'mybooking-plugin-configuration');

      // Creates a complements setting section "mybooking_plugin_settings_section_complements"
      add_settings_section('mybooking_plugin_settings_section_complements',
		                       'Complements',
		                       '',
		                       'mybooking-plugin-configuration');

      // Creates a css settings section "mybooking_plugin_settings_css"
		  add_settings_section('mybooking_plugin_settings_css',
		                       'CSS',
		                       '',
		                       'mybooking-plugin-configuration');


      // == Creates connection fields
		  add_settings_field('mybooking_plugin_settings_account_id',
		                     'Mybooking Id or URL',
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
		                     'Activities or Appointments',
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

		  add_settings_field('mybooking_plugin_settings_terms_page',
		                     'Terms and conditions page',
		                     array($this, 'field_mybooking_plugin_settings_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Selector in process
		  add_settings_field('mybooking_plugin_settings_selector_in_process',
		                     'Selector in process',
		                     array($this, 'field_mybooking_plugin_settings_selector_in_process_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Product detail pages (calendar)
		  add_settings_field('mybooking_plugin_settings_use_product_detail_pages',
		  									'<em>Use product detail pages</em>',
		  									array($this, 'field_mybooking_plugin_settings_use_product_detail_pages_callback'),
		  									'mybooking-plugin-configuration',
		  									'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_products_url',
		                     '<em>Product details pages URL prefix</em>',
		                     array($this, 'field_mybooking_plugin_settings_products_url_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

      // == Creates activities section fields
		  add_settings_field('mybooking_plugin_settings_activities_shopping_cart_page',
		                     'Checkout page',
		                     array($this, 'field_mybooking_plugin_settings_activities_shopping_cart_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_summary_page',
		                     'Summary page',
		                     array($this, 'field_mybooking_plugin_settings_activities_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_terms_page',
		                     'Terms & conditions page',
		                     array($this, 'field_mybooking_plugin_settings_activities_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  // Activity detail pages
		  add_settings_field('mybooking_plugin_settings_use_activities_detail_pages',
		  									'<em>Use detail pages</em>',
		  									array($this, 'field_mybooking_plugin_settings_use_activities_detail_pages_callback'),
		  									'mybooking-plugin-configuration',
		  									'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_url',
		                     '<em>Detail pages URL prefix</em>',
		                     array($this, 'field_mybooking_plugin_settings_activities_url_callback'),
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

      // == Create Complements section Fields
      add_settings_field('mybooking_plugin_settings_complements_popup',
		                     'Activate promotion pop-up',
		                     array($this, 'field_mybooking_plugin_settings_complements_popup_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_testimonials',
		                     'Activate testimonial module',
		                     array($this, 'field_mybooking_plugin_settings_complements_testimonials_callback'),
                         'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

       add_settings_field('mybooking_plugin_settings_complements_cookies',
 		                     'Activate cookies notice',
 		                     array($this, 'field_mybooking_plugin_settings_complements_cookies_callback'),
                          'mybooking-plugin-configuration',
 		                     'mybooking_plugin_settings_section_complements');

		  // == Create css section fields
		  add_settings_field('mybooking_plugin_settings_components_custom_loader',
		                     'Use custom loader',
		                     array($this, 'field_mybooking_plugin_settings_components_custom_loader_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  add_settings_field('mybooking_plugin_settings_components_css',
		                     'Custom CSS',
		                     array($this, 'field_mybooking_plugin_settings_components_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  add_settings_field('mybooking_plugin_settings_custom_css',
		                     'Include CSS/JS Framework',
		                     array($this, 'field_mybooking_plugin_settings_custom_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  add_settings_field('mybooking_plugin_settings_components_js_use_select2',
		                     'Use select2 library on selects',
		                     array($this, 'field_mybooking_plugin_settings_components_js_use_select2_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  add_settings_field('mybooking_plugin_settings_components_js_bs_modal_no_conflict',
		                     'Boostrap Modal no conflict mode',
		                     array($this, 'field_mybooking_plugin_settings_components_js_bs_modal_no_conflict_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  add_settings_field('mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility',
		                     'Boostrap Modal backdrop',
		                     array($this, 'field_mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility_callback'),
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
		  echo "<p class=\"description\">If you have a <b>mybooking subdomain</b> like <em>mycompany.mybookig.es</em>, input the subdomain name, <u>mycompany</u>.";
		  echo "<p class=\"description\">If your account is in other platform, like karyasala.com, just write the full domain, <em>https://karyasala.com</em>.</p>";

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
		  echo "<p class=\"description\">This page is shown after the <u>reservation selector submit</u>.";
		  echo "<p class=\"description\">It shows <b>all</b> the <em>company products</em> and <u>availability</u> for the selected dates and allows the customer to pickup the product.</p>";
		  echo "<p class=\"description\">This page is recommeded when the company offers a reduced set of categories, and holds an inventary of each one. For example, a <u>car rental company</u> or a <u>hotel</u>.</p>";
		  echo "<p class=\"description\">It can be used to build websites like: <a href=\"https://avis.com\" target=\"_blank\">avis.com</a>, <a href=\"https://www.hotelpalacebarcelona.com/\" target=\"_blank\">hotelpalacebarcelona.com</a></p>";

		}

		/**
		 * Render Mybooking Renting/Accommodation Choose extras page
		 */
		public function field_mybooking_plugin_settings_choose_extras_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_choose_extras_page");
		  echo "<p class=\"description\">An <em>optional</em> step page that shows and allows to select the reservation extras.</p>";

		}

		/**
		 * Render Mybooking Renting/Accommodation Checkout page
		 */
		public function field_mybooking_plugin_settings_checkout_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_checkout_page");
		  echo "<p class=\"description\">The complete reservation or checkout page. It shows the fill data form to finish the reservation process.</p>";

		}

		/**
		 * Render Mybooking Renting/Accommodation Summary page
		 */
		public function field_mybooking_plugin_settings_summary_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_summary_page");
		  echo "<p class=\"description\">The summary page. It shows the reservation information and allows the customer to fill the contract information and to pay.</p>";

		}

		/**
		 * Render Mybooking Renting/Accommodation Terms and conditions page
		 */
		public function field_mybooking_plugin_settings_terms_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_terms_page");
		  echo "<p class=\"description\">The terms and conditions page.</p>";

		}

		/**
		 * Render Mybooking Selector in process
		 */
		public function field_mybooking_plugin_settings_selector_in_process_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_selector_in_process";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose selector]</option>";

		  if ($value == 'wizard') {
		    $select .= "<option value='wizard' selected>Wizard</option>";
		  }
		  else {
		    $select .= "<option value='wizard'>Wizard</option>";
		  }

			if ($value == 'form') {
		    $select .= "<option value='form' selected>Form</option>";
		  }
		  else {
		    $select .= "<option value='form'>Form</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the selector that you want to use when you choose <em>modify reservation</em> on choose product or complete pages.</p>";
		  echo "<p class=\"description\">Select <b>wizard</b> if you are using the Wizard selector or widget on your home page.</p>";
		  echo "<p class=\"description\">Select <b>form</b> if you are using the Form selector or widget on yout home page.</p>";
		  echo "<hr>";

		}

		/**
		 * Render Mybooking Use Products Detail page
		 */
		public function field_mybooking_plugin_settings_use_product_detail_pages_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_use_product_detail_pages";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_renting[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_renting[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use product detail pages.";
		  echo "<p class=\"description\">Activate if you are fetching the products from the back-office using the <u>[mybooking_rent_engine_products]</u> shortcode.</p>";
		  echo "<p class=\"description\">Do not activate if you are using the wizard process. That is, the <u>[mybooking_rent_engine_product_listing]</u> shortcode on your choose products page.</p>";


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
		  echo "<p class=\"description\">This page shows a company product detail page. This page includes a calendar with its availability.";
		  echo "<p class=\"description\">This should be used with a <b>products navigation page</b> created with the [mybooking_rent_engine_products] shortcode.";
      echo "<p class=\"description\">Create the navigation page with a slug of <em>products</em> and then select <u>products</u> as the <em>product page url prefix</em>.";
		  echo "<p class=\"description\">It creates a new URL route and access <em>mybooking</em> <b>API</b> to retrieve the data.</p>";
		  echo "<p class=\"description\">This page is recommeded when the company offers a big quantity of products instead a reduced set of categories.</p>";
		  echo "<p class=\"description\">It can be used to build websites like: <a href=\"https://yescapa.com\" target=\"_blank\">yescapa.com</a>, <a href=\"https://www.airbnb.com/\" target=\"_blank\">airbnb.com</a></p>";

		}

    // == Activities

		/**
		 * Render Mybooking Activities Shopping cart page
		 */
		public function field_mybooking_plugin_settings_activities_shopping_cart_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_shopping_cart_page");

		}

		/**
		 * Render Mybooking Activities order/reservation page
		 */
		public function field_mybooking_plugin_settings_activities_summary_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_summary_page");

		}

		/**
		 * Render Mybooking Activities terms and conditions page
		 */
		public function field_mybooking_plugin_settings_activities_terms_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_terms_page");

		}

		/**
		 * Render Mybooking Use Activities Detail page
		 */
		public function field_mybooking_plugin_settings_use_activities_detail_pages_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_activities");
		  $field = "mybooking_plugin_settings_use_activities_detail_pages";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_activities[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_activities[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use detail pages.";
		  echo "<p class=\"description\">Activate if you are fetching data from the back-office using the <u>[mybooking_activities_engine_activities]</u> shortcode.</p>";
		  echo "<p class=\"description\">Do not activate if you are using the <u>[mybooking_activities_engine_activity]</u> shortcode on your custom pages.</p>";


		}

		/**
		 * Render Mybooking Activities URL
		 */
		public function field_mybooking_plugin_settings_activities_url_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_activities");
		  $field = "mybooking_plugin_settings_activities_url";
		  if (array_key_exists($field, $settings)) {
		    $value = $settings[$field] ? esc_attr( $settings[$field] ) : 'activities';
		  }
		  else {
		  	$value = 'activities';
		  }
		  echo "<input type='text' name='mybooking_plugin_settings_activities[$field]' value='$value' class='regular-text' />";
		  echo "<p class=\"description\">This page shows a company product detail page. This page includes a calendar with its availability.";
		  echo "<p class=\"description\">This should be used with a <b>product navigation page</b> created with the [mybooking_rent_engine_activities] shortcode.";
      echo "<p class=\"description\">Create the navigation page with a slug of <b>activities</b> and then select <u>activities</u> as the <em>activity page url prefix</em>.";
		  echo "<p class=\"description\">It creates a new URL route and access <em>mybooking</em> <b>API</b> to retrieve the data.</p>";
		  echo "<p class=\"description\">It can be used to build websites like: <a href=\"https://getyourguide.com\" target=\"_blank\">getyourguide.com</a></p>";

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

    // == Complements

    /**
     * Render promo pop-up complements
     */
    public function field_mybooking_plugin_settings_complements_popup_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_popup";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Activate <b>Promotion Pop-ups</b> Custom Post Type in order to create promotions.</p>";
      echo "<p class=\"description\">Pop-up will be shown only in the front page.</p>";
 		}

    /**
     * Render testimonials complements
     */
    public function field_mybooking_plugin_settings_complements_testimonials_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_testimonials";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Activate <b>Testimonials</b> Custom Post Type in order to create a testimonials carousel.</p>";
      echo "<p class=\"description\">Create one or more Testimonials under Mybooking menu and use [mybooking_testimonials] to show it on a page or sidebar.</p>";
 		}

    /**
     * Render cookies complements
     */
    public function field_mybooking_plugin_settings_complements_cookies_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_cookies_notice";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Activate <b>Cookies Notice</b> in order to create a cookies warning.</p>";
      echo "<p class=\"description\">Set the privacy page at WordPress settings to link properly the info button.</p>";
 		}

    // == CSS

		/**
		 * Render Mybooking Custom loader
		 */
		public function field_mybooking_plugin_settings_components_custom_loader_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_custom_loader";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use <b>custom loader</b> to notify the user when connecting to the reservation engine...";
		  echo "<p class=\"description\">Apply this option if you are using mybooking-wp-theme or a theme where you have defined your own loader.</p>";

		}

		/**
		 * Render Mybooking Bootstrap Modal No conflict
		 */
		public function field_mybooking_plugin_settings_components_js_use_select2_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_js_use_select2";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use <b>select2</b> library on form selects.";

		}


		/**
		 * Render Mybooking Bootstrap Modal No conflict
		 */
		public function field_mybooking_plugin_settings_components_js_bs_modal_no_conflict_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_js_bs_modal_no_conflict";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use <b>Bootstrap modal no conflict</b> if there is a conflict with Bootstrap modal.";
		  echo "<p class=\"description\">It will use $('#my_modal').bootstrapModal('show') instead of $('#my_modal').modal('show').</p>";
		  echo "<p class=\"description\">It only applies if you are using the plugin custom CSS/JS Framework.</p>";

		}

		/**
		 * Render Mybooking Bootstrap Modal Backdrop
		 */
		public function field_mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_js_bs_modal_backdrop_compatibility";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Setup <b>Bootstrap modal backdrop compatibility</b> when showing a modal.";
		  echo "<p class=\"description\">It helps to improve plugin compatibility with some themes when the modal is not shown on top.</p>";
		  echo "<p class=\"description\">Use only if reservation process modal is show behind the backdrop and components are not clickable.</p>";

		}

		/**
		 * Render Mybooking CSS components
		 */
		public function field_mybooking_plugin_settings_components_css_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_css";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include <b>CSS</b> for <u>JS components</u> like <em>Jquery UI datepicker</em> and <em>Jquery DateRange</em>.";
		  echo "<p class=\"description\">It also includes <b>CSS</b> to improve the plugin render process within an external theme.";
		  echo "<p class=\"description\">It's recommended to include it if your are developing your own theme.</p>";


		}

		/**
		 * Render Mybooking CSS Framework
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

		  echo "<p class=\"description\">Include <b>CSS Framework</b> to build the <u>UI</u> (default Bootstrap 4.4.1).";
		  echo "<p class=\"description\">It's recommended to include it you are not planning to override the plugin templates.</p>";
		}

    // ------------------------

		private function field_mybooking_plugin_renting_settings_page($field) {

		  $my_pages = array();
		  $pages = get_pages();
		  foreach( $pages as $page ) {
		    $my_pages[$page->ID] = $page->post_title; // $page->post_name
		  }

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
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
