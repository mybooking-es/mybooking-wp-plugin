<?php
/**
 *   MYBOOKING ENGINE - CHOOSE PRODUCT
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-choose-product.php
 *
 */
?>

<section class="mybooking mybooking-process_choose <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

  <!-- Reservation detail -->
  <div id="reservation_detail"></div>

  <!-- Product listing -->
  <div id="product_listing"></div>
</section>


<!-- DETAILS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail_MBM">
  <h3 class="mybooking-modal_title modal-product-detail-title"></h3>
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>
