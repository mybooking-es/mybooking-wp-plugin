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
				<?php echo esc_html_x( 'Componentes', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</h1>
			<p>
				<strong>
					<?php echo esc_html_x( 'A continuación te sugerimos los componentes del plugin que podrían se utiles para tu tipo de negocio', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</strong>
				<br />
				<?php echo esc_html_x( 'Entre ellos verás componentes dirigidos a la visualización de datos y otros dirigidos a iniciar el proceso de reserva', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				<br />
				<?php echo esc_html_x( 'Tomate el tiempo de ver las imagenes que ilustran el tipo de componente. Si aun tienes dudas en este', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				&nbsp;
				<a href="#">
					<?php echo esc_html_x( 'articulo', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
				</a>
				&nbsp;
				<?php echo esc_html_x( 'te explicamos todo', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</p>
			<?php if ( $module_rental || $module_transfer ): ?>
				<!-- Init components -->
				<?php if ( $module_rental ) { ?>
					<h2>
						<?php echo esc_html_x( 'Componentes para el  modulo de', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						&nbsp;
						<strong>
							<?php if ( $module_rental ) { ?><?php echo esc_html_x( 'Alquiler', 'onboarding_context', 'mybooking-wp-plugin' ) ?><?php } elseif ( $module_transfer ) { ?><?php echo esc_html_x( 'Transfer', 'onboarding_context', 'mybooking-wp-plugin' ) ?><?php } ?>
						</strong>
					</h2>
					<hr />
					<?php if ( (array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar']) || (array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning']) || (array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning']) || (array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning']) || (array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker']) ) { ?>
						<ul class="mb-onboarding-list">
							<?php if ( array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Calendario', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'Puedes añadir un calendario en la página de tu producto  para iniciar el proceso de reserva. El componente se mostrará según la configuración de tu negocio en Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
											<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Planning por horas', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'Puedes añadir un planning para ver la disponibilidad horaria en un día seleccionado. Se trata de un componente puramente informativo y se puede configurar por sucursal, familia y/o categoría de producto', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
											<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Planning por dias', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'Puedes añadir un planning que muestre la disponibilidad en un número de días preestablecido. Se trata de un componente puramente informativo y se puede configurar por sucursal, familia y/o categoría de productos', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
											<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Planning semanal', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'Puedes añadir un planning semanal con la disponibilidad a tu página de producto para iniciar el proceso de reserva', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
											<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
											&nbsp;
											<strong>
												<?php echo esc_html_x( 'Selector de turnos', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
											</strong>
										</p>
										<p>
											<?php echo esc_html_x( 'Puedes añadir un selector de turnos para iniciar el proceso de reserva. Especialmente recomendado en productos o categorías con selección de más de una unidad y con horario por turnos', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
								<?php echo esc_html_x( 'No se ha podido recuperar ningun componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
							</strong>
						</p>
					<?php } ?>
				<?php } else { ?>
					<p>
					<strong>
					<?php echo esc_html_x( 'No se ha podido recuperar ningun componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<!-- Init components -->
				<h2>
					<?php echo esc_html_x( 'Componentes para el  modulo de', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					&nbsp;
					<strong>
						<?php echo esc_html_x( 'Actividades', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
					</strong>
				</h2>
				<hr />
				<?php if (  array_key_exists('wc_activity_calendar', $onboarding_settings) &&  $onboarding_settings['wc_activity_calendar'] ) { ?>
					<ul class="mb-onboarding-list">
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									<?php echo esc_html_x( 'Componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>:
									&nbsp;
									<strong>
										<?php echo esc_html_x( 'Calendario', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
									</strong>
								</p>
								<p>
									<?php echo esc_html_x( 'Puedes añadir un calendario en la página de tu producto  para iniciar el proceso de reserva. El componente se mostrará según la configuración de tu negocio en Mybooking', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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
							<?php echo esc_html_x( 'No se ha podido recuperar ningun componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
						</strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
		<?php } else { ?>
			<?php echo esc_html_x( 'Lo lamentamos', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			&nbsp;
			<strong>
			 	<?php echo esc_html_x( 'no se ha podido recuperar ningun componente', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
			</strong>
			<?php echo esc_html_x( 'Por favor, vuelve a intentarlo y si se vuelve a producir un error contacta con', 'onboarding_context', 'mybooking-wp-plugin' ) ?>
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