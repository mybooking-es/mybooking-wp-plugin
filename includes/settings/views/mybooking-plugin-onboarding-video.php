<?php
	defined('ABSPATH') or die('Forbidden');
?>

<div  id="mb-onboarding-video-container" class="mb-onboarding-video-container" style="display: none;">
	<div class="mb-onboarding-video mb-onboarding-commons">
		<div id="mb-onboarding-close-btn" class="mb-onboarding-close-btn"></div>
		<div id="mb-onboarding-video-content" class="mb-onboarding-video-content"></div>
	</div>
</div>

<!-- Scripts -->
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
	var videoURLS = {
		login: {
			url: 'https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
			title: '',
		},
		component: {
			url: 'https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
			title: '',
		}
	};
</script>
<script>
	(function($) {
		$(document).ready(function() {
			/**
			 * Video
			 */
			// Get video data
			var video = videoURLS['<?php echo $video ?>'];
			
			// Append iframe
			var HTML = '<iframe src="' + video.url + '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" title="' + video.title + '" style="position:absolute; top:0; left:0; width:100%; height:100%;"></iframe>';
			
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
</script>