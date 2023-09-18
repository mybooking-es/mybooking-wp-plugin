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
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<?php if ( isset($pages_ids) ) { ?>
			<?php if ( $module_rental || $module_transfer ): ?>
				<h2>
					Páginas del proceso de reserva para el modulo de <strong><?php if ( $module_rental ) { ?>Alquiler<?php } elseif ( $module_transfer ) { ?>Transfer<?php } ?></strong>
				</h2>
				<hr />
				<ul class="mb-onboarding-list">
					<?php foreach ($pages_ids as $key => $id) { ?>
						<?php $post = get_post($id) ?>
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									Página:
									&nbsp;
									<strong><?php echo get_the_title( $id ) ?></strong>
									<?php if ($home_page_id === $id) { ?>
										(recuerda que el proceso de reserva se inicia desde aquí)
									<?php } ?>
								</p>
								<div class="mb-onboarding-row">
									<?php if ($home_page_id === $id) { ?>
										<a href="<?php echo get_permalink( $id ) ?>" title="Show page" target="_blank" class="mb-onboarding-row-link">
											<span class="mb-onboarding-icon dashicons dashicons-external"></span>
										</a>
									<?php } ?>
									<div data-href="<?php echo get_permalink( $id ) ?>" title="Copy page link for mybooking web configuration" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="Edit page" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<?php $type = array_search($id, $settings) ?>
									<?php $module = ($module_rental) ? 'mybooking_plugin_settings_renting' : 'mybooking_plugin_settings_transfer' ?>
									<span data-type="<?php echo $type ?>" data-module="<?php echo $module ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
				<?php if ( !$home_page_id && array_key_exists('wc_rent_selector', $onboarding_settings) &&  $onboarding_settings['wc_rent_selector'] ) { ?>
					<p>
						<strong>Tienes una configuración que no nos permite conocer desde que tipo de componente quieres iniciciar el proceso de reserva. </strong>
						<br />
						Te proponemos un <strong>buscador</strong>, sin embargo alternativamente puedes usar otros componentes que podrás visualizar <a href="<?php esc_attr(menu_page_url('mybooking-onboarding-components'))?>">aquí</a>.
					</p>
					<ul class="mb-onboarding-list">
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									Componente:
									&nbsp;
									<strong>
										Buscador
									</strong>
								</p>
								<div class="mb-onboarding-row">
									<div data-href="[mybooking_rent_engine_selector]" title="Copy shortcode" class="mb-onboarding-row-link mybooking-onboarding-get-shortcode">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
									<span data-type="selector" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					</ul>
				<?php } ?>
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<h2>
					Páginas del proceso de reserva para el modulo de <strong>Actividades</strong>
				</h2>
				<hr />
				<ul class="mb-onboarding-list">
					<?php foreach ($pages_ids as $key => $id) { ?>
						<?php $post = get_post($id) ?>
						<li>
							<div class="mb-onboarding-row mb-onboarding-space-between">
								<p>
									Página:
									&nbsp;
									<strong><?php echo get_the_title( $id ) ?></strong>
								</p>
								<div class="mb-onboarding-row">
									<div data-href="<?php echo get_permalink( $id ) ?>" title="Copy page link for mybooking web configuration" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
										<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
									</div>
									<a href="<?php echo get_edit_post_link( $id ) ?>" title="Edit page" target="_blank" class="mb-onboarding-row-link">
										<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
									</a>
									<?php $type = array_search($id, $settings) ?>
									<?php $module = ($module_activities) ? 'mybooking_plugin_settings_activities' : '' ?>
									<span data-type="<?php echo $type ?>" data-module="<?php echo $module ?>"class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>

				<p>
					<strong>Tienes una configuración que no nos permite conocer desde que tipo de componente quieres iniciciar el proceso de reserva. </strong>
					<br />
					Te proponemos un <strong>catálogo de productos</strong>, sin embargo alternativamente puedes usar otros componentes que puedes visualizar <a href="<?php esc_attr(menu_page_url('mybooking-onboarding-components'))?>">aquí</a>.
				</p>
				<ul class="mb-onboarding-list">
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Componente:
								&nbsp;
								<strong>
									Catálogo de productos
								</strong>
							</p>
							<div class="mb-onboarding-row">
								<div data-href="[mybooking_activities_engine_activities]" title="Copy shortcode" class="mb-onboarding-row-link mybooking-onboarding-get-shortcode">
									<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
								</div>
								<span data-type="catalog" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
							</div>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			<hr />
			<p>
				<strong>Recuerda seleccionar la homepage de prueba o inserir un componente de inicio para el proceso de reserva en Wordpress y añadir los url de la página de resumen y de mi reserva a la configuración de Mybooking en <i>"Guía de configuración > Web > Conexión con la página web"</i> para completar la configuración</strong>. Si tienes dudas puedes consultar el siguiente <a href="">articulo</a> donde te explicamos todo.
			</p>
		<?php } else { ?>
			Lo lamentamos no se ha podido crear ninguna página. Por favor, vuelve a intentarlo y si se vuelve a producir un error contacta con <a href="mail:soporte@mybooking.es">soporte@mybooking.es</a>.
		<?php } ?>
	</div>

	<!-- Snackbar -->
	<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>

	<!-- Script -->
	<script src="<?php echo MYBOOKING_RESERVATION_ENGINE_PLUGIN_URL.'admin-assets/js/mybooking-plugin-onboarding-pages.js' ?>"></script>
<?php
}

mybooking_plugin_onboarding_pages_page();
?>