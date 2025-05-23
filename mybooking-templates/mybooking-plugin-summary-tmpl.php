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
  <div class="mb-row-flex">
    <!-- // Product details -->
    <div class="mybooking-sidebar  mb-col-sm-12 mb-col-md-8 mb-col-center">
      <!-- // Reservation status message -->
      <div class="mybooking-summary_status">
        <%= booking.summary_status %>
      </div>

      <!-- // Summary details -->
      <div class="mb-section mb-panel-container">
        <div class="mybooking-summary_header">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-reservation-engine' ) ?>

            <div class="mybooking-summary_locator">
              <?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-reservation-engine') ?>
              <span class="mybooking-summary_locator-id"><%=booking.id%></span>
            </div>
          </div>
        </div>

        <div class="mybooking-summary_detail">
          <!-- Delivery -->
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_date">
              <span class="dashicons dashicons-arrow-right-alt"></span>
              <%=booking.date_from_full_format%>
              <% if (configuration.rentDateSelector === 'date_from_duration' && booking.days == 0) { %>
                (<%=booking.time_from%> - <%=booking.time_to%>)
              <% } else if (configuration.timeToFrom) { %>
                <%=booking.time_from%>
              <% } %>
            </span>
            <% if (configuration.pickupReturnPlace) { %>
              <span class="mybooking-summary_place">
                <%=booking.pickup_place_customer_translation%>
              </span>
            <% } %>
          </span>

          <!-- Collection -->
          <% if (configuration.rentDateSelector === 'date_from_date_to' || configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_item">
              <% if (configuration.rentDateSelector === 'date_from_date_to') { %>
                <span class="mybooking-summary_date">
                  <span class="dashicons dashicons-arrow-left-alt"></span>
                  <%=booking.date_to_full_format%>
                  <% if (configuration.timeToFrom) { %>
                    <%=booking.time_to%>
                  <% } %>
                </span>
              <% } %>
              <% if (configuration.pickupReturnPlace) { %>
                <span class="mybooking-summary_place">
                  <%=booking.return_place_customer_translation%>
                </span>
              <% } %>
            </span>
          <% } %>

          <!-- Duration -->
          <% if (booking.days > 0) { %>
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <span class="dashicons dashicons-calendar-alt"></span>
                <%=booking.days%> <?php echo esc_html( MyBookingEngineContext::getInstance()->getDuration() ) ?>
              </span>
            </span>
          <% } else if (booking.hours > 0) { %>
            <span class="mybooking-summary_item">
              <span class="mybooking-summary_duration">
                <span class="dashicons dashicons-clock"></span>
                <%=booking.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-reservation-engine' ) ?>
              </span>
            </span>
          <% } %>
        </div>
      </div>

      <% if (booking.summary_message_ok && booking.summary_message_ok !== '') { %>
        <!-- Summary message OK (defined in back-office) -->
        <div class="mb-alert warning">
          <%=booking.summary_message_ok%>
        </div>
      <% } %>

      <!-- // Product details -->
      <% if (booking.booking_lines.length > 0) { %>
        <div class="mb-section mb-panel-container">
          <% if ( !configuration.multipleProductsSelection ) { %>
            <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>
              <div class="mb-section">
                <div class="mb-card">
                  <div class="mb-col-sm-12 mb-col-md-6">
                    <!-- Product photo -->
                    <% if (booking.booking_lines[idx].photo_full && booking.booking_lines[idx].photo_full !== '') { %>
                      <img class="mybooking-product_image" src="<%=booking.booking_lines[idx].photo_full%>"/>
                    <% } else { %>
                      <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
                    <% } %>
                  </div>
                  <div class="mb-col-sm-12 mb-col-md-6">
                    <!-- Product name -->
                    <div class="mybooking-product_name">
                      <% if (typeof booking.booking_lines[idx].item_performance_id !== 'undefined' &&
                             booking.booking_lines[idx].item_performance_id !== null) { %>
					              <%=booking.booking_lines[idx].item_performance_description_customer_translation%>
				              <% } else { %>                      
                        <%=booking.booking_lines[idx].item_description_customer_translation%>
                      <% } %>
                    </div>
                    <% if (typeof booking.booking_lines[idx].item_rate_type_name !== 'undefined' && 
                          booking.booking_lines[idx].item_rate_type_name && booking.booking_lines[idx].item_rate_type_name !== '') { %>
                      <!-- Product rate type -->
                      <div class="mybooking-product_description">
                        <%=booking.booking_lines[idx].item_rate_type_name%>
                      </div>
                    <% } %>   
                    <% if (typeof booking.booking_lines[idx].item_performance_id === 'undefined' || 
                           booking.booking_lines[idx].item_performance_id === null) { %>
                      <!-- Optional external driver + driving license -->
                      <% if ((typeof booking.optional_external_driver !== '' &&
                            booking.optional_external_driver) ||
                            (typeof booking.item_driving_license_type_name !== '' &&
                            booking.item_driving_license_type_name) ) { %>      
                          <% if (typeof booking.optional_external_driver === 'string' &&
                              booking.optional_external_driver) { %>
                          <span class="mb-badge secondary"><%=booking.optional_external_driver%></span>    
                        <% } %>
                        <% if (typeof booking.item_driving_license_type_name !== '' &&
                              booking.item_driving_license_type_name) { %>
                          <span class="mb-badge secondary"><%=booking.item_driving_license_type_name%></span>    
                        <% } %>
                      <% } %>

                      <% if (typeof booking.item_hired_info !== '' &&
                              booking.item_hired_info) { %>
                        <div class="mb-text-muted"><%=booking.item_hired_info%></div>
                      <% } %>

                      <!-- // Product description -->
                      <div class="mybooking-product_description">
                        <%=booking.booking_lines[idx].item_full_description_customer_translation%>
                      </div>
                    <% } %>

                  </div>
                </div>

                <!-- // Price box -->
                <% if (!configuration.hidePriceIfZero || booking.item_cost > 0) { %>
                  <div class="mybooking-summary_price">
                    <div>
                      <!-- Discount -->
                      <div class="mybooking-product_discount">
                        <!-- // Offer/Promotion Code Appliance -->
                        <% if (booking.booking_lines[idx].item_unit_cost_base != booking.booking_lines[idx].item_unit_cost) { %>
                          <div class="mybooking-product_price">
                            <!-- Only show the price if it is higher -->
                            <% if (new Number(booking.booking_lines[idx].item_unit_cost) < new Number(booking.booking_lines[idx].item_unit_cost_base)) { %>
                              <span class="mybooking-product_original-price">
                                <%=configuration.formatCurrency(booking.booking_lines[idx].item_unit_cost_base * booking.booking_lines[idx].quantity)%>
                              </span>
                            <% } %>

                            <!-- // Offer -->
                            <% if (typeof booking.booking_lines[idx].offer_name !== 'undefined' && booking.booking_lines[idx].offer_name !== null && booking.booking_lines[idx].offer_name !== '') { %>
                              <span class="mybooking-product_discount-badge mb-badge info">
                                <% if (booking.booking_lines[idx].offer_discount_type === 'percentage' && booking.booking_lines[idx].offer_value !== '') {%>
                                  - <%=parseInt(booking.booking_lines[idx].offer_value)%>&#37;
                                <% } %>
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
                      <!-- // Taxes -->
                      <?php if ( array_key_exists('show_taxes_included', $args ) && ( $args['show_taxes_included'] ) ): ?>
                        <div class="mybooking-product_taxes">
                          <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-reservation-engine') ?>
                        </div>
                      <?php endif; ?>
                    </div>

                    <!-- Price -->
                    <div class="mybooking-product_price">
                      <!-- // Quantity -->
                      <% if (configuration.multipleProductsSelection) { %>
                        <span class="mybooking-product_quantity">
                          <%=configuration.formatCurrency(booking.booking_lines[idx].item_unit_cost)%>
                          x
                          <%=booking.booking_lines[idx].quantity%>
                        </span>
                      <% } %>

                      <!-- // Amount -->
                      <div class="mybooking-product_amount">
                        <%=configuration.formatCurrency(booking.booking_lines[idx].item_cost)%>
                      </div>
                    </div>  
                  </div>
                <% } %>
              </div>
            <% } %>
          <% } %>

          <!-- // Extras -->
          <% if ( booking.booking_extras.length > 0 ) { %>
            <div class="mb-section">
              <div class="mybooking-summary_details-title">
                <?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-reservation-engine' ) ?>
              </div>

              <% for (var idx=0;idx<booking.booking_extras.length;idx++) { %>
                <div class="mybooking-summary_extras">
                  <div class="mybooking-summary_extra-item">
                    <span class="mb-badge info mybooking-summary_extra-quantity"><%=booking.booking_extras[idx].quantity%></span>
                    <span class="mybooking-summary_extra-name"><%=booking.booking_extras[idx].extra_description_customer_translation%></span>
                  </div>
                  <span class="mybooking-summary_extra-amount">
                    <%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%>
                  </span>
                </div>
              <% } %>
            </div>
          <% } %>

          <!-- // Supplements -->
          <% if ( booking.time_from_cost > 0 ||
                booking.pickup_place_cost > 0 ||
                booking.time_to_cost > 0 ||
                booking.return_place_cost > 0 ||
                booking.driver_age_cost > 0 ||
                booking.category_supplement_1_cost > 0 ) { %>

            <div class="mb-section">
              <div class="mybooking-summary_details-title">
                <?php echo esc_html_x( 'Supplements', 'renting_summary', 'mybooking-reservation-engine' ) ?>
              </div>

              <div class="mybooking-summary_extras">
                <!-- // Pick-up time -->
                <% if (booking.time_from_cost > 0) { %>
                  <div class="mybooking-summary_extra-item">
                    <span class="mybooking-summary_extra-name">
                      <?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-reservation-engine' ) ?>
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
                      <?php echo esc_html_x( 'Pick-up place supplement', 'renting_complete', 'mybooking-reservation-engine' ) ?>
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
                      <?php echo esc_html_x( 'Return time supplement', 'renting_complete', 'mybooking-reservation-engine' ) ?>
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
                      <?php echo esc_html_x( 'Return place supplement', 'renting_complete', 'mybooking-reservation-engine' ) ?>
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
                      <?php echo esc_html_x( "Driver's age supplement", 'renting_complete', 'mybooking-reservation-engine' ) ?>
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
                      <?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking-reservation-engine' ) ?>
                    </span>
                  </div>
                  <span class="mybooking-summary_extra-amount">
                    <%=configuration.formatCurrency(booking.category_supplement_1_cost)%>
                  </span>
                <% } %>
              </div>
            </div>
          <% } %>

          <!-- // Deposits -->
          <?php mybooking_engine_get_template('mybooking-plugin-complete-deposits-tmpl.php'); ?>
          
          <!-- // Total -->
          <% if (!configuration.hidePriceIfZero || booking.total_cost > 0) { %>
            <div class="mybooking-summary_total">
              <div class="mybooking-summary_total-label">
                <?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-reservation-engine' ) ?>
              </div>
              <div class="mybooking-summary_total-amount">
                <%=configuration.formatCurrency(booking.total_cost)%>
              </div>
            </div>

            <div class="mybooking-summary_total">
              <div class="mybooking-summary_total-label">
                <?php echo esc_html_x( 'Total paid', 'renting_summary', 'mybooking-reservation-engine' ) ?>
              </div>
              <div class="mybooking-summary_total-amount">
                <%=configuration.formatCurrency(booking.total_paid)%>
              </div>
            </div>

            <% if (booking.total_pending > 0) { %>
              <div class="mybooking-summary_total mb--bg-danger">
                <div class="mybooking-summary_total-label">
                  <?php echo esc_html_x( 'Total pending', 'renting_summary', 'mybooking-reservation-engine' ) ?>
                </div>
                <div class="mybooking-summary_total-amount mb-text-negative">
                  <%=configuration.formatCurrency(booking.total_pending)%>
                </div>
              </div>
            <% } %>

            <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
              <div class="mybooking-product_taxes">
                <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-reservation-engine') ?>
              </div>
            <?php endif; ?>
          <% } %>
        </div>
      <% } %>

      <!-- // Customer details -->
      <div class="mb-section mb-panel-container">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-reservation-engine') ?>
        </div>
        <ul class="mb-list border">
          <li class="mb-list-item">
            <span class="dashicons dashicons-businessperson"></span>
            &nbsp;
            <%=booking.customer_fullname%> 
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

<!-- RESERVATION PRODUCT MULTIPLE TABLE ------------------------------------------------------>

<?php mybooking_engine_get_template( 'mybooking-plugin-complete-multiple-items-table-tmpl.php' ); ?>