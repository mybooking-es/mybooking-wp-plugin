<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_resume_page() {
	?>
	<!-- Styles -->
	<?php
		$plugin_dir = plugin_dir_url(__FILE__);

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
				if (str_contains($key, 'home')) {
					$home_page_id = $value;
				}

				// Sort the pages
				ksort($pages_ids);
			}
		}
	?>
	<link rel="stylesheet" href="<?php echo $plugin_dir ?>styles/mybooking-plugin-onboarding.css">
	
	<div class="mb-onboarding-resume mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1 class="mb-onboarding-row">
			<span class="mb-onboarding-icon dashicons dashicons-saved"></span>
			&nbsp;&nbsp;
			Configuración finalizada con exito
		</h1>
		<h2>
			A continuación puedes ver las páginas de prueba que se han creado con los contenidos que has seleccionado y configurado.
		</h2>
		<?php if ( $module_rental || $module_transfer ): ?>
			<br />
			<h5>
				Modulo: <?php if ( $module_rental ) { ?>Alquiler<?php } elseif ( $module_transfer ) { ?>Transfer<?php } ?>
			</h5>
			<ul class="mb-onboarding-list">
				<?php foreach ($pages_ids as $key => $id) { ?>
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
										<span class="mb-onboarding-icon dashicons dashicons-visibility"></span>
									</a>
								<?php } ?>
								<div data-href="<?php echo get_permalink( $id ) ?>" title="Copy page link for mybooking web configuration" class="mb-onboarding-row-link mybooking-onboarding-get-permalink">
									<span class="mb-onboarding-icon dashicons dashicons-admin-page"></span>
								</div>
								<a href="<?php echo get_edit_post_link( $id ) ?>" title="Edit page" target="_blank" class="mb-onboarding-row-link">
									<span class="mb-onboarding-icon dashicons dashicons-edit"></span>
								</a>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
			<p>
				<strong>Recuerda seleccionar la homepage de prueba como página de inicio en Wordpress y añadir los url de la página de resumen y de mi reserva a la configuración de Mybooking en <i>"Guía de configuración > Web > Conexión con la página web"</i> para completar la configuración</strong>.
			</p>
		<?php endif; ?>
		<?php if ( $module_activities ): ?>
			<br />
			<h5>
				Modulo: Actividades
			</h5>
			<ul class="mb-onboarding-list">
				<?php foreach ($pages_ids as $key => $id) { ?>
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
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
			<p>
				<strong>Recuerda añadir los url de la página de resumen y de mi reserva a la configuración de Mybooking en <i>"Guía de configuración > Web > Conexión con la página web"</i> para completar la configuración</strong>.
			</p>
		<?php endif; ?>
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
	<div id="mb-onboarding-snackbar" class="mb-onboarding-snackbar"></div>
<?php
}

mybooking_plugin_onboarding_resume_page();
?>