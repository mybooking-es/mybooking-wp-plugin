<?php
  /** 
   * The Template for showing the renting selector wizard widget - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-wizard-plugin-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
    <!-- ===================================================== -->
    <!--         Selector Wizard Microtemplates                -->
    <!-- ===================================================== -->

    <!-- Steps summary -->

    <script id="wizard_steps_summary" type="txt/tmpl">

      <div class="mybooking-wizard-summary mb-section">
        <div class="mb-row">
          <!-- Delivery -->
          <div class="mb-col-sm-6">
            <div class="mybooking-wizard-summary_pickup"><%= summary.pickupPlaceDescription %></div>
            <% if (summary.dateFrom != null) {%>
              <div class="mybooking-wizard-summary_delivery"><%= summary.dateFrom %> <% if (summary.timeFrom != null) {%><%= summary.timeFrom %><% } %> </div>
            <% } %>
          </div>
          <!-- Collection -->
          <div class="mb-col-sm-6">
            <div class="mybooking-wizard-summary_return"><%= summary.returnPlaceDescription %></div>
            <% if (summary.dateTo != null) {%>
              <div class="mybooking-wizard-summary_collection"><%= summary.dateTo %> <% if (summary.timeTo != null) {%><%= summary.timeTo %><% } %></div>
            <% } %>
          </div>
        </div>
      </div>

    </script>

    <!-- Select place micro-template -->

    <script id="select_place_tmpl" type="txt/tmpl">

      <div class="mb-section mb--p-0">
        <div class="mb-row">
          <div class="mb-col-md-12">
            <ul style="list-style: none" class="mb--pt-3">
              <% for (var idx=0; idx<places.length; idx++) { %>
              <li><a class="mybooking-wizard-selector_place selector_place" role="button" data-place-id="<%=places[idx].id%>"  data-place-name="<%=places[idx].name%>"><%=places[idx].name%></a></li>
              <% } %>
            </ul>
          </div>
        </div>
      </div>

    </script>

    <!-- Select place multiple destionations micro-template -->

    <script id="select_place_multiple_destinations_tmpl" type="txt/tmpl">

      <div class="mb-section mb--p-0">
        <!-- Destinations selector -->
        <div class="mb-row mb--mt-3">
          <div class="mb-col-md-12">
            <button class="btn btn-primary mybooking-wizard-multi-place_btn destination-selector" type="button" data-destination-id="all"><?php echo esc_html_x( 'All', 'renting_form_selector_wizard', 'mybooking-wp-plugin' ) ?></button>
            <% for (var idx=0; idx<places.destinations.length; idx++) { %>
              <button class="btn btn-primary mybooking-wizard-multi-place_btn destination-selector"  type="button" 
                 data-destination-id="<%=places.destinations[idx].id%>"><%=places.destinations[idx].name%></button>
            <% } %>
          </div>
        </div>
        <hr>
        <!-- Places selector -->
        <div class="mb-row">
          <div class="mb-col-md-12">
            <% for (var idx=0; idx<places.destinations.length; idx++) { %>
              <h3 class="mybooking-wizard-place_title destination-group" data-destination-id="<%=places.destinations[idx].id%>"><a name="<%=places.destinations[idx].id%>"><%=places.destinations[idx].name%></a></h3>
              <ul class="mybooking-wizard-place_list destination-group pt-3" data-destination-id="<%=places.destinations[idx].id%>">
              <% for (var idy=0; idy<places.destinations[idx].places.length; idy++) { %>               
                <li class="mybooking-wizard-place_item"><a class="selector_place text-primary" role="button" data-place-id="<%=places.destinations[idx].places[idy].id%>"  data-place-name="<%=places.destinations[idx].places[idy].name%>"><%=places.destinations[idx].places[idy].name%></a></li>
              <% } %>
              </ul>
            <% } %>
          </div>
        </div>
      </div>

    </script>    

    <!-- Select date micro-template -->

    <script id="select_date_tmpl" type="txt/tmpl">

      <div class="mb-section mb--p-0">
        <div class="mb-row">
          <div class="mb-col-md-12 mybooking-wizard-date_calendar">
             <div id="selector_date" class="pt-3"></div>
          </div>
        </div>
      </div>

    </script>

    <!-- Select time micro-template -->

    <script id="select_time_tmpl" type="txt/tmpl">

      <div class="mb-section mb--p-2 mb--mb-2">
          <% for (var idx=0; idx<times.length; idx++) { %>
              <% if (idx % 2 == 0) { %>
              <div class="mb-row">
              <% } %>
                <div class="mb-col-md-6 mybooking-wizard-time">
                  <button type="button" class="mybooking-wizard-time_btn selector_time text-center mb-2 p-3" style="width: 100%" data-value="<%=times[idx]%>"><%= times[idx] %></button>
                </div>
              <% if (idx % 2 == 1) { %>                
              </div>
              <% } %>
            <% } %>
        </div>
      </div>

    </script>  