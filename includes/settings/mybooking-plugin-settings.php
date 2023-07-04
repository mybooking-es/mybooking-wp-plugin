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
					<?php settings_errors(); ?>
		  	  <p>Mybooking is a platform that allow you to manage your inventory, reservations, planning, invoicing and integrate a
		  	  reservation engine in your web site.</p>
			 	  <h2>Quick start</h2>
			 	  <ol>
				 	  <li>Use your mybooking account or <a href="https://mybooking.es/en/sign-up" target="_blank">create a new account</a></li>
				 	  <li>Setup the connection in the connection tab</li>
				 	  <li>Setup the <b>modules</b> you want to use: renting/accommodation, activities or transfer</li>
				 	  <li><b>Create the pages</b> and insert shortcodes</li>
				 	  <li>Start accepting reservations</li>
				 	</ol>
					<?php
	            $active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_title( $_GET[ 'tab' ] ) : 'connection_options';
	            $tabs = array('connection_options', 'configuration_options', 'renting_options', 'transfer_options',
	            						  'activities_options', 'google_api_places_options', 'contact_form', 'complements_options',
	            						  'css_options');
	            if ( !in_array( $active_tab, $tabs) ) {
	            	$active_tab = 'connection_options';
	            }
	        ?>

	        <?php
	           $settings = (array) get_option("mybooking_plugin_settings_configuration");
	           $renting = $settings && array_key_exists('mybooking_plugin_settings_renting_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_renting_selector"] )) == '1') : false;
	           $activities = $settings && array_key_exists('mybooking_plugin_settings_activities_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_activities_selector"] )) == '1') : false;
						 $transfer = $settings && array_key_exists('mybooking_plugin_settings_transfer_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_transfer_selector"] )) == '1') : false;
	           $google_api_places = $settings && array_key_exists('mybooking_plugin_settings_google_api_places_selector', $settings) ? (trim(esc_attr( $settings["mybooking_plugin_settings_google_api_places_selector"] )) == '1') : false;
	         ?>

					<h2 class="nav-tab-wrapper">
					    <a href="?page=mybooking-plugin-configuration&tab=connection_options" class="nav-tab <?php echo $active_tab == 'connection_options' ? 'nav-tab-active' : ''; ?>">Connection</a>
					    <a href="?page=mybooking-plugin-configuration&tab=configuration_options" class="nav-tab <?php echo $active_tab == 'configuration_options' ? 'nav-tab-active' : ''; ?>">Modules</a>
					    <?php if ($renting) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=renting_options" class="nav-tab <?php echo $active_tab == 'renting_options' ? 'nav-tab-active' : ''; ?>">Renting or Accommodation</a>
              <?php } ?>
					    <?php if ($activities) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=activities_options" class="nav-tab <?php echo $active_tab == 'activities_options' ? 'nav-tab-active' : ''; ?>">Activities or Appointments</a>
					    <?php } ?>
					    <?php if ($transfer) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=transfer_options" class="nav-tab <?php echo $active_tab == 'transfer_options' ? 'nav-tab-active' : ''; ?>">Transfer</a>
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
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>vehicle rental</u>, <u>boat rental</u>, <u>properties</u> rental companies or <u>accommodation</u>.</p>
		                 <p>You <i>must</i> create the following pages and insert a shortcode on each</p>
		                 <ol style="list-style:square; margin-left: 20px">
		                   <li>Create a <b>choose product</b> page and insert [mybooking_rent_engine_product_listing] shortcode</li>
		                   <li>Create a <b>checkout page</b> and insert [mybooking_rent_engine_complete] shortcode</li>
		                   <li>Create a <b>summary page</b> and insert [mybooking_rent_engine_summary] shortcode</li>
		                 </ol>
		                 <p>If you want to include a <b>search form in the front page</b>, use the widgets or the shortcodes.</p>
		                 <ul style="list-style:square; margin-left: 20px">
		                   <li>Mybooking Rent Engine Selector Widget or [mybooking_rent_engine_selector] shortcode</li>
		                   <li>Mybooking Rent Engine Wizard Widget or [mybooking_rent_engine_selector_wizard] shortcode</li>
		                 </ul>
		                 <p>If you want to include the calendar in an <u>vehicle</u> or <u>property</u> page use:</p>
		                 <ul style="list-style:square; margin-left: 20px">
		                   <li>The [mybooking_rent_engine_product] shortcode. You can get this shortcode with the product id from your mybooking account</li>
		                 </ul>
		                </div>
                 </div>
                 <hr>
EOF;

               $activity_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>activities</u> or <u>tours</u> company.</p>
		                 <p>You <i>must</i> create the following pages and insert a shortcode on each</p>
		                 <ol style="list-style:square; margin-left: 20px">
		                   <li>Create a <b>checkout page</b> and insert [mybooking_activities_engine_shopping_cart] shortcode</li>
		                   <li>Create a <b>summary page</b> and insert [mybooking_activities_engine_summary] shortcode</li>
		                 </ol>
		                 <p>If you want to include the calendar in an <u>activity page</u> use:</p>
		                 <ul style="list-style:square; margin-left: 20px">
		                   <li>The [mybooking_activities_engine_activity] shortcode. You can get this shortcode with the activity id from your mybooking account</li>
		                 </ul>
		                </div>
                 </div>
                 <hr>
EOF;

               $transfer_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>transfer company</u>.</p>
		                 <p>You <i>must</i> create the following pages and insert a shortcode on each</p>
		                 <ol style="list-style:square; margin-left: 20px">
		                   <li>Create a <b>choose vehicle</b> page and insert [mybooking_transfer_choose_vehicle] shortcode</li>
		                   <li>Create a <b>checkout page</b> and insert [mybooking_transfer_checkout] shortcode</li>
		                   <li>Create a <b>summary page</b> and insert [mybooking_transfer_summary] shortcode</li>
		                 </ol>
		                 <p>If you want to include a search form in the front page, use the widget or the shortcode.</p>
		                 <ul style="list-style:square; margin-left: 20px">
		                   <li>Mybooking Transfer Engine Selector Widget or [mybooking_transfer_selector] shortcode</li>
		                 </ul>
		                </div>
                 </div>
                 <hr>
EOF;

							 $create_account_message = <<<EOF
									<p>Don't you have a mybooking account? <a href="https://mybooking.es/en/sign-up" target="_blank">Start your free trial</a></p>
EOF;

	             if ($active_tab == 'connection_options') {
			      	   settings_fields('mybooking_plugin_settings_group_connection');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_connection');
			           echo '</table>';
			           echo $create_account_message;
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
			         else if ($active_tab == 'transfer_options') {
			         	 echo $transfer_info;
			      	   settings_fields('mybooking_plugin_settings_group_transfer');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_transfer');
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
     *   - modules
     *   - renting
     *   - activities
     *   - transfer
     *   - google api places
     *   - contact
     *   - complements
     *   - css
		 *
		 */
		public function wp_settings_init() {

		  // == Register mybooking settings setting

		  register_setting('mybooking_plugin_settings_group_connection',
		                   'mybooking_plugin_settings_connection');

		  register_setting('mybooking_plugin_settings_group_configuration',
		                   'mybooking_plugin_settings_configuration');

		  register_setting('mybooking_plugin_settings_group_options',
		                   'mybooking_plugin_settings_options');

		  register_setting('mybooking_plugin_settings_group_renting',
		                   'mybooking_plugin_settings_renting');

		  register_setting('mybooking_plugin_settings_group_activities',
		                   'mybooking_plugin_settings_activities');

		  register_setting('mybooking_plugin_settings_group_transfer',
		                   'mybooking_plugin_settings_transfer');

		  register_setting('mybooking_plugin_settings_group_google_places',
		                   'mybooking_plugin_settings_google_places');

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
		                       'Renting or Accommodation',
		                       '',
		                       'mybooking-plugin-configuration');

		  // Creates an activities settings section "mybooking_plugin_settings_section_activities"
		  add_settings_section('mybooking_plugin_settings_section_activities',
		                       'Activities or Appointments',
		                       '',
		                       'mybooking-plugin-configuration');

		  // Creates an activities settings section "mybooking_plugin_settings_section_transfer"
		  add_settings_section('mybooking_plugin_settings_section_transfer',
		                       'Transfer',
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

		  add_settings_field('mybooking_plugin_settings_sales_channel',
		                     'Sales Channel Code',
		                     array($this, 'field_mybooking_plugin_settings_sales_channel_code_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

      // == Creates configuration fields

		  add_settings_field('mybooking_plugin_settings_renting_selector',
		                     'Renting or Accommodation',
		                     array($this, 'field_mybooking_plugin_settings_renting_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');

      add_settings_field('mybooking_plugin_settings_activities_selector',
		                     'Activities or Appointments',
		                     array($this, 'field_mybooking_plugin_settings_activities_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');

      add_settings_field('mybooking_plugin_settings_transfer_selector',
		                     'Transfer',
		                     array($this, 'field_mybooking_plugin_settings_transfer_selector_callback'),
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
			
			add_settings_field('mybooking_plugin_settings_privacy_page',
		                     'Privacy page',
		                     array($this, 'field_mybooking_plugin_settings_privacy_page_callback'),
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

      // == Creates transfer wizard fields

		  add_settings_field('mybooking_plugin_settings_transfer_choose_vehicle_page',
		                     'Choose vehicle page',
		                     array($this, 'field_mybooking_plugin_settings_transfer_choose_vehicle_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_checkout_page',
		                     'Checkout page',
		                     array($this, 'field_mybooking_plugin_settings_transfer_checkout_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_summary_page',
		                     'Summary page',
		                     array($this, 'field_mybooking_plugin_settings_transfer_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_terms_page',
		                     'Terms and conditions page',
		                     array($this, 'field_mybooking_plugin_settings_transfer_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');


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
		                     'Promotion Pop-up',
		                     array($this, 'field_mybooking_plugin_settings_complements_popup_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_testimonials',
		                     'Testimonial module',
		                     array($this, 'field_mybooking_plugin_settings_complements_testimonials_callback'),
                         'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_product_slider',
                        'Product Slider module',
                        array($this, 'field_mybooking_plugin_settings_complements_product_slider_callback'),
                        'mybooking-plugin-configuration',
                        'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_content_slider',
                        'Content Slider module',
                        array($this, 'field_mybooking_plugin_settings_complements_content_slider_callback'),
                        'mybooking-plugin-configuration',
                        'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_renting_item',
		                     'Renting Item module',
		                     array($this, 'field_mybooking_plugin_settings_complements_renting_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_activity_item',
		                     'Activity Items module',
		                     array($this, 'field_mybooking_plugin_settings_complements_activity_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_cookies',
 		                     'Cookies Notice',
 		                     array($this, 'field_mybooking_plugin_settings_complements_cookies_callback'),
                          'mybooking-plugin-configuration',
 		                     'mybooking_plugin_settings_section_complements');

		  // == Create css section fields

      // Custom CSS

		  add_settings_field('mybooking_plugin_settings_components_css',
		                     'Include CSS',
		                     array($this, 'field_mybooking_plugin_settings_components_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // SlickJS
		  add_settings_field('mybooking_plugin_settings_components_js_slickjs',
		                     'Include SlickJS',
		                     array($this, 'field_mybooking_plugin_settings_components_js_slickjs_callback'),
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
		  echo "<p class=\"description\">If you have a <b>mybooking account</b> like <em>mycompany.mybooking.es</em>, input the just the subdomain name, that is <u>mycompany</u>.";

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
		  echo "<p class=\"description\">Get the API key from your mybooking account settings</p>.";
		}


		/**
		 * Render Sales channel code
		 */
		public function field_mybooking_plugin_settings_sales_channel_code_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_connection");
		  $field = "mybooking_plugin_settings_sales_channel_code";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

		  echo "<input type='text' name='mybooking_plugin_settings_connection[$field]' value='$value' class='regular-text' />";
		  echo "<p class=\"description\">If you have <b>multiple sales channels</b>, input the sales channel code that you want to use in this website";

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
		  echo "<p class=\"description\">Activate if you want to create a vehicles</b>, <b>boats</b>, <b>properties rental</b> or <b>accomodation</b> web site.</p>";
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
		  echo "<p class=\"description\">Activate if you want to create a <b>tours</b>, <b>activities</b> or <b>appointments</b> web site.</p>";
		}

		/**
		 * Render Mybooking Transfer module
		 */
		public function field_mybooking_plugin_settings_transfer_selector_callback() {

		  $settings = (array) get_option("mybooking_plugin_settings_configuration");
		  $field = "mybooking_plugin_settings_transfer_selector";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
        $value = '';
		  }

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_configuration[$field]' value='1' $checked class='regular-text' />";
		  echo "<p class=\"description\">Activate if you want to create a <b>transfers</b> web site.</p>";
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
			echo "<p class=\"description\">Activate if you want to use Google Location API to input a custom delivery or collection address in a rental website.</p>";

		}

    // == Renting

		/**
		 * Render Mybooking Renting/Accommodation Choose products page
		 */
		public function field_mybooking_plugin_settings_choose_products_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_choose_products_page");
		  echo "<p class=\"description\">The page with [mybooking_rent_engine_product_listing] shortcode</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Checkout page
		 */
		public function field_mybooking_plugin_settings_checkout_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_checkout_page");
		  echo "<p class=\"description\">The page with [mybooking_rent_engine_complete] shortcode</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Summary page
		 */
		public function field_mybooking_plugin_settings_summary_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_summary_page");
		  echo "<p class=\"description\">The page with [mybooking_rent_engine_summary] shortcode</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Terms and conditions page
		 */
		public function field_mybooking_plugin_settings_terms_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_terms_page");
		  echo "<p class=\"description\">The terms and conditions page.</p>";
		  echo "<hr>";
		}

		/**
		 * Render Mybooking Renting/Accommodation Privacy page
		 */
		public function field_mybooking_plugin_settings_privacy_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_privacy_page");
		  echo "<p class=\"description\">The privacy page.</p>";
		  echo "<hr>";
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
		    $select .= "<option value='boat' selected>Boat</option>";
		  }
		  else {
		    $select .= "<option value='boat'>Boat</option>";
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
		    $select .= "<option value='arrive-departure' selected>Arrival/Depature</option>";
		  }
		  else {
		    $select .= "<option value='arrive-departure'>Arrival/Depature</option>";
		  }

			if ($value == 'departure-entry') {
		    $select .= "<option value='departure-entry' selected>Departure/Entry</option>";
		  }
		  else {
		    $select .= "<option value='departure-entry'>Departure/Entry</option>";
		  }

		  if ($value == 'eta-etd') {
		  	$select .= "<option value='eta-etd' selected>Estimated Time of Arrival / Departure</option>";
		  }
		  else {
		    $select .= "<option value='eta-etd'>Estimated Time of Arrival / Departure</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the start/end date that describes your business context.</p>";
		  echo "<p class=\"description\">Select <b>pickup/return</b> to describe pickup and return dates.</p>";
		  echo "<p class=\"description\">Select <b>checkin/checkout</b> for accommodation or properties.</p>";
		  echo "<p class=\"description\">Select <b>start/end</b> to describe start and end period.</p>";
		  echo "<p class=\"description\">Select <b>arrival/departure</b> to describe arrivals an departures</p>";
		  echo "<p class=\"description\">Select <b>departure/entry</b> to describe departures and entries</p>";
		  echo "<p class=\"description\">Select <b>eta/etd</b> to describe estimated arrival and departure times</p>";

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

			if ($value == 'check-by-email') {
		    $select .= "<option value='check-by-email' selected>E-mail consultation</option>";
		  }
		  else {
		    $select .= "<option value='check-by-email'>E-mail consultation</option>";
		  }

			if ($value == 'enquiry') {
		    $select .= "<option value='enquiry' selected>Enquiry</option>";
		  }
		  else {
		    $select .= "<option value='enquiry'>Enquiry</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">Choose the not available message that describes your business context.</p>";
		  echo "<p class=\"description\">Select <b>Not available</b> to show not available message.</p>";
		  echo "<p class=\"description\">Select <b>Telephone consultation</b> to show Telephone consultation message.</p>";
		  echo "<p class=\"description\">Select <b>E-mail consultation</b> to show E-mail consultation message.</p>";
		  echo "<p class=\"description\">Select <b>Enquiry</b> to show Enquiry message.</p>";

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

		  echo "<div class=\"description\">";
      echo "<p><b>Do not activate</b> if you have create a custom page for each one of your products with the [mybooking_rent_engine_product] or if you are using the [mybooking_rent_engine_selector] or the Selector widget in your home page.</p>";
		  echo "<p><b>Activate</b> it if you are using the [mybooking_rent_engine_products] shortcode to <b>browse the catalog</b> and you want the plugin to automatically create a page for each product.</p>";
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
		  echo "<hr>";

		}

    // == Activities

		/**
		 * Render Mybooking Activities Shopping cart page
		 */
		public function field_mybooking_plugin_settings_activities_shopping_cart_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_shopping_cart_page");
			echo "<p class=\"description\">The page with [mybooking_activities_engine_shopping_cart] shortcode</p>.";

		}

		/**
		 * Render Mybooking Activities order/reservation page
		 */
		public function field_mybooking_plugin_settings_activities_summary_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_summary_page");
		  echo "<p class=\"description\">The page with [mybooking_activities_engine_summary] shortcode</p>.";

		}

		/**
		 * Render Mybooking Activities terms and conditions page
		 */
		public function field_mybooking_plugin_settings_activities_terms_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_terms_page");
		  echo "<p class=\"description\">The page with the terms and conditions</p>.";
		  echo "<hr>";

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
      echo "<p>Do not activate if you have create a custom page for each one of your activities with the [mybooking_activities_engine_activity]</p>";
		  echo "<p>Activate it if you are using the [mybooking_activities_engine_activities] shortcode to <b>browse the activities catalog</b>";
      echo "and you want the plugin to automatically create a page for each activity.</p>";
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

    // == Transfer

		/**
		 * Render Mybooking Transfer Choose vehicle
		 */
		public function field_mybooking_plugin_settings_transfer_choose_vehicle_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_choose_vehicle_page");
		  echo "<p class=\"description\">The page with [mybooking_transfer_choose_vehicle] shortcode</p>.";
		}

		/**
		 * Render Mybooking Transfer Checkout page
		 */
		public function field_mybooking_plugin_settings_transfer_checkout_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_checkout_page");
			echo "<p class=\"description\">The page with [mybooking_transfer_checkout] shortcode</p>.";

		}

		/**
		 * Render Mybooking Transfer Summary page
		 */
		public function field_mybooking_plugin_settings_transfer_summary_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_summary_page");
		  echo "<p class=\"description\">The page with [mybooking_transfer_summary] shortcode</p>.";

		}

		/**
		 * Render Mybooking Transfer terms and conditions page
		 */
		public function field_mybooking_plugin_settings_transfer_terms_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_terms_page");
		  echo "<p class=\"description\">The terms and conditions page</p>.";

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

		  echo "<p class=\"description\"><b>Activate Promotion Pop-ups</b> Custom Post Type in order to create promotions.</p>";
      echo "<p class=\"description\"><small>Pop-up will be shown only in the front page.</small></p>";
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

		  echo "<p class=\"description\"><b>Activate Testimonials</b> Custom Post Type in order to create a testimonials carousel.</p>";
      echo "<p class=\"description\"><small>Create one or more Testimonials under Mybooking menu and use [mybooking_testimonials] to show it on a page or sidebar.</small></p>";
 		}

    /**
     * Render Content Slider complement
     */
    public function field_mybooking_plugin_settings_complements_content_slider_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_content_slider";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\"><b>Activate Content Slider</b> Custom Post Type in order to create a content slider with Gutenberg native editor.</p>";
      echo "<p class=\"description\"><small>Create one or more Sliders under Mybooking menu and use [mybooking_content_slider] to show it on a page or post.</small></p>";
 		}

    /**
     * Render Product Slider complement
     */
    public function field_mybooking_plugin_settings_complements_product_slider_callback() {

      $settings = (array) get_option("mybooking_plugin_settings_complements");
		  $field = "mybooking_plugin_settings_complements_product_slider";
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

      $checked = ($value == '1') ? 'checked' : '';

      echo "<input type='hidden' name='mybooking_plugin_settings_complements[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_complements[$field]' value='1' $checked class='regular-text' />";

		  echo "<p class=\"description\"><b>Activate Product Slider</b> Custom Post Type in order to create a content slider to show offers with limited custom fields.</p>";
      echo "<p class=\"description\"><small>Create one or more Product Sliders under Mybooking menu and use [mybooking_product_slider] to show it on a page or post.</small></p>";
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

		  echo "<p class=\"description\"><b>Activate Renting Items</b> Custom Post Type in order to create single items related to renting.</p>";
      echo "<p class=\"description\"><small>Create one or more Renting Items under Mybooking menu and show in a template or within any page builder query block.</small></p>";
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

		  echo "<p class=\"description\"><b>Activate Activity Items</b> Custom Post Type in order to create single items related to activities.</p>";
      echo "<p class=\"description\"><small>Create one or more Activity Items under Mybooking menu and show in a template or within any page builder query block.</small></p>";
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

		  echo "<p class=\"description\"><b>Activate Cookies Notice</b> in order to create a cookies warning.</p>";
      echo "<p class=\"description\"><small>Set the privacy page at WordPress settings to link properly the info button.</small></p>";
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
		  echo "<p class=\"description\"><b>¡Attention!</b> Uncheck only if you are using <u>mybooking theme<u> or a <u>custom theme with your own reservation engine templates</u>.";

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

		  echo "<p class=\"description\">Include <b>slickJS</b> library. It is <b>required</b> if you are using the testimonials or slider complement";
		  echo "<p class=\"description\"><b>¡Attention!</b> Uncheck if not testimonials or slider are used or if the theme that you are using includes slickJS.";
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

    // ------------------------

		/**
		 *  Renting settings page
		 */
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

		/**
		 * Activities settings page
		 */
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

		/**
		 * Transfer settings page
		 */
		private function field_mybooking_plugin_transfer_settings_page($field) {

		  $my_pages = array();
		  $pages = get_pages();
		  foreach( $pages as $page ) {
		    $my_pages[$page->ID] = $page->post_title; // $page->post_name
		  }

		  $settings = (array) get_option("mybooking_plugin_settings_transfer");
		  if (array_key_exists($field, $settings)) {
		    $value = esc_attr( $settings[$field] );
		  }
		  else {
		  	$value = '';
		  }

		  $select = "<select name='mybooking_plugin_settings_transfer[$field]'>";
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
