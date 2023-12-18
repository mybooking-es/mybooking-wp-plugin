<?php
  /**
   * The Template for showing the transfer summary step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-summary-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<!-- Reservation summary -->
<script type="text/tmpl" id="script_transfer_reservation_summary">
  <div class="mb-row">
    <div class="mb-col-sm-12 mb-col-md-8 mb-col-center">
      <!-- // Reservation status message -->
      <div class="mybooking-summary_status">
        <%= booking.summary_status %>
      </div>

      <!-- // Summary details -->
      <div class="mb-section mb-panel-container mybooking-details_container">
        <div class="mybooking-summary_header">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Reservation summary', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>

            <div class="mybooking-summary_locator">
              <?php echo esc_html_x( 'Reservation Id', 'transfer_choose_vehicle', 'mybooking-wp-plugin') ?>
              <span class="mybooking-summary_locator-id"><%=booking.id%></span>
            </div>
          </div>
        </div>

        <div class="mybooking-summary_detail">
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_date">
              <%=booking.date%> <%=booking.time%>
            </span>
            <span class="mybooking-summary_place">
              <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
              <%=booking.origin_point_name%>
            </span>
            <span class="mybooking-summary_place">
              <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
              <%=booking.destination_point_name%>
            </span>
          </span>

          <% if (booking.round_trip) { %>
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_date">
                <%=booking.date%> <%=booking.time%>
              </span>
              <span class="mybooking-summary_place">
                <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
                <%=booking.origin_point_name%>
              </span>
              <span class="mybooking-summary_place">
                <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
                <%=booking.destination_point_name%>
              </span>
            </span>
          <% } %>

          <span class="mybooking-summary_item">
            <?php echo esc_html_x( 'Adults', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_adults%></br>
            <?php echo esc_html_x( 'Children', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_children%></br>
            <?php echo esc_html_x( 'Infants', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=booking.number_of_infants%>
          </span>
        </div>
      </div>

      <div class="mb-section mb-panel-container">
        <div class="mb-card">
          <!-- // Product photo -->
          <img class="mybooking-product_image" src="<%=booking.item_full_photo%>"/>

          <div class="mybooking-product_header">
            <div class="mybooking-product_price">
              <!-- // Product name -->
              <span class="mybooking-product_name">
                <%=booking.item_name_customer_translation%>
              </span>

              <!-- // Price -->
              <div class="mybooking-product_amount">
                <%=configuration.formatCurrency(booking.item_cost)%>
              </div>
            </div>
          </div>
        </div>
    
        <!-- // Extras -->
        <% if (booking.extras.length > 0) { %>
          <div class="mb-section">
            <br/>
            <div class="mybooking-summary_details-title">
              <?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?>
            </div>

            <% for (var idx=0;idx<booking.extras.length;idx++) { %>
              <div class="mybooking-summary_extras">
                <div class="mybooking-summary_extra-item">
                  <span class="mb-badge info mybooking-summary_extra-quantity"><%=booking.extras[idx].quantity%></span>
                  <span class="mybooking-summary_extra-name"><%=booking.extras[idx].extra_name_customer_translation%></span>
                </div>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(booking.extras[idx].extra_cost)%>
                </span>
              </div>
            <% } %>
          </div>
        <% } %>

        <!-- // Supplements -->
        <% if (booking.supplements.length > 0) { %>
          <div class="mb-section">
            <div class="mybooking-summary_details-title">
              <?php echo esc_html_x( 'Supplements', 'transfer_summary', 'mybooking-wp-plugin' ) ?>
            </div>

            <% for (var idx=0;idx<booking.supplements.length;idx++) { %>
              <div class="mybooking-summary_extras">
                <div class="mybooking-summary_extra-item">
                  <span class="mb-badge info mybooking-summary_extra-quantity">
                    1
                  </span>
                  <span class="mybooking-summary_extra-name">
                    <%=booking.supplements[idx].supplement_name_customer_translation%>
                  </span>
                </div>
                <span class="mybooking-summary_extra-amount">
                  <%=configuration.formatCurrency(booking.supplements[idx].supplement_cost)%>
                </span>
              </div>
            <% } %>
          </div>
        <% } %>

        <!-- // Total -->
        <div class="mybooking-summary_total">
          <div class="mybooking-summary_total-label">
            <?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>
          <div class="mybooking-summary_total-amount">
            <%=configuration.formatCurrency(booking.total_cost)%>
          </div>
        </div>
        <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
          <div class="mybooking-product_taxes">
            <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- // Customer details -->
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?>
        </div>
        <ul class="mb-list border">
          <li class="mb-list-item">
            <span class="dashicons dashicons-businessperson"></span>
            &nbsp;
            <%=booking.customer_name%> <%=booking.customer_surname%>
          </li>

          <% if (booking.customer_phone && booking.customer_phone != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-phone"></span>
              &nbsp;
              <%=booking.customer_phone%> <%=booking.customer_mobile_phone%>
            </li>
          <% } %>

          <% if (booking.customer_email && booking.customer_email != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-email"></span>
              &nbsp;
              <%=booking.customer_email%>
            </li>
          <% } %>
        </ul>
      </div>
    </div>
  </div>
</script>
