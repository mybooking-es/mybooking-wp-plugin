<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_components_page() {
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

		if($settings) {
			$components_ids = array();
			foreach ($settings as $key => $value) {
				// Sort the components
				ksort($components_ids);
			}
		}
	?>
	
	<div class="mb-onboarding-components mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
		</div>
		<?php if ( isset($components_ids) ) { ?>
			<h1>
				<?php echo esc_html_x( 'Components', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
			<p>
				<strong>
					<?php echo esc_html_x( 'Below we suggest the plugin components that could be useful for your type of business.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</strong>
				<br />
				<?php echo esc_html_x( 'Among them you will see components aimed at data visualization and others aimed at starting the reservation process.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<br />
				<?php echo esc_html_x( 'Take the time to look at the images that illustrate the type of component. If you still have doubts on this', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<strong>
					<a href="https://help.mybooking.es/article/201-como-obtener-el-shortcode-de-un-componente-para-una-pagina-de-producto" target="_blank">
						<?php echo esc_html_x( 'article', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</a>
				</strong>
				<?php echo esc_html_x( 'we explain everything', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
			<?php if ( $module_rental || $module_transfer ): ?>
				<!-- Init components -->
				<?php if ( $module_rental ) { ?>
					<h2>
						<?php echo esc_html_x( 'Components for the module', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						&nbsp;
						<strong>
							<?php if ( $module_rental ) { ?><?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?><?php } elseif ( $module_transfer ) { ?><?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?><?php } ?>
						</strong>
					</h2>
					<hr />
					<?php if ( (array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar']) || (array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning']) || (array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning']) || (array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning']) || (array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker']) ) { ?>
						<ul class="mb-onboarding-list">
							<?php if ( array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'You can add a calendar on your product page to start the booking process. The component will be displayed according to the configuration of your business in Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</p>
										<div class="mb-onboarding-row">
											<span data-type="calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Planning by hours', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'You can add a schedule to see the time availability on a selected day. This is a purely informative component and can be configured by branch, family and/or product category', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-diary" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Planning by days', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'You can add a schedule that shows availability in a pre-established number of days. This is a purely informative component and can be configured by branch, family and/or product category', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Weekly planning', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'You can add a weekly schedule with availability to your product page to start the reservation process', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-weekly" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Shift picker', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'You can add a shift selector to start the reservation process. Especially recommended in products or categories with a selection of more than one unit and with a shift schedule', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</p>
										<div class="mb-onboarding-row">
											<span data-type="shift-picker" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
										</div>
									</div>
								</li>
							<?php } ?>
						</ul>
					<?php } else { ?>
						<p>
							<strong>
								<?php echo esc_html_x( 'No component could be recovered', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</strong>
						</p>
					<?php } ?>
				<?php } else { ?>
					<p>
					<strong>
					<?php echo esc_html_x( 'No component could be recovered', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<!-- Init components -->
				<h2>
					<?php echo esc_html_x( 'Components for the module', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<strong>
						<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
				</h2>
				<hr />
				<?php if (  array_key_exists('wc_activity_calendar', $onboarding_settings) &&  $onboarding_settings['wc_activity_calendar'] ) { ?>
					<ul class="mb-onboarding-list">
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									<?php echo esc_html_x( 'Component', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
									&nbsp;
									<strong>
										<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
								</p>
								<p>
									<?php echo esc_html_x( 'You can add a calendar on your product page to start the booking process. The component will be displayed according to the configuration of your business in Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<div class="mb-onboarding-row">
									<span data-type="calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="<?php echo esc_attr_x( 'Show gallery', 'onboarding_context', 'mybooking-wp-plugin' ) ?>"></span>
								</div>
							</div>
						</li>
					</ul>
				<?php } else { ?>
					<p>
						<strong>
							<?php echo esc_html_x( 'No component could be recovered', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
		<?php } else { ?>
			<?php echo esc_html_x( 'We sorry', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			&nbsp;
			<strong>
			 	<?php echo esc_html_x( 'no component could be recovered', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</strong>
			<?php echo esc_html_x( 'Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			&nbsp;
			<a href="mail:soporte@mybooking.es">
				soporte@mybooking.es
			</a>
		<?php } ?>
	</div>
	
	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php
}

mybooking_plugin_onboarding_components_page();
?>