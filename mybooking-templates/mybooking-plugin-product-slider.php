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
      $mybooking_engine_slider_args = array( 'post_type' => 'product-slider' );
      $mybooking_engine_slider_query = new WP_Query( $mybooking_engine_slider_args );
      $mybooking_engine_slider_items = $mybooking_engine_slider_query->get_posts();

      foreach( $mybooking_engine_slider_items as $mybooking_engine_slider_item ) :
        // Gets custom fields data
        $product_slider_title = get_post_meta( $mybooking_engine_slider_item->ID, 'mybooking-product-slider-title', true );
        $product_slider_description = get_post_meta( $mybooking_engine_slider_item->ID, 'mybooking-product-slider-description', true );
        $product_slider_offer_price = get_post_meta( $mybooking_engine_slider_item->ID, 'mybooking-product-slider-offer-price', true );
        $product_slider_original_price = get_post_meta( $mybooking_engine_slider_item->ID, 'mybooking-product-slider-original-price', true );
        $product_slider_link = get_post_meta( $mybooking_engine_slider_item->ID, 'mybooking-product-slider-link', true );
    ?>

    <section class="mybooking-slider_item slider-item">
      <div class="mybooking-slider_container slider-item_message">
        <div class="mybooking-slider_content slider-item_content">
          <div class="mb-row row">
            <div class="mb-col-md-6 col-md-6">
              <div class="mybooking-slider_image">
                <?php if ( has_post_thumbnail( $mybooking_engine_slider_item->ID ) ) { ?>
                  <?php $product_slider_img_url = get_the_post_thumbnail_url( $mybooking_engine_slider_item->ID, 'full' ); ?>
                  <img class="mybooking-slider_product-image" src="<?php echo esc_url( $product_slider_img_url ) ?>">
                <?php } ?>
              </div>
            </div>
            <div class="mb-col-md-6 col-md-6">
              <div class="mybooking-slider_info">

                <?php if ( $product_slider_title !='' ) {  ?>
		  	        	<h2 class="mybooking-slider_product-title"><?php echo esc_html( $product_slider_title ) ?></h2>
		  	        <?php } ?>

                <div class="mybooking-slider_product-price">
                  <?php if ( $product_slider_original_price !='' ) {  ?>
  		  	        	<span class="mybooking-slider_product-price--original"><?php echo esc_html( $product_slider_original_price ) ?></span>
  		  	        <?php } ?>

                  <?php if ( $product_slider_offer_price !='' ) {  ?>
  		  	        	<span class="mybooking-slider_product-price--offer"><?php echo esc_html( $product_slider_offer_price ) ?></span>
  		  	        <?php } ?>
                </div>

                <?php if ( $product_slider_description !='' ) {  ?>
		  	        	<p class="mybooking-slider_product-description"><?php echo esc_html( $product_slider_description ) ?></p>
		  	        <?php } ?>

                <?php if ( $product_slider_link !='' ) {  ?>
                  <div class="mybooking-slider_product-action">
                    <a class="mb-button button mybooking-read-more-link" href="<?php echo esc_attr( $product_slider_link ) ?>">
                      <?php echo wp_kses_post( _x( 'Book it!', 'renting_choose_product', 'mybooking-wp-plugin') ) ?>
                    </a>
                  </div>
		  	        <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php endforeach; ?>

  </div>
</div>
