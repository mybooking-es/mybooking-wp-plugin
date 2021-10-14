<?php
  /**
   * The Template for showing the renting selector widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-selector-widget-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<!-- =========================================== -->
<!--			 Renting Form selector template 			 -->
<!-- =========================================== -->
<script type="text/tmpl" id="widget_form_selector_tmpl">

	<% if (configuration.pickupReturnPlace && configuration.timeToFrom) { %>

		<!-- PICKUP SECTION -->

		<div class="mybooking-selector_group">
			<div class="mybooking-selector_place">
			  <% if (configuration.pickupReturnPlace) { %>

			    <!-- Delivery place -->
		      <label for="pickup_place">
						<?php echo esc_html_x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?>
					</label>

					<!-- List pickup place -->
					<div class="widget_pickup_place_group">
		      	<select class="mb-form-control" id="widget_pickup_place" name="pickup_place" ></select>
						<i class="mybooking-selector_field-icon fa fa-map-marker-alt"></i>
		  		</div>

		      <!-- Custom delivery place -->
		      <div id="widget_another_pickup_place_group" style="display: none;">
						<button class="mybooking-selector_close-btn widget_another_pickup_place_group_close">
							<i class="fa fa-times"></i>
						</button>
		        <input class="mb-form-control" id="widget_pickup_place_other" type="text" name="pickup_place_other" />
		        <input type="hidden" name="custom_pickup_place" value="false" />
		      </div>

				<% } %>
			</div>

			<div class="mybooking-selector_date">

				<!-- Pickup date -->
				<div class="mybooking-selector_cal">
					<label for="date_from">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
					</label>
					<input class="mb-form-control" type="text" name="date_from" id="widget_date_from" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
					<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
				</div>

				<!-- Pickup time -->
				<% if (configuration.timeToFrom) { %>
					<div class="mybooking-selector_hour">
					<select class="mb-form-control" id="widget_time_from" name="time_from"></select>
					<i class="mybooking-selector_field-icon fa fa-clock"></i>
					</div>
				<% } else { %>
					<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
					<i class="mybooking-selector_field-icon fa fa-clock"></i>
				<% } %>
			</div>
		</div>


		<!-- RETURN SECTION -->

		<div class="mybooking-selector_group">
			<div class="mybooking-selector_place">
				<% if (configuration.pickupReturnPlace) { %>

			    <!-- Return place -->
		      <label for="return_place">
						<?php echo esc_html_x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
					</label>

					<!-- List return place -->
		      <div class="widget_return_place_group">
		      	<select class="mb-form-control" name="return_place" id="widget_return_place"></select>
						<i class="mybooking-selector_field-icon fa fa-map-marker-alt"></i>
		      </div>

		      <!-- Custom delivery place -->
		      <div id="widget_another_return_place_group" style="display: none;">
						<button class="mybooking-selector_close-btn widget_another_return_place_group_close">
							<i class="fa fa-times"></i>
						</button>
		        <input class="mb-form-control" id="widget_return_place_other" type="text" name="return_place_other" />
		        <input type="hidden" name="custom_return_place" value="false" />
		      </div>

				<% } %>
			</div>

			<div class="mybooking-selector_date">

				<!-- Return date -->
				<div class="mybooking-selector_cal">
					<label for="date_to">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
					</label>
					<input type="text" class="mb-form-control" name="date_to" id="widget_date_to" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
					<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
				</div>

				<!-- Return time -->
				<% if (configuration.timeToFrom) { %>
					<div class="mybooking-selector_hour">
					<select class="mb-form-control" name="time_to" id="widget_time_to"></select>
					<i class="mybooking-selector_field-icon fa fa-clock"></i>
					</div>
				<% } else { %>
					<input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
				<% } %>
			</div>
		</div>


		<!-- FOOTER -->

		<div class="mybooking-selector_group mybooking-selector_footer">
			<!-- Location code selector -->
			<% if (not_hidden_rental_location_code && configuration.selectRentalLocation) { %>
		    <div class="widget_rental_location_code" style="display: none">
		      <label for="family_id">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
					</label>
		      <select name="family_id" id="widget_rental_location_code" class="mb-form-control"></select>
		    </div>
		  <% } %>

			<!-- Family selector -->
		  <% if (not_hidden_family_id && configuration.selectFamily) { %>
		    <div class="widget_family" style="display: none">
		      <label for="family_id">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
					</label>
		      <select name="family_id" id="widget_family_id" class="mb-form-control"></select>
		    </div>
	    <% } %>

			<!-- Promotion code -->
			<% if (configuration.promotionCode) { %>
				<div class="mybooking-selector_promo">
			    <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
				  <input type="text" class="mb-form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
				</div>
			<% } %>

			<!-- Search button -->
			<input style="text-align:center;" class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
		</div>

	<% } else { %>

	<div class="mybooking-selector_group inline">

			<!-- Location code selector -->
			<% if (not_hidden_rental_location_code && configuration.selectRentalLocation) { %>
				<div class="widget_rental_location" style="display: none">
					<label for="family_id">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
					</label>
					<select name="family_id" id="widget_rental_location_code" class="mb-form-control"></select>
					<i class="mybooking-selector_field-icon fa fa-map-marker-alt"></i>
				</div>
			<% } %>

			<!-- Pickup place -->
			<div class="mybooking-selector_cal">
				<label for="date_from">
					<?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
				</label>
				<input class="mb-form-control" name="date_from" id="widget_date_from" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
				<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
				<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
			</div>

			<!-- Pickup time -->
			<% if (configuration.timeToFrom) { %>
				<div class="mybooking-selector_hour">
					<select class="mb-form-control" id="widget_time_from" name="time_from"></select>
					<i class="mybooking-selector_field-icon fa fa-clock"></i>
				</div>
			<% } else { %>
				<input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
			<% } %>

			<!-- Return place -->
			<div class="mybooking-selector_cal">
				<label for="date_to">
					<?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
				</label>
				<input class="mb-form-control" name="date_to" id="widget_date_to" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
				<input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
				<i class="mybooking-selector_field-icon fa fa-calendar-alt"></i>
			</div>

			<!-- Return time -->
			<% if (configuration.timeToFrom) { %>
				<div class="mybooking-selector_hour">
					<select class="mb-form-control" name="time_to" id="widget_time_to"></select>
					<i class="mybooking-selector_field-icon fa fa-clock"></i>
				</div>
			<% } else { %>
				<input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
			<% } %>

			<!-- Family selector -->
			<% if (not_hidden_family_id && configuration.selectFamily) { %>
				<div class="widget_family" style="display: none">
					<label for="family_id">
						<?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
					</label>
					<select name="family_id" id="widget_family_id" class="mb-form-control"></select>
					<i class="mybooking-selector_field-icon fa fa-list-alt"></i>
				</div>
			<% } %>

			<!-- Promotion code -->
			<% if (configuration.promotionCode) { %>
				<div class="mybooking-selector_promo">
					<label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
					<input type="text" class="mb-form-control" name="promotion_code" id="widget_promotion_code" autocomplete="off">
				</div>
			<% } %>

		<!-- Search button -->
		<input style="text-align:center;" class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />

  <% } %>

</script>
