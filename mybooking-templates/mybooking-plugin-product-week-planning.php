		<!-- Planning init -->
		<div class="mybooking-product-planning-week-content" 
         data-category-code="<?php echo esc_attr( $args['code'] )?>" 
         id="planning-<?php echo esc_attr( $args['planning_id'] )?>">
			<form class="mybooking-product-planning-week-head">
        <div class="mybooking-title mybooking-product-planning-week-title"></div>
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
          </form>
      </div>
		</div>
    <!-- Planning end -->