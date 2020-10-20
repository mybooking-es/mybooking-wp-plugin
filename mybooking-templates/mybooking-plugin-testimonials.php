<?php
  /** 
   * The Template for showing the testimonials
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-testimonials.php
   */
?>
<div class="mybooking-testimonials">
  <div class="container -carrusel-testimonials">

    <?php
    $mybooking_engine_testimonial_args = array('post_type' => 'testimonial');
    $mybooking_engine_testimonial_query = new WP_Query($mybooking_engine_testimonial_args);
    $mybooking_engine_testimonial_items = $mybooking_engine_testimonial_query->get_posts();
    foreach($mybooking_engine_testimonial_items as $mybooking_engine_testimonial_item) :
    ?>

    <blockquote class="testimonial-item">
      <div class="testimonial-item_message">
        <div class="testimonial-item_content ">
          <?php echo wp_kses_post( $mybooking_engine_testimonial_item->post_content ); ?>
        </div>
      </div>

      <div class="testimonial-item_avatar">

        <?php if ( !has_post_thumbnail( $mybooking_engine_testimonial_item->ID ) ) { ?>
          <img class="testimonial-item_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-avatar.png' ) ?>"/>
        <?php } else { ?>
          <?php $mybooking_engine_featured_img_url = get_the_post_thumbnail_url( $testimonial_item, 'full' ); ?>
          <img class="testimonial-item_image" src="<?php echo esc_url( $mybooking_engine_featured_img_url ) ?>">
        <?php } ?>

        <footer class="blockquote-footer">
          <?php echo esc_html( $mybooking_engine_testimonial_item->post_title ); ?>
        </footer>

      </div>
    </blockquote>

    <?php endforeach; ?>

  </div>
</div>
