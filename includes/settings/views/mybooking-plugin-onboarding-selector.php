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
	?>
	<link rel="stylesheet" href="<?php echo $plugin_dir ?>styles/mybooking-plugin-onboarding.css">
	
	<div class="mb-onboarding-selector mb-onboarding-commons">
		<div id="mb-onboarding-loading" class="mb-onboarding-loading" style="display: none;">Loading...</div>
		<h1>
			Tipo de negocio: Alquiler de vehículos
		</h1>
		<h2>
			Por favor, selecciona la opción que se ajusta mejor a tus necesidades.
		</h2>
		<ul class="mb-onboarding-list">
			<li class="mb-onboarding-row mb-onboarding-space-between">
				<span>
					<strong>Quiero un buscador en la página de inicio</strong> donde se puedan seleccionar las fechas de entrega y devolución y me devuelva un listado de productos con precio y disponibilidad.
				</span>
				<span data-section="searcher" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
				<input type="radio" name="selector" value="1" class="mb-onboarding-check" title="Select" />
			</li>
			<li class="mb-onboarding-row mb-onboarding-space-between">
				<span>
				<strong>Tengo las páginas de los productos y quiero añadir un calendario o similar</strong> para mostrar disponibilidad y hacer la reserva desde cada una de ellas.
				</span>
				<span data-section="pages" class="mb-onboarding-gallery-btn mb-onboarding-icon dashicons dashicons-visibility" title="Show gallery"></span>
				<input type="radio" name="selector" value="2" class="mb-onboarding-check" title="Select" />
			</li>
		</ul>

		<div  id="mb-onboarding-gallery-container" class="mb-onboarding-gallery-container" style="display: none">
			<?php require_once ('mybooking-plugin-onboarding-gallery.php') ?>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		(function($) {
			$(document).ready(function() {
				/*
				* Events
				*/
			});
		})(jQuery)
	</script>
<?php
}

mybooking_plugin_onboarding_selector_page();
?>