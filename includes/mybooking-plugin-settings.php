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


		// == Plugin Settings

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
		 * Settings init : Initialize settings
		 */ 
		public function wp_settings_init() {

		  // Register the setting : 
		  register_setting('mybooking_plugin_settings_group',
		                   'mybooking_plugin_settings');

		  // Creates a settings section in "mybooking_plugin_settings_page"
		  add_settings_section('mybooking_plugin_settings_section',
		                       'Mybooking settings',
		                       '',
		                       'mybooking-plugin-configuration');

		  // Creates account id and api key fields
		  add_settings_field('mybooking_plugin_settings_account_id',
		                     'Mybooking Id',
		                     array($this, 'field_mybooking_plugin_settings_account_id_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  add_settings_field('mybooking_plugin_settings_api_key',
		                     'Mybooking API Key',
		                     array($this, 'field_mybooking_plugin_settings_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  // Creates pages fields 	  
		  add_settings_field('mybooking_plugin_settings_choose_products_page',
		                     'Choose products page',
		                     array($this, 'field_mybooking_plugin_settings_choose_products_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  add_settings_field('mybooking_plugin_settings_choose_extras_page',
		                     'Choose extras page',
		                     array($this, 'field_mybooking_plugin_settings_choose_extras_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  add_settings_field('mybooking_plugin_settings_checkout_page',
		                     'Checkout page',
		                     array($this, 'field_mybooking_plugin_settings_checkout_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  add_settings_field('mybooking_plugin_settings_summary_page',
		                     'Summary page',
		                     array($this, 'field_mybooking_plugin_settings_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');

		  // Create custom css fields
		  add_settings_field('mybooking_plugin_settings_custom_css',
		                     'Include plugin CSS',
		                     array($this, 'field_mybooking_plugin_settings_custom_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section');  

		}

		/**
		 * Render Mybooking settings page
		 *
		 * setting_fields: Settings section id
		 * setting_sections :Plugin menu slug
		 *
		 *
		 */
		public function mybooking_plugin_settings_page() {
		?>
		  <div class="wrap">
		      <form action="options.php" method="POST">
		        <?php settings_fields('mybooking_plugin_settings_group'); ?> 
		        <?php do_settings_sections('mybooking-plugin-configuration'); ?>  
		        <?php submit_button(); ?>
		      </form>
		  </div>
		<?php 
		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_account_id_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings");
		  $field = "mybooking_plugin_settings_account_id";
		  $value = esc_attr( $settings[$field] );
		  
		  echo "<input type='text' name='mybooking_plugin_settings[$field]' value='$value' class='regular-text' />";
		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_api_key_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings");
		  $field = "mybooking_plugin_settings_api_key";
		  $value = esc_attr( $settings[$field] );
		  
		  echo "<input type='text' name='mybooking_plugin_settings[$field]' value='$value' class='regular-text' />";
		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_choose_products_page_callback() {

		  $this->field_mybooking_plugin_settings_page("mybooking_plugin_settings_choose_products_page");

		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_choose_extras_page_callback() {
		  
		  $this->field_mybooking_plugin_settings_page("mybooking_plugin_settings_choose_extras_page");

		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_checkout_page_callback() {
		  
		  $this->field_mybooking_plugin_settings_page("mybooking_plugin_settings_checkout_page");

		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_summary_page_callback() {
		  
		  $this->field_mybooking_plugin_settings_page("mybooking_plugin_settings_summary_page");

		}

		/**
		 * Render Mybooking settings fields
		 */
		public function field_mybooking_plugin_settings_custom_css_callback() {
		  
		  $settings = (array) get_option("mybooking_plugin_settings");
		  $field = "mybooking_plugin_settings_custom_css";
		  $value = esc_attr( $settings[$field] );
		  
		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings[$field]' value='1' $checked class='regular-text' />";
		}

		public function field_mybooking_plugin_settings_page($field) {

		  $my_pages = array();
		  $pages = get_pages();
		  foreach( $pages as $page ) {
		    $my_pages[$page->ID] = $page->post_title; // $page->post_name
		  }   

		  $settings = (array) get_option("mybooking_plugin_settings");
		  $value = esc_attr( $settings[$field] );
		  
		  $select = "<select name='mybooking_plugin_settings[$field]'>";
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