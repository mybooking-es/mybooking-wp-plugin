<?php
	defined('ABSPATH') or die('Forbidden');
?>

<div id="mb-onboarding-video-content" class="mb-onboarding-video-content"></div>

<!-- Scripts -->
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
	var videoURLS = {
		login: {
			url: 'https://player.vimeo.com/video/850116866?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
			title: '',
		},
	};
</script>
<script>
	(function($) {
		$(document).ready(function() {
			var video = videoURLS['<?php echo $video ?>'];
			var HTML = '<iframe src="' + video.url + '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" title="' + video.title + '" style="position:absolute; top:0; left:0; width:100%; height:100%;"></iframe>';
			$('#mb-onboarding-video-content').html('<div class="mb-onboarding-loading">Loading...</div>');
			
			/**
			 * Events
			 */
			$('#mb-onboarding-video-link').on('click', function() {
				$('#mb-onboarding-video-content').html(HTML);
				$('#mb-onboarding-video-container').show();
			});
			$('#mb-onboarding-close-btn').on('click', function() {
				$('#mb-onboarding-video-container').hide();
				$('#mb-onboarding-video-content').html('<div class="mb-onboarding-loading">Loading...</div>');
			});
		});
	})(jQuery);
</script>