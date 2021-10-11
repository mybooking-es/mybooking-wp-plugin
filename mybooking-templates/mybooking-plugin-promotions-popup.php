<?php
  /**
   * The Template for showing the promotions
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-promotions-popup.php
   *
   */
?>
<?php
$mybooking_engine_popup_args = array(
  'post_type' => 'popup',
  'posts_per_page'=> 1,
);
$mybooking_engine_query = new WP_Query($mybooking_engine_popup_args);
$mybooking_engine_popup_items = $mybooking_engine_query -> get_posts();

foreach($mybooking_engine_popup_items as $mybooking_engine_popup_item) :

  /**
  *		PROMO POPUP
  *  	-----------
  * 	Gets the featured image as a background, if not set nothigns happens.
  *   Supports Gutenber, and Elementor if allowed in settings.
  */
  ?>

  <div class="mybooking-popup_backdrop" id="MybookingPromotionsPopup">
    <div class="mybooking-popup_box">
      <div class="mybooking-popup" tabindex="-1" role="dialog">
        <?php $mybooking_engine_featured_img_url = get_the_post_thumbnail_url( $mybooking_engine_popup_item, 'full' ); ?>
        <div class="mybooking-popup_content" style="background-image: url(<?php echo esc_url( $mybooking_engine_featured_img_url ) ?>)">
          <button type="button" class="close mybooking-popup_close" aria-label="<?php echo esc_attr_x( 'Close', 'promotions_popup', 'mybooking-wp-plugin' ); ?>">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="mybooking-popup_post">
            <?php echo wp_kses_post( $mybooking_engine_popup_item->post_content ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endforeach; ?>
