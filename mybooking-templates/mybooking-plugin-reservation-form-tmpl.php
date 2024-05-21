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
  <form class="mybooking-form" id="form-reservation" name="booking_information_form" autocomplete="off">

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

    <!-- // Customer  -->
    <? mybooking_engine_get_template('mybooking-plugin-reservation-form-customer-tmpl.php'); ?>

    <!-- // Drivers -->
		<% if (!booking.has_optional_external_driver) { %>
      <% if (booking.driver_type == 'driver') { %>
        <!-- DRIVERS (NOT CHARTER) ----------------------------------------------------------->
        <? mybooking_engine_get_template('mybooking-plugin-reservation-form-drivers-tmpl.php'); ?>
      <% } else if (booking.driver_type === 'skipper') { %>
        <!-- SKIPPER  (CHARTER) ----------------------------------------------------------->
        <? mybooking_engine_get_template('mybooking-plugin-reservation-form-skipper-tmpl.php'); ?>
      <% } %>
		<% } %>

    <!-- // Flight -->
    <% if (configuration.rentingFromFillDataFlight) { %>
      <? mybooking_engine_get_template('mybooking-plugin-reservation-form-flight-tmpl.php'); ?>
    <% } %>

    <!-- // Named resources (KAYAK ETC) -->
    <% if (configuration.rentingFormFillDataNamedResources) { %>
			<? mybooking_engine_get_template('mybooking-plugin-reservation-form-named-resources-tmpl.php'); ?>
    <% } %>

    <% if (booking.can_edit_online) { %>
      <button class="mb-button" id="btn_update_reservation">
          <?php echo esc_html_x( 'Update', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      </button>
    <% } %>
  </form>
</script>