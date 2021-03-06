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
        plugin_dir_url(__DIR__)."../assets/images/mybooking-logo-bn.png"
      ); // Callable

      add_submenu_page(
		      'mybooking-plugin-configuration',
		    	_x('Settings', 'plugin_settings', 'mybooking-wp-plugin'),
		    	_x('Settings', 'plugin_settings', 'mybooking-wp-plugin'),
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
	            						  'activities_options', 'google_api_places_options', 'contact_form', 'complements_options', 'css_options');
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
              <a href="?page=mybooking-plugin-configuration&tab=contact_form" class="nav-tab <?php echo $active_tab == 'contact_form' ? 'nav-tab-active' : ''; ?>">Contact Form</a>
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
               else if ($active_tab == 'contact_form') {
			      	   settings_fields('mybooking_plugin_settings_group_contact_form');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_contact_form');
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

      register_setting('mybooking_plugin_settings_group_contact_form',
                 		   'mybooking_plugin_settings_contact_form');

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

		  // Show taxes included
		  add_settings_field('mybooking_plugin_settings_show_taxes_included',
		                     'Show taxes included',
		                     array($this, 'field_mybooking_plugin_settings_show_taxes_included_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');


		  // Duration context
		  add_settings_field('mybooking_plugin_settings_duration_context',
		                     'Duration context',
		                     array($this, 'field_mybooking_plugin_settings_duration_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Rental Location context
		  add_settings_field('mybooking_plugin_settings_rental_location_context',
		                     'Rental Location context',
		                     array($this, 'field_mybooking_plugin_settings_rental_location_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Family context
		  add_settings_field('mybooking_plugin_settings_family_context',
		                     'Family context',
		                     array($this, 'field_mybooking_plugin_settings_family_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Product context
		  add_settings_field('mybooking_plugin_settings_product_context',
		                     'Product context',
		                     array($this, 'field_mybooking_plugin_settings_product_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');


		  // Dates context
		  add_settings_field('mybooking_plugin_settings_dates_context',
		                     'Dates context',
		                     array($this, 'field_mybooking_plugin_settings_dates_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Not available context
		  add_settings_field('mybooking_plugin_settings_not_available_context',
		                     'Not available context',
		                     array($this, 'field_mybooking_plugin_settings_not_available_context_callback'),
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

      // == Create Contact form sectionn Fields
      add_settings_field('mybooking_plugin_settings_contact_form_use_google_captcha',
		                     'Use Google captcha',
		                     array($this, 'field_mybooking_plugin_settings_contact_form_use_google_captcha_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      add_settings_field('mybooking_plugin_settings_contact_form_google_captcha_api_key',
		                     'Google Captcha API Key',
		                     array($this, 'field_mybooking_plugin_settings_contact_form_google_captcha_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      add_settings_field('mybooking_plugin_settings_contact_form_include_google_captcha_js',
		                     'Include Google Captcha JS library',
		                     array($this, 'field_mybooking_plugin_settings_contact_form_include_google_captcha_js_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      // == Create Complements section Fields
      add_settings_field('mybooking_plugin_settings_complements_popup',
		                     'Activate Promotion Pop-up',
		                     array($this, 'field_mybooking_plugin_settings_complements_popup_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_testimonials',
		                     'Activate Testimonial module',
		                     array($this, 'field_mybooking_plugin_settings_complements_testimonials_callback'),
                         'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_renting_item',
		                     'Activate Renting Item module',
		                     array($this, 'field_mybooking_plugin_settings_complements_renting_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_activity_item',
		                     'Activate Activity Items module',
		                     array($this, 'field_mybooking_plugin_settings_complements_activity_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_cookies',
 		                     'Activate Cookies Notice',
 		                     array($this, 'field_mybooking_plugin_settings_complements_cookies_callback'),
                          'mybooking-plugin-configuration',
 		                     'mybooking_plugin_settings_section_complements');

		  // == Create css section fields

		  add_settings_field('mybooking_plugin_settings_components_css',
		                     'Include CSS',
		                     array($this, 'field_mybooking_plugin_settings_components_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Bootstrap

		  add_settings_field('mybooking_plugin_settings_custom_css',
		                     'Include Bootstrap',
		                     array($this, 'field_mybooking_plugin_settings_custom_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Font Awesome
		  add_settings_field('mybooking_plugin_settings_components_css_fontawesome',
		                     'Include Fontawesome',
		                     array($this, 'field_mybooking_plugin_settings_components_css_fontawesome_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // SlickJS
		  add_settings_field('mybooking_plugin_settings_components_js_slickjs',
		                     'Include SlickJS',
		                     array($this, 'field_mybooking_plugin_settings_components_js_slickjs_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Compatibility

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

		  // Select 2
		  add_settings_field('mybooking_plugin_settings_components_js_use_select2',
		                     'Use select2 library on selects',
		                     array($this, 'field_mybooking_plugin_settings_components_js_use_select2_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Custom loader
		  add_settings_field('mybooking_plugin_settings_components_custom_loader',
		                     'Use custom loader',
		                     array($this, 'field_mybooking_plugin_settings_components_custom_loader_callback'),
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
		 * Render Mybooking Taxes Included
		 */
		public function field_mybooking_plugin_settings_show_taxes_included_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_show_taxes_included";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_renting[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_renting[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Show taxes included.";
		  echo "<p class=\"description\">Activate if you want to show taxes included literal in reservation.</p>";
		  echo "<p class=\"description\">Do not activate if you do not want to show taxes included literal in reservation.</p>";


		}

		/**
		 * Render Mybooking Rental Location context
		 */
		public function field_mybooking_plugin_settings_rental_location_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_rental_location_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose rental location context]</option>";

		  if ($value == 'branch_office') {
		    $select .= "<option value='branch_office' selected>Branch office</option>";
		  }
		  else {
		    $select .= "<option value='branch_office'>Branch office</option>";
		  }

			if ($value == 'hotel') {
		    $select .= "<option value='hotel' selected>Hotel</option>";
		  }
		  else {
		    $select .= "<option value='family'>Hotel</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the rental location that describes your business context.</p>";
		  echo "<hr>";

		}

		/**
		 * Render Mybooking Family context
		 */
		public function field_mybooking_plugin_settings_family_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_family_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose family context]</option>";

		  if ($value == 'product') {
		    $select .= "<option value='product' selected>Type of product</option>";
		  }
		  else {
		    $select .= "<option value='product'>Type of product</option>";
		  }

			if ($value == 'family') {
		    $select .= "<option value='family' selected>Family</option>";
		  }
		  else {
		    $select .= "<option value='family'>Family</option>";
		  }

			if ($value == 'vehicle') {
		    $select .= "<option value='vehicle' selected>Type of vehicle</option>";
		  }
		  else {
		    $select .= "<option value='vehicle'>Type of vehicle</option>";
		  }

			if ($value == 'boat') {
		    $select .= "<option value='boat' selected>Type of boat</option>";
		  }
		  else {
		    $select .= "<option value='boat'>Type of boat</option>";
		  }

			if ($value == 'property') {
		    $select .= "<option value='property' selected>Type of property</option>";
		  }
		  else {
		    $select .= "<option value='property'>Type of property</option>";
		  }

		  if ($value == 'room') {
		    $select .= "<option value='room' selected>Type of room</option>";
		  }
		  else {
		    $select .= "<option value='room'>Type of room</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the family that describes your business context.</p>";
		  echo "<hr>";

		}

		/**
		 * Render Mybooking Product context
		 */
		public function field_mybooking_plugin_settings_product_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_product_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose product context]</option>";

		  if ($value == 'vehicle') {
		    $select .= "<option value='vehicle' selected>Vehicle</option>";
		  }
		  else {
		    $select .= "<option value='vehicle'>Vehicle</option>";
		  }

			if ($value == 'boat') {
		    $select .= "<option value='product' selected>Boat</option>";
		  }
		  else {
		    $select .= "<option value='product'>Boat</option>";
		  }

			if ($value == 'product') {
		    $select .= "<option value='product' selected>Product</option>";
		  }
		  else {
		    $select .= "<option value='product'>Product</option>";
		  }

			if ($value == 'property') {
		    $select .= "<option value='property' selected>Property</option>";
		  }
		  else {
		    $select .= "<option value='property'>Property</option>";
		  }

		  if ($value == 'room') {
		    $select .= "<option value='room' selected>Room</option>";
		  }
		  else {
		    $select .= "<option value='room'>Room</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the product that describes your business context.</p>";
		  echo "<hr>";

		}


		/**
		 * Render Mybooking Duration context
		 */
		public function field_mybooking_plugin_settings_duration_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_duration_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose duration context]</option>";

		  if ($value == 'days') {
		    $select .= "<option value='days' selected>Days</option>";
		  }
		  else {
		    $select .= "<option value='days'>Days</option>";
		  }

			if ($value == 'nights') {
		    $select .= "<option value='nights' selected>Nights</option>";
		  }
		  else {
		    $select .= "<option value='nights'>Nights</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the duration that describes your business context.</p>";
		  echo "<p class=\"description\">Select <b>days</b> to describe duration in days.</p>";
		  echo "<p class=\"description\">Select <b>nights/b> to describe duration in nights.</p>";
		  echo "<hr>";

		}

		/**
		 * Render Mybooking Dates context
		 */
		public function field_mybooking_plugin_settings_dates_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_dates_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose dates context]</option>";

		  if ($value == 'pickup-return') {
		    $select .= "<option value='pickup-return' selected>Pickup/Return</option>";
		  }
		  else {
		    $select .= "<option value='pickup-return'>Pickup/Return</option>";
		  }

			if ($value == 'checkin-checkout') {
		    $select .= "<option value='checkin-checkout' selected>Checkin/Checkout</option>";
		  }
		  else {
		    $select .= "<option value='checkin-checkout'>Checkin/Checkout</option>";
		  }

		  if ($value == 'start-end') {
		    $select .= "<option value='start-end' selected>Start/End</option>";
		  }
		  else {
		    $select .= "<option value='start-end'>Start/End</option>";
		  }

			if ($value == 'arrive-departure') {
		    $select .= "<option value='arrive-departure' selected>Arrive/Depature</option>";
		  }
		  else {
		    $select .= "<option value='arrive-departure'>Arrive/Depature</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the start/end date that describes your business context.</p>";
		  echo "<p class=\"description\">Select <b>pickup/return</b> to describe pickup and return dates.</p>";
		  echo "<p class=\"description\">Select <b>checkin/checkout</b> for accommodation or properties.</p>";
		  echo "<p class=\"description\">Select <b>start/end</b> to describe start and end period.</p>";
		  echo "<p class=\"description\">Select <b>arrive/depature</b> to describe arrivals an departures</p>";
		  echo "<hr>";

		}

		/**
		 * Render Mybooking Not available context
		 */
		public function field_mybooking_plugin_settings_not_available_context_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_renting");
		  $field = "mybooking_plugin_settings_not_available_context";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_renting[$field]'>";
		  $select .= "<option value=''>[Choose not available context]</option>";

		  if ($value == 'not-available') {
		    $select .= "<option value='not-available' selected>Not available</option>";
		  }
		  else {
		    $select .= "<option value='not-available'>Not available</option>";
		  }

			if ($value == 'check-by-phone') {
		    $select .= "<option value='check-by-phone' selected>Telephone consultation</option>";
		  }
		  else {
		    $select .= "<option value='check-by-phone'>Telephone consultation</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the not available message that describes your business context.</p>";
		  echo "<p class=\"description\">Select <b>Not available</b> to show not available message.</p>";
		  echo "<p class=\"description\">Select <b>Telephone consultation</b> to show Telephone consultation message.</p>";
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
		  echo "<div class=\"description\">";
      echo "<p>It activates a <b>detail page</b> for any product with details and the calendar for each product automatically</p>";
      echo "<p>If you only have a few products and you want to show a calendar to rent an specific one, 
        it is recommended to create a page for any product an use the <u>[mybooking_rent_engine_product]</u> shortcode 
        to show a calendar because of the flexibility to create the page with Elementor, Gutenberg or Divi.</p>";
      echo "<p>It is not necessary if you are using the wizard process. That is the <u>[mybooking_rent_engine_selector]</u> 
      shortcode and the <u>[mybooking_rent_engine_product_listing]</u> to show the results.</p>";
		  echo "</div>";

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
		  echo "<div class=\"description\">";
		  echo "<p>This is the <b>prefix folder</b> that is added to the product detail page created virtually for any
		  product if <u>Use product detail pages</u> is active.</p>";
		  echo "</div>";

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

		  echo "<div class=\"description\">";
      echo "<p>It activates a <b>detail page</b> for any activity with details and the calendar for each activity automatically</p>";
      echo "<p>If you only have a few activities and you want to show a calendar to rent an specific one, 
        it is recommended to create a page for any activity an use the <u>[mybooking_activities_engine_activity]</u> shortcode 
        to show a calendar because of the flexibility to create the page with Elementor, Guteberg or Divi.</p>";
		  echo "</div>";


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
		  echo "<div class=\"description\">";
		  echo "<p>This is the <b>prefix folder</b> that is added to the activity detail page created virtually for any
		  product if <u>Use detail pages</u> is active.</p>";
		  echo "</div>";

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

		// == Contact Form

    /**
     * Use Google captcha on contact form
     */
    public function field_mybooking_plugin_settings_contact_form_use_google_captcha_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_contact_form");
		  $field = "mybooking_plugin_settings_contact_form_use_google_captcha";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_contact_form[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_contact_form[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Use Google Captcha on <b>Contact Form</b>.</p>";
 		}

		/**
		 * Google captcha API KEY for contact form
		 */
		public function field_mybooking_plugin_settings_contact_form_google_captcha_api_key_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_contact_form");
		  $field = "mybooking_plugin_settings_contact_form_google_captcha_api_key";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

		  echo "<input type='text' name='mybooking_plugin_settings_contact_form[$field]' value='$value' class='regular-text' />";
		}

    /**
     * Include Google captcha JS script
     */
    public function field_mybooking_plugin_settings_contact_form_include_google_captcha_js_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_contact_form");
		  $field = "mybooking_plugin_settings_contact_form_include_google_captcha_js";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_contact_form[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_contact_form[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include Google Captcha JS library.</p>";
 		}

    // == Complements

    /**
     * Render Promo Pop-up complement
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
     * Render Testimonials complement
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
     * Render Renting Items complement
     */
    public function field_mybooking_plugin_settings_complements_renting_item_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_renting_item";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Activate <b>Renting Items</b> Custom Post Type in order to create single items related to renting.</p>";
      echo "<p class=\"description\">Create one or more Renting Items under Mybooking menu and show in a template or within any page builder query block.</p>";
 		}

    /**
     * Render Activity Items complement
     */
    public function field_mybooking_plugin_settings_complements_activity_item_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_activity_item";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Activate <b>Activity Items</b> Custom Post Type in order to create single items related to activities.</p>";
      echo "<p class=\"description\">Create one or more Activity Items under Mybooking menu and show in a template or within any page builder query block.</p>";
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
		 * Render Mybooking CSS
		 */
		public function field_mybooking_plugin_settings_components_css_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_css";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '1';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include <b>CSS</b> for plugin <u>UX components</u> like <em>Jquery UI datepicker</em> and <em>Jquery DateRange</em>.";
		  echo "<p class=\"description\"><b>¡Attention!</b> Uncheck only if you are using mybooking theme or a custom theme with your own reservation engine templates.";

		}

		/**
		 * Render Mybooking Bootstrap Framework
		 */
		public function field_mybooking_plugin_settings_custom_css_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_custom_css";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '1';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include <b>Boostrap Framework</b> CSS+JS to build the <u>UI</u>.";
		  echo "<p class=\"description\"><b>¡Attention!</b> Uncheck only if you are using mybooking theme or a theme based on <u>Bootstrap</u>.";
		}


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
		  echo "<p class=\"description\"><b>¡Attention!</b> check only if you are using mybooking theme or custom theme with its own Ajax Loader.";

		}

		/**
		 * Render SlickJS
		 */
		public function field_mybooking_plugin_settings_components_js_slickjs_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_js_slickjs";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '1';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include <b>slickJS</b> library. It is <b>required</b> if you are using the testimonials complement";
		  echo "<p class=\"description\"><b>¡Attention!</b> uncheck if not testimonials are used or if the theme that you are using includes slickJS.";
		}

		/**
		 * Render Fontawesome
		 */
		public function field_mybooking_plugin_settings_components_css_fontawesome_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_css");
		  $field = "mybooking_plugin_settings_components_css_fontawesome";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '1';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_css[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_css[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\">Include <b>Fontawesome 4.7</b> library.";
		  echo "<p class=\"description\"><b>¡Attention!</b> uncheck only if your theme is using it.";
		}


		/**
		 * Render Use Select2
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
		  echo "<p class=\"description\"><b>¡Attention!</b> check only if modals, like product detail or edit reservation, are not shown.";

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
		  echo "<p class=\"description\"><b>¡Attention!</b> check only if modals are not shown on top of the page.";

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
