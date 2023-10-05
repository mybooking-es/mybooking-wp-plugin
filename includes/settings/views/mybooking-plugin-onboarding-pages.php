<?php
	defined('ABSPATH') or die('Forbidden');
?>

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

		function getList ($settings) {
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

			return array(
				"pages_ids" => $pages_ids,
				"home_page_id" => $home_page_id,
			);
		}

		// Get settings
		if ($module_rental) {
			$rental_settings = (array) get_option("mybooking_plugin_settings_renting");
			$rental_obj = getList($rental_settings);
		}

		// Get activities settings
		if ($module_activities) {
			$activities_settings = (array) get_option("mybooking_plugin_settings_activities");
			$activities_obj = getList($activities_settings);
		}

		// Get transfer settings
		if ($module_transfer) {
			$transfer_settings = (array) get_option("mybooking_plugin_settings_transfer");
			$transfer_obj = getList($transfer_settings);
		}
	?>
	
	<div class="mb-onboarding-pages mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</div>
		
			<!-- RENTING -->
			<?php if ( $module_rental ): ?>
				<?php if ( isset($rental_obj['pages_ids']) ) { ?>
					<h2 class="mb-onboarding-step-title">
						<?php echo esc_html_x( 'Reservation process pages for ', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<strong>
							<?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</h2>

					<ul class="mb-onboarding-list">
						<?php foreach ($rental_obj['pages_ids'] as $key => $id) { ?>
							<?php $post = get_post($id) ?>
							
							<li class="mb-onboarding-setup-item">
								<div class="mb-onboarding-setup-item-name">
									<strong><?php echo get_the_title( $id ) ?></strong>
									<?php if ( $rental_obj['home_page_id'] === $id ) { ?>
										<p class="mb-onboarding-setup-item-hint"><?php echo esc_html_x( '(Reservation process starts here)', 'onboarding_context', 'mybooking-wp-plugin' ) ?></p>
									<?php } ?>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<?php if ( isset($rental_settings) ) { 

										$type = array_search($id, $rental_settings); 
										
									} ?>
									<?php if ( $rental_obj['home_page_id'] === $id ) { ?>
										<a href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Show page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
											<span class="mb-onboarding-icon dashicons dashicons-external"></span>
										</a>
									<?php } ?>
									<?php $module = ($module_rental) ? 'mybooking_plugin_settings_renting' : 'mybooking_plugin_settings_transfer' ?>
									<span data-type="<?php echo $type ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="<?php echo esc_attr_x( 'Edit page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Copy page link for mybooking web configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php } else { ?>
					<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<a href="mail:soporte@mybooking.es">
						soporte@mybooking.es
					</a>
				<?php } ?>
			<?php endif; ?>

			<!-- TRANSFER PAGES -->
			<?php if ( $module_transfer ): ?>
				<?php if ( isset($transfer_obj['pages_ids']) ) { ?>
					<h2 class="mb-onboarding-step-title">
						<?php echo esc_html_x( 'Reservation process pages for ', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<strong>
							<?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</h2>

					<ul class="mb-onboarding-list">
						<?php foreach ($transfer_obj['pages_ids'] as $key => $id) { ?>
							<?php $post = get_post($id) ?>
							
							<li class="mb-onboarding-setup-item">
								<div class="mb-onboarding-setup-item-name">
									<strong><?php echo get_the_title( $id ) ?></strong>
									<?php if ($transfer_obj['home_page_id'] === $id) { ?>
										<p class="mb-onboarding-setup-item-hint"><?php echo esc_html_x( '(Reservation process starts here)', 'onboarding_context', 'mybooking-wp-plugin' ) ?></p>
									<?php } ?>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<?php if ( isset($transfer_settings) ) { $type = array_search($id, $transfer_settings); } ?>
									<?php if ($transfer_obj['home_page_id'] === $id) { ?>
										<a href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Show page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
											<span class="mb-onboarding-icon dashicons dashicons-external"></span>
										</a>
									<?php } ?>
									<?php $module = ($module_rental) ? 'mybooking_plugin_settings_renting' : 'mybooking_plugin_settings_transfer' ?>
									<span data-type="<?php echo $type ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="<?php echo esc_attr_x( 'Edit page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Copy page link for mybooking web configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php } else { ?>
					<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<a href="mail:soporte@mybooking.es">
						soporte@mybooking.es
					</a>
				<?php } ?>
			<?php endif; ?>

			<!-- ACTIVITIES PAGES -->
			<?php if ( $module_activities ): ?>
				<?php if ( isset($activities_obj['pages_ids']) ) { ?>
					<h2 class="mb-onboarding-step-title">
						<?php echo esc_html_x( 'Reservation process pages for', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<strong>
							<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</h2>

					<ul class="mb-onboarding-list">
						<?php foreach ($activities_obj['pages_ids'] as $key => $id) { ?>
							<?php $post = get_post($id) ?>
							
							<li class="mb-onboarding-setup-item">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo get_the_title( $id ) ?>
									</strong>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
										<?php if ( isset($activities_settings) ) { $type = array_search($id, $activities_settings); } ?>
										<?php $module = ($module_activities) ? 'mybooking_plugin_settings_activities' : '' ?>
										<span data-type="<?php echo $type ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="<?php echo esc_attr_x( 'Edit page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Copy page link for mybooking web configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php } else { ?>
					<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<a href="mail:soporte@mybooking.es">
						soporte@mybooking.es
					</a>
				<?php } ?>
			<?php endif; ?>
	</div>

	<!-- Snackbar -->
	<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php } mybooking_plugin_onboarding_pages_page(); ?>