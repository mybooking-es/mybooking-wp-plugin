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
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<h3>
  <?php echo esc_html_x( 'Customer', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
</h3>

<% if (booking.customer_type == 'legal_entity') { %>
  <!-- Custom type company -->
  <div class="mb-form-row">
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_company_name')) { %>*<% } %>
      </label>
      <input class="mb-form-control" type="text" name="customer_company_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" maxlength="40" value="<%=booking.customer_company_name%>" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_company_name')) { %>required<% } %>>
    </div>
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'VAT Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_company_document_id')) { %>*<% } %>
      </label>
      <input class="mb-form-control" type="text" name="customer_company_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company VAT Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" maxlength="40" value="<%=booking.customer_company_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_company_document_id')) { %>required<% } %>>
    </div>
  </div>
  <!-- End custom type company -->

  <!-- Custom contact information -->
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
  <!-- End custom contact information -->
<% } else { %>
  <!-- Custom type individual -->
  <div class="mb-form-row">
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_name')) { %>*<% } %>
      </label>
      <!-- Customer name -->
      <input class="mb-form-control" type="text" name="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" maxlength="40" value="<%=booking.customer_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>  <% if (required_fields.includes('customer_name')) { %>required<% } %>>
    </div>
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_surname')) { %>*<% } %>
      </label>
      <!-- Customer surname -->
      <input class="mb-form-control" type="text" name="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" maxlength="40" value="<%=booking.customer_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>  <% if (required_fields.includes('customer_surname')) { %>required<% } %>>
    </div>
  </div>

  <div class="mb-form-row">
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_email')) { %>*<% } %>
      </label>
      <input class="mb-form-control" type="text" name="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>" maxlength="50" value="<%=booking.customer_email%>" 
            <% if (!booking.can_edit_online || (typeof booking.customer_email !== 'undefined' && booking.customer_email != '')){%>disabled<%}%> <% if (required_fields.includes('customer_email')) { %>required<% } %>>
    </div>
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_phone')) { %>*<% } %>
      </label>
      <input class="mb-form-control" type="text" name="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>" maxlength="15" value="<%=booking.customer_phone%>" 
      <% if (!booking.can_edit_online || (typeof booking.customer_phone !== 'undefined' && booking.customer_phone != '')){%>disabled<%}%> <% if (required_fields.includes('customer_phone')) { %>required<% } %>>
    </div>
  </div>

  <div class="mb-form-row">

    <div class="mb-form-group mb-col-md-6 js-date-select-control">
      <label>
        <?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_date_of_birth')) { %>*<% } %>
      </label>
      <div class="mb-form-row mb-custom-date-form">
        <div class="mb-custom-date-item">
          <select name="customer_date_of_birth_day"
            class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
        </div>
        <div class="mb-custom-date-item">
          <select name="customer_date_of_birth_month"
            class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
        </div>
        <div class="mb-custom-date-item">
          <select name="customer_date_of_birth_year"
            class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
        </div>
      </div>
      <input type="hidden" name="customer_date_of_birth" <% if (required_fields.includes('customer_date_of_birth')) { %>required<% } %>>
    </div>

    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_nacionality')) { %>*<% } %>
      </label>
      <!-- Customer nacionality -->
      <select name="customer_nacionality" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_nacionality')) { %>required<% } %>></select>
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
        <% if (required_fields.includes('customer_document_id_type_id')) { %>*<% } %>
      </label>
      <!-- Customer document type -->
      <select name="customer_document_id_type_id" class="mb-form-control" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_document_id_type_id')) { %>required<% } %>></select>
    </div>
    <div class="mb-form-group mb-col-md-6">
      <label>
        <?php echo esc_html_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        <% if (required_fields.includes('customer_document_id')) { %>*<% } %>
      </label>
      <!-- Customer document type -->
      <input class="mb-form-control" type="text" name="customer_document_id" id="customer_document_id"
        autocomplete="off" placeholder="<?php echo esc_attr_x( 'ID card/passport number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" value="<%=booking.customer_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_document_id')) { %>required<% } %>>
    </div>
  </div>
  <!-- End custom type individual -->
<% } %>

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
      <% if (required_fields.includes('customer_address[country]')) { %>*<% } %>
    </label>
    <select name="customer_address[country]" class="mb-form-control" 
      <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[country]')) { %>required<% } %> 
      data-state-selector-name=".customer_address_state_code_container"
      data-state-input-name="input[name=customer_address\\[state\\]]"
      data-city-selector-name=".customer_address_city_code_container"
      data-city-input-name="input[name=customer_address\\[city\\]]">
    </select>
  </div>

  <!-- State -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[state]')) { %>*<% } %>
    </label>
    <% if (configuration.sesHospedajes) { %>
      <div class="customer_address_state_code_container"
           <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%> >
        <select id="customer_address[state_code]" name="customer_address[state_code]" class="mb-form-control" 
          <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[state_code]')) { %>required<% } %>
          data-select-name="customer_address[city_code]" 
          data-select-value="address_city_code"
          data-code-value="<%=booking.address_state_code%>"
          data-text-value="<%=booking.address_state%>">
        </select>
      </div>
    <% } %>
    <input class="mb-form-control" name="customer_address[state]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_state%>"  maxlength="60" 
      <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[state]')) { %>required<% } %> 
      <% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
  </div>
</div>

<div class="mb-form-row">
  <!-- City -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[city]')) { %>*<% } %>
    </label>
    <% if (configuration.sesHospedajes) { %>
      <div class="customer_address_city_code_container" 
           <% if (booking.address_country !== 'ES') { %>style="display: none;"<%}%>>
        <select id="customer_address[city_code]" name="customer_address[city_code]" class="mb-form-control" 
          <% if (!booking.can_edit_online || !booking.address_state_code || booking.address_state_code == ''){%>disabled<%}%> 
          <% if (required_fields.includes('customer_address[city_code]')) { %>required<% } %> 
          data-code-value="<%=booking.address_city_code%>"
          data-text-value="<%=booking.address_city%>">
        </select>
      </div>
    <% } %>
    <input class="mb-form-control" name="customer_address[city]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
      value="<%=booking.address_city%>" maxlength="60" 
      <% if (!booking.can_edit_online){%>disabled<%}%> 
      <% if (required_fields.includes('customer_address[city]')) { %>required<% } %> 
      <% if (configuration.sesHospedajes && booking.address_country === 'ES') { %>style="display: none;"<%}%>>
  </div>

  <!-- Zip -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[zip]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="customer_address[zip]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[zip]')) { %>required<% } %>>
  </div>
</div>

<div class="mb-form-row">
  <!-- Street -->
  <div class="mb-form-group mb-col-md-6">
    <label>
      <?php echo esc_html_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[street]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="customer_address[street]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Street', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[street]')) { %>required<% } %>>
  </div>

  <!-- Number -->
  <div class="mb-form-group mb-col-md-3">
    <label>
      <?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[number]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="customer_address[number]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[number]')) { %>required<% } %>>
  </div>

  <!-- Complement -->
  <div class="mb-form-group mb-col-md-3">
    <label>
      <?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      <% if (required_fields.includes('customer_address[complement]')) { %>*<% } %>
    </label>
    <input class="mb-form-control" name="customer_address[complement]" type="text"
      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%> <% if (required_fields.includes('customer_address[complement]')) { %>required<% } %>>
  </div>
</div>