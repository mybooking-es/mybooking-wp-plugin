<?php
/**
 *   MYBOOKING ENGINE - TESTIMONIALS
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-testimonials.php
 *
 */
?>

<div class="mybooking mybooking-testimonial">
  <div class="-carrusel-testimonials">

    <?php
    $mybooking_engine_testimonial_args = array('post_type' => 'testimonial');
    $mybooking_engine_testimonial_query = new WP_Query($mybooking_engine_testimonial_args);
    $mybooking_engine_testimonial_items = $mybooking_engine_testimonial_query->get_posts();
    foreach( $mybooking_engine_testimonial_items as $mybooking_engine_testimonial_item ) :
    ?>

    <section class="mybooking-testimonial_item testimonial-item">
      <div class="mybooking-testimonial_container testimonial-item_message">
        <div class="mybooking-testimonial_avatar testimonial-item_avatar">
          <div>
            <?php if ( !has_post_thumbnail( $mybooking_engine_testimonial_item->ID ) ) { ?>
              <img class="mybooking-testimonial_image testimonial-item_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-avatar.png' ) ?>"/>
            <?php } else { ?>
              <?php $mybooking_engine_featured_img_url = get_the_post_thumbnail_url( $mybooking_engine_testimonial_item, 'full' ); ?>
              <img class="mybooking-testimonial_image testimonial-item_image" src="<?php echo esc_url( $mybooking_engine_featured_img_url ) ?>">
            <?php } ?>
          </div>
        </div>
        <div class="mybooking-testimonial_content testimonial-item_content">
          <div class="mybooking-testimonial_text">
            <?php echo wp_kses_post( $mybooking_engine_testimonial_item->post_content ); ?>
          </div>
          <footer class="mybooking-testimonial_name">
            <?php echo esc_html( $mybooking_engine_testimonial_item->post_title ); ?>
          </footer>
        </div>
      </div>
    </section>

    <?php endforeach; ?>

  </div>
</div>
