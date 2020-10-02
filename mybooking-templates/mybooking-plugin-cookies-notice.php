<?php
// Getting WordPress configured privacy URL
$privacy_page = get_privacy_policy_url();
?>

<div id="cookie-notice" class="cookie-notice">
  <p class="cookie-notice_text">
    <?php echo _x('This website uses cookies to ensure you get the best experience','cookie-notice','mybooking'); ?>
  </p>
  <button class="cookie-notice_button btn btn-primary" onclick="acceptCookie();">
    <?php echo _x('Accept','cookie-notice','mybooking'); ?>
  </button>
  <a href="<?php echo $privacy_page ?>" class="cookie-notice_button btn btn-primary">
    <?php echo _x('More','cookie-notice','mybooking'); ?>
  </a>
</div>
