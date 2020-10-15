<?php
// Getting WordPress configured privacy URL
$privacy_page = get_privacy_policy_url();
?>

<div id="cookie-notice" class="cookie-notice">
  <p class="cookie-notice_text">
    <?php _ex('This website uses cookies to ensure you get the best experience','cookie_notice','mybooking-wp-plugin'); ?>
  </p>
  <button id="cookie-notice_button" class="cookie-notice_button btn btn-primary">
    <?php _ex('Accept','cookie_notice','mybooking-wp-plugin'); ?>
  </button>
  <?php if ( !empty($privacy_page) ) { ?>
	  <a href="<?php echo $privacy_page ?>" class="cookie-notice_button btn btn-primary">
	    <?php _ex('More','cookie_notice','mybooking-wp-plugin'); ?>
	  </a>
  <?php } ?>
</div>
