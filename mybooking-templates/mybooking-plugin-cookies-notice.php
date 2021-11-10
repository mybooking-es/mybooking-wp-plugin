<?php
/**
 *   MYBOOKING ENGINE - COOKIES NOTICE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-cookies-notice.php
 *
 */
?>

<?php
// Getting WordPress configured privacy URL
$mybooking_engine_privacy_page = get_privacy_policy_url();
?>

<!--div class="mybooking-cookies"-->
  <div id="cookie-notice" class="mybooking-cookies_container cookie-notice" style="visibility: hidden">
    <p class="mybooking-cookies_text cookie-notice_text">
      <?php echo esc_html_x( 'This website uses cookies to ensure you get the best experience', 'cookie_notice', 'mybooking-wp-plugin' ); ?>

      <?php if ( !empty($mybooking_engine_privacy_page) ) { ?>
    	  <a href="<?php echo esc_url( $mybooking_engine_privacy_page ) ?>" class="mybooking-cookies_link">
    	    <?php echo esc_html_x( 'More', 'cookie_notice', 'mybooking-wp-plugin' ); ?>
    	  </a>
      <?php } ?>
    </p>
    <button id="mybooking-cookies_button" class="mybooking-cookies_button mb-button cookie-notice_button">
      <?php echo esc_html_x( 'Ok', 'cookie_notice', 'mybooking-wp-plugin'); ?>
    </button>
  </div>
<!--/div-->
