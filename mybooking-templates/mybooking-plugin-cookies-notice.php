<?php
// Getting WordPress configured privacy URL
$privacy_page = get_privacy_policy_url();
?>

<div id="cookie-notice" class="cookie-notice">
  <p class="cookie-notice_text">
    <?php _ex('This website uses cookies to ensure you get the best experience','cookie-notice','mybooking'); ?>
  </p>
  <button class="cookie-notice_button btn btn-primary" onclick="acceptCookie();">
    <?php _ex('Accept','cookie-notice','mybooking'); ?>
  </button>
  <a href="<?php echo $privacy_page ?>" class="cookie-notice_button btn btn-primary">
    <?php _ex('More','cookie-notice','mybooking'); ?>
  </a>
</div>
