<?php
/**
 *   MYBOOKING ENGINE - WIZARD TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-wizard-plugin-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<!-- SUMMARY ------------------------------------------------------------------>

<script id="wizard_steps_summary" type="txt/tmpl">
  <div class="mybooking-wizard_summary mybooking-summary_detail">

    <!-- // Delivery data -->
    <div class="mybooking-summary_item">
      <div class="mybooking-summary_place">
        <%= summary.pickupPlaceDescription %>
      </div>

      <% if (summary.dateFrom != null) {%>
        <div class="mybooking-summary_date">
          <%= summary.dateFrom %> <% if (summary.timeFrom != null) {%><%= summary.timeFrom %><% } %>
        </div>
      <% } %>
    </div>

    <!-- // Collection data -->
    <div class="mybooking-summary_item">
      <div class="mybooking-summary_place">
        <%= summary.returnPlaceDescription %>
      </div>

      <% if (summary.dateTo != null) {%>
        <div class="mybooking-summary_date">
          <%= summary.dateTo %> <% if (summary.timeTo != null) {%><%= summary.timeTo %><% } %>
        </div>
      <% } %>
    </div>
  </div>
</script>


<!-- MICROTEMPLATES ----------------------------------------------------------->

<!-- Select place micro-template -->
<script id="select_place_tmpl" type="txt/tmpl">
  <div  class="mybooking-wizard_place">
    <% for (var idx=0; idx<places.length; idx++) { %>
      <button class="mb-button mybooking-wizard_place-item selector_place" type="button" data-place-id="<%=places[idx].id%>"  data-place-name="<%=places[idx].name%>"><%=places[idx].name%></button>
    <% } %>
  </div>
</script>


<!-- Select place multiple destionations micro-template -->
<script id="select_place_multiple_destinations_tmpl" type="txt/tmpl">
  <div class="mybooking-wizard_place-filter">
    <button class="mb-button mybooking-wizard_place-item destination-selector" type="button" data-destination-id="all" style="background-color: transparent;border: 1px solid var(--mb-border-color);">
      <?php echo esc_html_x( 'All', 'renting_form_selector_wizard', 'mybooking-wp-plugin' ) ?>
    </button>
    <% for (var idx=0; idx<places.destinations.length; idx++) { %>
      <button class="mb-button mybooking-wizard_place-item destination-selector" type="button" data-destination-id="<%=places.destinations[idx].id%>">
        <%=places.destinations[idx].name%>
      </button>
    <% } %>
  </div>

  <!-- // Places selector -->
  <% for (var idx=0; idx<places.destinations.length; idx++) { %>
    <div class="mybooking-wizard_place_title destination-group" data-destination-id="<%=places.destinations[idx].id%>">
      <span name="<%=places.destinations[idx].id%>"><%=places.destinations[idx].name%></span>
    </div>

    <div class="mybooking-wizard_place destination-group" data-destination-id="<%=places.destinations[idx].id%>">
    <% for (var idy=0; idy<places.destinations[idx].places.length; idy++) { %>
      <button class="mb-button mybooking-wizard_place-item selector_place" type="button" data-place-id="<%=places.destinations[idx].places[idy].id%>" data-place-name="<%=places.destinations[idx].places[idy].name%>">
        <%=places.destinations[idx].places[idy].name%>
      </button>
    <% } %>
    </div>
  <% } %>
</script>


<!-- Select date micro-template -->
<script id="select_date_tmpl" type="txt/tmpl">
  <div class="mybooking-wizard_date full-size-datepicker-container">
     <div id="selector_date" class="mybooking-wizard_date-calendar"></div>
  </div>
</script>


<!-- Select time micro-template -->
<script id="select_time_tmpl" type="txt/tmpl">
  <div class="mybooking-wizard_time">
    <% for (var idx=0; idx<times.length; idx++) { %>
      <button type="button" class="mb-button mybooking-wizard_time-item selector_time text-center" style="width: 100%" data-value="<%=times[idx]%>"><%= times[idx] %></button>
    <% } %>
  </div>
</script>

<!-- Select age micro-template -->
<script id="select_age_tmpl" type="txt/tmpl">
  <!-- Age code selector -->
  <div class="mybooking-wizard_place">
    <% for (var idx=0; idx<ages.length; idx++) { %>
      <button class="mb-button mybooking-wizard_place-item  age-selector" data-age-id="<%=ages[idx]['id']%>" style="width: 100%">
        <%=ages[idx]['description']%>
      </button>
    <% } %>
  </div>
</script>
