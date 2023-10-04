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
	
	<!-- CONTENT -->
	<div class="mb-onboarding-components mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
			<?php echo esc_html_x( 'Loading', 'onboarding_context', 'mybooking-wp-plugin' ) ?>...
		</div>

		<?php if ( isset($components_ids) ) { ?>

			<!-- Renting and transfer headings -->
			<?php if ( $module_rental || $module_transfer ): ?>
				<h2 class="mb-onboarding-step-title">
					<?php echo esc_html_x( 'Components for', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					<strong>
						<?php if ( $module_rental ) { ?>
							<?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<?php } elseif ( $module_transfer ) { ?>
							<?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<?php } ?>
					</strong>
				</h2>
			<?php endif; ?>

			<!-- RENTING COMPONENTS -->

			<ul class="mb-onboarding-list">

				<!-- Renting and transfer Selector -->
				<?php if ( $module_rental || $module_transfer ): ?>
					<li class="mb-onboarding-component-item">
						<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/selector/horizontal-selector.png'; ?>">
						<div class="mb-onboarding-component-item-body">
							<div class="mb-onboarding-setup-item-name">
								<strong>
									<?php echo esc_html_x( 'Dates Selector', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
								<p>
									<?php echo esc_html_x( 'Is mandatory you copy the code below and paste on your home page or your booking process won\'t work.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<p>
									<strong><?php echo esc_html_x( 'Paste this code on your home page:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
									<?php if ( $module_rental ) { ?>
										<code class="mb-onboarding-shortcode">[mybooking_rent_engine_selector]</code>
									<?php } elseif ( $module_transfer ) { ?>
										<code class="mb-onboarding-shortcode">[mybooking_transfer_selector]</code>
									<?php } ?>
								</p>
							</div>
							<div class="mb-onboarding-setup-item-buttons">
								<?php if ( $module_rental ) { ?>
									<button data-href="[mybooking_rent_engine_selector]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								<?php } elseif ( $module_transfer ) { ?>
									<button data-href="[mybooking_transfer_selector]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								<?php } ?>
							</div>
						</div>
					</li>
				
					<li class="mb-onboarding-component-item">
						<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/catalog/change_me.png'; ?>">
						<div class="mb-onboarding-component-item-body">
							<div class="mb-onboarding-setup-item-name">
								<strong>
									<?php echo esc_html_x( 'Float catalog', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</strong>
								<p>
									<?php echo esc_html_x( 'This component shows a product grid based on your inventory. You can activate buttons and product pages checking Detail pages option on your configuration.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</p>
								<p>
									<strong><?php echo esc_html_x( 'Paste this code where you want to show the catalog:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
									<code class="mb-onboarding-shortcode">[mybooking_rent_engine_products]</code>
								</p>
							</div>
							<div class="mb-onboarding-setup-item-buttons">
								<button data-href="[mybooking_rent_engine_products]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
									<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
								</button>
							</div>
						</div>
					</li>
				<?php endif; ?>
			</ul>

			<!-- ACTIVITIES COMPONENTS -->

			<?php if ( $module_activities ): ?>

				<?php if (  array_key_exists('wc_activity_calendar', $onboarding_settings) &&  $onboarding_settings['wc_activity_calendar'] ) { ?>

					<!-- Activities heading -->
					<h2 class="mb-onboarding-step-title">
						<?php echo esc_html_x( 'Components for', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						<strong>
							<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</h2>

					<ul class="mb-onboarding-list">
						<!-- Calendar -->
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/calendar/calendar.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'The booking calendar is shown automatically when you activate the Detail pages option. In case you don\'t, you must create the product pages and insert calendars manually for each of them.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<?php echo esc_html_x( 'Copy the shortcodes from your Mybooking account.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<strong>
										<a class="button action" href="https://help.mybooking.es/article/201-como-obtener-el-shortcode-de-un-componente-para-una-pagina-de-producto" target="_blank">
											<?php echo esc_html_x( 'How to get the calendar codes', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</a>
									</strong>
								</div>
							</div>
						</li>

						<!-- Catalog -->
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/catalog/change_me.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Activities catalog', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'This component shows a product grid based on your inventory. You can activate buttons and product pages checking Detail pages option on your configuration.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<?php echo esc_html_x( 'Paste this code where you want to show the catalog:', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										<code class="mb-onboarding-shortcode">[mybooking_activities_engine_activities]</code>
									</p>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<button data-href="[mybooking_activities_engine_activities]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								</div>
							</div>
						</li>
					</ul>
				<?php } ?>
			<?php endif; ?>

			<!-- RENTING EXTRA COMPONENTS -->

			<?php if ( (array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar']) || (array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning']) || (array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning']) || (array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning']) || (array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker']) ) { ?>
				
				<hr>
				<ul class="mb-onboarding-list">
					
					<!-- Calendar -->
					<?php if ( array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar'] ) { ?>
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/calendar/calendar.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'The booking calendar is shown automatically in generated pages when you activate the Detail pages option. In case you don\'t, you must create the product pages and insert calendars manually for each of them.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<strong><?php echo esc_html_x( 'Copy the shortcodes from your Mybooking account.', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
									</p>
									<strong>
										<a class="button action" href="https://help.mybooking.es/article/201-como-obtener-el-shortcode-de-un-componente-para-una-pagina-de-producto" target="_blank">
											<?php echo esc_html_x( 'How to get the calendar codes', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
										</a>
									</strong>
								</div>
							</div>
						</li>
					<?php } ?>

					<!-- Daily Planning -->
					<?php if ( array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning'] ) { ?>
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/planning/planning-calendar.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Planning by hours', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'You can add a schedule to see the time availability on a selected day. This is a purely informative component and can be configured by branch, family and/or product category', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<strong><?php echo esc_html_x( 'Paste this code where you want to show the component:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
										<code class="mb-onboarding-shortcode">[mybooking_rent_engine_planning type=diary]</code>
									</p>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<button data-href="[mybooking_rent_engine_planning type=diary]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								</div>
							</div>
						</li>
					<?php } ?>

					<!-- Monthly Planning -->
					<?php if ( array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning'] ) { ?>
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/planning/planning-diary.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Planning by days', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'You can add a schedule that shows availability in a pre-established number of days. This is a purely informative component and can be configured by branch, family and/or product category', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<strong><?php echo esc_html_x( 'Paste this code where you want to show the component:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
										<code class="mb-onboarding-shortcode">[mybooking_rent_engine_planning type=monthly]</code>
									</p>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<button data-href="[mybooking_rent_engine_planning type=monthly]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								</div>
							</div>
						</li>
					<?php } ?>

					<!-- Weekly Planning -->
					<?php if ( array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning'] ) { ?>
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/planning/planning-calendar.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Weekly planning', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'You can add a weekly schedule with availability to your product page to start the reservation process', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<strong><?php echo esc_html_x( 'Paste this code where you want to show the component:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
										<code class="mb-onboarding-shortcode">[mybooking_rent_engine_planning type=weekly]</code>
									</p>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<button data-href="[mybooking_rent_engine_planning type=weekly]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								</div>
							</div>
						</li>
					<?php } ?>

					<!-- Shift Picker -->
					<?php if ( array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker'] ) { ?>
						<li class="mb-onboarding-component-item">
							<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/shift-picker/shift-picker.png'; ?>">
							<div class="mb-onboarding-component-item-body">
								<div class="mb-onboarding-setup-item-name">
									<strong>
										<?php echo esc_html_x( 'Shift picker', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
									<p>
										<?php echo esc_html_x( 'You can add a shift selector to start the reservation process. Especially recommended for products or categories with a shift schedule and several units.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</p>
									<p>
										<strong><?php echo esc_html_x( 'Paste this code where you want to show the component:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
										<code class="mb-onboarding-shortcode">[mybooking_rent_engine_shift_picker]</code>
									</p>
								</div>
								<div class="mb-onboarding-setup-item-buttons">
									<button data-href="[mybooking_rent_engine_shift_picker]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="button button-primary mb-onboarding-btn-primary mybooking-onboarding-get-shortcode">
										<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</button>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>

		<!-- ERROR MESSAGES -->

		<?php } else { ?>
			<?php echo esc_html_x( 'We sorry', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
	
	<!-- GALLERY -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php
}

mybooking_plugin_onboarding_components_page();
?>