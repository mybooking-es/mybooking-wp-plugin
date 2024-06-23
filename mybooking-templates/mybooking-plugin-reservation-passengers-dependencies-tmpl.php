<?php
/**
 *   MYBOOKING ENGINE - RESERVATION  PASSENGERS DEPENDENCIES TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the passengers dependencies information
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-passengers-dependencies-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_passengers_table">
  <div id="passengers_list">
    <div id="passengers_list__not_data" style="display:none;">
      <?php echo esc_html_x('No passengers found in reservation', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
    </div>
    <div id="passengers_list__content">
    </div>
</script>

<script type="text/tmpl" id="script_passengers_form">
  <br />
  <div id="passengers_error" class="alert alert-danger" style="display: none;"></div>
  <form id="booking_passengers_form" name="booking_passengers_form"> 
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="passenger_name">
          <?php echo esc_html_x('Name', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
          *
        </label>
        <input class="form-control" id="passenger_name" name="passenger_name" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x("Name", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>"
        value=""
        maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="">
          <?php echo esc_html_x('Surname', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
          *
        </label>
        <input class="form-control" id="passenger_surname" name="passenger_surname" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x("Surname", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>" value=""
        maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-12">
        <label for="passenger_document_id">
          <?php echo esc_html_x('ID card/passport number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
          *
        </label>
        <input class="form-control" id="passenger_document_id" name="passenger_document_id" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x("ID card/passport number", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>" value=""
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-6">
        <label for="passenger_email">
          <?php echo esc_html_x('Email address', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" id="passenger_email" name="passenger_email" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x('Email address', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>"
        value=""
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="passenger_phone_number">
          <?php echo esc_html_x('Phone number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" id="passenger_phone_number" name="passenger_phone_number" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x('Phone number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>"
        value=""
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-md-12">
        <label for="passenger_notes">
          <?php echo esc_html_x('Notes', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </label>
        <input class="form-control" id="passenger_notes" name="passenger_notes" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x('Notes', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>"
        value=""
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
    </div>

    <div id="booking_passengers_form_errors" class="mb-alert danger" style="display:none;"></div>

    <div class="mb-card_footer" style="margin: 0 -1rem;">
      <button class="mb-button" id="btn_add_passenger" <% if (!booking.can_edit_online){%>disabled<%}%>>
        <?php echo esc_html_x('Add a new passenger', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
      </button>
    </div>
  </form>
</script>

<script type="text/tmpl" id="script_passengers_list__item">
  <div style="padding: 0.5rem 0; font-size: 14px; clear:both;">
    <div class="mb-form-row" style="display: flex; align-items: center; justify-content: flex-start;">
      <div class="mb-form-group mb-col-sm-1" style="width: 5%; margin-right: 1rem;">
        <span class="mb-badge info" style="position: relative; top: -0.1rem;"><%= index %></span>
      </div>
      <div class="mb-form-group mb-col-sm-9" style="width: 85%;">
        <h6 style="margin: 0;">
          <%= passenger.name %> <%= passenger.surname %> 
        </h6>
      </div>
      <div class="mb-form-group mb-col-sm-2" style="width: 10%;">
        <button class="float-right btn_remove_passenger" title="<?php echo esc_attr_x("Remove", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>" data-id="<%= passenger.id %>" data-name="<%= passenger.name %> <%= passenger.surname %>">
          <i class="mb-button icon" style="opacity: 0.6;"><span class="dashicons dashicons-trash"></span></i>
        </button>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-sm-12 mb-col-md-4">
        <b>
          <?php echo esc_html_x('ID card/passport number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <%= passenger.document_id %>
      </div>
      <div class="mb-form-group mb-col-sm-12 mb-col-md-4">
        <b>
          <?php echo esc_html_x('Email address', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <% if (passenger.email && passenger.email != '') { %>
          <%= passenger.email %>
        <% } else { %>
          -
        <% } %>
      </div>
      <div class="mb-form-group mb-col-sm-12 mb-col-md-4">
        <b>
          <?php echo esc_html_x('Phone number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <% if (passenger.phone_number && passenger.phone_number != '') { %>
         <%= passenger.phone_number %>
        <% } else { %>
          -
        <% } %>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-sm-12" style="margin-bottom: 0;">
        <b>
          <?php echo esc_html_x('Notes', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <%= passenger.notes %>
      </div>
    </div>
  </div>
</script>