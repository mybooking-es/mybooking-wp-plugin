<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
/**
* Render Mybooking onboarding page
*
* config: On boarding configuration data
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
	        $wc_rent_selector = false;
	        if ( $module_rental ) {
		        if (array_key_exists('wc_rent_selector', $onboarding_settings)) {
					$wc_rent_selector = $onboarding_settings["wc_rent_selector"];
		        }
	        }
	        $wc_rent_calendar = $wc_rent_shift_picker = $wc_rent_weekly_planning = false;
	        if ( $module_rental ) {
		        if (array_key_exists('wc_rent_calendar', $onboarding_settings)) {
					$wc_rent_calendar = $onboarding_settings["wc_rent_calendar"];
		        }
	        }	        
			if (array_key_exists('module_activities', $onboarding_settings)) {
				$module_activities = $onboarding_settings["module_activities"];
	        }
			if (array_key_exists('module_transfer', $onboarding_settings)) {
				$module_transfer = $onboarding_settings["module_transfer"];
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
			Tipo de negocio: <span id="mb-onboarding-bussiness-type"><?php esc_html_e($family_name) ?></span>
		</h1>
		<h2>
			Bienvenido <strong id="mb-onboarding-client-name"><?php esc_html_e($trade_name) ?></strong>.
		</h2>
		<h6>
			Por favor, selecciona la opción que se ajusta mejor a tus necesidades.
		</h6>
		<form  id="mb-onboarding-selector-form" method="POST">
			<ul id="mb-onboarding-list" class="mb-onboarding-list">
				<?php if ( $module_rental ): ?>
					<?php if ( $wc_rent_selector ): ?>
						<li><strong>Quiero un buscador en la página de inicio</strong> donde se puedan seleccionar las fechas de entrega y devolución y me devuelva un listado de productos con precio y disponibilidad.</li>
					<?php endif; ?>
					<?php if ( $wc_rent_calendar || $wc_rent_shift_picker || $wc_rent_weekly_planning ): ?>
						<li><strong>Tengo las páginas de los productos y quiero añadir un calendario o similar</strong> para mostrar disponibilidad y hacer la reserva desde cada una de ellas.
						</li>
					<?php endif; ?>					
				<?php endif; ?>	

			</ul>
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
		var OPTIONS = [
			{
				text: "<strong>Quiero un buscador en la página de inicio</strong> donde se puedan seleccionar las fechas de entrega y devolución y me devuelva un listado de productos con precio y disponibilidad.", // TODO i18n
				components: [
					"wc_rent_selector",
				],
				type: "selector",
			},
			{
				text: "<strong>Tengo las páginas de los productos y quiero añadir un calendario o similar</strong> para mostrar disponibilidad y hacer la reserva desde cada una de ellas.",
				components: [
					"wc_rent_calendar",
					"wc_rent_daily_planning",
					"wc_rent_monthly_planning",
					"wc_rent_monthly_planning",
					"wc_rent_weekly_planning",
					"wc_rent_shift_picker",
				],
				type: "page"
			},
		];
	</script>
	<script>
		(function($) {
			$(document).ready(function() {
				/*
				* Get data from URL
				*/
				var query = window.location.search.substring(1);
				var data = getDataFromQueryString(query);

				function getDataFromQueryString (str) {
						var params = str.split('&');
						var obj = {};
						params.forEach(e=>{
							var param = e.split('=');
								obj[param[0]] = decodeURIComponent(param[1]);
						});
						return obj;
				}

				/*
				* Append data
				*/
				// Append titles
				//$('#mb-onboarding-bussiness-type').html(data.booking_item_family_name);
				//$('#mb-onboarding-client-name').html(data.trade_name);

/*
				// Append list
				var HTML = '';
				OPTIONS.forEach(option => {
					HTML += '<li>';
					HTML += '<div class="mb-onboarding-row mb-onboarding-space-between';
					if (option.components['wc_rent_selector']) {
						HTML += ' mb-onboarding-higthlight'; // TODO
					}
					HTML += '"><p>' + option.text + '</p>';
					HTML += '<span data-type="' + option.type + '" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>';
					HTML += '<input type="radio" name="selector" value="' + option.type + '" class="mb-onboarding-check" title="Select" />';
					HTML += '</div>';
					HTML += option.components['wc_rent_selector'] ? '<small style="position: relative; top: -1rem;"><i>Es la opción que aconsejamos para tu tipo de producto.</i></small>' : ''; // TODO
					HTML += '</li>';
				});
				$('#mb-onboarding-list').html(HTML);
*/
				/*
				* Form validation
				*/
				$('#mb-onboarding-selector-form').validate({
						submitHandler: function(form) {
							// TODO
							
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