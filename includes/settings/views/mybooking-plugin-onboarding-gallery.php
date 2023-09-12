<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
	$plugin_dir = plugin_dir_url(__FILE__);
	$folder = $plugin_dir.'images/';
?>

<div  id="mb-onboarding-gallery-container" class="mb-onboarding-gallery-container" style="display: none">
	<div class="mb-onboarding-gallery mb-onboarding-commons">
		<div id="mb-onboarding-close-btn" class="mb-onboarding-close-btn"></div>
		<form id="mb-onboarding-gallery-form" class="mb-onboarding-gallery-form"></form>
	</div>
</div>

<!-- Scripts -->
<script>
	var galleryURLS = {
		'home-test': [
			'vertical-selector.png',
		],
		'search-result': [
			'search-result.png',
		],
		'checkout': [
			'checkout.png',
		],
		'summary': [
			'summary.png'
		],
		'my-reservation': [
			'my-reservation.png'
		],
		'selector': [
			'vertical-selector.png',
			'horizontal-selector.png'
		],
		'catalog': [
			'catalog.png'
		],
		'calendar': [
			'calendar.png',
		],
		'planning-diary': [
			'planning-diary.png'
		],
		'planning-calendar': [
			'planning-calendar.png'
		],
		'planning-weekly': [
			'planning-weekly.png'
		],
		'shift-picker': [
			'shift-picker.png'
		],
	};
</script>
<script>
	(function($) {
		$(document).ready(function() {
			/**
			 * Gallery
			 */
			// Get gallery data
			var folder = '<?php echo $folder ?>';

			// Append loading
			var form = $('#mb-onboarding-gallery-form');
			form.html('<div class="mb-onboarding-loading">Loading...</div>');

			/**
			 * Buttons events
			 */
			var container = $('#mb-onboarding-gallery-container');
			$('.mb-onboarding-list').on('click', '.mb-onboarding-gallery-btn', function() {
				var element = $(this);
				var type = element.attr('data-type');
				var URLS = galleryURLS[type];

				var HTML = '';
				URLS.forEach(url => {
					HTML +=  '<input type="radio" name="selector" id="' + url + '" />';
				});
				URLS.forEach(url => {
					HTML += '<label for="' + url + '">';
					HTML += '<img src="' + folder  + type + '/' + url + '" alt="image" />';
					HTML +=   '</label>';
				});
				// Append video
				form.html(HTML);

				container.show();
			});
			$('#mb-onboarding-close-btn').on('click', function() {
				container.hide();
				// Append loading
				form.html('<div class="mb-onboarding-loading">Loading...</div>');
			});
		});
	})(jQuery);
</script>