<?php
/**
 *   MYBOOKING ENGINE - SLIDER
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-slider.php
 *
 */
?>

<div class="mybooking mybooking-slider">
  <div class="-carrusel-testimonials">

    <?php
    $mybooking_engine_slider_args = array('post_type' => 'content-slider');
    $mybooking_engine_slider_query = new WP_Query($mybooking_engine_slider_args);
    $mybooking_engine_slider_items = $mybooking_engine_slider_query->get_posts();
    foreach($mybooking_engine_slider_items as $mybooking_engine_slider_item) :
    ?>

    <section class="mybooking-slider_item slider-item">
      <div class="mybooking-slider_container slider-item_message">
        <div class="mybooking-slider_content slider-item_content">
          <div class="mybooking-slider_text">
            <?php echo wp_kses_post( $mybooking_engine_slider_item->post_content ); ?>
          </div>
        </div>
      </div>
    </section>

    <?php endforeach; ?>

  </div>
</div>
