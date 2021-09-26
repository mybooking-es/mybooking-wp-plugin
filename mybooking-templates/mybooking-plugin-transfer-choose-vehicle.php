<?php
  /** 
   * The Template for showing the renting select product step
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-choose-vehicle.php
   *
   */
?>
  
<section class="section container">
  <div class="row">
    <!-- Reservation detail -->
    <div class="col-lg-12">
      <div id="mybooking_transfer_reservation_detail"></div>
    </div>
    <!-- Vehicle listing -->
    <div class="col-lg-12">
      <div id="mybooking_transfer_product_listing"></div>
    </div>
  </div>
</section>

<!-- Modal that shows the product detail -->
<div class="modal modal-mybooking" tabindex="-1" role="dialog" id="modalTransferProductDetail">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-product-detail-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo esc_attr_x( 'Close', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ); ?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-product-detail-content">
      </div>
    </div>
  </div>
</div>
