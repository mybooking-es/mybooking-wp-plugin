<?php
  /** 
   * The Template for showing selector widget inline product
   * This template can be overridden by copying it to your
   * theme /mybooking-templates/mybooking-plugin-selector-widget-inline-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
		<div class="mybooking-selector_group mb-inline">
			  <% if (typeof company !== 'undefined' && company && company !== '') { %>
				<input type="hidden" name="company" value="<%=company%>"/>
			  <% } %>		
	
				<!-- // Simple location selector -->
        <% if (not_hidden_rental_location_code && configuration.simpleLocation) { %>
  				<div class="mybooking-selector_simple_location">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-location"></span>
						</i>
						<label for="widget_simple_location_id">
							<?php echo esc_html_x( 'Where', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
						</label>
						<select name="simple_location_id" id="widget_simple_location_id" class="mb-form-control"></select>
					</div>
				<% } %>

				<!-- // Family selector -->
				<% if (not_hidden_family_id && configuration.selectFamily) { %>
					<div class="widget_family mybooking-selector_family" style="display: none">
						<label for="family_id">
							<?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
						</label>
						<select name="family_id" id="widget_family_id" class="mb-form-control"></select>
					</div>
				<% } %>

				<!--
				// Rental location selector
				// Location code selector:
				// Opens .mybooking-selector_group
				// only when Locator or Family fields are activated
				-->
				<% if (not_hidden_rental_location_code && configuration.selectorRentalLocation || not_hidden_family_id && configuration.selectFamily ) { %>
	  				<div class="mybooking-selector_location widget_rental_location" style="display: none">
							<i class="mybooking-selector_field-icon">
								<span class="dashicons dashicons-location"></span>
							</i>
							<label for="rental_location_code">
								<?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
							</label>
							<select name="rental_location_code" id="widget_rental_location_code" class="mb-form-control"></select>
						</div>
				<% } %>

				<!-- // Pickup Date -->
				<div class="mybooking-selector_cal">
					<i class="mybooking-selector_field-icon">
						<span class="dashicons dashicons-calendar-alt"></span>
					</i>
					<label for="date_from">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
					</label>
					<input class="mb-form-control" name="date_from" id="widget_date_from" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
				</div>

				<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>

				<% if (configuration.rentDateSelector === 'date_from_date_to') { %>
					<!-- // Return date -->
					<div class="mybooking-selector_cal">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-calendar-alt"></span>
						</i>
						<label for="date_from">
							<?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
						</label>
						<input class="mb-form-control" name="date_to" id="widget_date_to" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
					</div>

					<!-- // Return time -->
					<input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>

			  <% } else if (configuration.rentDateSelector === 'date_from_duration') { %>
				  <!-- // Duration -->
				  <div class="mybooking-selector_hour">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-backup"></span>
						</i>
						<label for="widget_renting_duration">
							<?php echo esc_html_x( 'Duration', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
						</label>
						<select class="mb-form-control" id="widget_renting_duration" name="renting_duration"></select>
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

				<!-- // Search button -->
				<div class="mybooking-selector_button-box">
					<label>&nbsp;</label>
					<input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
				</div>
      </div>        