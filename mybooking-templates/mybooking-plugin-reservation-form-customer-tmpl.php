<div class="mb-section mb-panel-container">
  <h3>
    <?php echo esc_html_x( 'Customer', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
  </h3>

  <% if ( booking.customer_type == 'individual' ) { %>
    <!-- Custom type individual -->
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
        <input class="mb-form-control" type="text" name="customer_name" id="customer_name" required autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
        <input class="mb-form-control" type="text" name="customer_surname" id="customer_surname" required autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-4">
        <label for="customer_document_id_type_id"><?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <select name="customer_document_id_type_id" id="customer_document_id_type_id" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
      </div>
      <div class="mb-form-group mb-col-md-4">
        <label for="customer_document_id"><?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
        <!-- TODO dni validation -->
        <input class="mb-form-control" type="text" name="customer_document_id" id="customer_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" value="<%=booking.customer_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-4">
        <label for="customer_nacionality"><?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <select name="customer_nacionality" id="customer_nacionality" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
      </div>
    </div>
  <% } else { %>
    <!-- Custom type company -->
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="customer_company_name"><?php echo esc_html_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
        <input class="mb-form-control" type="text" name="customer_company_name" id="customer_company_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="customer_company_document_id"><?php echo esc_html_x( 'Company ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
        <input class="mb-form-control" type="text" name="customer_company_document_id" id="customer_company_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
  <% } %>
  <div class="mb-form-row">
    <div class="mb-form-group mb-col-md-6">
      <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
      <input class="mb-form-control" type="text" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50" value="<%=booking.customer_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
    </div>
    <div class="mb-form-group mb-col-md-6">
      <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
      <input class="mb-form-control" type="text" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15" value="<%=booking.customer_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
    </div>
  </div>

  <!-- // Address -->
  <% if (configuration.rentingFormFillDataAddress) { %>
    <h6>
      <?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h6>
    <hr />
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="street"><?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="street" name="customer_address[street]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label for="number"><?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="number" name="customer_address[number]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-3">
        <label for="complement"><?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="complement" name="customer_address[complement]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="city"><?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="city" name="customer_address[city]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="state"><?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="state" name="customer_address[state]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="country"><?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <select name="customer_address[country]" id="country" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
        </select>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="zip"><?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
        <input class="mb-form-control" id="zip" name="customer_address[zip]" type="text"
          placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
  <% } %>
</div>