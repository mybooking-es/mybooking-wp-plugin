<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM CUSTOMER SKIPPER TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the customer data in the reservation process
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-customer-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<h3>
  <?php echo esc_html_x( 'Customer/Skipper', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
</h3>

<div class="mb-form-row">
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_name') ||
             required_fields.includes('driver_name')) { %>*<% } %>
    </label>
    <!-- Customer name -->
    <input class="mb-form-control" type="text" name="driver_name" autocomplete="off" 
           placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" 
           maxlength="40" value="<%=booking.driver_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>  
           <% if (required_fields.includes('customer_name') ||
                  required_fields.includes('driver_name')) { %>required<% } %>>
  </div>
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_surname') || required_fields.includes('driver_surname')) { %>*<% } %>
    </label>
    <!-- Customer surname -->
    <input class="mb-form-control" type="text" name="driver_surname" autocomplete="off" 
           placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" maxlength="40" 
           value="<%=booking.driver_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%> 
           <% if (required_fields.includes('customer_surname') || required_fields.includes('driver_surname')) { %>required<% } %>>
  </div>
</div>

<div class="mb-form-row">
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_email')) { %>*<% } %>
    </label>
    <input class="mb-form-control" type="text" name="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>" maxlength="50" value="<%=booking.customer_email%>" 
          <% if (!booking.can_edit_online || (typeof booking.customer_email !== 'undefined' && booking.customer_email !== null && booking.customer_email != '')){%>disabled<%}%> <% if (required_fields.includes('customer_email')) { %>required<% } %>>
  </div>
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_phone')) { %>*<% } %>
    </label>
    <input class="mb-form-control" type="text" name="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>" maxlength="15" value="<%=booking.customer_phone%>" 
    <% if (!booking.can_edit_online || (typeof booking.customer_phone !== 'undefined' && booking.customer_phone !== null && booking.customer_phone != '')){%>disabled<%}%> <% if (required_fields.includes('customer_phone')) { %>required<% } %>>
  </div>
</div>

<div class="mb-form-row">
  <div class="mb-form-group mb-col-md-12">
    <label>
      <?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('driver_nacionality')) { %>*<% } %>
    </label>
    <!-- Customer nacionality -->
    <select name="driver_nacionality" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_nacionality')) { %>required<% } %>></select>
  </div>
</div>

<h6>
  <?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
</h6>
<hr />

<div class="mb-form-row">
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_document_id_type_id') ||
             required_fields.includes('driver_document_id_type_id')) { %>*<% } %>
    </label>
    <!-- Customer document type -->
    <select name="driver_document_id_type_id" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_document_id_type_id')) { %>required<% } %>></select>
  </div>
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_document_id') ||
             required_fields.includes('driver_document_id')) { %>*<% } %>
    </label>
    <!-- Customer document  -->
    <input class="mb-form-control" type="text" name="driver_document_id" id="customer_driver_document_id"
     autocomplete="off" placeholder="<?php echo esc_attr_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" value="<%=booking.driver_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('driver_document_id')) { %>required<% } %>>
  </div>
</div>

<!-- // Address (an address is always required to billing system) -->
<h6>
  <?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
</h6>
<hr />

<!-- // Address -->
<div class="mb-form-row">
  <!-- Country -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[country]') || 
						 required_fields.includes('driver_address[country]')) { %>*<% } %>
    </label>
    <select name="driver_address[country]" class="mb-form-control" 
      <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[country]') || 
             required_fields.includes('driver_address[country]')) { %>*<% } %>
      data-state-selector-name=".driver_address_state_code_container"
      data-state-input-name="input[name=driver_address\\[state\\]]"
      data-city-selector-name=".driver_address_city_code_container"
      data-city-input-name="input[name=driver_address\\[city\\]]">
    </select>
  </div>

  <!-- State (required applied by JS because there are two fields) -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[state]')) { %>*<% } %>
    </label>
    <% if (configuration.sesHospedajes) { %>
      <div class="driver_address_state_code_container"
           <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%>>
        <select id="driver_address[state_code]" name="driver_address[state_code]" class="mb-form-control" 
          <% if (!booking.can_edit_online){%>disabled<%}%> 
          data-select-name="driver_address[city_code]" 
          data-select-value="driver_city_code"
          data-code-value="<%=booking.driver_address_state_code%>"
          data-text-value="<%=booking.driver_address_state%>">
        </select>
      </div>
    <% } %>
    <input class="mb-form-control" name="driver_address[state]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_state%>"  maxlength="60" 
      <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
  </div>
</div>

<div class="mb-form-row">
    <!-- City (required applied by JS because there are two fields) -->
    <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[city]')) { %>*<% } %>
    </label>
    <% if (configuration.sesHospedajes) { %>
      <div class="driver_address_city_code_container" 
           <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%>>
        <select id="driver_address[city_code]" name="driver_address[city_code]" class="mb-form-control" 
          <% if (!booking.can_edit_online || !booking.driver_address_state_code || booking.driver_address_state_code == ''){%>disabled<%}%> 
          data-code-value="<%=booking.driver_address_city_code%>"
          data-text-value="<%=booking.driver_address_city%>">
        </select>
      </div>
    <% } %>
    <input class="mb-form-control" name="driver_address[city]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_city%>" maxlength="60" 
      <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
  </div>

  <!-- Zip -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[zip]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="driver_address[zip]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
      value="<%=booking.address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[zip]')) { %>required<% } %>>
  </div>
</div>

<div class="mb-form-row">
  <!-- Street -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('driver_address[street]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="driver_address[street]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('driver_address[street]')) { %>required<% } %>>
  </div>

  <!-- Number -->
  <div class="mb-form-group mb-col-md-3">
    <label>
      <?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[number]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="driver_address[number]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[number]')) { %>required<% } %>>
  </div>

  <!-- Complement -->
  <div class="mb-form-group mb-col-md-3">
    <label>
      <?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[complement]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="driver_address[complement]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
      value="<%=booking.address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[complement]')) { %>required<% } %>>
  </div>
</div>

<!-- // Skipper data (if the boat requires a license) -->
<% if (typeof booking.item_driving_license_type_name !== 'undefined' && 
       booking.item_driving_license_type_name) { %>
  <h6>
    <?php echo esc_html_x( 'Skipper data', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
  </h6>
  <hr />

  <div class="mb-form-row">
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
      <label
        for="driver_driving_license_type"><?php echo esc_html_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('driver_driving_license_type')) { %>*<% } %></label>
      <input class="form-control" id="driver_driving_license_type" name="driver_driving_license_type"
        type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
        value="<%=booking.driver_driving_license_type%>"
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>
        <% if (required_fields.includes('driver_driving_license_type')) { %>required<% } %>>
      </div>

      <div class="mb-form-group mb-col-md-6">
      <label
        for="driver_driving_license_number"><?php echo esc_html_x('Navigation license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('driver_driving_license_type')) { %>*<% } %>
      </label>
      <input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
        type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
        value="<%=booking.driver_driving_license_number%>"
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>
        <% if (required_fields.includes('driver_driving_license_number')) { %>required<% } %>>
      </div>
    </div>
  </div>
<% } %>