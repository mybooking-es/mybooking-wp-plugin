<?php
/**
 *   MYBOOKING ENGINE - ACTIVITY CALENDAR TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step - JS microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-activities-widget-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<!-- Activity Cyclic Calendar -->

<script type="text/tmpl" id="script_cyclic_calendar">
 <ol class="mybooking-product_calendar-step-list">
  <li class="mybooking-product_calendar-step"><?php echo esc_html_x( 'Select date', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?></li>

  <form name="select_date_form" id="select_date_form" class="mybooking-form">
    <input type="hidden" name="activity_id" id="activity_id" value="<%=activity_id%>"/>
    <div id="datepicker"></div>
    <div id="turns" class="mybooking-activity_turns"></div>
    <div id="tickets" class="mybooking-activity_tickets"></div>
  </form>
</ol>
</script>

<script type="text/tmpl" id="script_cyclic_turns">

  <% if (isEmptyTurns) {%>
    <div class="mb-alert warning">
      <?php echo esc_html_x( 'We are sorry. There are not schedules available', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?>
    </div>

  <% } else { %>
    <li class="mybooking-product_calendar-step"><?php echo esc_html_x( 'Select hour', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?></li>

    <div class="mb-form-group">
      <% for (turn in turns) { %>
        <div class="mb-form-check">
          <label class="mb-form-check-label" for="turn">
            <input class="mb-form-check-input" type="radio" name="turn" id="turn" value="<%=turn%>" <% if (!turns[turn]) {%>disabled<%}%>>
            <% if (!turns[turn]) {%><span class="mb-text-danger"><%=turn%></span><% } else {%><%=turn%><% } %>
          </label>
        </div>
      <% } %>
    </div>
  <% }%>
</script>


<!-- Activity Multiple Dates Selector -->

<script type="text/tmpl" id="script_multiple_dates_selector">
<ol class="mybooking-product_calendar-step-list">
  <li class="mybooking-product_calendar-step"><?php echo esc_html_x( 'Select date', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?></li>

  <form name="select_date_form" id="select_date_form" class="mybooking-form">
    <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>
    <div class="form-group">
      <select name="activity_date_id" id="activity_date_id" class="mb-form-control">
      </select>
    </div>
    <div id="tickets" class="mybooking-activity_tickets"></div>
  </form>
</ol>
</script>


<!-- Activity One Time Selector -->

<script type="text/tmpl" id="script_one_time_selector">
<ol class="mybooking-product_calendar-step-list">
  <form name="select_date_form" id="select_date_form" class="mybooking-form">
    <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>

      <% if (typeof activity.available !== 'undefined') { %>
        <% if (activity.available == 0) { %>
          <div class="mb-alert danger">
            <p><%=i18next.t('activities.calendarWidget.fullPlaces')%></p>
          </div>
        <% } else if (activity.available == 2) {%>
          <div class="mb-alert warning">
            <% if (activity.allow_select_places_for_reservation) { %>
              <%=i18next.t('activities.calendarWidget.fewPlacesWarning')%>
            <% } else { %>
              <%=i18next.t('activities.calendarWidget.fewNoPlacesWarning')%>
            <% } %>
          </div>
        <% } %>
      <% } %>

    <div id="tickets" class="mybooking-activity_tickets"></div>
  </form>
</ol>
</script>


<!-- Customer buy tickets -->

<script type="text/tmpl" id="script_tickets">

  <li class="mybooking-product_calendar-step"><?php echo esc_html_x( 'People', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?></li>

  <% for (item in tickets) { %>
   <div class="form-group">
      <select name="quantity_rate_<%=item%>" id="quantity_rate_<%=item%>" class="quantity_rate mb-form-control">
        <% for (var idx=0; idx<tickets[item].length; idx++) { %>
        <option value="<%=tickets[item][idx]["number"]%>" data-total="<%=tickets[item][idx]["total"]%>"><%=tickets[item][idx]["description"]%></option>
        <% } %>
      </select>
   </div>
  <% } %>

  <div class="form-group">
    <button type="button" id="btn_reservation" class="mb-button button block btn-choose-product">
      <?php echo esc_html_x( 'Book now', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?>
    </button>
  </div>
</script>


<!-- Customer buys full activity -->

<script type="text/tmpl" id="script_fixed_ticket">

  <% if (Object.keys(tickets).length == 1) { %>

    <!-- // There is only one option, so hide it -->
    <% for (item in tickets) { %>
      <input type="hidden" name="quantity_rate_<%=item%>" class="quantity_rate" value="1"/>
    <% } %>

  <% } else if (Object.keys(tickets).length > 1) { %>

    <!-- // There are more than 1 option, allow the customer to pick up one -->
    <div class="form-group">
      <select name="selected_tickets_full_mode" class="mb-form-control">
        <option value=""><?php echo esc_html_x( 'Please, select an option', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?></option>
      <% for (item in tickets) { %>
        <option value="<%=item%>"><%=tickets[item][0]["description"]%></option>
      <% } %>
      </select>
    </div>
  <% } %>

  <div class="form-group">
    <button type="button" id="btn_reservation" class="mb-button button block btn-choose-product">
      <?php echo esc_html_x( 'Book now', 'activity_tickets_form_selector', 'mybooking-wp-plugin' ) ?>
    </button>
  </div>
</script>
