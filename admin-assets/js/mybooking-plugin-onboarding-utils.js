(function($) {
	$(document).ready(function() {

		// Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;
		var hideTimeOut;
		function showToast(txt, type) {
			// Show toast in success
			$('.mb-onboarding-snackbar').html(txt);
			
			switch (type) {
				case 'error':
					$('.mb-onboarding-snackbar').addClass('mb-onboarding-error');
					break;
			
				default:
					break;
			}

			$('.mb-onboarding-snackbar').addClass('mb-onboarding-show');
			hideTimeOut = setTimeout(function(){ 
				$('.mb-onboarding-snackbar').removeClass('mb-onboarding-show');
			}, 3000);
		}

		// Block concealment from hideTimeOut on mouseover
		$('.mb-onboarding-snackbar').on('mouseover', function() {
			clearTimeout(hideTimeOut);
		});
		$('.mb-onboarding-snackbar').on('mouseout', function() {
			$('.mb-onboarding-snackbar').removeClass('mb-onboarding-show');
		});

		/*
		* Button events
		*/
		$('.mybooking-onboarding-get-shortcode').on('click', function(event){
			event.preventDefault();
			var shortcode = $(this).attr('data-href');

			// Add string to clipboard
			if (!navigator.clipboard) {
				showToast(_x('Your browser unsupport clipboard copy, please copy the text', 'onboarding_context_js', 'mybooking-wp-plugin'), 'error');
			}
			navigator.clipboard.writeText(shortcode).then(() => {
				showToast(_x('The shortcode ', 'onboarding_context_js', 'mybooking-wp-plugin') + shortcode +  _x( ' has been copied to the clipboard', 'onboarding_context_js', 'mybooking-wp-plugin'));
			}, (err) => {
				showToast(_x('An error has occurred' + ': ' + err, 'onboarding_context_js', 'mybooking-wp-plugin'), 'error');
			});
		});

		$('.mybooking-onboarding-get-permalink').on('click', function(event) {
			event.preventDefault();
			var url = $(this).attr('data-href');
			if (url === '') {
				const msg = _x('We are sorry, an error has occurred, check that the page exists, please', 'onboarding_context_js', 'mybooking-wp-plugin');
				showToast(msg, 'error');
			}

			// If last element is a / character remove that
			var lastElementInString = url.slice(-1);
			url = lastElementInString === '/' ? url.substring(0, url.length - 1) : url;
			
			// Add id parameter
			if (url.includes('summary') || url.includes('my-reservation')) {
				url += '?id={id}';
			}

			// Add string to clipboard
			if (!navigator.clipboard) {
				showToast(_x('Your browser unsupport clipboard copy, please copy: ' + url, 'onboarding_context_js', 'mybooking-wp-plugin'), 'error');
			}
			navigator.clipboard.writeText(url).then(() => {
				showToast(_x('The url ', 'onboarding_context_js', 'mybooking-wp-plugin') + url +  _x(' has been copied to the clipboard', 'onboarding_context_js', 'mybooking-wp-plugin'));
			}, (err) => {
				showToast(_x('An error has occurred' + ': ' + err, 'onboarding_context_js', 'mybooking-wp-plugin'), 'error');
			});
		});
	});
})(jQuery);