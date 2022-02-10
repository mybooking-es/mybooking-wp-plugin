<?php
/**
 *   MYBOOKING ENGINE - MODIFY RESERVATION MODAL TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-modify-reservation-tmpl.php
 *
 */
?>

<script type="text/tmpl" id="form_selector_tmpl">

<% if (configuration.pickupReturnPlace && configuration.timeToFrom) { %>

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
            <i class="fa fa-times">
              <span class="dashicons dashicons-dismiss"></span>
            </i>
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
            <i class="fa fa-times">
              <span class="dashicons dashicons-dismiss"></span>
            </i>
          </button>
          <input class="mb-form-control" id="return_place_other" type="text" name="return_place_other" />
          <input type="hidden" name="custom_return_place" value="false" />
        </div>

      <% } %>
    </div>

    <div class="mybooking-selector_date">

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
          <select class="mb-form-control" name="time_to" id="time_to"></select>
        </div>
      <% } else { %>
        <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
      <% } %>
    </div>
  </div>


  <!-- // FOOTER -->

  <div class="mybooking-selector_group mybooking-selector_footer">

    <!-- // Location code selector -->
    <% if (not_hidden_rental_location_code && configuration.selectRentalLocation) { %>
      <div class="rental_location" style="display: none">
        <label for="location_code">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
        </label>
        <select name="location_code" id="rental_location_code" class="mb-form-control"></select>
      </div>
    <% } %>

    <!-- // Family selector -->
    <% if (not_hidden_family_id && configuration.selectFamily) { %>
      <div class="family" style="display: none">
        <i class="mybooking-selector_field-icon fa fa-list-alt">
          <span class="dashicons dashicons-list-view"></span>
        </i>
        <label for="family_id">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
        </label>
        <select name="family_id" id="family_id" class="mb-form-control"></select>
      </div>
    <% } %>

    <!-- // Category code -->

    <!-- // Promotion code -->
    <% if (configuration.promotionCode) { %>
      <div class="mybooking-selector_promo">
        <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
        <input type="text" class="mb-form-control" name="promotion_code" id="promotion_code" autocomplete="off">
      </div>
    <% } %>

    <!-- // Search button -->
    <input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
  </div>

<% } else { %>

    <!--
    // Location code selector:
    // Opens .mybooking-selector_group
    // only when Locator or Family fields are activated
    -->
    <% if (not_hidden_rental_location_code && configuration.selectRentalLocation || not_hidden_family_id && configuration.selectFamily ) { %>

    <div class="mybooking-selector_group mb-inline">

      <div class="mybooking-selector_location rental_location" style="display: none">
        <i class="mybooking-selector_field-icon">
          <span class="dashicons dashicons-location"></span>
        </i>
        <label for="location_code">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getRentalLocation() ) ?>
        </label>
        <select name="location_code" id="rental_location_code" class="mb-form-control"></select>
      </div>
    <% } else { %>

    <!--
    // When the above is not active
    // we need to encapsulate all fields
    -->
    <div class="mybooking-selector_group mb-inline">
    <% } %>

      <!-- // Pickup place -->
      <div class="mybooking-selector_cal">
        <i class="mybooking-selector_field-icon">
          <span class="dashicons dashicons-calendar-alt"></span>
        </i>
        <label for="date_from">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getDeliveryDate() ) ?>
        </label>
        <input class="mb-form-control" name="date_from" id="date_from" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
        <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
      </div>

      <!-- // Pickup time -->
      <% if (configuration.timeToFrom) { %>
        <div class="mybooking-selector_hour">
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-clock"></span>
          </i>
          <select class="mb-form-control" id="time_from" name="time_from"></select>
        </div>
      <% } else { %>
        <input type="hidden" name="time_from" value="<%=configuration.defaultTimeStart%>"/>
      <% } %>

      <!-- // Return place -->
      <div class="mybooking-selector_cal">
        <i class="mybooking-selector_field-icon">
          <span class="dashicons dashicons-calendar-alt"></span>
        </i>
        <label for="date_to">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getCollectionDate() ) ?>
        </label>
        <input class="mb-form-control" name="date_to" id="date_to" type="text" autocomplete="off" readonly="true" placeholder="dd/mm/aa">
        <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
      </div>

      <!-- // Return time -->
      <% if (configuration.timeToFrom) { %>
        <div class="mybooking-selector_hour">
          <i class="mybooking-selector_field-icon">
            <span class="dashicons dashicons-clock"></span>
          </i>
          <select class="mb-form-control" name="time_to" id="time_to"></select>
        </div>
      <% } else { %>
        <input type="hidden" name="time_to" value="<%=configuration.defaultTimeEnd%>"/>
      <% } %>


    <!--
    // Closes div tag for .mybooking-selector_group
    // and opens a group for the footer
    // only when Locator or Family fields are activated
    -->
    <% if (not_hidden_rental_location_code && configuration.selectRentalLocation || not_hidden_family_id && configuration.selectFamily ) { %>
      </div>
      <div class="mybooking-selector_group mybooking-selector_footer">
    <% } %>

    <!-- // Family selector -->
    <% if (not_hidden_family_id && configuration.selectFamily) { %>
      <div class="family" style="display: none">
        <i class="mybooking-selector_field-icon fa fa-list-alt">
          <span class="dashicons dashicons-list-view"></span>
        </i>
        <label for="family_id">
          <?php echo esc_html( MyBookingEngineContext::getInstance()->getFamily() ) ?>
        </label>
        <select name="family_id" id="family_id" class="mb-form-control"></select>
      </div>
    <% } %>

    <!-- // Promotion code -->
    <% if (configuration.promotionCode) { %>
      <div class="mybooking-selector_promo">
        <label for="promotion_code"><?php echo esc_html_x( 'Promotion code', 'renting_form_selector', 'mybooking-wp-plugin' ) ?></label>
        <input type="text" class="mb-form-control" name="promotion_code" id="promotion_code" autocomplete="off">
      </div>
    <% } %>

    <!-- // Search button -->
    <input class="mb-button mybooking-selector_button" type="submit" value="<?php echo esc_html_x( 'Search', 'renting_form_selector', 'mybooking-wp-plugin') ?>" />
  </div>

<% } %>

</script>
