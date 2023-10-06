<?php
	defined('ABSPATH') or die('Forbidden');
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

				<?php if ( is_array($rental_obj['pages_ids']) && count($rental_obj['pages_ids']) > 0 ) {?>
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
					<?php echo esc_html_x( 'We have not been able to recover any pages', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<?php } ?>
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

				<?php if ( is_array($transfer_obj['pages_ids']) && count($transfer_obj['pages_ids']) > 0 ) { ?>
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
					<?php echo esc_html_x( 'We have not been able to recover any pages', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<?php } ?>
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

				<?php if ( is_array($activities_obj['pages_ids']) && count($activities_obj['pages_ids']) > 0 ) { ?>
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
					<?php echo esc_html_x( 'We have not been able to recover any pages', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<?php } ?>
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