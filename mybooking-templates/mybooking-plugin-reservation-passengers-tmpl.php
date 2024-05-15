<% if (configuration.guests) { %>
  <div id="passengers_container" class="mb-section mb-panel-container" style="display:none; margin-top: 1rem;">
    <h3 class="mb-form_title">
      <?php echo esc_html_x('Passengers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h3>
    <div id="passengers_table_container"></div>
    <div id="passengers_form_container"></div>
  </div>
<% } %>