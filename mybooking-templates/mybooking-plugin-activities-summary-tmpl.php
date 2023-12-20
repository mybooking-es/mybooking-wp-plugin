<?php
/**
 *   MYBOOKING ENGINE - SUMMARY ACTIVITY TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting summary step
 *   This template can be overridden by copying it to your theme
 *   /mybooking-templates/mybooking-plugin-activities-summary-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tpml" id="script_order">
  <div class="mb-row">
    <div class="mb-col-sm-12 mb-col-md-8 mb-col-center">
      <!-- // Reservation status message -->
      <div class="mybooking-summary_status">
        <%= order.summary_status %>
      </div>

      <!-- // Products -->
      <div id="selected_products">
        <div class="mb-section mb-panel-container mybooking-details_container">
          <div class="mybooking-summary_locator">
            <?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-wp-plugin') ?>:
            <span class="mybooking-summary_locator-id"><%=order.id%></span>
          </div>
        </div>

        <% for (idx in order.items) { %>
          <div class="mb-section">
            <div class="mb-card">
              <!-- // Product photo -->
              <% if (order.items[idx].photo_full != null) { %>
                <img class="mybooking-product_image" src="<%=order.items[idx].photo_full%>" alt="">

              <% } else { %>
                <div class="mybooking-product_image-fallback">
                  <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
              <% } %>

              <div class="mb-card_body">
                <!-- // Product name -->
                <span class="mybooking-product_name">
                  <%=order.items[idx].item_description_customer_translation%>
                </span>

                <div class="mybooking-activity_date">
                  <span class="mybooking-activity_date-item">
                    <%= configuration.formatDate(order.items[idx].date) %>
                  </span>
                  <span class="mybooking-activity_date-item">
                    <%= order.items[idx].time %>
                  </span>
                </div>

                <% if (order.allow_select_places_for_reservation || order.use_rates) { %>
                  <% if (order.allow_select_places_for_reservation) { %>
                    <% if (order.use_rates) { %>
                      <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                        <div class="mybooking-summary_activities">
                          <div class="mybooking-summary_activity-item">
                            <span class="mb-badge info mybooking-summary_activity-quantity">
                              <%=order.items[idx]['items'][x].quantity %>
                            </span>
                            <span class="mybooking-summary_activity-name">
                              <%=order.items[idx]['items'][x].item_price_description %> x
                            </span>
                            <span class="mybooking-summary_activity-amount">
                              <%=configuration.formatCurrency(order.items[idx]['items'][x].item_unit_cost) %>
                            </span>
                          </div>
                          <span class="mybooking-summary_activity-amount">
                            <%=configuration.formatCurrency(order.items[idx]['items'][x].item_cost) %>
                          </span>
                        </div>
                      <% } %>

                    <% } else { %>
                      <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                        <div class="mybooking-summary_activities">
                          <span class="mybooking-summary_activity-quantity">
                            <%=order.items[idx]['items'][x].quantity %>
                          </span>
                          <span class="mybooking-summary_activity-name">
                            <%=order.items[idx]['items'][x].item_price_description %>
                          </span>
                        </div>
                      <% } %>
                    <% } %>
                  <% } %>
                <% } %>
              </div>
            </div>
          </div>
        <% } %>
      </div>

      <br />

      <!-- // Show the total -->
      <% if (order.use_rates) { %>
        <div class="mb-section mb-panel-container">
          <div class="mybooking-summary_activities-total mybooking-summary_activities-total--notborder">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Total', 'activity_shopping_cart_item', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount">
              <%=configuration.formatCurrency(order.items[idx]['total'])%>
            </span>
          </div>

          <div class="mybooking-summary_activities-total">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Paid', 'activity_summary', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount">
              <%=configuration.formatCurrency(order.total_paid)%>
            </span>
          </div>
          <div class="mybooking-summary_activities-total">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Pending', 'activity_summary', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount mb-text-danger">
              <%=configuration.formatCurrency(order.total_pending)%>
            </span>
          </div>
        </div>
      <% } %>

      <!-- // Customers detail -->
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?>
        </div>
        <ul class="mb-list border">
          <li class="mb-list-item">
            <span class="dashicons dashicons-businessperson"></span>
            &nbsp;
            <%=order.customer_name%> <%=order.customer_surname%>
          </li>

          <% if (order.customer_phone && order.customer_phone != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-phone"></span>
              &nbsp;
              <%=order.customer_phone%> <%=order.customer_mobile_phone%>
            </li>
          <% } %>

          <% if (order.customer_email && order.customer_email != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-email"></span>
              &nbsp;
              <%=order.customer_email%>
            </li>
          <% } %>

          <% if (configuration.activityCustomerVehicle) { %>

              <li class="mb-list-item">
                <% if (order.customer_stock_brand && order.customer_stock_brand != '') { %>
                  <%=order.customer_stock_brand%>
                <% } %>  
                <% if (order.customer_stock_model && order.customer_stock_model != '') { %>
                  <%=order.customer_stock_model%>
                <% } %>  
                <% if (order.customer_stock_plate && order.customer_stock_plate != '') { %>  
                  <%=order.customer_stock_plate%>
                <% } %>  
                <% if (order.customer_stock_color && order.customer_stock_color != '') { %>
                  <%=order.customer_stock_color%>
                <% } %>
              </li>

          <% } %>
          
        </ul>
      </div>
    </div>
  </div>
</script>
