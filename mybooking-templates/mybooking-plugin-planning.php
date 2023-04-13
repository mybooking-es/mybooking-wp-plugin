<?php
/**
 *   MYBOOKING ENGINE - PLANNING
 *   ---------------------------------------------------------------------------
 *   The Template for showing the occupation planning in the web site
 * 
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-planning.php
 *
 */
?>
<div class="mybooking-planning-content" 
  data-family-code="<?php echo isset($args['family']) ? esc_attr( $args['family'] ) : '' ?>" 
  data-category-code="<?php echo isset($args['category']) ? esc_attr( $args['category']) : '' ?>" 
  data-rental-location-code="<?php echo isset($args['rental_location']) ? esc_attr( $args['rental_location'] ) : '' ?>" 
  data-direction="<?php echo isset($args['direction']) ? esc_attr( $args['direction'] ) : '' ?>" 
  data-type="<?php echo isset($args['type']) ? esc_attr( $args['type'] ) : '' ?>"
  data-interval="<?php echo isset($args['interval']) ? esc_attr( $args['interval'] ) : '' ?>" 
  data-items="<?php echo isset($args['days']) ? esc_attr( $args['days'] ) : '' ?>" 
  id="planning-<?php echo isset($args['planning_id']) ? esc_attr( $args['planning_id'] ) : '' ?>"
>
  <form class="mybooking-planning-head">
    <div class="field">
      <label  class="label">
        <?php echo esc_html_x( 'Date', 'planning', 'mybooking-wp-plugin' ) ?>
      </label>
      <div class="control">
        <input type="text" name="date"  />
        <div class="button-box">
          <button data-action="date" data-direction="back" class="button"><i class="dashicons dashicons-arrow-left-alt"></i></button>
          <button data-action="date" data-direction="next" class="button"><i class="dashicons dashicons-arrow-right-alt"></i></button>
        </div>
      </div>
    </div>
    <div class="field" style="display: none;">
      <label  class="label">
        <?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
      </label>
      <div class="control">
        <div class="select" data-default="<?php echo esc_attr( 'All', 'planning', 'mybooking-wp-plugin' ) ?>">
          <select name="rentalLocation" style="min-width: 300px;">
          </select>
        </div>
      </div>
    </div>
    <div class="field" style="display: none;">
      <label  class="label">
        <?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
      </label>
      <div class="control">
        <div class="select" data-default="<?php echo esc_attr( 'All', 'planning', 'mybooking-wp-plugin' ) ?>">
          <select name="family" style="min-width: 300px;">
          </select>
        </div>
      </div>
    </div>
    <div class="field" style="display: none;">
      <label  class="label">
        <?php echo esc_html( MyBookingEngineContext::getInstance()->getProduct() ) ?>
      </label>
      <div class="control">
        <div class="select" data-default="<?php echo esc_attr( 'All', 'planning', 'mybooking-wp-plugin' ) ?>">
          <select name="category" style="min-width: 300px;">
          </select>
        </div>
      </div>
    </div>
    <div class="field">
      <label  class="label"></label>
      <div class="control" style="top: 6px;">
        <div class="button-box">
          <button data-action="scroll" data-direction="back" class="button"><i class="dashicons dashicons-arrow-left-alt"></i></button>
          <button data-action="scroll" data-direction="next" class="button"><i class="dashicons dashicons-arrow-right-alt"></i></button>
        </div>
      </div>
    </div>
  </form>
  <div class="mybooking-planning-table"></div>
</div>

<!-- DETAILS MODAL ------------------------------------------------------------>
<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="modalProductDetail_MBM">
  <h3 class="mybooking-modal_title modal-product-detail-title"></h3>
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>
