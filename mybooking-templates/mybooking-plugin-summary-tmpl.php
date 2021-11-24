<?php
/**
 *   MYBOOKING ENGINE - RESERVATION SUMMARY TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting complete step - JS microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-complete-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<!-- RESERVATION SUMMARY ------------------------------------------------------>

<script type="text/tmpl" id="script_reservation_summary">

  <!-- // Summary details -->

  <div class="mb-section">
    <div class="mybooking-summary_header">
      <div class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
      </div>

      <div class="mybooking-summary_locator">
        <?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-wp-plugin') ?>:
        <span class="mybooking-summary_locator-id"><%=booking.id%></span>
      </div>
    </div>

    <div class="mybooking-summary_detail">

      <% if (configuration.timeToFrom) { %>
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <%=booking.date_to_full_format%>
            <%=booking.time_from%>
          </span>
          <% if (configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_place">
              <%=booking.pickup_place_customer_translation%>
            </span>
          <% } %>
        </span>
      <% } %>

      <% if (configuration.timeToFrom || configuration.pickupReturnPlace) { %>
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <%=booking.date_to_full_format%>
            <%=booking.time_to%>
          </span>
          <% if (configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_place">
              <%=booking.return_place_customer_translation%>
            </span>
          <% } %>
        </span>
      <% } %>

      <% if (booking.days > 0) { %>
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_duration"><%=booking.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?></span>
        </span>
      <% } else if (booking.hours > 0) { %>
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_duration"><%=booking.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></span>
        </span>
      <% } %>
    </div>
  </div>

  <!-- // Product details -->

  <div class="mb-col-md-8 mb-col-center">

    <!-- // Reservation status message -->
    <div class="mybooking-summary_status">
      <%= booking.summary_status %>
    </div>

    <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>

      <div class="mb-section">
        <div class="mb-card inline">
          <div class="mb-col-md-6">

            <!-- // Product photo -->
            <% if (booking.booking_lines[idx].photo_full && booking.booking_lines[idx].photo_full !== '') { %>
              <img class="mybooking-product_image" src="<%=booking.booking_lines[idx].photo_full%>"/>
            <% } else { %>
              <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
            <% } %>  
          </div>
          <div class="mb-col-md-6">

            <!-- // Product name -->
            <span class="mybooking-product_name">
              <%=booking.booking_lines[idx].item_description_customer_translation%>

              <!-- // Quantity -->
              <% if (configuration.multipleProductsSelection) { %>
                <span class="mybooking-product_quantity">
                  <%=booking.booking_lines[idx].quantity%>
                </span>
              <% } %>
            </span>

            <!-- // Product description -->
            <div class="mybooking-product_description">
              <%=booking.booking_lines[idx].item_full_description_customer_translation%>
            </div>
          </div>
        </div>

        <% if (!configuration.hidePriceIfZero || booking.item_cost > 0) { %>
          <div class="mybooking-product_header">

           <div class="mybooking-product_price">
             <!-- // Price -->
             <div class="mybooking-product_amount">
               <%=configuration.formatCurrency(booking.booking_lines[idx].item_cost)%>
            </div>

             <!-- // Taxes -->
            <?php if ( array_key_exists('show_taxes_included', $args ) && ( $args['show_taxes_included'] ) ): ?>
              <div class="mybooking-product_taxes">
                <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
              </div>
            <?php endif; ?>
           </div>

           <div class="mybooking-product_discount">

             <!-- // Offer/Promotion Code Appliance -->
             <% if (booking.booking_lines[idx].item_unit_cost_base != booking.booking_lines[idx].item_unit_cost) { %>
               <div class="mybooking-product_price">

                 <span class="mybooking-product_original-price">
                   <%=configuration.formatCurrency(booking.booking_lines[idx].item_unit_cost_base * booking.booking_lines[idx].quantity)%>
                 </span>

                 <!-- // Offer -->
                 <% if (typeof booking.booking_lines[idx].offer_name !== 'undefined' && booking.booking_lines[idx].offer_name !== null && booking.booking_lines[idx].offer_name !== '') { %>
                   <% if (booking.booking_lines[idx].offer_discount_type === 'percentage' && booking.booking_lines[idx].offer_value !== '') {%>
                     <span class="mybooking-product_discount-badge mb-badge success">
                       - <%=parseInt(booking.booking_lines[idx].offer_value)%>&#37;
                     </span>
                   <% } %>
                    <span class="mybooking-product_discount-badge mb-badge info">
                      <%=booking.booking_lines[idx].offer_name%>
                    </span>
                 <% } %>

                 <!-- // Promotion Code -->
                 <% if (typeof booking.promotion_code !== 'undefined' && booking.promotion_code !== '' && typeof booking.booking_lines[idx].promotion_code !== 'undefined' && booking.booking_lines.promotion_code !== '') { %>
                   <% if (booking.booking_lines[idx].promotion_code_discount_type === 'percentage' && booking.booking_lines[idx].promotion_code_value !== '') {%>
                     <span class="mybooking-product_discount-badge mb-badge success">
                       <%=parseInt(booking.booking_lines[idx].promotion_code_value)%>&#37;
                     </span>
                     <span class="mybooking-product_discount-badge mb-badge success">
                       <%=booking.promotion_code%>
                     </span>
                   <% } %>
                 <% } %>
               </div>
             <% } %>
           </div>
          </div>
        <% } %>
      </div>
    <% } %>

    <!-- // Extras -->

    <% if (booking.booking_extras.length > 0) { %>
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?>
        </div>

          <% for (var idx=0;idx<booking.booking_extras.length;idx++) { %>
            <div class="mybooking-summary_extras">
              <div class="mybooking-summary_extra-item">
                <span class="mb-badge info mybooking-summary_extra-quantity"><%=booking.booking_extras[idx].quantity%></span>
                <span class="mybooking-summary_extra-name"><%=booking.booking_extras[idx].extra_description%></span>
              </div>
              <span class="mybooking-summary_extra-amount">
                <%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%>
              </span>
            </div>
          <% } %>

      </div>
    <% } %>

    <!-- // Supplements -->

    <% if (booking.time_from_cost > 0 ||
          booking.pickup_place_cost > 0 ||
          booking.time_to_cost > 0 ||
          booking.return_place_cost > 0 ||
          booking.driver_age_cost > 0 ||
          booking.category_supplement_1_cost > 0) { %>

      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( 'Supplements', 'renting_summary', 'mybooking-wp-plugin' ) ?>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Pick-up time -->
          <% if (booking.time_from_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.time_from_cost)%>
            </span>
          <% } %>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Pick-up place -->
          <% if (booking.pickup_place_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
              <span class="mybooking-summary_extra-name">
                <?php echo esc_html_x( 'Pick-up place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
              </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.pickup_place_cost)%>
            </span>
          <% } %>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Return time -->
          <% if (booking.time_to_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
            <span class="mybooking-summary_extra-name">
              <?php echo esc_html_x( 'Return time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.time_to_cost)%>
            </span>
          <% } %>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Return place -->
          <% if (booking.return_place_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
              <span class="mybooking-summary_extra-name">
                <?php echo esc_html_x( 'Return place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
              </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.return_place_cost)%>
            </span>
          <% } %>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Driver age -->
          <% if (booking.driver_age_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
              <span class="mybooking-summary_extra-name">
                <?php echo esc_html_x( "Driver's age supplement", 'renting_complete', 'mybooking-wp-plugin' ) ?>
              </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.driver_age_cost)%>
            </span>
          <% } %>
        </div>

        <div class="mybooking-summary_extras">

          <!-- // Petrol -->
          <% if (booking.category_supplement_1_cost > 0) { %>
            <div class="mybooking-summary_extra-item">
              <span class="mybooking-summary_extra-name">
                <?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking-wp-plugin' ) ?>
              </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(booking.category_supplement_1_cost)%>
            </span>
          <% } %>
        </div>
      </div>
    <% } %>

    <% if (booking.total_deposit > 0) { %>

      <!-- // Deposit -->
      <div class="mybooking-summary_deposit">
        <span class="mybooking-summary_extra-name">
          <?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
        </span>
        <span class="mybooking-summary_extra-amount">
          <%=configuration.formatCurrency(booking.total_deposit)%>
        </span>
      </div>
    <% } %>

    <!-- // Total -->

    <% if (!configuration.hidePriceIfZero || booking.total_cost > 0) { %>

      <div class="mb-section">
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

    <% } %>

    <!-- // Customer details -->

    <div class="mb-section">
      <div class="mybooking-summary_details-title">
        <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?>
      </div>
      <ul class="mb-list border">
        <li class="mb-list-item">
          <%=booking.customer_name%> <%=booking.customer_surname%>
        </li>

        <% if (booking.customer_phone && booking.customer_phone != '') { %>
          <li class="mb-list-item">
            <%=booking.customer_phone%> <%=booking.customer_mobile_phone%>
          </li>
        <% } %>

        <% if (booking.customer_email && booking.customer_email != '') { %>
          <li class="mb-list-item">
            <%=booking.customer_email%>
          </li>
        <% } %>
      </ul>
    </div>
  </div>

</script>
