<?php
	defined('ABSPATH') or die('Forbidden');
?>

<?php
	$plugin_dir = plugin_dir_url(__FILE__);
	$folder = $plugin_dir.'images/';
?>

<div class="mb-onboarding-gallery mb-onboarding-commons">
	<div id="mb-onboarding-close-btn" class="mb-onboarding-close-btn"></div>
	<form id="mb-onboarding-gallery-form" class="mb-onboarding-gallery-form"></form>
</div>

<!-- Scripts -->
<script>
	var galleryURLS = {
		searcher: [
			'vertical-searcher.png',
			'horizontal-searcher.png',
			'choose-product.png',
			'complete.png',
			'summary.png'
		],
		pages: [
			'calendar.png',
			'planning-calendary.png',
			'planning-diary.png',
			'shift-picker.png',
			'choose-product.png',
			'complete.png',
			'summary.png'
		]
	};
</script>
<script>
	(function($) {
		$(document).ready(function() {
			var folder = '<?php echo $folder ?>';
			var form = $('#mb-onboarding-gallery-form');
			var container = $('#mb-onboarding-gallery-container');
			form.html('<div class="mb-onboarding-loading">Loading...</div>');

			/**
			 * Events
			 */
			$('.mb-onboarding-gallery-btn').on('click', function() {
				var element = $(this);
				var section = element.attr('data-section');
				var URLS = galleryURLS[section];
				debugger;

				var HTML = '';
				URLS.forEach(url => {
					HTML +=  '<input type="radio" name="selector" id="' + url + '" />';
				});
				URLS.forEach(url => {
					HTML += '<label for="' + url + '">';
					HTML += '<img src="' + folder  + section + '/' + url + '" alt="image" />';
					HTML +=   '</label>';
				});
				form.html(HTML);

				container.show();
			});
			$('#mb-onboarding-close-btn').on('click', function() {
				container.hide();
				form.html('<div class="mb-onboarding-loading">Loading...</div>');
			});
		});
	})(jQuery);
</script>