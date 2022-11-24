		<!-- Planning init -->
		<div class="mybooking-product-planning-week-content" 
         data-category-code="<?php echo esc_attr( $args['code'] )?>" 
         id="planning-<?php echo esc_attr( $args['planning_id'] )?>">
			<form class="mybooking-product-planning-week-head">
        <div class="h1 mybooking-product-planning-week-title"></div>
        <div class="field">
          <div class="control">
            <div class="button-box">
              <button data-action="date" data-direction="back" class="mb-button"><i class="dashicons dashicons-arrow-left-alt"></i></button>
              <input type="text" name="date"  />
              <button data-action="date" data-direction="next" class="mb-button"><i class="dashicons dashicons-arrow-right-alt"></i></button>
            </div>
          </div>
        </div>
			</form>
			<div class="mybooking-product-planning-week-table"></div>
      <div class="mybooking-product-planning-week-btns">
        <button class="button mybooking-send-btn">
          <?php echo esc_html_x( 'Send', 'product_week_planning', 'mybooking-wp-plugin' ) ?>
        </button>
      </div>
		</div>
    <!-- Planning end -->