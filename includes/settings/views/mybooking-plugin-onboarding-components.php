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
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<?php if ( isset($components_ids) ) { ?>
			<h1>
				Componentes
			</h1>
			<p>
				<strong>A continuación te sugerimos los componentes del plugin que podrían se utiles para tu tipo de negocio.</strong>
				<br />
				Entre ellos verás componentes dirigidos a la visualización de datos y otros dirigidos a iniciar el proceso de reserva. 
				<br />
				Tomate el tiempo de ver las imagenes que ilustran el tipo de componente. Si aun tienes dudas en este <a href="">articulo</a> te explicamos todo.
			</p>
			<?php if ( $module_rental || $module_transfer ): ?>
				<!-- Init components -->
				<?php if ( $module_rental ) { ?>
					<h2>
						Componentes para el  modulo de <strong><?php if ( $module_rental ) { ?>Alquiler<?php } elseif ( $module_transfer ) { ?>Transfer<?php } ?></strong>
					</h2>
					<hr />
					<?php if ( (array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar']) || (array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning']) || (array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning']) || (array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning']) || (array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker']) ) { ?>
						<ul class="mb-onboarding-list">
							<?php if ( array_key_exists('wc_rent_calendar', $onboarding_settings) &&  $onboarding_settings['wc_rent_calendar'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											Componente:
											&nbsp;
											<strong>
												Calendario
											</strong>
										</p>
										<p>
											Puedes añadir un calendario en la página de tu producto  para iniciar el proceso de reserva. El componente se mostrará según la configuración de tu negocio en Mybooking.
										</p>
										<div class="mb-onboarding-row">
											<span data-type="calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_daily_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_daily_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											Componente:
											&nbsp;
											<strong>
												Planning por horas
											</strong>
										</p>
										<p>
											Puedes añadir un planning para ver la disponibilidad horaria en un día seleccionado. Se trata de un componente puramente informativo y se puede configurar por sucursal, familia y/o categoría de producto.
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-diary" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_monthly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_monthly_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											Componente:
											&nbsp;
											<strong>
												Planning por dias
											</strong>
										</p>
										<p>
											Puedes añadir un planning que muestre la disponibilidad en un número de días preestablecido. Se trata de un componente puramente informativo y se puede configurar por sucursal, familia y/o categoría de productos.
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_weekly_planning', $onboarding_settings) &&  $onboarding_settings['wc_rent_weekly_planning'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											Componente:
											&nbsp;
											<strong>
												Planning semanal.
											</strong>
										</p>
										<p>
											Puedes añadir un planning semanal con la disponibilidad a tu página de producto para iniciar el proceso de reserva. 
										</p>
										<div class="mb-onboarding-row">
											<span data-type="planning-weekly" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
										</div>
									</div>
								</li>
							<?php } ?>
							<?php if ( array_key_exists('wc_rent_shift_picker', $onboarding_settings) &&  $onboarding_settings['wc_rent_shift_picker'] ) { ?>
								<li>
									<div class="mb-onboarding-row mb-onboarding-space-between">
										<p>
											Componente:
											&nbsp;
											<strong>
												Selector de turnos
											</strong>
										</p>
										<p>
											Puedes añadir un selector de turnos para iniciar el proceso de reserva. Especialmente recomendado en productos o categorías con selección de más de una unidad y con horario por turnos.
										</p>
										<div class="mb-onboarding-row">
											<span data-type="shift-picker" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
										</div>
									</div>
								</li>
							<?php } ?>
						</ul>
					<?php } else { ?>
						<p>
							<strong>No se ha podido recuperar ningun componente.</strong>
						</p>
					<?php } ?>
				<?php } else { ?>
					<p>
					<strong>No se ha podido recuperar ningun componente. </strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<!-- Init components -->
				<h2>
					Componentes para el  modulo de <strong>Actividades</strong>
				</h2>
				<hr />
				<?php if (  array_key_exists('wc_activity_calendar', $onboarding_settings) &&  $onboarding_settings['wc_activity_calendar'] ) { ?>
					<ul class="mb-onboarding-list">
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									Componente:
									&nbsp;
									<strong>
										Calendario
									</strong>
								</p>
								<p>
									Puedes añadir un calendario en la página de tu producto  para iniciar el proceso de reserva. El componente se mostrará según la configuración de tu negocio en Mybooking.
								</p>
								<div class="mb-onboarding-row">
									<span data-type="calendar" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					</ul>
				<?php } else { ?>
					<p>
						<strong>No se ha podido recuperar ningun componente. </strong>
					</p>
				<?php } ?>
				<!-- End components -->
			<?php endif; ?>
		<?php } else { ?>
			Lo lamentamos <strong>no se ha podido recuperar ningun componente</strong>. Por favor, vuelve a intentarlo y si se vuelve a producir un error contacta con <a href="mail:soporte@mybooking.es">soporte@mybooking.es</a>.
		<?php } ?>
	</div>

	<!-- Scripts -->

	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php
}

mybooking_plugin_onboarding_components_page();
?>