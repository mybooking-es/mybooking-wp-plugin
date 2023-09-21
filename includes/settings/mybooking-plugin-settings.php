<?php
  class MyBookingPluginSettings {

	  public function __construct() {
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
		  	  <h1>
						<?php echo esc_html_x( 'Mybooking Settings', 'settings_context', 'mybooking-wp-plugin' ) ?>
					</h1>
					<p>
						<?php echo esc_html_x( 'Welcome to the settings page. After the initial configuration, this page will allow you to update some configurations that may change over time or add advanced modules and plugins.', 'settings_context', 'mybooking-wp-plugin' ) ?>
					</p>

					<?php settings_errors(); ?>

					<!-- Buttons -->
					<h2>
						<?php echo esc_html_x( 'Generated pages and components', 'settings_context', 'mybooking-wp-plugin' ) ?>
					</h2>
					<a href="<?php esc_attr(menu_page_url('mybooking-onboarding-pages'))?>">
						<?php echo esc_html_x( 'Pages', 'settings_context', 'mybooking-wp-plugin' ) ?>
					</a>
					&nbsp;
					<a href="<?php esc_attr(menu_page_url('mybooking-onboarding-components'))?>">
						<?php echo esc_html_x( 'Components', 'settings_context', 'mybooking-wp-plugin' ) ?>
					</a>
					<hr />

					<!-- Tabs -->
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
					    <a href="?page=mybooking-plugin-configuration&tab=connection_options" class="nav-tab <?php echo $active_tab == 'connection_options' ? 'nav-tab-active' : ''; ?>">
								<?php echo esc_html_x( 'Connection', 'settings_context', 'mybooking-wp-plugin' ) ?>
							</a>
					    <?php if ($renting) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=renting_options" class="nav-tab <?php echo $active_tab == 'renting_options' ? 'nav-tab-active' : ''; ?>">
									<?php echo esc_html_x( 'Renting or Accommodation', 'settings_context', 'mybooking-wp-plugin' ) ?>
								</a>
              <?php } ?>
					    <?php if ($activities) { ?>
								<a href="?page=mybooking-plugin-configuration&tab=activities_options" class="nav-tab <?php echo $active_tab == 'activities_options' ? 'nav-tab-active' : ''; ?>">
									<?php echo esc_html_x( 'Activities or Appointments', 'settings_context', 'mybooking-wp-plugin' ) ?>
								</a>
					    <?php } ?>
					    <?php if ($transfer) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=transfer_options" class="nav-tab <?php echo $active_tab == 'transfer_options' ? 'nav-tab-active' : ''; ?>">
									<?php echo esc_html_x( 'Transfer', 'settings_context', 'mybooking-wp-plugin' ) ?>
								</a>
              <?php } ?>
              <a href="?page=mybooking-plugin-configuration&tab=contact_form" class="nav-tab <?php echo $active_tab == 'contact_form' ? 'nav-tab-active' : ''; ?>">
								<?php echo esc_html_x( 'Contact Form', 'settings_context', 'mybooking-wp-plugin' ) ?>
							</a>
              <a href="?page=mybooking-plugin-configuration&tab=complements_options" class="nav-tab <?php echo $active_tab == 'complements_options' ? 'nav-tab-active' : ''; ?>">
								<?php echo esc_html_x( 'Complements', 'settings_context', 'mybooking-wp-plugin' ) ?>
							</a>
							<!-- Get onboarding settings -->
							<?php $onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info'); ?>
							<?php $pickup_return_place_exists = array_key_exists('pickup_return_place', $onboarding_settings) ?>
							<?php if ($pickup_return_place_exists and $onboarding_settings['pickup_return_place']) { ?>
								<a href="?page=mybooking-plugin-configuration&tab=configuration_options" class="nav-tab <?php echo $active_tab == 'configuration_options' ? 'nav-tab-active' : ''; ?>">
									<?php echo esc_html_x( 'Integration', 'settings_context', 'mybooking-wp-plugin' ) ?>
								</a>
							<?php } ?>
							<?php if ($google_api_places) { ?>
					      <a href="?page=mybooking-plugin-configuration&tab=google_api_places_options" class="nav-tab <?php echo $active_tab == 'google_api_places_options' ? 'nav-tab-active' : ''; ?>">
									<?php echo esc_html_x( 'Google Api Places', 'settings_context', 'mybooking-wp-plugin' ) ?>
								</a>
					    <?php } ?>
  				    <a href="?page=mybooking-plugin-configuration&tab=css_options" class="nav-tab <?php echo $active_tab == 'css_options' ? 'nav-tab-active' : ''; ?>">
								<?php echo esc_html_x( 'Advanced', 'settings_context', 'mybooking-wp-plugin' ) ?>
							</a>
					</h2>

		      <form action="options.php" method="POST">

	            <?php

               $renting_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>vehicle rental</u>, <u>boat rental</u>, <u>properties</u> rental companies or <u>accommodation</u>.</p>
		                 <p>
										 	Con la configuración inicial hemos las páginas necesarias para el proceso de reserva y las hemos configurado desde aquí como puedes ver a continuación. 
										</p>
										<p>
											<strong>
												Edita esta parte solo si creas una nueva página para el proceso o para los términos y condiciones y la quieres asignar.	
											</strong>
										 </p>
		                </div>
                 </div>
                 <hr />

EOF;

               $activity_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>activities</u> or <u>tours</u> company.</p>
										 <p>
										 	Con la configuración inicial hemos las páginas necesarias para el proceso de reserva y las hemos configurado desde aquí como puedes ver a continuación. 
										</p>
										<p>
											<strong>
												Edita esta parte solo si creas una nueva página para el proceso o para los términos y condiciones y la quieres asignar.	
											</strong>
										 </p>
		                </div>
                 </div>
                 <hr />

EOF;

              $transfer_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>This module helps you to build a <em>reservation web site</em> for a <u>transfer</u> company.</p>
										 <p>
										 	Con la configuración inicial hemos las páginas necesarias para el proceso de reserva y las hemos configurado desde aquí como puedes ver a continuación. 
										</p>
										<p>
											<strong>
												Edita esta parte solo si creas una nueva página para el proceso o para los términos y condiciones y la quieres asignar.	
											</strong>
										 </p>
		                </div>
                 </div>
                 <hr />
							
EOF;		
								 
							$contact_info = <<<EOF
                 <br>
                 <div class="postbox">
                  <div class="inside">
										<p>
											Hemos desarrollado un <strong>formulario de contacto my básico</strong> para dar soporte a las necesidades de nuestros clientes. Si lo quieres usar solo tienes que pegar el shortcode [mybooking_contact] en cualquier página o post donde quieras que aparezca el formulario.
										</p>
										<p>
											La ventaja que tiene es que se integra con tu back-office de Mybooking y puedes tener en un mismo lugar tanto las reservas como otros mensajes que te escriban tus clientes.
										<br />
											Además, puedes añadir una asunto a cada formulario de mensaje de forma que puedas identificar el contexto indicando si está en la ficha de un producto o bien en la página de contacto. 
										</p>
										<p>	
											<strong>
												En este apartado puedes configurar si quieres utilizar el captcha de Google para asegurar el envío de tus formularios de contacto.
											</strong>
										</p>
		              </div>
                 </div>
                 <hr />

EOF;		
								 
							$complements_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
										<p>
											Esta pestaña <strong>no tiene que ver directamente con el motor de reservas</strong>. Se trata de una serie de funcionalidades extra que se han añadido al plugin para cubrir las necesidades de nuestros clientes sin que estos tenga que instalar otros plugins. Tienen una <strong>funcionalidad mínima</strong> en estos aspectos:
											</p>
											<ol>
												<li>Mostrar un pop-up al cargar la home para una promoción</li>
												<li>Mostrar los testimonios de sus clientes</li>
												<li>Mostrar un pase de diapositivas como CTA (Call to Action)</li>
												<li>Mostrar mensaje de cookies</li>
											</ol>
											<p>
												<strong>
													Si necesitas una funcionalidad avanzada puedes instalar un plugin concreto para cada una de ellas.
												</strong>
											</p>
		                </div>
                 </div>
                 <hr />

EOF;		
								 
							$google_api_places_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>
										 	Aqui puedes configurar la integración de la web con <strong>Google Api Places</strong>.
										 </p>
		                </div>
                 </div>
                 <hr />

EOF;		
								 
							$advanced_info = <<<EOF
                 <br>
                 <div class="postbox">
                   <div class="inside">
		                 <p>
										 	Esta pestaña esta dedicada a los profesionales del diseño o de la maquetación. Permite configurar las librerias que se van a cargar en función de las necesidades y de las compatibilidades con otras librerias. 
										 </p>
		                </div>
                 </div>
                 <hr />
EOF;

	             if ($active_tab == 'connection_options') {
			      	   settings_fields('mybooking_plugin_settings_group_connection');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_connection');
			           echo '</table>';
			         }
			         else if ($active_tab == 'renting_options') {
			         	 echo $renting_info;
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
               else if ($active_tab == 'contact_form') {
								 echo $contact_info;
			      	   settings_fields('mybooking_plugin_settings_group_contact_form');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_contact_form');
			           echo '</table>';
			         }
               else if ($active_tab == 'complements_options') {
								 echo $complements_info;
			      	   settings_fields('mybooking_plugin_settings_group_complements');
			           echo '<table class="form-table">';
			           do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_complements');
			           echo '</table>';
			         }
							 else if ($active_tab == 'configuration_options') {
								settings_fields('mybooking_plugin_settings_group_configuration');
								echo '<table class="form-table">';
								do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_configuration');
								echo '</table>';
							}
							else if ($active_tab == 'google_api_places_options') {
								echo $google_api_places_info;
								settings_fields('mybooking_plugin_settings_group_google_api_places');
								echo '<table class="form-table">';
								do_settings_fields('mybooking-plugin-configuration','mybooking_plugin_settings_section_google_api_places');
								echo '</table>';
							}
			        else if ($active_tab == 'css_options') {
								 echo $advanced_info;
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
		                       null,
		                       'mybooking-plugin-configuration');

      // Creates a connection settings section "mybooking_plugin_settings_section_configuration"
		  add_settings_section('mybooking_plugin_settings_section_configuration',
		                       'Configuration',
		                       null,
		                       'mybooking-plugin-configuration');

		  // Creates a renting wizard settings section "mybooking_plugin_settings_section_renting"
		  add_settings_section('mybooking_plugin_settings_section_renting',
		                       'Renting or Accommodation',
		                       null,
		                       'mybooking-plugin-configuration');

		  // Creates an activities settings section "mybooking_plugin_settings_section_activities"
		  add_settings_section('mybooking_plugin_settings_section_activities',
		                       'Activities or Appointments',
		                       null,
		                       'mybooking-plugin-configuration');

		  // Creates an activities settings section "mybooking_plugin_settings_section_transfer"
		  add_settings_section('mybooking_plugin_settings_section_transfer',
		                       'Transfer',
		                       null,
		                       'mybooking-plugin-configuration');


      // Creates a connection settings section "mybooking_plugin_settings_section_google_api_places"
		  add_settings_section('mybooking_plugin_settings_section_google_api_places',
		                       'Connection',
		                       null,
		                       'mybooking-plugin-configuration');

      // Creates a complements setting section "mybooking_plugin_settings_section_complements"
      add_settings_section('mybooking_plugin_settings_section_complements',
		                       'Complements',
		                       null,
		                       'mybooking-plugin-configuration');

      // Creates a css settings section "mybooking_plugin_settings_css"
		  add_settings_section('mybooking_plugin_settings_css',
		                       'CSS',
		                       null,
		                       'mybooking-plugin-configuration');


      // == Creates connection fields

		  add_settings_field('mybooking_plugin_settings_account_id',
												 _x('Mybooking Client Id', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_account_id_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

		  add_settings_field('mybooking_plugin_settings_api_key',
												 _x('Mybooking API Key', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

		  add_settings_field('mybooking_plugin_settings_sales_channel',
												 _x('Sales Channel Code', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_sales_channel_code_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_connection');

      // == Creates configuration fields

			add_settings_field('mybooking_plugin_settings_google_api_places_selector',
												 _x('Google Api Places', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration');

			add_settings_field('mybooking_plugin_settings_renting_selector',
		                     null,
		                     array($this, 'field_mybooking_plugin_settings_renting_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration',
												 array('class' => 'hidden-field'));

      add_settings_field('mybooking_plugin_settings_activities_selector',
		                     null,
		                     array($this, 'field_mybooking_plugin_settings_activities_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration',
												 array('class' => 'hidden-field'));

      add_settings_field('mybooking_plugin_settings_transfer_selector',
		                     null,
		                     array($this, 'field_mybooking_plugin_settings_transfer_selector_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_configuration',
												 array('class' => 'hidden-field'));

      // == Creates renting wizard fields

		  add_settings_field('mybooking_plugin_settings_choose_products_page',
												 _x('Choose products page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_choose_products_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_checkout_page',
												 _x('Checkout page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_checkout_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_summary_page',
												 _x('Summary page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  add_settings_field('mybooking_plugin_settings_terms_page',
												 _x('Terms and conditions page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Selector in process
		  add_settings_field('mybooking_plugin_settings_selector_in_process',
												 _x('Selector in process', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_selector_in_process_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Show taxes included
		  add_settings_field('mybooking_plugin_settings_show_taxes_included',
												 _x('Show taxes included', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_show_taxes_included_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Duration context
		  add_settings_field('mybooking_plugin_settings_duration_context',
												 _x('Duration context', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_duration_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Dates context
		  add_settings_field('mybooking_plugin_settings_dates_context',
												 _x('Dates context', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_dates_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

		  // Not available context
		  add_settings_field('mybooking_plugin_settings_not_available_context',
												 _x('Not available context', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_not_available_context_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_renting');

			// Product detail pages (calendar)
			add_settings_field('mybooking_plugin_settings_use_product_detail_pages',
												 _x('<em>Use product detail pages</em>', 'plugin_settings', 'mybooking-wp-plugin'),
												 array($this, 'field_mybooking_plugin_settings_use_product_detail_pages_callback'),
												 'mybooking-plugin-configuration',
												 'mybooking_plugin_settings_section_renting');

add_settings_field('mybooking_plugin_settings_products_url',
												 _x('<em>Product details pages URL prefix</em>', 'plugin_settings', 'mybooking-wp-plugin'),
												 array($this, 'field_mybooking_plugin_settings_products_url_callback'),
												 'mybooking-plugin-configuration',
												 'mybooking_plugin_settings_section_renting');

      // == Creates activities section fields

		  add_settings_field('mybooking_plugin_settings_activities_shopping_cart_page',
												 _x('Checkout page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_activities_shopping_cart_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_summary_page',
												 _x('Summary page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_activities_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_terms_page',
												 _x('Terms & conditions page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_activities_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

		  // Activity detail pages
		  add_settings_field('mybooking_plugin_settings_use_activities_detail_pages',
												_x('<em>Use detail pages</em>', 'plugin_settings', 'mybooking-wp-plugin'),
		  									array($this, 'field_mybooking_plugin_settings_use_activities_detail_pages_callback'),
		  									'mybooking-plugin-configuration',
		  									'mybooking_plugin_settings_section_activities');

		  add_settings_field('mybooking_plugin_settings_activities_url',
												 _x('<em>Detail pages URL prefix</em>', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_activities_url_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_activities');

      // == Creates transfer wizard fields

		  add_settings_field('mybooking_plugin_settings_transfer_choose_vehicle_page',
												 _x('Choose vehicle page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_transfer_choose_vehicle_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_checkout_page',
												 _x('Checkout page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_transfer_checkout_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_summary_page',
												 _x('Summary page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_transfer_summary_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');

		  add_settings_field('mybooking_plugin_settings_transfer_terms_page',
												 _x('Terms and conditions page', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_transfer_terms_page_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_transfer');


      // == Creates google api places fields

		  add_settings_field('mybooking_plugin_settings_google_api_places_api_key',
												 _x('Api Key', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_restrict_country_code',
												 _x('Country code restriction', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_restrict_country_code_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_restrict_bounds',
												 _x('Restrict bounds', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_restrict_bounds_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_sw_lat',
												 _x('SW Latitude', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_sw_lat_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_sw_lng',
												 _x('SW Longitude', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_sw_lng_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_ne_lat',
												 _x('NE Latitude', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_ne_lat_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

		  add_settings_field('mybooking_plugin_settings_google_api_places_bounds_ne_lng',
												 _x('NE Longitude', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_google_api_places_bounds_ne_lng_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_google_api_places');

      // == Create Contact form sectionn Fields
      add_settings_field('mybooking_plugin_settings_contact_form_use_google_captcha',
												 _x('Use Google captcha', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_contact_form_use_google_captcha_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      add_settings_field('mybooking_plugin_settings_contact_form_google_captcha_api_key',
												 _x('Google Captcha API Key', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_contact_form_google_captcha_api_key_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      add_settings_field('mybooking_plugin_settings_contact_form_include_google_captcha_js',
												 _x('Include Google Captcha JS library', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_contact_form_include_google_captcha_js_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_contact_form');

      // == Create Complements section Fields
      add_settings_field('mybooking_plugin_settings_complements_popup',
												 _x('Promotion Pop-up', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_complements_popup_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_testimonials',
												 _x('Testimonial module', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_complements_testimonials_callback'),
                         'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_product_slider',
												_x('Product Slider module', 'plugin_settings', 'mybooking-wp-plugin'),
                        array($this, 'field_mybooking_plugin_settings_complements_product_slider_callback'),
                        'mybooking-plugin-configuration',
                        'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_content_slider',
												_x('Content Slider module', 'plugin_settings', 'mybooking-wp-plugin'),
                        array($this, 'field_mybooking_plugin_settings_complements_content_slider_callback'),
                        'mybooking-plugin-configuration',
                        'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_renting_item',
												 _x('Renting Item module', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_complements_renting_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

     add_settings_field('mybooking_plugin_settings_complements_activity_item',
												 _x('Activity Items module', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_complements_activity_item_callback'),
                        'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_section_complements');

      add_settings_field('mybooking_plugin_settings_complements_cookies',
												  _x('Cookies Notice', 'plugin_settings', 'mybooking-wp-plugin'),
 		                     array($this, 'field_mybooking_plugin_settings_complements_cookies_callback'),
                          'mybooking-plugin-configuration',
 		                     'mybooking_plugin_settings_section_complements');

		  // == Create css section fields

      // Custom CSS

		  add_settings_field('mybooking_plugin_settings_components_css',
												 _x('Include CSS', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_components_css_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // SlickJS
		  add_settings_field('mybooking_plugin_settings_components_js_slickjs',
												 _x('Include SlickJS', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_components_js_slickjs_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Select 2
		  add_settings_field('mybooking_plugin_settings_components_js_use_select2',
												 _x('Use select2 library on selects', 'plugin_settings', 'mybooking-wp-plugin'),
		                     array($this, 'field_mybooking_plugin_settings_components_js_use_select2_callback'),
		                     'mybooking-plugin-configuration',
		                     'mybooking_plugin_settings_css');

		  // Custom loader
		  add_settings_field('mybooking_plugin_settings_components_custom_loader',
												 _x('Use custom loader', 'plugin_settings', 'mybooking-wp-plugin'),
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

		  echo "<input type='text' name='mybooking_plugin_settings_connection[$field]' value='$value' class='regular-text' readonly />";

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

		  echo "<input id='mybooking_plugin_settings_api_key_active' type='text' name='mybooking_plugin_settings_connection[$field]' value='$value' class='regular-text' readonly /><button type='button' title='Active' id='mybooking_plugin_settings_api_key_active_btn'><span class='dashicons dashicons-edit'></span></button>";
		  echo "<p class=\"description\">"._x( 'For the API key from your mybooking account settings', 'settings_context', 'mybooking-wp-plugin' )."</p>.";
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
		  echo "<p class=\"description\">"._x( 'If you have <b>multiple sales channels</b>, input the sales channel code that you want to use in this website.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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

      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value='$value'/>";
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

      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value='$value'/>";
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

      echo "<input type='hidden' name='mybooking_plugin_settings_configuration[$field]' value='$value'/>";
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
			echo "<p class=\"description\">"._x( 'Activate if you want to use Google Location API to input a custom delivery or collection address in a rental website.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

		}

    // == Renting

		/**
		 * Render Mybooking Renting/Accommodation Choose products page
		 */
		public function field_mybooking_plugin_settings_choose_products_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_choose_products_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_rent_engine_product_listing] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Checkout page
		 */
		public function field_mybooking_plugin_settings_checkout_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_checkout_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_rent_engine_complete] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Summary page
		 */
		public function field_mybooking_plugin_settings_summary_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_summary_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_rent_engine_summary] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Renting/Accommodation Terms and conditions page
		 */
		public function field_mybooking_plugin_settings_terms_page_callback() {

		  $this->field_mybooking_plugin_renting_settings_page("mybooking_plugin_settings_terms_page");
		  echo "<p class=\"description\">"._x( 'The terms and conditions page.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<hr />";
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
		  $select .= "<option value=''>["._x('Choose selector', 'plugin_settings', 'mybooking-wp-plugin')."]</option>";

		  if ($value == 'wizard') {
		    $select .= "<option value='wizard' selected>"._x('Wizard', 'plugin_settings', 'mybooking-wp-plugin')."</option>";
		  }
		  else {
		    $select .= "<option value='wizard'>"._x('Wizard', 'plugin_settings', 'mybooking-wp-plugin')."</option>";
		  }

			if ($value == 'form') {
		    $select .= "<option value='form' selected>"._x('Form', 'plugin_settings', 'mybooking-wp-plugin')."</option>";
		  }
		  else {
		    $select .= "<option value='form'>"._x('Form', 'plugin_settings', 'mybooking-wp-plugin')."</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">"._x( 'Choose the selector that you want to use when you choose <em>modify reservation</em> on choose product or complete pages.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>wizard</b> if you are using the Wizard selector or widget on your home page.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>form</b> if you are using the Form selector or widget on yout home page.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<hr />";

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

		  echo "<p class=\"description\">"._x( 'Show taxes included.', 'settings_context', 'mybooking-wp-plugin' )."";
		  echo "<p class=\"description\">"._x( 'Activate if you want to show taxes included literal in reservation.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Do not activate if you do not want to show taxes included literal in reservation.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
			echo "<hr />";

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
		  $select .= "<option value=''>["._x( 'Choose duration context', 'settings_context', 'mybooking-wp-plugin' )."]</option>";

		  if ($value == 'days') {
		    $select .= "<option value='days' selected>"._x( 'Days', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='days'>"._x( 'Days', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'nights') {
		    $select .= "<option value='nights' selected>"._x( 'Nights', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='nights'>"._x( 'Nights', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">"._x( 'Choose the duration that describes your business context.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>days</b> to describe duration in days.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>nights/b> to describe duration in nights.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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
		  $select .= "<option value=''>["._x( 'Choose dates context', 'settings_context', 'mybooking-wp-plugin' )."]</option>";

		  if ($value == 'pickup-return') {
		    $select .= "<option value='pickup-return' selected>"._x( 'Pickup/Return', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='pickup-return'>"._x( 'Pickup/Return', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'checkin-checkout') {
		    $select .= "<option value='checkin-checkout' selected>"._x( 'Checkin/Checkout', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='checkin-checkout'>"._x( 'Checkin/Checkout', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

		  if ($value == 'start-end') {
		    $select .= "<option value='start-end' selected>"._x( 'Start/End', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='start-end'>"._x( 'Start/End', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'arrive-departure') {
		    $select .= "<option value='arrive-departure' selected>"._x( 'Arrival/Depature', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='arrive-departure'>"._x( 'Arrival/Depature', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'departure-entry') {
		    $select .= "<option value='departure-entry' selected>"._x( 'Departure/Entry', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='departure-entry'>"._x( 'Departure/Entry', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

		  if ($value == 'eta-etd') {
		  	$select .= "<option value='eta-etd' selected>"._x( 'Estimated Time of Arrival / Departure', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='eta-etd'>"._x( 'Estimated Time of Arrival / Departure', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">"._x( 'Choose the start/end date that describes your business context.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>pickup/return</b> to describe pickup and return dates.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>checkin/checkout</b> for accommodation or properties.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>start/end</b> to describe start and end period.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>arrival/departure</b> to describe arrivals an departures', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>departure/entry</b> to describe departures and entries', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>eta/etd</b> to describe estimated arrival and departure times', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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
		  $select .= "<option value=''>["._x( 'Choose not available context', 'settings_context', 'mybooking-wp-plugin' )."]</option>";

		  if ($value == 'not-available') {
		    $select .= "<option value='not-available' selected>"._x( 'Not available', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='not-available'>"._x( 'Not available', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'check-by-phone') {
		    $select .= "<option value='check-by-phone' selected>"._x( 'Telephone consultation', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='check-by-phone'>"._x( 'Telephone consultation', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'check-by-email') {
		    $select .= "<option value='check-by-email' selected>"._x( 'E-mail consultation', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='check-by-email'>"._x( 'E-mail consultation', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

			if ($value == 'enquiry') {
		    $select .= "<option value='enquiry' selected>"._x( 'Enquiry', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }
		  else {
		    $select .= "<option value='enquiry'>"._x( 'Enquiry', 'settings_context', 'mybooking-wp-plugin' )."</option>";
		  }

		  $select .= "</select>";

		  echo $select;
		  echo "<p class=\"description\">"._x( 'Choose the not available message that describes your business context.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>Not available</b> to show not available message.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>Telephone consultation</b> to show Telephone consultation message.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>E-mail consultation</b> to show E-mail consultation message.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( 'Select <b>Enquiry</b> to show Enquiry message.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
			echo "<hr />";

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

			echo "<p class=\"description\">"._x( 'IMPORTANT: This is basic and experimental functionality', 'settings_context', 'mybooking-wp-plugin' )."</p>";
			echo "<br />";

		  $checked = ($value == '1') ? 'checked' : '';
      echo "<input type='hidden' name='mybooking_plugin_settings_renting[$field]' value=''/>";
		  echo "<input type='checkbox' name='mybooking_plugin_settings_renting[$field]' value='1' $checked class='regular-text' />";
		  echo "<p class=\"description\">"._x( 'Use product detail pages.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

		  echo "<div class=\"description\">";
      echo "<p>"._x( '<b>Do not activate</b> if you have create a custom page for each one of your products with the [mybooking_rent_engine_product] or if you are using the [mybooking_rent_engine_selector] or the Selector widget in your home page.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p>"._x( '<b>Activate</b> it if you are using the [mybooking_rent_engine_products] shortcode to <b>browse the catalog</b> and you want the plugin to automatically create a page for each product.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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
		  echo "<p>"._x( 'This is the <b>prefix folder</b> that is added to the product detail page created virtually for any
		  product if <u>Use product detail pages</u> is active.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "</div>";
		  echo "<hr />";

		}

    // == Activities

		/**
		 * Render Mybooking Activities Shopping cart page
		 */
		public function field_mybooking_plugin_settings_activities_shopping_cart_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_shopping_cart_page");
			echo "<p class=\"description\">"._x( 'The page with [mybooking_activities_engine_shopping_cart] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Activities order/reservation page
		 */
		public function field_mybooking_plugin_settings_activities_summary_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_summary_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_activities_engine_summary] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Activities terms and conditions page
		 */
		public function field_mybooking_plugin_settings_activities_terms_page_callback() {

		  $this->field_mybooking_plugin_activities_settings_page("mybooking_plugin_settings_activities_terms_page");
			echo "<p class=\"description\">"._x( 'The page with the terms and conditions.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";
		  echo "<hr />";

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

		  echo "<p class=\"description\">"._x( 'Use detail pages.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

		  echo "<div class=\"description\">";
      echo "<p>"._x( 'Do not activate if you have create a custom page for each one of your activities with the [mybooking_activities_engine_activity]', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p>"._x( 'Activate it if you are using the [mybooking_activities_engine_activities] shortcode to <b>browse the activities catalog</b> and you want the plugin to automatically create a page for each activity.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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
			echo "<p>"._x( 'This is the <b>prefix folder</b> that is added to the activity detail page created virtually for any
		  product if <u>Use detail pages</u> is active.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "</div>";

		}

    // == Transfer

		/**
		 * Render Mybooking Transfer Choose vehicle
		 */
		public function field_mybooking_plugin_settings_transfer_choose_vehicle_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_choose_vehicle_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_transfer_choose_vehicle] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";
		}

		/**
		 * Render Mybooking Transfer Checkout page
		 */
		public function field_mybooking_plugin_settings_transfer_checkout_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_checkout_page");
			echo "<p class=\"description\">"._x( 'The page with [mybooking_transfer_checkout] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Transfer Summary page
		 */
		public function field_mybooking_plugin_settings_transfer_summary_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_summary_page");
		  echo "<p class=\"description\">"._x( 'The page with [mybooking_transfer_summary] shortcode.', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

		}

		/**
		 * Render Mybooking Transfer terms and conditions page
		 */
		public function field_mybooking_plugin_settings_transfer_terms_page_callback() {

		  $this->field_mybooking_plugin_transfer_settings_page("mybooking_plugin_settings_transfer_terms_page");
		  echo "<p class=\"description\">"._x( 'The terms and conditions page', 'settings_context', 'mybooking-wp-plugin' )."</p>.";

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

		  echo "<p class=\"description\">"._x( 'Use Google Captcha on <b>Contact Form</b>.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( 'Include Google Captcha JS library.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Promotion Pop-ups</b> Custom Post Type in order to create promotions.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Pop-up will be shown only in the front page.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Testimonials</b> Custom Post Type in order to create a testimonials carousel.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Create one or more Testimonials under Mybooking menu and use [mybooking_testimonials] to show it on a page or sidebar.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Content Slider</b> Custom Post Type in order to create a content slider with Gutenberg native editor.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Create one or more Sliders under Mybooking menu and use [mybooking_content_slider] to show it on a page or post.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Product Slider</b> Custom Post Type in order to create a content slider to show offers with limited custom fields.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Create one or more Product Sliders under Mybooking menu and use [mybooking_product_slider] to show it on a page or post.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Renting Items</b> Custom Post Type in order to create single items related to renting.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Create one or more Renting Items under Mybooking menu and show in a template or within any page builder query block.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Activity Items</b> Custom Post Type in order to create single items related to activities.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Create one or more Activity Items under Mybooking menu and show in a template or within any page builder query block.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( '<b>Activate Cookies Notice</b> in order to create a cookies warning.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
      echo "<p class=\"description\">"._x( '<small>Set the privacy page at WordPress settings to link properly the info button.</small>', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( 'Include <b>CSS</b> for plugin <u>UX components</u> like <em>Jquery UI datepicker</em> and <em>Jquery DateRange</em>.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( '<b>¡Attention!</b> Uncheck only if you are using <u>mybooking theme<u> or a <u>custom theme with your own reservation engine templates</u>.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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

		  echo "<p class=\"description\">"._x( 'Use <b>custom loader</b> to notify the user when connecting to the reservation engine...', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( '<b>¡Attention!</b> check only if you are using mybooking theme or custom theme with its own Ajax Loader.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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

		  echo "<p class=\"description\">"._x( 'Include <b>slickJS</b> library. It is <b>required</b> if you are using the testimonials or slider complement.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
		  echo "<p class=\"description\">"._x( '<b>¡Attention!</b> Uncheck if not testimonials or slider are used or if the theme that you are using includes slickJS.', 'settings_context', 'mybooking-wp-plugin' )."</p>";
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

		  echo "<p class=\"description\">"._x( 'Use <b>select2</b> library on form selects.', 'settings_context', 'mybooking-wp-plugin' )."</p>";

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
		  $select .= "<option value=''>["._x( 'Choose page', 'settings_context', 'mybooking-wp-plugin' )."]</option>";
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
		  $select .= "<option value=''>["._x( 'Choose page', 'settings_context', 'mybooking-wp-plugin' )."]</option>";
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
		  $select .= "<option value=''>["._x( 'Choose page', 'settings_context', 'mybooking-wp-plugin' )."]</option>";
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