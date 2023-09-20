(function($) {
	$(document).ready(function() {

		// Wp i18n integration
    const { __, _x, _n, sprintf } = wp.i18n;
		
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
			
			showToast(_x('El shortcode', 'onboarding_context_js', 'mybooking-wp-plugin') + ': ' + shortcode + +  _x(' se ha copiado en el portapapeles', 'onboarding_context_js', 'mybooking-wp-plugin'));
		});

		$('.mybooking-onboarding-get-permalink').on('click', function(event) {
			event.preventDefault();
			var url = $(this).attr('data-href');
			if (url === '') {
				const msg = _x('Lo lamentamos se ha producido un error, revisa que la página existe, por favor', 'onboarding_context_js', 'mybooking-wp-plugin');
				showToast(msg);
			}

			// If last element is a / character remove that
			var lastElementInString = url.slice(-1);
			url = lastElementInString === '/' ? url.substring(0, url.length - 1) : url;
			
			// Add id parameter
			if (url.includes('summary') || url.includes('my-reservation')) {
				url += '?id={id}';
			}

			// Add string to clipboard
			navigator.clipboard.writeText(url);
			
			showToast(_x('El url', 'onboarding_context_js', 'mybooking-wp-plugin') + url +  _x(' se ha copiado en el portapapeles', 'onboarding_context_js', 'mybooking-wp-plugin'));
		});
	});
})(jQuery);