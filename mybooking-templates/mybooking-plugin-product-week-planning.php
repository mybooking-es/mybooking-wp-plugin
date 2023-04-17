<?php
/**
 *   MYBOOKING ENGINE - PRODUCT WEEK PLANNING
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the week planning to create a reservation
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-product-week-planning.php
 *
 */
?>
		<!-- Planning init -->
		<div class="mybooking-product-planning-week-content" 
        data-interval="<?php echo isset($args['interval']) ? esc_attr( $args['interval'] ) : '' ?>"  
        data-category-code="<?php echo isset($args['category']) ? esc_attr( $args['category'] ) : '' ?>" 
        id="planning-<?php echo isset($args['planning_id']) ? esc_attr( $args['planning_id'] ) : '' ?>" >
			<form class="mybooking-product-planning-week-head">
        <div class="mybooking-title mybooking-product-planning-week-title"></div>
        <div class="field" style="display: none; margin-bottom: 0;">
          <div style="display: flex; align-items: center;">
            <label  class="label">
              <?php echo esc_html( MyBookingEngineContext::getInstance()->getProduct() ) ?>
              &nbsp;
            </label>
            <div class="control">
              <div class="select">
                <select name="category" style="min-width: 300px;">
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="button-box">
          <button data-action="date" data-direction="back" class="button"><i class="dashicons dashicons-arrow-left-alt"></i></button>
          <input type="text" name="date"  />
          <button data-action="date" data-direction="next" class="button"><i class="dashicons dashicons-arrow-right-alt"></i></button>
        </div>
			</form>
			<div class="mybooking-product-planning-week-table"></div>
      <div class="mybooking-product-planning-week-btns">
          <form
            name="mybooking_product_week_planning_reservation"
            method="get"
            enctype="application/x-www-form-urlencoded"
            class="mybooking-form">
            <div id="mybooking_product_week_planning_reservation_summary"></div>                           
          </form>
      </div>
		</div>
    <!-- Planning end -->