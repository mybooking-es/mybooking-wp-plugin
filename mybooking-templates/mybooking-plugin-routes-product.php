<?php
/**
 *   MYBOOKING ENGINE - PRODUCT DETAIL
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-routes-product.php
 *
 */
?>

<?php get_header();?>

<div class="entry">
  <div class="entry-content">
    <div class="mybooking mybooking-product_detail mybooking-product_container">
      <div class="mb-row">
        <div class="mb-col-md-12 mb-col-lg-12">
          <div class="mybooking-product_detail-header">
            <div class="mybooking-product_detail-title">
              <h1><?php echo esc_html( $args->name ) ?></h1>
            </div>

            <!-- From price -->
            <?php if ($args->from_price > 0) { ?>
             <div class="mybooking-product_detail-price">
               <?php echo wp_kses_post( sprintf( _x('From <span class="mybooking-product_detail-amount">%s€</span>', 'renting_product_detail', 'mybooking-wp-plugin' ), number_format_i18n( $args->from_price ) ) )?>
             </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="mb-row">
        <div class="mb-col-md-6 mb-col-lg-8">

          <!-- Product image -->
          <?php if (!empty( $args->photos ) && count( $args->photos ) > 1) { ?>

            <div class="mybooking-product-carousel-inner">
              <?php foreach( $args->photos as $mybooking_key => $mybooking_photo ) { ?>
                <div class="mybooking-carousel-item">
                  <img class="d-block w-100" src="<?php echo esc_url ( $mybooking_photo->full_photo_path ) ?>" alt="<?php echo esc_attr( $args->name )?>">
                </div>
              <?php } ?>
            </div>

          <?php } else if (count($args->photos) == 1) { ?>
            <img class="d-block product-photo" src="<?php echo esc_url ( $args->photos[0]->full_photo_path ) ?>" alt="<?php echo esc_attr( $args->name )?>">

          <?php } else { ?>
            <div class="text-center no-product-photo pt-3"><i class="fa fa-camera" aria-hidden="true"></i></div>
          <?php } ?>

          <?php if ( isset( $args->key_characteristics) && is_array( (array) $args->key_characteristics ) && !empty( (array) $args->key_characteristics ) ) { ?>
            <div class="mybooking-product_characteristics">
              <?php foreach ( $args->key_characteristics as $mybooking_key => $mybooking_value) { ?>
                <div class="mybooking-product_characteristics-item">
                  <img class="mybooking-product_characteristics-img" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/key_characteristics/'.$mybooking_key.'.svg' ) ?>" alt="<?php echo esc_attr( MyBookingEngineContext::getInstance()->getKeyCharacteristic( $mybooking_key ) ) ?>"/>
                  <span class="mybooking-product_characteristics-key"><?php echo esc_html( $mybooking_value ) ?></span>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

          <!-- Short description -->
          <?php if ( !empty( $args->short_description) ) { ?>
            <div class="mybooking-product_detail-short">
              <?php echo wp_kses_post( $args->short_description ) ?>
            </div>
          <?php } ?>

          <!-- Description -->
          <?php if ( !empty( $args->description ) ) { ?>
            <div class="mybooking-product_detail-description">
              <?php echo wp_kses_post( $args->description )?>
            </div>
          <?php } ?>

        </div>

        <div class="mb-col-md-6 mb-col-lg-4">
          <h2><?php echo wp_kses_post( _x( 'Book it!', 'renting_choose_product', 'mybooking-wp-plugin') ) ?></h2>
          <?php
             $widget_data = array( 'code' => $args->code );
             if ( isset( $args->sales_channel_code ) ) {
               $widget_data['sales_channel_code'] = $args->sales_channel_code;
             }
          ?>
          <?php mybooking_engine_get_template('mybooking-plugin-product-widget.php', $widget_data ) ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
