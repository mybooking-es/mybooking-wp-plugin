<?php get_header();?>
<br>
<div class="container product-container">
  <div class="row">
    <div class="col-md-8">
      <div class="shadow mb-5 bg-white rounded">
          <!-- The photo -->
          <?php if (!empty( $args->photos ) && count( $args->photos ) > 1) { ?>
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php foreach( $args->photos as $key => $photo ) { ?>
              <div class="carousel-item <?php if ($key == key($args->photos)) { ?>active<?php } ?>">
                <img class="d-block w-100" src="<?php echo $photo->full_photo_path?>" alt="<?php echo $args->name?>">
              </div>
              <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only"><? echo _x('Previous', 'renting_product_detail', 'mybooking-wp-plugin' ) ?></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only"><? echo _x('Next', 'renting_product_detail', 'mybooking-wp-plugin' ) ?></span>
            </a>
          </div>
          <?php } else if (count($args->photos) == 1) { ?>
            <img class="d-block product-photo" src="<?php echo $args->photos[0]->full_photo_path?>" alt="<?php echo $args->name?>">
          <?php } else { ?>
              <div class="text-center no-product-photo pt-3"><i class="fa fa-camera" aria-hidden="true"></i></div>
          <?php } ?>
          <div class="p-3">
            <!-- Name -->
            <h1 class="h2 mt-3"><b><?php echo $args->name ?></b></h1>
            <!-- Short description -->
            <?php if ( !empty( $args->short_description) ) { ?>
              <div class="text-muted mt-1">
                <?php echo $args->short_description ?>
              </div>
            <?php } ?>
            <!-- From price -->
            <?php if ($args->from_price > 0) { ?>
            <h2 class="h4 mt-3 text-danger font-weight-normal"><?php printf( _x('From <b>%s</b>', 'renting_product_detail', 'mybooking-wp-plugin' ), number_format_i18n( $args->from_price ) ) ?>€</h2>
            <?php } ?>
            <!-- Key characteristics -->
            <?php if ( isset( $args->key_characteristics) && !empty( $args->key_characteristics ) ) { ?>
            <div class="card-body  key-characteristics">
              <ul class="icon-list-items">
                <?php if ( isset( $args->characteristic_length ) && !empty( $args->characteristic_length ) ) { ?>
                  <li class="icon-list-item">
                      <span class="icon-list-icon">
                         <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/characteristics/length.svg"/>
                      </span>
                      <span class="icon-list-text text-muted"><?php printf( _x('<b>%.2f</b> m.', 'renting_product_detail', 'mybooking-wp-plugin' ), $args->characteristic_length ) ?></span>
                  </li>
                <?php } ?>  
                <?php foreach ( $args->key_characteristics as $key => $value) { ?>
                <li class="icon-list-item">
                    <span class="icon-list-icon">
                      <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/key_characteristics/<?php echo $key ?>.svg"/>
                    </span>
                    <span class="icon-list-text text-muted"><?php echo $value ?></span>
                </li>
                <?php } ?>
              </ul>
            </div>  
            <?php } ?>
            <!-- Description -->
            <?php if ( !empty( $args->description ) ) { ?>
              <hr>
              <div class="mt-3">
                <h2 class="h3 mb-3"><? echo _x('Details', 'renting_product_detail', 'mybooking-wp-plugin' ) ?></h2>
                <?php echo $args->description ?>
              </div>
            <?php } ?>

          </div>
      </div>
    </div>  
    <div class="col-md-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h2"><b><?php echo $args->name ?></b></h2>
            <p class="mt-3 text-muted"><? echo _x('Please choose your dates in the availability calendar', 'renting_product_detail', 'mybooking-wp-plugin' ) ?>
          </div>
        </div>
      </div>
      <hr>
          <?php mybooking_engine_get_template('mybooking-plugin-product-widget.php', array('code' => $args->code)) ?>     
    </div>
  </div>
</div>

<?php get_footer(); ?>