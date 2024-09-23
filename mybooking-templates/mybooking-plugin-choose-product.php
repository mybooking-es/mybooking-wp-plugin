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

<!-- Reservation detail -->
<div id="reservation_detail" class="sticky-top <?php echo esc_attr( mybooking_engine_theme_align_width() )?>"></div>

<!-- Filter -->
<?php if ( array_key_exists('filter', $args) && $args['filter'] == 'top' ) : ?>
  <div id="mybooking_choose_product_filter" class="mybooking-page-container"></div>
<?php endif; ?>

<div class="mybooking-process-page <?php echo esc_attr( mybooking_engine_theme_align_width() )?>">
  <section class="mybooking mybooking-process_choose mybooking-page-container">
    <div class="mb-row-flex">
      <div class="mb-col-sm-12">
        <button id="go_to_complete" class="mb-button btn-confirm-selection" style="display: none;">
          <?php echo esc_html_x( 'Next', 'renting_choose_product', 'mybooking-wp-plugin') ?>
          <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
        </button>
        <!-- Product listing -->
        <div class="mybooking-product_listing" id="product_listing" 
          <?php if ( array_key_exists('use_renting_detail_page', $args) && $args['use_renting_detail_page'] == 'true' ) : ?>
          data-use-renting-detail-page="true" 
          <?php endif; ?> <?php if ( array_key_exists('lazy_loading', $args) && $args['lazy_loading'] == 'true' ) : ?>
          data-lazy-loading="true" 
          <?php endif; ?>>
        </div>
        <br/>
      </div>
    </div>
  </section>
</div>

<!-- DETAILS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail_MBM">
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>

<!-- VARIANTS MODAL ------------------------------------------------------------>

<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalVariantSelector_MBM">
  <h3 id="variant-product-title" class="mybooking-modal_title modal-product-detail-title"></h3>
  <div id="variant-product-content" class="mybooking-modal_body modal-product-detail-content"></div>
</div>