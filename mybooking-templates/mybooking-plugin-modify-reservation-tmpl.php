<?php
/**
 *   MYBOOKING ENGINE - MODIFY RESERVATION MODAL TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-modify-reservation-tmpl.php
 * 
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tmpl" id="form_selector_tmpl">

  <% if (!not_hidden_rental_location_code) { %>
    <input type="hidden" name="engine_fixed_rental_location" value="true"/>
    <input type="hidden" name="rental_location_code" value="<%=rental_location_code%>"/>
  <% } %>  

  <% if (!not_hidden_family_id) { %>
    <input type="hidden" name="engine_fixed_family" value="true"/>
    <input type="hidden" name="family_id" value="<%=family_id%>"/>
  <%  } %>

  <% if (configuration.pickupReturnPlace) { %>

    <!-- // PICKUP SECTION -->

    <div class="mybooking-selector_group">
      <div class="mybooking-selector_place">
        <% if (configuration.pickupReturnPlace) { %>

          <!-- // Delivery place -->
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-location"></span>
          </i>
          <label for="pickup_place">
            <?php echo esc_html_x( 'Pick-up place', 'renting_form_selector', 'mybooking-wp-plugin') ?>
          </label>

          <!-- // List pickup place -->
          <div class="pickup_place_group">
            <select class="mb-form-control" id="pickup_place" name="pickup_place" ></select>
          </div>

          <!-- // Custom delivery place -->
          <div id="another_pickup_place_group" style="display: none;">
            <button class="mybooking-selector_close-btn another_pickup_place_group_close">
              <span class="dashicons dashicons-dismiss"></span>
            </button>
            <input class="mb-form-control" id="pickup_place_other" type="text" name="pickup_place_other" />
            <input type="hidden" name="custom_pickup_place" value="false" />
          </div>

        <% } %>
      </div>

      <div class="mybooking-selector_date">

        <!-- // Pickup date -->
        <div class="mybooking-selector_cal">
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-calendar-alt"></span>
          </i>
          <label for="date_from">
            <?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
          </label>
          <input class="mb-form-control" type="text" name="date_from" id="date_from" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
        </div>

        <!-- // Pickup time -->
        <% if (configuration.timeToFrom) { %>
          <div class="mybooking-selector_hour">
            <i class="mybooking-selector_field-icon">
              <span class="dashicons dashicons-clock"></span>
            </i>
            <label for="time_from">
              <?php echo esc_html_x( 'Time', 'renting_form_selector', 'mybooking-wp-plugin') ?>
            </label>
            <select class="mb-form-control" id="time_from" name="time_from"></select>
          </div>
        <% } else { %>
          <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
        <% } %>
      </div>
    </div>


    <!-- // RETURN SECTION -->

    <div class="mybooking-selector_group">
      <div class="mybooking-selector_place">
        <% if (configuration.pickupReturnPlace) { %>

          <!-- // Return place -->
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-location"></span>
          </i>
          <label for="return_place">
            <?php echo esc_html_x( 'Return place', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
          </label>

          <!-- // List return place -->
          <div class="return_place_group">
            <select class="mb-form-control" name="return_place" id="return_place"></select>
          </div>

          <!-- // Custom delivery place -->
          <div id="another_return_place_group" style="display: none;">
            <button class="mybooking-selector_close-btn another_return_place_group_close">
              <span class="dashicons dashicons-dismiss"></span>
            </button>
            <input class="mb-form-control" id="return_place_other" type="text" name="return_place_other" />
            <input type="hidden" name="custom_return_place" value="false" />
          </div>

        <% } %>
      </div>

      <div class="mybooking-selector_date">
        <% if (configuration.rentDateSelector === 'date_from_duration') { %>
				  <!-- // Duration -->
					<div class="mybooking-selector_duration">
						<i class="mybooking-selector_field-icon">
							<span class="dashicons dashicons-clock"></span>
						</i>
						<label for="renting_duration">
							<?php echo esc_html_x( 'Duration', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
						</label>
						<select class="mb-form-control" id="renting_duration" name="renting_duration"></select>
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
            <input type="text" class="mb-form-control" name="date_to" id="date_to" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
          </div>

          <!-- // Return time -->
          <% if (configuration.timeToFrom) { %>
            <div class="mybooking-selector_hour">
              <i class="mybooking-selector_field-icon">
                <span class="dashicons dashicons-clock"></span>
              </i>
              <label for="time_from">
                <?php echo esc_html_x( 'Time', 'renting_form_selector', 'mybooking-wp-plugin') ?>
              </label>
              <select class="mb-form-control" name="time_to" id="time_to"></select>
            </div>
          <% } else { %>
            <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
          <% } %>
        <% } %>
      </div>
    </div>

    <!-- // FOOTER -->
    <div class="mybooking-selector_group mybooking-selector_footer">
      <!-- // Rental location selector - Location code selector -->
      <% if (not_hidden_rental_location_code && configuration.selectorRentalLocation) { %>
        <div class="mybooking-selector_location rental_location" style="display: none">
          <label for="rental_location_code">
            <?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
          </label>
          <select name="rental_location_code" id="rental_location_code" class="mb-form-control"></select>
        </div>
      <% } %>

      <!-- // Family selector -->
      <% if (not_hidden_family_id && configuration.selectFamily) { %>
        <div class="family mybooking-selector_family" style="display: none">
          <label for="family_id">
            <?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
          </label>
          <select name="family_id" id="family_id" class="mb-form-control"></select>
        </div>
      <% } %>

      <!-- // Category code -->

      <!-- Age code selector -->
			<div class="driver_age_rule mybooking-selector_driver_age" style="display: none">
				<label for="driver_age_rule_id">
				<?php echo esc_html_x( 'Age selector', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
				</label>
				<select name="driver_age_rule_id" id="driver_age_rule_id"></select>
			</div>

      <!-- // Promotion code -->
      <% if (configuration.promotionCode) { %>
        <div class="mybooking-selector_promo">
          <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
          <input type="text" class="mb-form-control" name="promotion_code" id="promotion_code" autocomplete="off">
        </div>
      <% } %>

      <!-- // Search button -->
      <div class="mybooking-selector_button-box">
        <label>&nbsp;</label>
        <input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
      </div>
    </div>

  <% } else { %>

    <div class="mybooking-selector_group mb-inline">
        <!--
        // Location code selector:
        // Opens .mybooking-selector_group
        // only when Locator or Family fields are activated
        -->
        <!-- Simple location -->
				<% if (not_hidden_rental_location_code && configuration.simpleLocation) { %>
          <div class="mybooking-selector_cal">
            <label for="simple_location_id">
              <?php echo esc_html_x( 'Where', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
            </label>
            <select class="mb-form-control" id="simple_location_id" name="simple_location_id" ></select>
          </div>
				<% } %>
				<!-- END Simple location -->

        <% if ( (not_hidden_rental_location_code && configuration.selectorRentalLocation) || 
                (not_hidden_family_id && configuration.selectFamily) ) { %>

          <div class="mybooking-selector_location rental_location" style="display: none">
            <i class="mybooking-selector_field-icon">
              <span class="dashicons dashicons-location"></span>
            </i>
            <label for="rental_location_code">
              <?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
            </label>
            <select name="rental_location_code" id="rental_location_code" class="mb-form-control"></select>
          </div>

        <% } %>

        <!-- // Pickup date -->
        <div class="mybooking-selector_cal">
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-calendar-alt"></span>
          </i>
          <label for="date_from">
            <?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
          </label>
          <input class="mb-form-control" name="date_from" id="date_from" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa"> 
        </div>

        <% if (configuration.timeToFrom) { %>
          <!-- // Pickup time -->
          <div class="mybooking-selector_hour">
            <i class="mybooking-selector_field-icon">
              <span class="dashicons dashicons-clock"></span>
            </i>
            <label for="time_from">
							<?php echo esc_html_x( 'Time', 'renting_form_selector', 'mybooking-wp-plugin') ?>
						</label>
            <select class="mb-form-control" id="time_from" name="time_from"></select>
          </div>
        <% } else { %>
          <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
        <% } %>

        <% if (configuration.rentDateSelector === 'date_from_date_to') { %>
          
          <!-- // Return Date -->
          <div class="mybooking-selector_cal">
            <i class="mybooking-selector_field-icon">
              <span class="dashicons dashicons-calendar-alt"></span>
            </i>
            <label for="date_to">
              <?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
            </label>
            <input class="mb-form-control" name="date_to" id="date_to" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
          </div>

          <!-- // Return time -->
          <% if (configuration.timeToFrom) { %>
            <div class="mybooking-selector_hour">
              <i class="mybooking-selector_field-icon">
                <span class="dashicons dashicons-backup"></span>
              </i>
              <label for="time_to">
                <?php echo esc_html_x( 'Time', 'renting_form_selector', 'mybooking-wp-plugin') ?>
              </label>
              <select class="mb-form-control" name="time_to" id="time_to"></select>
            </div>
          <% } else { %>
            <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
          <% } %>

        <% } else if (configuration.rentDateSelector === 'date_from_duration') { %>
          
          <!-- // Duration -->
          <div class="mybooking-selector_hour">
            <i class="mybooking-selector_field-icon">
              <span class="dashicons dashicons-clock"></span>
            </i>
            <label for="renting_duration">
              <?php echo esc_html_x( 'Duration', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
            </label>
            <select class="mb-form-control" id="renting_duration" name="renting_duration"></select>
          </div>
          
        <% } %>

      <!--
      // Closes div tag for .mybooking-selector_group
      // and opens a group for the footer
      // only when Locator or Family fields are activated
      -->
      <% if (not_hidden_rental_location_code && configuration.selectorRentalLocation || not_hidden_family_id && configuration.selectFamily ) { %>
        </div>
        <div class="mybooking-selector_group mybooking-selector_footer">
      <% } %>

      <!-- // Family selector -->
      <% if (not_hidden_family_id && configuration.selectFamily) { %>
        <div class="family mybooking-selector_family" style="display: none">
          <label for="family_id">
            <?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
          </label>
          <select name="family_id" id="family_id" class="mb-form-control"></select>
        </div>
      <% } %>

      <!-- Age code selector -->
			<div class="driver_age_rule mybooking-selector_driver_age" style="display: none">
				<label for="driver_age_rule_id">
				<?php echo esc_html_x( 'Age selector', 'renting_form_selector', 'mybooking-wp-plugin' ) ?>
				</label>
				<select name="driver_age_rule_id" id="driver_age_rule_id"></select>
			</div>

      <!-- // Promotion code -->
      <% if (configuration.promotionCode) { %>
        <div class="mybooking-selector_promo">
          <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
          <input type="text" class="mb-form-control" name="promotion_code" id="promotion_code" autocomplete="off">
        </div>
      <% } %>

      <!-- // Search button -->
      <div class="mybooking-selector_button-box">
        <label>&nbsp;</label>
        <input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
      </div>
    </div>

  <% } %>

</script>
