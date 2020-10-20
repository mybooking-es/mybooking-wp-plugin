<?php
  /** 
   * The Template for showing the cookies notice
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-cookies-notice.php
   *
   */
?>
<?php
// Getting WordPress configured privacy URL
$mybooking_engine_privacy_page = get_privacy_policy_url();
?>

<div id="cookie-notice" class="cookie-notice">
  <p class="cookie-notice_text">
    <?php echo esc_html_x( 'This website uses cookies to ensure you get the best experience', 'cookie_notice', 'mybooking-wp-plugin' ); ?>
  </p>
  <button id="cookie-notice_button" class="cookie-notice_button btn btn-primary">
    <?php echo esc_html_x( 'Accept', 'cookie_notice', 'mybooking-wp-plugin'); ?>
  </button>
  <?php if ( !empty($mybooking_engine_privacy_page) ) { ?>
	  <a href="<?php echo esc_url( $mybooking_engine_privacy_page ) ?>" class="cookie-notice_button btn btn-primary">
	    <?php echo esc_html_x( 'More', 'cookie_notice', 'mybooking-wp-plugin' ); ?>
	  </a>
  <?php } ?>
</div>
