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
									<span data-type="<?php echo $post->post_name ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
				<?php if ( !$home_page_id && array_key_exists('wc_rent_selector', $onboarding_settings) &&  $onboarding_settings['wc_rent_selector'] ) { ?>
					<p>
						<strong>Tienes una configuración que no nos permite conocer desde que tipo de componente quieres iniciciar el proceso de reserva. </strong>
						<br />
						Te proponemos un <strong>buscador</strong>, sin embargo alternativamente puedes usar otros componentes que podrás visualizar <a href="/wp-admin/admin.php?page=mybooking-onboarding-components">aquí</a>. <!-- TODO -->
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
									<span data-type="<?php echo $post->post_name ?>" class="mb-onboarding-gallery-btn mb-onboarding-row-link mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>

				<p>
					<strong>Tienes una configuración que no nos permite conocer desde que tipo de componente quieres iniciciar el proceso de reserva. </strong>
					<br />
					Te proponemos un <strong>catálogo de productos</strong>, sin embargo alternativamente puedes usar otros componentes que puedes visualizar <a href="/wp-admin/admin.php?page=mybooking-onboarding-components">aquí</a>.<!-- TODO -->
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

	<!-- Scripts -->
	<script>
		(function($) {
			$(document).ready(function() {
				function showToast(txt) {
					// Show toast in success
					$('.mb-onboarding-snackbar').html(txt);
					$('.mb-onboarding-snackbar').addClass('mb-onboarding-show');
					setTimeout(function(){ 
						$('.mb-onboarding-snackbar').removeClass('mb-onboarding-show');
					}, 3000);
				}

				/*
				* Button events
				*/
				$('.mybooking-onboarding-get-shortcode').on('click', function(event){
					event.preventDefault();
					var shortcode = $(this).attr('data-href');

					// Add string to clipboard
					navigator.clipboard.writeText(shortcode);
					
					showToast('El shortcode: "' + shortcode + '" se ha copiado en el portapapeles');
				});

				$('.mybooking-onboarding-get-permalink').on('click', function(event) {
					event.preventDefault();
					var url = $(this).attr('data-href');
					if (url === '') {
						showToast('Lo lamentamos se ha producido un error, revisa que la página existe, por favor.');
					}

					// If last element is a / character remove that
					var lastElementInString = url.slice(-1);
					url = lastElementInString === '/' ? url.substring(0, url.length - 1) : url;
					// Add id parameter
					url += '?id={id}';

					// Add string to clipboard
					navigator.clipboard.writeText(url);
					
					showToast('El url: "' + url + '" se ha copiado en el portapapeles');
				});
			});
		})(jQuery);
	</script>

	<!-- Snackbar -->
	<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>

	<!-- Gallery -->
	<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
<?php
}

mybooking_plugin_onboarding_pages_page();
?>