<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_pages_page() {
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
	?>
	
	<div class="mb-onboarding-pages mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</div>
		<?php if ( isset($pages_ids) ) { ?>
			<?php if ( $module_rental || $module_transfer ): ?>
				<h2>
					<?php echo esc_html_x( 'Reservation process pages for the module ', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					 <strong>
						<?php if ( $module_rental ) { ?> <?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?> <?php } elseif ( $module_transfer ) { ?> <?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?> <?php } ?>
					</strong>
				</h2>
				<hr />
				<ul class="mb-onboarding-list">
					<?php foreach ($pages_ids as $key => $id) { ?>
						<?php $post = get_post($id) ?>
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									<?php echo esc_html_x( 'Page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
									&nbsp;
									<strong><?php echo get_the_title( $id ) ?></strong>
									<?php if ($home_page_id === $id) { ?>
										<?php echo esc_html_x( '(Remember that the reservation process starts from here)', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									<?php } ?>
								</p>
								<div class="mb-onboarding-row">
									<?php $type = array_search($id, $settings) ?>
										<?php $module = ($module_rental) ? 'mybooking_plugin_settings_renting' : 'mybooking_plugin_settings_transfer' ?>
										<span data-type="<?php echo $type ?>" data-module="<?php echo $module ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<?php if ($home_page_id === $id) { ?>
										<a href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Show page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
											<span class="mb-onboarding-icon dashicons dashicons-external"></span>
										</a>
									<?php } ?>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="<?php echo esc_attr_x( 'Edit page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Copy page link for mybooking web configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
				<?php if ( !$home_page_id && array_key_exists('wc_rent_selector', $onboarding_settings) &&  $onboarding_settings['wc_rent_selector'] ) { ?>
					<p>
						<strong>
							<?php echo esc_html_x( 'You have a configuration that does not allow us to know from which type of component you want to start the reservation process', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
						<br />
						<?php echo esc_html_x( 'We propose a', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						&nbsp;
						<strong>
						<?php echo esc_html_x( 'searcher', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>,
						&nbsp;
						<?php echo esc_html_x( 'However, alternatively you can use other components that you can view', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						&nbsp;
						<a href="<?php esc_attr(menu_page_url('mybooking-onboarding-components'))?>">
							<?php echo esc_html_x( 'here', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</a>
					</p>
					<ul class="mb-onboarding-list">
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
									&nbsp;
									<strong>
										<?php echo esc_html_x( 'Searcher', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
								</p>
								<div class="mb-onboarding-row">
									<span data-type="selector" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<div data-href="[mybooking_rent_engine_selector]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-shortcode">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</div>
						</li>
					</ul>
				<?php } ?>
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<h2>
					<?php echo esc_html_x( 'Reservation process pages for the module', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<strong>
						<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
				</h2>
				<hr />
				<ul class="mb-onboarding-list">
					<?php foreach ($pages_ids as $key => $id) { ?>
						<?php $post = get_post($id) ?>
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									<?php echo esc_html_x( 'Page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
									&nbsp;
									<strong>
										<?php echo get_the_title( $id ) ?>
									</strong>
								</p>
								<div class="mb-onboarding-row">
									<?php $type = array_search($id, $settings) ?>
										<?php $module = ($module_activities) ? 'mybooking_plugin_settings_activities' : '' ?>
										<span data-type="<?php echo $type ?>" data-module="<?php echo $module ?>"class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="<?php echo esc_attr_x( 'Edit page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="<?php echo esc_attr_x( 'Copy page link for mybooking web configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>

				<p>
					<strong>
						<?php echo esc_html_x( 'You have a configuration that does not allow us to know from which type of component you want to start the reservation process', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
					<br />
					<?php echo esc_html_x( 'We propose a', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<strong>
						<?php echo esc_html_x( 'product catalog', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>,
					&nbsp;
					<?php echo esc_html_x( 'However alternatively you can use other components that you can display', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<a href="<?php esc_attr(menu_page_url('mybooking-onboarding-components'))?>">
						<?php echo esc_html_x( 'here', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</a>
				</p>
				<ul class="mb-onboarding-list">
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
								&nbsp;
								<strong>
									<?php echo esc_html_x( 'Product catalog', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
							</p>
							<div class="mb-onboarding-row">
								<span data-type="catalog" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
								<div data-href="[mybooking_activities_engine_activities]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-row-link mybooking-onboarding-get-shortcode">
									<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
								</div>
							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			<hr />
			<p>
				<strong>
					<?php echo esc_html_x( 'Remember to select the test homepage as the home page or insert a component that starts the reservation process in Wordpress and add the url of the summary page and my reservation to the Mybooking configuration in', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<i>
						"<?php echo esc_html_x( 'Configuration Guide > Web > Connect to the Web Page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"
					</i>
					&nbsp;
					<?php echo esc_html_x( 'to complete the configuration', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</strong>
				&nbsp;
				<?php echo esc_html_x( 'If you have questions you can consult the following', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<strong>
					<a href="https://help.mybooking.es/article/200-configuracion-de-la-direccion-de-las-paginas-de-resumen-y-mi-reserva" target="_blank">
						<?php echo esc_html_x( 'article', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</a>
				</strong>
				<?php echo esc_html_x( 'where we explain everything', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
		<?php } else { ?>
			<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			&nbsp;
			<a href="mail:soporte@mybooking.es">
				soporte@mybooking.es
			</a>
		<?php } ?>
	</div>

	<!-- Snackbar -->
	<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php
}

mybooking_plugin_onboarding_pages_page();
?>