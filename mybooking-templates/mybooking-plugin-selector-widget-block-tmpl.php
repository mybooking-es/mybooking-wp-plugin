<?php
  /** 
   * The Template for showing selector widget block product
   * This template can be overridden by copying it to your
   * theme /mybooking-templates/mybooking-plugin-selector-widget-block-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
 		<!-- // Rental location selector - Location code selector -->
		<% if (not_hidden_rental_location_code && configuration.selectorRentalLocation) { %>
			<div class="mybooking-selector_group">
		    <div class="mybooking-selector_location widget_rental_location" style="display: none">
		      <label for="rental_location_code">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
					</label>
		      <select name="rental_location_code" id="widget_rental_location_code" class="mb-form-control"></select>
		    </div>
			</div>
		<% } %>
		
		<!-- // PICKUP SECTION -->
		<div class="mybooking-selector_group">
			<% if (configuration.pickupReturnPlace) { %>
				<div class="mybooking-selector_place">
			    <!-- // Delivery place -->
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-location"></span>
					</i>
		      <label for="pickup_place">
						<?php echo esc_html_x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?>
					</label>

					<!-- // List pickup place -->
					<div class="widget_pickup_place_group">
		      	<select class="mb-form-control" id="widget_pickup_place" name="pickup_place" ></select>
		  		</div>

		      <!-- // Custom delivery place -->
		      <div id="widget_another_pickup_place_group" style="display: none;">
						<button class="mybooking-selector_close-btn widget_another_pickup_place_group_close">
							<i>
								<span class="dashicons dashicons-dismiss"></span>
							</i>
						</button>
		        <input class="mb-form-control" id="widget_pickup_place_other" type="text" name="pickup_place_other" />
		        <input type="hidden" name="custom_pickup_place" value="false" />
		      </div>
				</div>
			<% } %>

			<div class="mybooking-selector_date">
				<!-- // Pickup date -->
				<div class="mybooking-selector_cal">
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-calendar-alt"></span>
					</i>
					<label for="date_from">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
					</label>
					<input class="mb-form-control" type="text" name="date_from" id="widget_date_from" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
				</div>

				<!-- // Pickup time -->
				<% if (configuration.timeToFrom) { %>
					<div class="mybooking-selector_hour">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-clock"></span>
						</i>
						<label for="time_from">
							<?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryTime() ) ?>
						</label>
						<select class="mb-form-control" id="widget_time_from" name="time_from"></select>
					</div>
				<% } else { %>
					<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
				<% } %>
			</div>
		</div>

		<!-- // RETURN SECTION -->
		<div class="mybooking-selector_group">
			<% if (configuration.pickupReturnPlace) { %>
				<div class="mybooking-selector_place">
			    <!-- // Return place -->
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-location"></span>
					</i>
		      <label for="return_place">
						<?php echo esc_html_x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
					</label>

					<!-- // List return place -->
		      <div class="widget_return_place_group">
		      	<select class="mb-form-control" name="return_place" id="widget_return_place"></select>
		      </div>

		      <!-- // Custom delivery place -->
		      <div id="widget_another_return_place_group" style="display: none;">
						<button class="mybooking-selector_close-btn widget_another_return_place_group_close">
							<i>
								<span class="dashicons dashicons-dismiss"></span>
							</i>
						</button>
		        <input class="mb-form-control" id="widget_return_place_other" type="text" name="return_place_other" />
		        <input type="hidden" name="custom_return_place" value="false" />
		      </div>
				</div>
			<% } %>

			<div class="mybooking-selector_date">
				<% if (configuration.rentDateSelector === 'date_from_duration') { %>
				  <!-- // Duration -->
					<div class="mybooking-selector_duration">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-clock"></span>
						</i>
						<label for="widget_renting_duration">
							<?php echo esc_html_x( 'Duration', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
						</label>
						<select class="mb-form-control" id="widget_renting_duration" name="renting_duration"></select>
					</div>
				<% } else if (configuration.rentDateSelector === 'date_from_date_to') { %>	
					<!-- // Return date -->
					<div class="mybooking-selector_cal">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-calendar-alt"></span>
						</i>
						<label for="date_to">
							<?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
						</label>
						<input type="text" class="mb-form-control" name="date_to" id="widget_date_to" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
					</div>

					<!-- // Return time -->
					<% if (configuration.timeToFrom) { %>
						<div class="mybooking-selector_hour">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-clock"></span>
						</i>
						<label for="time_to">
							<?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionTime() ) ?>
						</label>
						<select class="mb-form-control" name="time_to" id="widget_time_to"></select>
						</div>
					<% } else { %>
						<input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
					<% } %>
				<% } %>
			</div>
		</div>

		<!-- // FOOTER -->
		<div class="mybooking-selector_group mybooking-selector_footer">
			<!-- // Family selector -->
		  <% if (not_hidden_family_id && configuration.selectFamily) { %>
		    <div class="widget_family mybooking-selector_family" style="display: none">
		      <label for="family_id">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
					</label>
		      <select name="family_id" id="widget_family_id" class="mb-form-control"></select>
		    </div>
	    <% } %>

			<!-- Age code selector -->
      <% if (configuration.useDriverAgeRules) { %>
        <div class="driver_age_rule mybooking-selector_driver_age" style="display: none">
          <label for="driver_age_rule_id">
          <?php echo esc_html_x( 'Age selector', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
          </label>
          <select name="driver_age_rule_id" id="driver_age_rule_id"></select>
        </div>
      <% } %>

			<!-- // Promotion code -->		
			<% if (configuration.promotionCode) { %>
				<div class="mybooking-selector_promo">
					<label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
					<input type="text" class="mb-form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off"
					<% if (typeof promotionCode !== 'undefined' && promotionCode !== '') { %> value="<%=promotionCode%>" <%}%>>
				</div>
			<% } %>

			<!-- Company -->
			<% if (typeof company !== 'undefined' && company && company !== '') { %>
				<input type="hidden" name="company" value="<%=company%>"/>
			<% } %>		

			<!-- // Search button -->
			<div class="mybooking-selector_button-box">
        <label>&nbsp;</label>
				<input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
			</div>
		</div>