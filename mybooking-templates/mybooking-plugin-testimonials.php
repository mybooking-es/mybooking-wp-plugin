<div class="mybooking-home_testimonials">
  <div class="container -carrusel-testimonials">

    <?php
    $testimonial_args = array('post_type' => 'testimonial');
    $query = new WP_Query($testimonial_args);
    $testimonial_items = $query->get_posts();
    foreach($testimonial_items as $testimonial_item) :
    ?>

    <blockquote class="testimonial-item">
      <div class="testimonial-item_message">
        <div class="testimonial-item_content ">
          <?php echo $testimonial_item->post_content; ?>
        </div>
      </div>

      <div class="testimonial-item_avatar">

        <?php if ( !has_post_thumbnail( $testimonial_item->ID ) ) { ?>
          <img class="testimonial-item_image" src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/default-avatar.png"/>
        <?php } else { ?>
          <?php $featured_img_url = get_the_post_thumbnail_url( $testimonial_item,'full' ); ?>
          <img class="testimonial-item_image" src="<?php echo esc_url( $featured_img_url ) ?>">
        <?php } ?>

        <footer class="blockquote-footer">
          <?php echo $testimonial_item->post_title; ?>
        </footer>

      </div>
    </blockquote>

    <?php endforeach; ?>

  </div>
</div>
