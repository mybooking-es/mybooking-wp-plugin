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
		$('.mybooking-onboarding-get-shortcode').on('click', function(event){
			event.preventDefault();
			var shortcode = $(this).attr('data-href');

			// Add string to clipboard
			navigator.clipboard.writeText(shortcode);
			
			showToast('El shortcode: "' + shortcode + '" se ha copiado en el portapapeles');
		});

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
			if (url.includes('summary') || url.includes('my-reservation')) {
				url += '?id={id}';
			}

			// Add string to clipboard
			navigator.clipboard.writeText(url);
			
			showToast('El url: "' + url + '" se ha copiado en el portapapeles');
		});
	});
})(jQuery);