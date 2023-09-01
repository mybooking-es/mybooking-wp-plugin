<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* https://developer.wordpress.org/reference/functions/do_settings_fields/
*/
function mybooking_plugin_onboarding_selector_page() {
	?>
	<!-- Styles -->
	<?php
		$plugin_dir = plugin_dir_url(__FILE__);
		
		$onboarding_settings = (array) get_option('mybooking_plugin_onboarding_business_info');

		if ( $onboarding_settings ) {
			$trade_name = $family_name = '';
			if (array_key_exists('trade_name', $onboarding_settings)) {
				$trade_name = $onboarding_settings["trade_name"];
	    }
	    if (array_key_exists('booking_item_family_name', $onboarding_settings)) {
				$family_name = $onboarding_settings["booking_item_family_name"];
	    }

	    $module_rental = $module_activities = $module_transfer = false;
	    if (array_key_exists('module_rental', $onboarding_settings)) {
				$module_rental = $onboarding_settings["module_rental"];
	    }
	    
	    if ( $module_rental ) {
				$wc_rent_selector = false;
		    if (array_key_exists('wc_rent_selector', $onboarding_settings)) {
					$wc_rent_selector = $onboarding_settings["wc_rent_selector"];
		    }
				$wc_rent_calendar = $wc_rent_shift_picker = $wc_rent_weekly_planning = false;
				if (array_key_exists('wc_rent_calendar', $onboarding_settings)) {
					$wc_rent_calendar = $onboarding_settings["wc_rent_calendar"];
		    }
				if (array_key_exists('wc_rent_shift_picker', $onboarding_settings)) {
					$wc_rent_shift_picker = $onboarding_settings["wc_rent_shift_picker"];
		    }
				if (array_key_exists('wc_rent_weekly_planning', $onboarding_settings)) {
					$wc_rent_weekly_planning = $onboarding_settings["wc_rent_weekly_planning"];
		    }
	    }

			if (array_key_exists('module_activities', $onboarding_settings)) {
				$module_activities = $onboarding_settings["module_activities"];
	    }

			if ( $module_activities ) {
				$wc_activity_calendar = false;
				if (array_key_exists('wc_activity_calendar', $onboarding_settings)) {
					$wc_activity_calendar = $onboarding_settings["wc_activity_calendar"];
		    }
	    }

			if (array_key_exists('module_transfer', $onboarding_settings)) {
				$module_transfer = $onboarding_settings["module_transfer"];
	    }

			if ( $module_transfer ) {
				$wc_transfer_selector = false;
				if (array_key_exists('wc_transfer_selector', $onboarding_settings)) {
					$wc_transfer_selector = $onboarding_settings["wc_transfer_selector"];
				}
			}
		}
		else {
			wp_redirect('mybooking-plugin-onboarding-welcome.php');
			exit;
		}

	?>
	<link rel="stylesheet" href="<?php echo $plugin_dir ?>styles/mybooking-plugin-onboarding.css">
	
	<div class="mb-onboarding-selector mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1>
			Tipo de negocio: <strong><?php esc_html_e($family_name) ?></strong>
		</h1>
		<h2>
			Bienvenido <strong><?php esc_html_e($trade_name) ?></strong>.
		</h2>
		<p>
			Para configurar el plugin <strong>vamos a comenzar utilizando la configuración actual de Mybooking de manera que con unos pocos pasos puedas empezar a utilizar tu motor de reserva.</strong>. 
		</p>
		<form  id="mb-onboarding-selector-form" method="POST">
			<?php if ( $module_rental ): ?>
				<br />
				<h5>
					Modulo activo: Alquiler
				</h5>
				<ul class="mb-onboarding-list">
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Vamos a crear las páginas necesarias para el proceso de reserva y vamos a crear una página de inicio con un buscador desde donde podrás seleccionar las fechas de recogida y devolución.
								<br/>
								<small>
									Puedes visualizar un ejemplo de la estructura de la navegación clicando sobre el icono
								</small>
							</p>
							<span data-type="selector" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
						</div>
					</li>
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Alternativamente tienes la posibilidad de utilizar otros componentes para iniciar la reserva que tambien te mostraremos al finalizar el proceso.
								<br/>
								<small>
									Puedes visualizar un ejemplo de estos componentes  clicando sobre el icono
								</small>
							</p>
							<span data-type="page" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			<?php if ( $module_activities ): ?>
				<br />
				<h5>
					Modulo activo: Actividades
				</h5>
				<ul class="mb-onboarding-list">
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Vamos a crear las páginas necesarias para el proceso de reserva sin embargo por la configuración de este modulo te vamos a aconsejar iniciar el proceso desde un catalogo de productos u otros componentes que te mostraremos a continuación.
								<br/>
								<small>
									Puedes visualizar un ejemplo de la estructura de la navegación clicando sobre el icono
								</small>
							</p>
							<span data-type="page" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			<?php if ( $module_transfer ): ?>
				<br />
				<h5>
					Modulo activo: Transfer
				</h5>
				<ul class="mb-onboarding-list">
					<li>
						<div class="mb-onboarding-row mb-onboarding-space-between">
							<p>
								Vamos a crear las páginas necesarias para el proceso de reserva y vamos a crear una página de inicio con un buscador desde donde podrás seleccionar las fechas de recogida y devolución.
								<br/>
								<small>
									Puedes visualizar un ejemplo de la estructura de la navegación clicando sobre el icono
								</small>
							</p>
							<span data-type="selector" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			<div class="mb-onboarding-row mb-onborading-pull-right">
				<input type="submit" value="Generar" />
			</div>
		</form>

		<div  id="mb-onboarding-gallery-container" class="mb-onboarding-gallery-container" style="display: none">
			<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		(function($) {
			$(document).ready(function() {
				/*
				* Form validation
				*/
				$('#mb-onboarding-selector-form').validate({
						submitHandler: function(form) {
							var url = '/wp-json/api/v1/setupOnboarding';
							var params = $(form).formParams();
							var data = JSON.stringify(params);

							// Request  
							$.ajax({
								type: 'POST',
								url,
								data,
								dataType : 'json',
								contentType : 'application/json; charset=utf-8',
								crossDomain: false,
								success: (data, textStatus, jqXHR) => {
									window.location.search = '?page=mybooking-onboarding-resume'; // TODO safe
								},
								error: function(err) {
									window.location.search = '?page=mybooking-onboarding-error'; // TODO safe
									// alert('Por favor, revisa los datos proporcionados se ha producido un error.'); // TODO
								},
								beforeSend: function() {
									$('#mb-onboarding-loading').show();
								},        
								complete: function() {
									$('#mb-onboarding-loading').hide();
								}
							});
							
							return false;
						},
						errorClass: 'error',
						rules : {
							'selector': 'required',
						},
						messages: {
							'selector': 'Es requerido', // TODO
						},
					}
        );
			});
		})(jQuery)
	</script>
<?php
}

mybooking_plugin_onboarding_selector_page();
?>