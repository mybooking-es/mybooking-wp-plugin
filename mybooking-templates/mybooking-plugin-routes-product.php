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

<div class="mybooking mybooking-product_detail product-container">
  <div class="mb-row">
    <div class="mb-col-md-8">

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

      <!-- Product image -->
      <?php if (!empty( $args->photos ) && count( $args->photos ) > 1) { ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php foreach( $args->photos as $mybooking_key => $mybooking_photo ) { ?>
              <div class="carousel-item <?php if ($mybooking_key == key($args->photos)) { ?>active<?php } ?>">
                <img class="d-block w-100" src="<?php echo esc_url ( $mybooking_photo->full_photo_path ) ?>" alt="<?php echo esc_attr( $args->name )?>">
              </div>
            <?php } ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php echo esc_html_x('Previous', 'renting_product_detail', 'mybooking-wp-plugin' ) ?></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php echo esc_html_x('Next', 'renting_product_detail', 'mybooking-wp-plugin' ) ?></span>
          </a>
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

    <div class="mb-col-md-4">
      <div class="container">
        <div class="mb-row">
          <div class="mb-col-md-12">
            <h2 class="h2"><b><?php echo esc_html( $args->name ) ?></b></h2>
            <p class="mt-3 text-muted"><?php echo esc_html_x('Please choose your dates in the availability calendar', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
          </div>
        </div>
      </div>
      <hr>
      <?php mybooking_engine_get_template('mybooking-plugin-product-widget.php', array('code' => $args->code)) ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
