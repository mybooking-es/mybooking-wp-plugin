<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
	$plugin_dir = plugin_dir_url(__FILE__);
	$folder = $plugin_dir.'images/'.$section.'/';
?>

<div class="wrap mb-onboarding-gallery">
	<div id="mb-onboarding-close-btn" class="mb-onboarding-close-btn">x</div>
	<div id="mb-onboarding-gallery-carrousel" class="mb-onboarding-gallery-carrousel"></div>
	<ul id="mb-onboarding-gallery-options" class="mb-onboarding-gallery-options" ></ul>
</div>

<!-- Scripts -->
<script>
	var galleryURLS = {
		login: [
			'buscador-vertical.png',
		],
		searcher: [
			'buscador-vertical.png',
			'buscador-horizontal.png',
			'completar.png',
			'resultados.png',
			'resumen.png'
		]
	};
</script>
<script>
	(function($) {
		$(document).ready(function() {
			var folder = '<?php echo $folder ?>';
			var URLS = galleryURLS['<?php echo $section ?>'];

			var container = $('#mb-onboarding-gallery-carrousel');
			URLS.forEach(url => {
				container.append('<img src="' + folder + url + '" alt="' + url + '" />');
			});

			/**
			 * Events
			 */
			$('#mb-onboarding-close-btn').on('click', function() {
				$('#mb-onboarding-gallery-container').hide();
			});
		});
	})(jQuery);
</script>