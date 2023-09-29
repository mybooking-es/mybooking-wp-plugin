<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_resume_page() {
	?>
	<?php
	// Get onboarding settings
	$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

	if ( $onboarding_settings ) {
		// Set type of module 
		$module_rental = $module_activities = $module_transfer = false;
		if (array_key_exists('module_rental', $onboarding_settings)) {
			$module_rental = $onboarding_settings["module_rental"];
		}
		if (array_key_exists('module_activities', $onboarding_settings)) {
			$module_activities = $onboarding_settings["module_activities"];
		}
		if (array_key_exists('module_transfer', $onboarding_settings)) {
			$module_transfer = $onboarding_settings["module_transfer"];
		}
	}

	// Get settings
	if ($module_rental) {
		$settings = (array) get_option("mybooking_plugin_settings_renting");
	}

	// Get activities settings
	if ($module_activities) {
		$settings = (array) get_option("mybooking_plugin_settings_activities");
	}

	// Get transfer settings
	if ($module_transfer) {
		$settings = (array) get_option("mybooking_plugin_settings_transfer");
	}

	?>

	<div class="mb-onboarding-page-header">
		<div class="mb-onboarding-title-section">
			<?php if ( isset($settings) ) { ?>
				<h1 class="mb-onboarding-title">
					<?php echo esc_html_x( 'Your booking engine pages had been successfully set up', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</h1>
				<p class="mb-onboarding-description">
					<?php echo esc_html_x( 'Your proces pages are available under Mybooking menu at sidebar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</p>
			<?php } else { ?>
				<h1 class="mb-onboarding-title mb-onboarding-error">
					<span class="mb-onboarding-icon dashicons dashicons-error"></span>
					<?php echo esc_html_x( 'An error has occurred', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</h1>
			<?php } ?>
		</div>
	</div>

	<?php function mybooking_plugin_onboarding_pages_page() { ?>
		<?php
			// Get onboarding settings
			$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

			if ( $onboarding_settings ) {
				// Set type of module 
				$module_rental = $module_activities = $module_transfer = false;
			if (array_key_exists('module_rental', $onboarding_settings)) {
					$module_rental = $onboarding_settings["module_rental"];
			}
				if (array_key_exists('module_activities', $onboarding_settings)) {
					$module_activities = $onboarding_settings["module_activities"];
			}
				if (array_key_exists('module_transfer', $onboarding_settings)) {
					$module_transfer = $onboarding_settings["module_transfer"];
			}
			}

			// Get settings
			if ($module_rental) {
				$settings = (array) get_option("mybooking_plugin_settings_renting");
			}

			// Get activities settings
			if ($module_activities) {
				$settings = (array) get_option("mybooking_plugin_settings_activities");
			}

			// Get transfer settings
			if ($module_transfer) {
				$settings = (array) get_option("mybooking_plugin_settings_transfer");
			}

			if ($settings) {
				$pages_ids = array();
				$home_page_id = 0;
				foreach ($settings as $key => $value) {
					// Get all pages with _page end characters in key
					if (str_ends_with($key, '_page')) {
						// Push values in a array position
						if (get_post_field('menu_order', $value)) {
							$pages_ids[get_post_field('menu_order', $value) - 1] = $value;
						}
					}

					// Set home page id
					if (str_contains($key, 'home_test') || str_contains($key, 'transfer_choose_vehicle')) {
						$home_page_id = $value;
					}

					// Sort the pages
					ksort($pages_ids);
				}
			}

			if($settings) {
				$components_ids = array();
				foreach ($settings as $key => $value) {
					// Sort the components
					ksort($components_ids);
				}
			}
		?>
		
		<div class="mb-onboarding-pages mb-onboarding-commons">
			<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
				<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</div>

			<?php if ( isset($pages_ids) ) { ?>
				<p class="mb-onboarding-pages-notice">
					<?php echo esc_html_x( 'To complete your configuration you must to do the following:', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</p>
			<?php } else { ?>
				<p class="mb-onboarding-pages-notice">
					<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					<a href="mail:soporte@mybooking.es">
						soporte@mybooking.es
					</a>
				</p>
			<?php } ?>

			<h2 class="mb-onboarding-step-title">
				<?php echo esc_html_x( '1. Insert the booking starter component on your Home page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h2>
			<p>
				<?php echo esc_html_x( 'This is the starting point to make a reservation. Copy the shortcode provided and paste it on the place you want to start a booking process, normally that\'s your home page. If you do not have a home page yet you can', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<a href="/wp-admin/post-new.php?post_type=page"><?php echo esc_html_x( 'create it now', 'onboarding_context', 'mybooking-wp-plugin' ) ?></a>
			</p>

			<!-- RENTING SELECTOR -->
			<?php if ( $module_rental): ?>
				<ul class="mb-onboarding-list">
					<li class="mb-onboarding-component-item">
						<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" data-type="selector" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/selector/horizontal-selector.png'; ?>" title="<?php echo esc_attr_x( 'Click to zoom', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
						<div class="mb-onboarding-component-item-body">
							<div class="mb-onboarding-setup-item-name">
								<strong>
									<?php echo esc_html_x( 'Renting Selector', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
								<p>
									<?php echo esc_html_x( 'Is mandatory you copy the code below and paste on your home page or your booking process won\'t work.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<p>
									<strong><?php echo esc_html_x( 'Paste this code on your home page:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
								</p>
								<code>[mybooking_rent_engine_selector]</code>
							</div>
							<div class="mb-onboarding-setup-item-buttons">
								<button data-href="[mybooking_rent_engine_selector]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mybooking-onboarding-get-shortcode">
									<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</button>
								<a role="button" class="button action" href="/wp-admin/post-new.php?post_type=page" title="<?php echo esc_attr_x( 'Create a new page and paste the shortcode inside', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
									<?php echo esc_attr_x( 'Create a new page now', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</a>
							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>

			<!-- TRANSFER SELECTOR -->
			<?php if ( $module_transfer ): ?>
				<ul class="mb-onboarding-list">
					<li class="mb-onboarding-component-item">
						<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" data-type="selector" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/selector/horizontal-selector.png'; ?>" title="<?php echo esc_attr_x( 'Click to zoom', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
						<div class="mb-onboarding-component-item-body">
							<div class="mb-onboarding-setup-item-name">
								<strong>
									<?php echo esc_html_x( 'Transfer Selector', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
								<p>
									<?php echo esc_html_x( 'Is mandatory you copy the code below and paste on your home page or your booking process won\'t work.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<p>
									<strong><?php echo esc_html_x( 'Paste this code on your home page:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
								</p>
								<code>[mybooking_transfer_selector]</code>
							</div>
							<div class="mb-onboarding-setup-item-buttons">
								<button data-href="[mybooking_transfer_selector]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mybooking-onboarding-get-shortcode">
									<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</button>
								<a role="button" class="button action" href="/wp-admin/post-new.php?post_type=page" title="<?php echo esc_attr_x( 'Create a new page and paste the shortcode inside', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
									<?php echo esc_attr_x( 'Create a new page now', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</a>
							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>

			<!-- ACTIVITIES COMPONENTS -->
			<?php if ( $module_activities ): ?>
				<ul class="mb-onboarding-list">
					<!-- Catalog -->
					<li class="mb-onboarding-component-item">
						<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" data-type="catalog" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/catalog/change_me.png'; ?>">
						<div class="mb-onboarding-component-item-body">
							<div class="mb-onboarding-setup-item-name">
								<strong>
									<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
								<p>
									<?php echo esc_html_x( 'This component shows a product grid based on your inventory. You can activate buttons and product pages checking Detail pages option on your configuration.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<p>
									<?php echo esc_html_x( 'Paste this code where you want to show the catalog:', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<code>[mybooking_activities_engine_activities]</code>
							</div>
							<div class="mb-onboarding-setup-item-buttons">
								<button data-href="[mybooking_activities_engine_activities]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mybooking-onboarding-get-shortcode">
									<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</button>
							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>

			<h2 class="mb-onboarding-step-title">
				<?php echo esc_html_x( '2. Set the paths on your account', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h2>
			<p>
				<?php echo esc_html_x( 'Your reservation system needs to know where Summary and Reservation pages are located, please copy and paste the adresses bellow and enter your account and set the paths.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
			
			<ul class="mb-onboarding-list">
				<div class="mb-onboarding-setup-item">
					<span class="mb-onboarding-path">
						<?php echo get_site_url(); ?>/summary
					</span>
					<a role="button" class="button button-primary" data-href="<?php echo get_site_url(); ?>/summary" title="<?php echo esc_attr_x( 'Copy Summary path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
						<?php echo esc_attr_x( 'Copy Sumary path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</a>
				</div>
				<div class="mb-onboarding-setup-item">
					<span class="mb-onboarding-path">
						<?php echo get_site_url(); ?>/my-reservation
					</span>
					<a role="button" class="button button-primary" data-href="<?php echo get_site_url(); ?>/my-reservation" title="<?php echo esc_attr_x( 'Copy Reservation path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
						<?php echo esc_attr_x( 'Copy Reservation path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</a>
				</div>
			</ul>

			<a class="mb-onboarding-help-link" href="https://help.mybooking.es/article/200-configuracion-de-la-direccion-de-las-paginas-de-resumen-y-mi-reserva">
				<?php echo esc_html_x( 'How to set your engine paths', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</a>
			<span class="mb-onboarding-separator"></span>
			<a class="mb-onboarding-help-link">
				<?php echo esc_attr_x( 'Enter your account', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</a>
		</div>

		<!-- Snackbar -->
		<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

		<!-- Gallery -->
		<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
	<?php } mybooking_plugin_onboarding_pages_page(); ?>
<?php } mybooking_plugin_onboarding_resume_page(); ?>