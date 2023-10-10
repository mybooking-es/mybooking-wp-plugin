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
<div class="mybooking-process-page">
  <section class="mybooking mybooking-process_choose mybooking-page-container<?php echo esc_attr( mybooking_engine_theme_align_width() )?>">

  <!-- Reservation detail -->
  <div id="reservation_detail"></div>

  <!-- Product listing -->
  <div class="mybooking-product_listing" id="product_listing" 
      <?php if ( array_key_exists('use_renting_detail_page', $args) && $args['use_renting_detail_page'] == 'true' ) : ?>
      data-use-renting-detail-page="true" 
      <?php endif; ?>></div>
  </section>
</div>

<!-- DETAILS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail_MBM">
  <h3 class="mybooking-modal_title modal-product-detail-title"></h3>
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>

<!-- VARIANTS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalVariantSelector_MBM">
  <h3 id="variant-product-title"  class="mybooking-modal_title modal-product-detail-title"></h3>
  <div id="variant-product-content"  class="mybooking-modal_body modal-product-detail-content"></div>
</div>