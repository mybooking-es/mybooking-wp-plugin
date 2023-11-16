<?php
/**
 *   MYBOOKING ENGINE - CHOOSE PRODUCT
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-transfer-choose-vehicle.php
 *
 */
?>

<!-- Reservation detail sticky
  
  .mybooking-transfer_choose class is present to fix missing styles 
  due to refactorization related to adaptation to Mybooking Theme 
  -->
<div id="mybooking_transfer_reservation_detail" class="sticky-top mybooking-transfer_choose"></div>

<div class="mybooking-process-page">
  <section class="mybooking mybooking-page-container mybooking-process_choose <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

  <!-- Product listing -->
  <div class="mybooking-product_listing" id="mybooking_transfer_product_listing"></div>
  <br />
  </section>
</div>

<!-- DETAILS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalTransferProductDetail_MBM">
  <h3 class="mybooking-modal_title modal-product-detail-title"></h3>
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>
