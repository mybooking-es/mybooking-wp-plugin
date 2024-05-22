<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM CUSTOMER TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the customer data in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-customer-tmpl.php
 *
 */
?>
<div class="mb-section mb-panel-container">
  <!-- Custom type company -->
  <% if (booking.customer_type == 'legal_entity') { %>
    <h3>
      <?php echo esc_html_x( 'Customer', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h3>

    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*
        </label>
        <input class="mb-form-control" type="text" name="customer_company_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'VAT Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*
        </label>
        <input class="mb-form-control" type="text" name="customer_company_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
  <% } %>
  <!-- End custom type company -->

  <!-- Driver is customer check -->
  <% if (configuration.rentingFormFillDataDriverDetail && !booking.has_optional_external_driver && booking.customer_type != 'legal_entity') { %>
    <div class="mb-form-row">
      <label for="driver_is_customer">
        <input type="checkbox" name="driver_is_customer" id="driver_is_customer" <% if (booking.driver_is_customer != false) { %>checked<% } %> <% if (!booking.can_edit_online){%>disabled<%}%> data-panel="driver_panel">
        &nbsp;
        <?php echo esc_html_x('The customer is the driver', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      </label>
    </div>
    <br />
  <% } %>
  
  <% if (booking.customer_type != 'legal_entity') { %>
    <h3 <% if (booking.driver_is_customer) { %>style="display: none;"<% } %> class="js-driver-is-customer-off">
      <?php echo esc_html_x( 'Customer', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h3>
  <% } %>

  <h3 <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %> class="js-driver-is-customer-on">
    <?php echo esc_html( MyBookingEngineContext::getInstance()->getDriver() ) ?>
  </h3>

  <!-- Custom type individual -->
  <% if (booking.customer_type != 'legal_entity') { %>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*
        </label>
        <!-- Customer name -->
        <input class="mb-form-control js-driver-is-customer-off" type="text" name="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>  <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
        <!-- Driver name -->
        <input class="form-control js-driver-is-customer-on" name="driver_name" type="text"
              placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
              maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>  <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*
        </label>
        <!-- Customer surname -->
        <input class="mb-form-control js-driver-is-customer-off" type="text" name="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>  <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
        <!-- Driver surname -->
        <input class="form-control js-driver-is-customer-on" name="driver_surname" type="text"
              placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
              maxlength="40" <% if (!booking.can_edit_online ){%>disabled<%}%>  <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
      </div>
    </div>

    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*
        </label>
        <input class="mb-form-control" type="text" name="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50" value="<%=booking.customer_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*
        </label>
        <input class="mb-form-control" type="text" name="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15" value="<%=booking.customer_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>

    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6 js-driver-is-customer-on js-date-select-control" <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
        <label>
          <?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <div class="mb-form-row mb-custom-date-form">
          <div class="mb-custom-date-item">
            <select name="driver_date_of_birth_day"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_date_of_birth_month"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_date_of_birth_year"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="driver_date_of_birth"></input>
      </div>
      <div class="mb-form-group <% if (booking.driver_is_customer) { %>mb-col-md-6<% } else { %>mb-col-md-12<% } %>">
        <label>
          <?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <!-- Customer nacionality -->
        <select name="customer_nacionality" class="mb-form-control js-driver-is-customer-off" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>></select>
        <!-- Driver nacionality -->
        <select name="driver_nacionality" class="form-control js-driver-is-customer-on" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>></select>
      </div>
    </div>

    <h6>
      <?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h6>
    <hr />

    <div class="mb-form-row">
      <div class="mb-form-group <% if (!booking.driver_is_customer) { %>mb-col-md-6<% } else { %>mb-col-md-4<% } %>">
        <label>
          <?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <!-- Customer document type -->
        <select name="customer_document_id_type_id" class="mb-form-control js-driver-is-customer-off" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>></select>
        <!-- Driver document type -->
        <select name="driver_document_id_type_id" class="form-control js-driver-is-customer-on" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>></select>
      </div>
      <div class="mb-form-group <% if (!booking.driver_is_customer) { %>mb-col-md-6<% } else { %>mb-col-md-4<% } %>">
        <label>
          <?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*
        </label>
        <!-- Customer document type -->
        <!-- TODO dni validation -->
        <input class="mb-form-control js-driver-is-customer-off" type="text" name="customer_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" value="<%=booking.customer_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
        <!-- Driver document type -->
        <input class="form-control js-driver-is-customer-on" name="driver_document_id" type="text"
              placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
              maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
      </div>
      <!-- Driver origin country -->
      <div class="mb-form-group mb-col-md-4 js-driver-is-customer-on" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
        <label><?php echo esc_html_x( 'Driving expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <select name="driver_origin_country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
      </div>
    </div>

    <div class="mb-form-row js-driver-is-customer-on" <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %>>
      <div class="mb-form-group mb-col-md-6 js-date-select-control">
        <label>
          <?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <div class="mb-form-row mb-custom-date-form">
          <div class="mb-custom-date-item">
            <select name="driver_document_id_date_day"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_document_id_date_month"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_document_id_date_year"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="driver_document_id_date"></input>
      </div>
      <div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
        <label>
          <?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <div class="mb-form-row mb-custom-date-form">
          <div class="mb-custom-date-item">
            <select name="driver_document_id_expiration_date_day"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_document_id_expiration_date_month"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_document_id_expiration_date_year"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="driver_document_id_expiration_date"></input>
      </div>
    </div>
  <% } %>
  <!-- End custom type individual -->

  <div <% if (!booking.driver_is_customer) { %>style="display: none;"<% } %> class="js-driver-is-customer-on">
    <h6>
      <%=configuration.escapeHtml("<?php echo esc_attr_x('License', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>
    </h6>
    <hr />
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-4">
        <label>
          <?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <select name="driver_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
      </div>
      <div class="mb-form-group mb-col-md-4">
        <label>
          <?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_driving_license_number"
          type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
          value="<%=booking.driver_driving_license_number%>"
          maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-4">
        <label>
          <?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <select name="driver_driving_license_country" class="form-control"
          <% if (!booking.can_edit_online){%>disabled<%}%>>
        </select>
      </div>                
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6 js-date-select-control">
        <label>
          <?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <div class="mb-form-row mb-custom-date-form">
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_date_day"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_date_month"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_date_year"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="driver_driving_license_date"></input>
      </div>
      <div class="mb-form-group mb-col-md-6 js-date-select-control" data-date-select-control-direction="future">
        <label>
          <?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <div class="mb-form-row mb-custom-date-form">
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_expiration_date_day"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_expiration_date_month"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="mb-custom-date-item">
            <select name="driver_driving_license_expiration_date_year"
              class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="driver_driving_license_expiration_date"></input>
      </div>
    </div>
  </div>

  <!-- // Address (an address is always required to billing system) -->
  <h6>
    <?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
  </h6>
  <hr />
  
  <div <% if (!booking.driver_is_customer || booking.customer_type == 'legal_entity') { %>style="display: block;"<% } else { %>style="display: none;"<% } %> class="js-driver-is-customer-off">
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[street]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label>
          <?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[number]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label>
          <?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[complement]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[city]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[state]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <select name="customer_address[country]" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
        </select>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="mb-form-control" name="customer_address[zip]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
  </div>
  <div <% if (booking.driver_is_customer && booking.customer_type != 'legal_entity') { %>style="display: block;"<% } else { %>style="display: none;"<% } %> class="js-driver-is-customer-on">
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_address[street]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label>
          <?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_address[number]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label>
          <?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_address[complement]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_address[city]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for=driver_address_state"><?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="form-control" name="driver_address[state]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <select name="driver_address[country]" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
        </select>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label>
          <?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" name="driver_address[zip]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
  </div>
</div>