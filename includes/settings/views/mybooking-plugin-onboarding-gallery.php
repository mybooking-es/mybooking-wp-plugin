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
		'mybooking_plugin_settings_home_test_page': [
			'vertical-selector.png',
		],
		'mybooking_plugin_settings_choose_products_page': [
			'search-result.png',
		],
		'mybooking_plugin_settings_checkout_page': [
			'checkout.png',
		],
		'mybooking_plugin_settings_summary_page': [
			'summary.png'
		],
		'rmybooking_plugin_settings_my_reservation_page': [
			'my-reservation.png'
		],
		'mybooking_plugin_settings_activities_shopping_cart_page': [
			'checkout.png',
		],
		'mybooking_plugin_settings_activities_summary_page': [
			'summary.png'
		],
		'mybooking_plugin_settings_my_reservation_page': [
			'my-reservation.png'
		],
		'mybooking_plugin_settings_home_test_page': [
			'vertical-selector.png',
		],
		'mybooking_plugin_settings_transfer_choose_vehicle_page': [
			'choose-vehicle.png',
		],
		'mybooking_plugin_settings_transfer_checkout_page': [
			'checkout.png',
		],
		'mybooking_plugin_settings_transfer_summary_page': [
			'summary.png'
		],
		'mybooking_plugin_settings_my_reservation_page': [
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
				var module = element.attr('data-module');
				var URLS = galleryURLS[type];

				var HTML = '';
				URLS.forEach(url => {
					HTML +=  '<input type="radio" name="selector" id="' + url + '" />';
				});
				URLS.forEach(url => {
					HTML += '<label for="' + url + '">';
					if (module) {
						HTML += '<img src="' + folder  + module + '/' + type + '/' + url + '" alt="image" />';
					} else {
						HTML += '<img src="' + folder  + type + '/' + url + '" alt="image" />';
					}
					
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