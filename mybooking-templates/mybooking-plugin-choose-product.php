<?php
  /** 
   * The Template for showing the renting select product step
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-choose-product.php
   *
   */
?>
  
<!-- Complement to modify reservation dates -->
<?php if ( $args['selector_in_process'] == 'wizard' ) { ?>
  <?php mybooking_engine_get_template('mybooking-plugin-selector-wizard-container.php') ?>
<?php } else { ?>
  <?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>
<?php } ?>

<section class="section">
  <div class="row">
    <!-- Sidebar reservation detail -->
    <div class="col-lg-4">
      <div id="reservation_detail"></div>
    </div>
    <!-- Product listing -->
    <div class="col-lg-8">
      <div id="product_listing"></div>
    </div>
  </div>
</section>

<!-- Modal that shows the product detail -->
<div class="modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-product-detail-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo esc_attr_x( 'Close', 'renting_choose_product', 'mybooking-wp-plugin' ); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-product-detail-content">
      </div>
    </div>
  </div>
</div>
