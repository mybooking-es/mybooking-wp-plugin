<?php
/**
 *   MYBOOKING ENGINE - RESERVATION PASSENGERS TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the passengers information
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-passengers-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.guests) { %>
  <div id="passengers_container" class="mb-section mb-panel-container" style="display:none; margin-top: 1rem;">
    <h3 class="mb-form_title">
      <?php echo esc_html_x('Passengers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
    </h3>
    <div id="passengers_table_container"></div>
    <div id="passengers_form_container"></div>
  </div>
<% } %>