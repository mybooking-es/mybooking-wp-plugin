<?php
	defined('ABSPATH') or die('Forbidden');
?>

<div class="mb-onboarding-page-header">
	<div class="mb-onboarding-title-section">
		<?php if ( $setup_completed ) { ?>
			<h1 class="mb-onboarding-title">
				<?php echo esc_html_x( 'The booking engine has been successfully set up', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
			<p class="mb-onboarding-description">
				<?php echo esc_html_x( 'The reservation process pages are available in the pages option within the Mybooking menu', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
		<?php } else { ?>
			<h1 class="mb-onboarding-title mb-onboarding-error">
				<span class="mb-onboarding-icon dashicons dashicons-error"></span>
				<?php echo esc_html_x( 'An error has occurred', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
		<?php } ?>
	</div>
</div>

<div class="mb-onboarding-pages mb-onboarding-commons">
	<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">
		<?php echo esc_html_x( 'Loading...', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
	</div>

	<?php if ( $setup_completed ) { ?>
		<p class="mb-onboarding-pages-notice">
			<?php echo esc_html_x( 'To complete the configuration you can to do the following:', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</p>

		<!-- == COMPONENTS SUGGEST == -->
		<h2 class="mb-onboarding-step-title">
			<?php echo esc_html_x( '1. Insert the search engine or selector component on your Home page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h2>
		<p>
			<?php echo esc_html_x( 'This is the starting point to make a reservation. Copy the shortcode provided and paste it on the place you want to start a booking process, normally that\'s your home page. If you do not have a home page yet you can', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			<a href="/wp-admin/post-new.php?post_type=page"><?php echo esc_html_x( 'create it now', 'onboarding_context', 'mybooking-wp-plugin' ) ?></a>
		</p>

		<ul class="mb-onboarding-list">
			<!-- == RENT == -->
			<!-- RENT & TRANSFER SELECTOR -->
			<?php if ( (array_key_exists('wc_rent_selector', $onboarding_settings) && $onboarding_settings['wc_rent_selector']) || (array_key_exists('wc_transfer_selector', $onboarding_settings) && $onboarding_settings['wc_transfer_selector']) ): ?>
				<li class="mb-onboarding-component-item">
					<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" data-type="selector" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/selector/horizontal-selector.png'; ?>" title="<?php echo esc_attr_x( 'Click to zoom', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
					<div class="mb-onboarding-component-item-body">
						<div class="mb-onboarding-component-item-pill">
							<?php if ( $module_rental ) { ?>
								<?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							<?php } elseif ( $module_transfer ) { ?>
								<?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							<?php } ?>
						</div>
						<div class="mb-onboarding-setup-item-name">
							<strong>
								<?php echo esc_html_x( 'Search engine or selector', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</strong>
							<p>
								<?php echo esc_html_x( 'Copy the code below and paste on your home page to start the reservation process.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</p>
							<p>
								<strong><?php echo esc_html_x( 'Insert this shortcode on your home page:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
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
							<a role="button" class="mb-onboarding-btn-primary button action" href="/wp-admin/post-new.php?post_type=page" title="<?php echo esc_attr_x( 'Create a new page and paste the shortcode inside', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
								<?php echo esc_attr_x( 'Create a new page now', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</a>
						</div>
						<?php if ( get_page_by_path('home-test') ) : ?>
								<p>
									<a href="<?php echo get_permalink(get_page_by_path('home-test'))?>" target="_blank">
										<?php echo esc_html_x( 'Go to the example test page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</a>
								</p>
							<?php endif; ?>
							<?php if ( $module_rental && get_page_by_path('home-test-renting') ) : ?>
								<p>
									<a href="<?php echo get_permalink(get_page_by_path('home-test-renting'))?>" target="_blank">
										<?php echo esc_html_x( 'Go to the rent example test page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</a>
								</p>
							<?php endif; ?>
							<?php if ( $module_transfer  && get_page_by_path('home-test-transfer') ) : ?>
								<p>
									<a href="<?php echo get_permalink(get_page_by_path('home-test-transfer'))?>" target="_blank">
										<?php echo esc_html_x( 'Go to the transfer example test page', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</a>
								</p>
							<?php endif; ?>
					</div>
				</li>
			<?php endif; ?>

			<!-- == ACTIVITIES == -->
			<!-- ACTIVITIES CALENDAR -->
			<?php if ( array_key_exists('wc_activity_calendar', $onboarding_settings) && $onboarding_settings['wc_activity_calendar'] ): ?>
				<li class="mb-onboarding-component-item">
					<img class="mb-onboarding-component-item-image mb-onboarding-gallery-btn" data-type="calendar" src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL . 'admin-assets/images/calendar/calendar.png'; ?>">
					<div class="mb-onboarding-component-item-body">
						<div class="mb-onboarding-component-item-pill">
							<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</div>
						<div class="mb-onboarding-setup-item-name">
							<strong>
								<?php echo esc_html_x( 'Calendar', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</strong>
							<p>
								<?php echo esc_html_x( 'The booking calendar is shown automatically in generated pages when you activate the Detail pages option. In case you don\'t, you must create the product pages and insert calendars manually for each of them.', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</p>
							<p>
							<strong><?php echo esc_html_x( 'Paste this code where you want to show the catalog:', 'onboarding_context', 'mybooking-wp-plugin' ) ?></strong>
								<code class="mb-onboarding-shortcode">[mybooking_activities_engine_activities]</code>
							</p>
						</div>
						<div class="mb-onboarding-setup-item-buttons">
							<button data-href="[mybooking_activities_engine_activities]" title="<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>" class="mb-onboarding-btn-primary button button-primary mybooking-onboarding-get-shortcode">
								<?php echo esc_attr_x( 'Copy shortcode', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</button>
						</div>
					</div>
				</li>
			<?php endif; ?>
		</ul>

		<!-- == PAGES LINKS == -->
		<h2 class="mb-onboarding-step-title">
			<?php echo esc_html_x( '2. Complete the setup on your Mybooking account', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</h2>
		<p>
			<?php echo wp_kses_post( _x('Mybooking needs to know the URL of <b>summary</b> and <b>my reservation</b> pages in order to link to them when required. Please copy and paste the adresses below, log in into your account and set the paths.', 'onboarding_context', 'mybooking-wp-plugin' ) )?>
		</p>
		
		<ul class="mb-onboarding-list">
			<!-- RENTAL -->
			<?php if ( isset($rental_pages_list) && is_array($rental_pages_list) && count($rental_pages_list) > 0 ): ?>
				<h2>
					<?php echo esc_html_x( 'Renting', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</h2>
				<?php foreach ($rental_pages_list as $key => $id) { ?>
					<div class="mb-onboarding-setup-item">
						<span class="mb-onboarding-path">
							<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}
						</span>
						<a role="button" class="mb-onboarding-btn-primary button button-primary mybooking-onboarding-get-shortcode" 
							data-href="<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}" 
							title="<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
							<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</a>
					</div>
				<?php } ?>
			<?php endif; ?>

			<!-- ACTIVITIES -->
			<?php if ( isset($activities_pages_list) && is_array($activities_pages_list) && count($activities_pages_list) > 0 ): ?>
				<h2>
					<?php echo esc_html_x( 'Activities', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</h2>
				<?php foreach ($activities_pages_list as $key => $id) { ?>
					<div class="mb-onboarding-setup-item">
						<span class="mb-onboarding-path">
							<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}
						</span>
						<a role="button" class="mb-onboarding-btn-primary button button-primary mybooking-onboarding-get-shortcode" 
							 data-href="<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}" 
							 title="<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
							<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</a>
					</div>
				<?php } ?>
			<?php endif; ?>

			<!-- TRANSFER -->
			<?php if ( isset($transfer_pages_list) && is_array($transfer_pages_list) && count($transfer_pages_list) > 0 ): ?>
				<h2>
					<?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</h2>
				<?php foreach ($transfer_pages_list as $key => $id) { ?>
					<div class="mb-onboarding-setup-item">
						<span class="mb-onboarding-path">
							<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}
						</span>
						<a role="button" class="mb-onboarding-btn-primary button button-primary mybooking-onboarding-get-shortcode" 
							 data-href="<?php echo get_site_url(); ?>/<?php echo get_post_field('post_name', $id) ?>?id={id}" 
							 title="<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>">
							<?php echo esc_attr_x( 'Copy path', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</a>
					</div>
				<?php } ?>
			<?php endif; ?>
		</ul>

		<a class="mb-onboarding-help-link" href="https://help.mybooking.es/article/200-configuracion-de-la-direccion-de-las-paginas-de-resumen-y-mi-reserva" target="_black">
			<?php echo esc_html_x( 'How to set your engine paths', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
		<span class="mb-onboarding-separator"></span>
		<a href="<?php echo 'https://'.$clientId.'.mybooking.es/login' ?>" target="_blank" class="mb-onboarding-help-link">
			<?php echo esc_attr_x( 'Access to your account', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
		</a>
		
	<?php } else { ?>
		<p class="mb-onboarding-pages-notice">
			<?php echo esc_html_x( 'We are sorry no page could be created. Please try again and if an error occurs again, contact', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			<a href="mail:soporte@mybooking.es">
				soporte@mybooking.es
			</a>
		</p>
	<?php } ?>
</div>

<!-- Snackbar -->
<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

<!-- Gallery -->
<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
