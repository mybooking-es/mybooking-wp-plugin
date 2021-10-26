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

  <!-- Sidebar reservation detail -->
  <div id="reservation_detail"></div>

  <!-- Product listing -->
  <div id="product_listing"></div>
</section>

<!-- Modal that shows the product detail -->
<div class="mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail_MBM">
  <h5 class="mb-modal-title modal-product-detail-title"></h5>
  <hr>
  <div class="mb-modal-body modal-product-detail-content">
  </div>
</div>
