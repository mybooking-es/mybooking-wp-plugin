<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-tmpl.php
 *
 */
?>
<script type="text/tmpl" id="script_reservation_form">
  <form class="mybooking-form" id="form-reservation" name="booking_information_form" autocomplete="off" novalidate>

    <!-- // Alert form incomplete -->
    <% if (booking.contract_errors && booking.contract_errors.length) { %>
      <div class="mb-alert danger mb--txt-align_left">
        <strong><?php echo esc_html_x( 'Please fill in all the required fields', 'renting_my_reservation', 'mybooking-wp-plugin') ?></strong>
        <ul>
          <% Object.keys(booking.contract_errors).forEach(function(key) { %>
            <li><%= booking.contract_errors[key] %></li>
          <% }); %>
        </ul>
      </div>
    <% } %>

    <!-- Driver is customer check -->
    <div class="mb-section mb-panel-container">
      <% if (configuration.rentingFormFillDataDriverDetail && booking.driver_type == 'driver' && !booking.has_optional_external_driver && booking.customer_type != 'legal_entity') { %>
        <div class="mb-alert lighter text-left">
          <?php echo esc_html_x('The customer represents the contract holder. Typically, the driver is the contract holder.', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          <strong>
            <?php echo esc_html_x("Assign a different customer from the driver only if you want the contract to be under another person's name.", 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          </strong>
          <?php echo esc_html_x('This does not affect billing, as you can always request the invoice with different tax details than those on the contract.', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          <br /><br />
          <div class="mb-form-row">
            <label>
              <input type="checkbox" name="driver_is_customer" id="driver_is_customer" <% if (booking.driver_is_customer != false) { %>checked<% } %> <% if (!booking.can_edit_online){%>disabled<%}%>>
              &nbsp;
              <?php echo esc_html_x('The customer is the driver', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
            </label>
          </div>
        </div>
        
        <br />
      <% } %>

      <!-- // Customer  -->
      <div id="customer_panel_container"></div>
    </div>

    <!-- // Driver -->
		<div id="driver_panel_container" class="mb-section"></div>

    <% if (booking.driver_type == 'driver') { %>
      <!-- ADDITIONAL DRIVERS (NOT CHARTER) ----------------------------------------------------------->
      <? mybooking_engine_get_template('mybooking-plugin-reservation-form-additional-drivers-tmpl.php'); ?>
    <% } %>

    <!-- // Flight -->
    <? mybooking_engine_get_template('mybooking-plugin-reservation-form-flight-tmpl.php'); ?>

    <!-- // Named resources (KAYAK ETC) -->
		<? mybooking_engine_get_template('mybooking-plugin-reservation-form-named-resources-tmpl.php'); ?>

    <% if (booking.can_edit_online) { %>
      <button class="mb-button" id="btn_update_reservation">
          <?php echo esc_html_x( 'Update', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      </button>
    <% } %>
  </form>
</script>

<script type="text/tmpl" id="script_reservation_form_customer">
  <? mybooking_engine_get_template('mybooking-plugin-reservation-form-customer-tmpl.php'); ?>
</script>

<script type="text/tmpl" id="script_reservation_form_customer_driver">
  <? mybooking_engine_get_template('mybooking-plugin-reservation-form-customer-driver-tmpl.php'); ?>
</script>

<script type="text/tmpl" id="script_reservation_form_driver">
  <!-- // Drivers -->
  <!-- configuration.driver => The business accepts a driver or skipper (rent a car, motorbikes) -->
  <!-- optional_external_driver => The item is rented with a driver or skipper (the customer can not drive it) -->
  <% if (booking.driver_type == 'driver') { %>
    <!-- DRIVERS (NOT CHARTER) ----------------------------------------------------------->
    <? mybooking_engine_get_template('mybooking-plugin-reservation-form-driver-tmpl.php'); ?>
  <% } else if (booking.driver_type === 'skipper') { %>
    <!-- SKIPPER  (CHARTER) ----------------------------------------------------------->
    <? mybooking_engine_get_template('mybooking-plugin-reservation-form-skipper-tmpl.php'); ?>
  <% } %>
</script>