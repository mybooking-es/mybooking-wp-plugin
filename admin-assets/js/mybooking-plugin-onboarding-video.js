(function($) {
	// Data TODO
	var videoURLS = {
		login: {
			url: 'https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
			title: '',
		}
	};

	$(document).ready(function() {
		/**
		 * Video
		 */
		// Get video data
		var videoData = $('#mb-onboarding-video-container').attr('data-video');
		var video = videoURLS[videoData];
		var HTML = '';

		if (video && video instanceof Object) {
			// Append iframe
			HTML = '<iframe src="' + video.url + '" frameborder="0" allowfullscreen title="' + video.title + '"></iframe>';
		}
		
		
		/**
		 * Buttons events
		 */
		$('.mb-onboarding-video-link').on('click', function(event) {
			event.preventDefault();

			// Append video
			$('#mb-onboarding-video-content').html(HTML);

			$('#mb-onboarding-video-container').show();
		});

		$('#mb-onboarding-close-btn').on('click', function(event) {
			event.preventDefault();
			
			// Remove video
			$('#mb-onboarding-video-content').html('');

			$('#mb-onboarding-video-container').hide();
		});
	});
})(jQuery);