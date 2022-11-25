<div class="mybooking-planning-content" 
			data-category-code="<?php echo esc_attr( $args['code'] )?>" 
			data-rental-location-code="<?php echo esc_attr( $args['rental_location'] )?>" 
			data-direction="<?php echo esc_attr( $args['direction'] )?>" 
			data-type="<?php echo esc_attr( $args['type'] )?>"
			data-items="<?php echo esc_attr( $args['days'] )?>" 
			id="planning-<?php echo esc_attr( $args['planning_id'] )?>">
			<form class="mybooking-planning-head">
        <div class="field">
          <label for="date" class="label">
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
          <label for="date" class="label">
						<?php echo esc_html_x( 'Category', 'planning', 'mybooking-wp-plugin' ) ?>
					</label>
          <div class="control">
            <div class="select">
              <select name="category" style="min-width: 300px;">
                <option value="all">
									<?php echo esc_html_x( 'All', 'planning', 'mybooking-wp-plugin' ) ?>
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label for="date" class="label"></label>
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