<?php
/**
 *   MYBOOKING ENGINE - MY RESERVATION TEMPLATE
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


<!-- MY RESERVATION & EXTRA DATA FORM ----------------------------------------->

<script type="text/tmpl" id="script_reservation_summary">
      <!-- // Product details -->
      <div class="mb-row-flex">
        <% if (showReservationForm) { %>
          <div class="mb-col-md-6 mb-col-lg-8">
            <!-- //Customer extra data form -->
            <div id="reservation_form_container" style="display:none"></div>
            <% if (configuration.guests) { %>
              <!-- Passengers -->
              <br/>
              <div id="passengers_container" class="mb-section mb-panel-container" style="display:none">
                <h3 class="mb-form_title">
                  <?php echo esc_html_x('Passengers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
                </h3>
                <div id="passengers_table_container"></div>
                <div id="passengers_form_container"></div>
              </div>
              <!-- End passengers -->
            <% } %>
          </div>
        <% } %>

        <div class="mybooking-sidebar mb-col-md-6 <% if (showReservationForm) { %>mb-col-lg-4<%} else { %>mb-col-lg-8 mb-col-center<% } %>">

          <!-- // Reservation status message -->
          <div class="mb-section mybooking-summary_status">
            <%= booking.summary_status %>
          </div>

          <!-- // Summary details -->
          <div class="mb-section mb-panel-container">
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
                    <%=booking.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?>
                  </span>
                </span>
              <% } else if (booking.hours > 0) { %>
                <span class="mybooking-summary_item">
                  <span class="mybooking-summary_duration">
                    <span class="dashicons dashicons-clock"></span>
                    <%=booking.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
                  </span>
                </span>
              <% } %>       
            </div>
          </div>

          <!-- // Product details -->
          <% if (booking.booking_lines.length > 0) { %>
            <div class="mb-section mb-panel-container">
              <% if ( !configuration.multipleProductsSelection ) { %>
                <!-- Product card -->
                <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>
                  <div class="mb-section">
                    <div class="mb-card mb--p-1">
                      <!-- // Product photo -->
                      <% if (booking.booking_lines[idx].photo_full && booking.booking_lines[idx].photo_full !== '') { %>
                        <img class="mybooking-product_image" src="<%=booking.booking_lines[idx].photo_full%>"/>
                      <% } else { %>
                        <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
                      <% } %>

                      <br /><br />

                      <!-- // Product name -->
                      <div class="mybooking-product_name">
                        <% if (booking.booking_lines[idx].item_performance_id !== null) { %>
					                <%=booking.booking_lines[idx].item_performance_description_customer_translation%>
				                <% } else { %>                           
                          <%=booking.booking_lines[idx].item_description_customer_translation%>
                        <% } %>  
                      </div>

                      <% if (booking.booking_lines[idx].item_performance_id === null) { %>
                        <!-- Optional external driver + driving license -->
                        <% if ((typeof booking.optional_external_driver !== '' &&
                              booking.optional_external_driver) ||
                              (typeof booking.item_driving_license_type_name !== '' &&
                              booking.item_driving_license_type_name) ) { %>   
                          <% if (typeof booking.optional_external_driver !== '' &&
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

                        <!-- //Product description -->
                        <div class="mybooking-product_description">
                          <%=booking.booking_lines[idx].item_full_description_customer_translation%>
                        </div>
                      <% } %>
                      
                    </div>

                    <% if ( (!configuration.hidePriceIfZero || booking.item_cost > 0 ) || ( booking.booking_lines[idx].item_unit_cost_base != booking.booking_lines[idx].item_unit_cost ) ) { %>
                      <% if (!configuration.hidePriceIfZero || booking.item_cost > 0) { %>
                        <div class="mybooking-summary_price">
                          <div>
                            <!-- Discount -->
                            <div class="mybooking-product_discount">
                              <!-- // Offer/Promotion Code Appliance -->
                              <% if (booking.booking_lines[idx].item_unit_cost_base != booking.booking_lines[idx].item_unit_cost) { %>
                                  <div class="mybooking-product_price">
                                    <% if (booking.booking_lines[idx].item_unit_cost < booking.booking_lines[idx].item_unit_cost_base) { %>
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
                                <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
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
                    <% } %>
                  </div>
                <% } %>
              <% } %>

              <!-- // Extras -->
              <% if ( booking.booking_extras.length > 0 ) { %>
                <div class="mb-section">
                  <div class="mybooking-summary_details-title">
                    <?php echo esc_html_x( 'Extras', 'renting_summary', 'mybooking-wp-plugin' ) ?>
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

              <!-- // Deposits -->
              <?php mybooking_engine_get_template('mybooking-plugin-complete-deposits-tmpl.php'); ?>

              <!-- // Total -->
              <% if ( !configuration.hidePriceIfZero || booking.total_cost > 0 ) { %>
                <div class="mybooking-summary_total">
                  <div class="mybooking-summary_total-label">
                    <?php echo esc_html_x( 'Total', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                  </div>
                  <div class="mybooking-summary_total-amount">
                    <%=configuration.formatCurrency(booking.total_cost)%>
                  </div>
                </div>

                <ul class="mb-list border">
                  <li class="mb-list-item">
                    <span class="mb-list-element">
                      <?php echo esc_html_x( 'Paid', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
                    </span>
                    <span class="mb-list-element secondary">
                      <%=configuration.formatCurrency(booking.total_paid)%>
                    </span>
                  </li>
                  <li class="mb-list-item">
                    <span class="mb-list-element">
                      <?php echo esc_html_x( 'Pending', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
                    </span>
                    <span class="mb-list-element <% if (booking.total_pending > 0) {%>danger<% } %> secondary">
                      <%=configuration.formatCurrency(booking.total_pending)%>
                    </span>
                  </li>
                </ul>

                <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
                  <div class="mybooking-product_taxes">
                    <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                  </div>
                <?php endif; ?>
              <% } %>
            </div>
          <% } %>

          <!-- // Contract signature -->
          <% if (typeof booking.electronic_signature_url !== 'undefined' &&
                 booking.electronic_signature_url && booking.electronic_signature_url != '') { %>
            <div class="mb-section">
              <!-- // Electronic signature --> 
              <button id="js_mb_electronic_signature_link" class="mb-button block">
                <?php echo esc_html_x( 'Sign contract', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
              </button>
            </div>
          <% } %>   

          <!-- // Payment block -->
          <div id="payment_detail" class="mb-section"></div>

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

<!-- RESERVATION PRODUCT MULTIPLE TABLE ------------------------------------------------------>

<script type="text/tmpl" id="script_mybooking_summary_product_detail_table">
  <?php mybooking_engine_get_template( 'mybooking-plugin-complete-multiple-items-table-tmpl.php' ); ?>
</script>

<!-- EXTRA DATA FORM ------------------------------------------------------>

<script type="text/tmpl" id="script_reservation_form">
  <% if (configuration.rentingFormFillDataAddress || configuration.rentingFormFillDataDriverDetail || 
         configuration.rentingFormFillDataNamedResources) { %>
    <form class="mybooking-form" id="form-reservation" name="booking_information_form" autocomplete="off">
      <div class="mb-alert light">
        <?php echo esc_html_x( 'Please complete the information to speed up the delivery process on the scheduled date', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
      </div>

      <!-- // Customer  -->
      <div class="mb-section mb-panel-container">
        <h3>
          <?php echo esc_html_x( 'Client tax data', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </h3>

        <% if ( booking.customer_type == 'individual' ) { %>
          <!-- Custom type individual -->
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-6">
              <label for="customer_name"><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
              <input class="mb-form-control" type="text" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-6">
              <label for="customer_surname"><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
              <input class="mb-form-control" type="text" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-4">
              <label for="customer_document_id_type_id"><?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <select name="customer_document_id_type_id" id="customer_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="customer_document_id"><?php echo esc_html_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
              <!-- TODO dni validation -->
              <input class="mb-form-control" type="text" name="customer_document_id" id="customer_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'ID card or passport', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" value="<%=booking.customer_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="customer_nacionality"><?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <select name="customer_nacionality" id="customer_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
            </div>
          </div>
        <% } else { %>
          <!-- Custom type company -->
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-6">
              <label for="customer_company_name"><?php echo esc_html_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
              <input class="mb-form-control" type="text" name="customer_company_name" id="customer_company_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-6">
              <label for="customer_company_document_id"><?php echo esc_html_x( 'Company ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>*</label>
              <input class="mb-form-control" type="text" name="customer_company_document_id" id="customer_company_document_id" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Company ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:*" maxlength="40" value="<%=booking.customer_company_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
        <% } %>
        <div class="mb-form-row">
          <div class="mb-form-group mb-col-md-6">
            <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input class="mb-form-control" type="text" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50" value="<%=booking.customer_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
          </div>
          <div class="mb-form-group mb-col-md-6">
            <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*</label>
            <input class="mb-form-control" type="text" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15" value="<%=booking.customer_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
          </div>
        </div>

        <!-- // Address -->
        <% if (configuration.rentingFormFillDataAddress) { %>
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-6">
              <label for="street"><?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="street" name="customer_address[street]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-3">
              <label for="number"><?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="number" name="customer_address[number]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-3">
              <label for="complement"><?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="complement" name="customer_address[complement]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-6">
              <label for="city"><?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="city" name="customer_address[city]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-6">
              <label for="state"><?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="state" name="customer_address[state]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-6">
              <label for="country"><?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <select name="customer_address[country]" id="country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
              </select>
            </div>
            <div class="mb-form-group mb-col-md-6">
              <label for="zip"><?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="zip" name="customer_address[zip]" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
        <% } %>
      </div>

      <!-- // Drivers -->
      <% if (!booking.has_optional_external_driver) { %>
        <% if (configuration.rentingFormFillDataDriverDetail) { %>
          <div class="mb-section mb-panel-container alert alert-info">
            <div class="mb-form-row">
              <label for="driver_is_customer">
                <input type="checkbox" name="driver_is_customer" id="driver_is_customer" <% if (booking.driver_is_customer) { %>checked<% } %>>
                &nbsp;
                <?php echo esc_html_x("Driver is client", 'renting_my_reservation', 'mybooking-wp-plugin') ?>
              </label>
            </div>
          </div>
        
          <div class="mb-section mb-panel-container" <% if (booking.driver_is_customer) { %>style="display: none;"<% } %>>
            <h3 class="mb-form_title">
              <?php echo esc_html( MyBookingEngineContext::getInstance()->getDriver() ) ?>
            </h3>
            <!-- Driver information -->
            <% if (booking.driver_type === 'driver') { %>
              <!-- Driver -->
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-6">
                  <label for="driver_name"><?php echo esc_html_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_name" name="driver_name" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
                    maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                </div>
                <div class="mb-form-group mb-col-md-6">
                  <label for=""><?php echo esc_html_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_surname" name="driver_surname" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
                    maxlength="40" <% if (!booking.can_edit_online ){%>disabled<%}%>>
                </div>
              </div>
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-6">
                  <label for="driver_nacionality"><?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_nacionality" id="driver_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                </div>
                <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_date_of_birth"><?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="mb-form-row mb-custom-date-form">
                    <div class="mb-custom-date-item">
                      <select name="driver_date_of_birth_day" id="driver_date_of_birth_day"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_date_of_birth_month" id="driver_date_of_birth_month"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_date_of_birth_year" id="driver_date_of_birth_year"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_date_of_birth" id="driver_date_of_birth"></input>
                </div>
              </div>
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-4">
                  <label for="driver_document_id_type_id"><?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_document_id_type_id" id="driver_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                </div>
                <div class="mb-form-group mb-col-md-4">
                  <label for="driver_document_id"><?php echo esc_html_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_document_id" name="driver_document_id" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
                    maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                </div>
                <div class="mb-form-group mb-col-md-4">
                  <label for="driver_origin_country"><?php echo esc_html_x( 'Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_origin_country" id="driver_origin_country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                </div>
              </div>
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_document_id_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="mb-form-row mb-custom-date-form">
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_date_day" id="driver_document_id_date_day"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_date_month" id="driver_document_id_date_month"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_date_year" id="driver_document_id_date_year"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_document_id_date" id="driver_document_id_date"></input>
                </div>
                <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_document_id_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="mb-form-row mb-custom-date-form">
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_expiration_date_day" id="driver_document_id_expiration_date_day"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_expiration_date_month" id="driver_document_id_expiration_date_month"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_document_id_expiration_date_year" id="driver_document_id_expiration_date_year"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_document_id_expiration_date" id="driver_document_id_expiration_date"></input>
                </div>
              </div>
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-4">
                  <label for="driver_driving_license_type_id"><?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_driving_license_type_id" id="driver_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                </div>
                <div class="mb-form-group mb-col-md-4">
                  <label
                    for="driver_driving_license_number"><?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.driver_driving_license_number%>"
                    maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                </div>
                <div class="mb-form-group mb-col-md-4">
                  <label for="driver_driving_license_country"><?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="driver_driving_license_country" id="driver_driving_license_country" class="form-control"
                    <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </select>
                </div>                
              </div>
              <div class="mb-form-row">
                <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_driving_license_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="mb-form-row mb-custom-date-form">
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_date_day" id="driver_driving_license_date_day"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_date_month" id="driver_driving_license_date_month"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_date_year" id="driver_driving_license_date_year"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_driving_license_date" id="driver_driving_license_date"></input>
                </div>
                <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_driving_license_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <div class="mb-form-row mb-custom-date-form">
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_expiration_date_day" id="driver_driving_license_expiration_date_day"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_expiration_date_month" id="driver_driving_license_expiration_date_month"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-custom-date-item">
                      <select name="driver_driving_license_expiration_date_year" id="driver_driving_license_expiration_date_year"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                  </div>
                  <input type="hidden" name="driver_driving_license_expiration_date" id="driver_driving_license_expiration_date"></input>
                </div>
              </div>

              <!-- // Driver Address -->
              <% if (configuration.rentingFormFillDataAddress) { %>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label for="driver_address_street"><?php echo esc_html_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_street" name="driver_address[street]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_street%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-3">
                    <label for="driver_address_number"><?php echo esc_html_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_number" name="driver_address[number]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-3">
                    <label for="driver_address_complement"><?php echo esc_html_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_complement" name="driver_address[complement]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_complement%>"  maxlength="20" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label for="driver_address_city"><?php echo esc_html_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_city" name="driver_address[city]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_city%>" maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label for=driver_address_state"><?php echo esc_html_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_state" name="driver_address[state]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_state%>"  maxlength="60" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label for="driver_address_country"><?php echo esc_html_x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="driver_address[country]" id="driver_address_country" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </select>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label for="driver_address_zip"><?php echo esc_html_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="driver_address_zip" name="driver_address[zip]" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_address_zip%>"  maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
              <% } %>
            </div>

            <% if (configuration.rentingFormFillDataAdditionalDriver1 || 
                  configuration.rentingFormFillDataAdditionalDriver2) { %>
              <div class="mb-section mb-panel-container">
                <!-- // Additional drivers information -->
                <h3 class="mb-form_title">
                  <?php echo esc_html_x('Additional drivers', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
                </h3>

                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label for="additional_driver_1_name"><?php echo esc_html_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="additional_driver_1_name" name="additional_driver_1_name" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                      value="<%=booking.additional_driver_1_name%>"
                      maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label for="additional_driver_1_surname"><?php echo esc_html_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="additional_driver_1_surname" name="additional_driver_1_surname" type="text"
                      placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                      value="<%=booking.additional_driver_1_surname%>"
                      maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label for="additional_driver_1_nacionality"><?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="additional_driver_1_nacionality" id="additional_driver_1_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label
                      for="additional_driver_1_date_of_birth"><?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <div class="mb-form-row mb-custom-date-form">
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_date_of_birth_day" id="additional_driver_1_date_of_birth_day"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_date_of_birth_month" id="additional_driver_1_date_of_birth_month"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_date_of_birth_year" id="additional_driver_1_date_of_birth_year"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                    </div>
                    <input type="hidden" name="additional_driver_1_date_of_birth" id="additional_driver_1_date_of_birth"></input>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-4">
                    <label for="additional_driver_1_document_id_type_id"><?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="additional_driver_1_document_id_type_id" id="additional_driver_1_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label
                      for="additional_driver_1_document_id"><?php echo esc_html_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="additional_driver_1_document_id" name="additional_driver_1_document_id"
                      type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                      value="<%=booking.additional_driver_1_document_id%>"
                      maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label
                      for="additional_driver_1_origin_country"><?php echo esc_html_x('Document ID expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="additional_driver_1_origin_country" id="additional_driver_1_origin_country"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </select>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label
                      for="additional_driver_1_document_id_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <div class="mb-form-row mb-custom-date-form">
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_date_day" id="additional_driver_1_document_id_date_day"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_date_month" id="additional_driver_1_document_id_date_month"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_date_year" id="additional_driver_1_document_id_date_year"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                    </div>
                    <input type="hidden" name="additional_driver_1_document_id_date" id="additional_driver_1_document_id_date"></input>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label
                      for="additional_driver_1_document_id_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <div class="mb-form-row mb-custom-date-form">
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_expiration_date_day" id="additional_driver_1_document_id_expiration_date_day"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_expiration_date_month" id="additional_driver_1_document_id_expiration_date_month"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_document_id_expiration_date_year" id="additional_driver_1_document_id_expiration_date_year"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                    </div>
                    <input type="hidden" name="additional_driver_1_document_id_expiration_date" id="additional_driver_1_document_id_expiration_date"></input>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-4">
                    <label for="additional_driver_1_driving_license_type_id"><?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="additional_driver_1_driving_license_type_id" id="additional_driver_1_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label
                      for="additional_driver_1_driving_license_number"><?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input class="form-control" id="additional_driver_1_driving_license_number" name="additional_driver_1_driving_license_number"
                      type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                      value="<%=booking.additional_driver_1_driving_license_number%>"
                      maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label
                      for="additional_driver_1_driving_license_country"><?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <select name="additional_driver_1_driving_license_country" id="additional_driver_1_driving_license_country"
                        class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </select>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                    <label
                      for="additional_driver_1_driving_license_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <div class="mb-form-row mb-custom-date-form">
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_date_day" id="additional_driver_1_driving_license_date_day"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_date_month" id="additional_driver_1_driving_license_date_month"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_date_year" id="additional_driver_1_driving_license_date_year"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                    </div>
                    <input type="hidden" name="additional_driver_1_driving_license_date" id="additional_driver_1_driving_license_date"></input>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                    <label
                      for="additional_driver_1_driving_license_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <div class="mb-form-row mb-custom-date-form">
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_expiration_date_day" id="additional_driver_1_driving_license_expiration_date_day"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_expiration_date_month" id="additional_driver_1_driving_license_expiration_date_month"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                      <div class="mb-custom-date-item">
                        <select name="additional_driver_1_driving_license_expiration_date_year" id="additional_driver_1_driving_license_expiration_date_year"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                      </div>
                    </div>
                    <input type="hidden" name="additional_driver_1_driving_license_expiration_date" id="additional_driver_1_driving_license_expiration_date"></input>
                  </div>
                </div>

                <hr />

                <% if (configuration.rentingFormFillDataAdditionalDriver2) { %>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-6">
                      <label for="additional_driver_2_name"><?php echo esc_html_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input class="form-control" id="additional_driver_2_name" name="additional_driver_2_name" type="text"
                        placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                        value="<%=booking.additional_driver_2_name%>"
                        maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-6">
                      <label for="additional_driver_2_surname"><?php echo esc_html_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input class="form-control" id="additional_driver_2_surname" name="additional_driver_2_surname" type="text"
                        placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                        value="<%=booking.additional_driver_2_surname%>"
                        maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-6">
                      <label for="additional_driver_2_nacionality"><?php echo esc_html_x( 'Nacionality', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <select name="additional_driver_2_nacionality" id="additional_driver_2_nacionality" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-form-group mb-col-md-6">
                      <label
                        for="additional_driver_2_date_of_birth"><?php echo esc_html_x('Date of birth', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <div class="mb-form-row mb-custom-date-form">
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_date_of_birth_day" id="additional_driver_2_date_of_birth_day"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_date_of_birth_month" id="additional_driver_2_date_of_birth_month"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_date_of_birth_year" id="additional_driver_2_date_of_birth_year"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                      </div>
                      <input type="hidden" name="additional_driver_2_date_of_birth" id="additional_driver_2_date_of_birth"></input>
                    </div>
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-4">
                      <label for="additional_driver_2_document_id_type_id"><?php echo esc_html_x( 'Document type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <select name="additional_driver_2_document_id_type_id" id="additional_driver_2_document_id_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label
                        for="additional_driver_2_document_id"><?php echo esc_html_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input class="form-control" id="additional_driver_2_document_id" name="additional_driver_2_document_id"
                        type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                        value="<%=booking.additional_driver_2_document_id%>"
                        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label
                        for="additional_driver_2_origin_country"><?php echo esc_html_x('Document ID expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <select name="additional_driver_2_origin_country" id="additional_driver_2_origin_country"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
                      </select>
                    </div>
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-6">
                      <label
                        for="additional_driver_2_document_id_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <div class="mb-form-row mb-custom-date-form">
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_date_day" id="additional_driver_2_document_id_date_day"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_date_month" id="additional_driver_2_document_id_date_month"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_date_year" id="additional_driver_2_document_id_date_year"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                      </div>
                      <input type="hidden" name="additional_driver_2_document_id_date" id="additional_driver_2_document_id_date"></input>
                    </div>
                    <div class="mb-form-group mb-col-md-6">
                      <label
                        for="additional_driver_2_document_id_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <div class="mb-form-row mb-custom-date-form">
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_expiration_date_day" id="additional_driver_2_document_id_expiration_date_day"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_expiration_date_month" id="additional_driver_2_document_id_expiration_date_month"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_document_id_expiration_date_year" id="additional_driver_2_document_id_expiration_date_year"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                      </div>
                      <input type="hidden" name="additional_driver_2_document_id_expiration_date" id="additional_driver_2_document_id_expiration_date"></input>
                    </div>
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-4">
                      <label for="additional_driver_2_driving_license_type_id"><?php echo esc_html_x( 'License type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <select name="additional_driver_2_driving_license_type_id" id="additional_driver_2_driving_license_type_id" class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label
                        for="additional_driver_2_driving_license_number"><?php echo esc_html_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input class="form-control" id="additional_driver_2_driving_license_number" name="additional_driver_2_driving_license_number"
                        type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                        value="<%=booking.additional_driver_2_driving_license_number%>"
                        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label
                        for="additional_driver_2_driving_license_country"><?php echo esc_html_x('Driving license expedition country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <select name="additional_driver_2_driving_license_country" id="additional_driver_2_driving_license_country"
                          class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>>
                      </select>
                    </div>                    
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-6">
                      <label
                        for="additional_driver_2_driving_license_date"><?php echo esc_html_x('Date of Issue', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <div class="mb-form-row mb-custom-date-form">
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_date_day" id="additional_driver_2_driving_license_date_day"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_date_month" id="additional_driver_2_driving_license_date_month"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_date_year" id="additional_driver_2_driving_license_date_year"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                      </div>
                      <input type="hidden" name="additional_driver_2_driving_license_date" id="additional_driver_2_driving_license_date"></input>
                    </div>
                    <div class="mb-form-group mb-col-md-6">
                      <label
                        for="additional_driver_2_driving_license_expiration_date"><?php echo esc_html_x('Date of expiry', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <div class="mb-form-row mb-custom-date-form">
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_expiration_date_day" id="additional_driver_2_driving_license_expiration_date_day"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_expiration_date_month" id="additional_driver_2_driving_license_expiration_date_month"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                        <div class="mb-custom-date-item">
                          <select name="additional_driver_2_driving_license_expiration_date_year" id="additional_driver_2_driving_license_expiration_date_year"
                            class="form-control" <% if (!booking.can_edit_online){%>disabled<%}%>></select>
                        </div>
                      </div>
                      <input type="hidden" name="additional_driver_2_driving_license_expiration_date" id="additional_driver_2_driving_license_expiration_date"></input>
                    </div>
                  </div>
                <% } %> 
              <% } %>

              <% } else if (booking.driver_type === 'skipper') { %>
                <!-- Skipper -->
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                  <label for="driver_name"><?php echo esc_html_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_name" name="driver_name" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("Name", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_name%>"
                    maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-6">
                  <label for="driver_surname"><?php echo esc_html_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_surname" name="driver_surname" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php  echo esc_attr_x("Surname", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_surname%>"
                    maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>

                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-12">
                  <label for="driver_document_id"><?php echo esc_html_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_document_id" name="driver_document_id" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x("ID card or passport", 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.driver_document_id%>"
                    maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>

                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_driving_license_type"><?php echo esc_html_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_driving_license_type" name="driver_driving_license_type"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Navigation license type', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.driver_driving_license_type%>"
                    maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>

                  <div class="mb-form-group mb-col-md-6">
                  <label
                    for="driver_driving_license_number"><?php echo esc_html_x('Navigation license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="driver_driving_license_number" name="driver_driving_license_number"
                    type="text" placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Driving license number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>"
                    value="<%=booking.driver_driving_license_number%>"
                    maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
              </div>
            <% } %>
          </div>
        <% } %>
      <% } %>

      <!-- // Flight -->
      <% if (configuration.rentingFromFillDataFlight) { %>
        <div class="mb-section mb-panel-container">
					<h3 class="mb-form_title">
            <?php echo esc_html_x('Flight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          </h3>

          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_company"><?php echo esc_html_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_company" name="flight_company" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company%>" maxlength="80" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_number"><?php echo esc_html_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_number" name="flight_number" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number%>" maxlength="10" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_time"><?php echo esc_html_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_time" name="flight_time" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time%>" maxlength="5" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>

          <h3 class="mb-form_title">
						<?php echo esc_html_x('Return flight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
					</h3>

          <div class="mb-form-row">
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_company_departure"><?php echo esc_html_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_company_departure" name="flight_company_departure" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Company', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_company_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_number_departure"><?php echo esc_html_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_number_departure" name="flight_number_departure" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Flight Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_number_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
            <div class="mb-form-group mb-col-md-4">
              <label for="flight_time_departure"><?php echo esc_html_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
              <input class="form-control" id="flight_time_departure" name="flight_time_departure" type="text"
                placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x('Estimated Time', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.flight_time_departure%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
            </div>
          </div>
        </div>
      <% } %>

      <!-- // Named resources -->
      <% if (configuration.rentingFormFillDataNamedResources) { %>
        <div class="mb-section mb-panel-container">
          <% for (var idx=0; idx<booking.booking_lines.length; idx++) { %>
              <% var booking_line = booking.booking_lines[idx]; %>
              <h3 class="mb-form_title"><%=booking_line.quantity%> x <%=booking_line.item_description%></h3>
              <% for (var idxResource=0; idxResource<booking.booking_lines[idx].booking_line_resources.length; idxResource++) { %>
                <% var booking_line_resource = booking.booking_lines[idx].booking_line_resources[idxResource]; %>
                <input type="hidden" name="booking_line_resources[<%=booking_line_resource.id%>][id]" value="<%=booking_line_resource.id%>"/>
                <% if (booking_line_resource.pax == 1) { %>
                  <h5 class="h5 border p-2"><?php echo esc_html_x( 'Participant', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                <% } else if (booking_line_resource.pax == 2) { %>
                  <h5 class="h5 border p-2"><?php echo esc_html_x( 'Participants', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                  <h6 class="h6 border p-1 text-right"><?php echo esc_attr_x( 'Pax 1', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
                <% } %>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-4">
                    <label><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_name]"
                            title="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                            class="form-control alt" type="text"
                            placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                            value="<%=booking_line_resource.resource_user_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_surname]"
                            title="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                            class="form-control alt" type="text"
                            placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                            value="<%=booking_line_resource.resource_user_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label><?php echo esc_html_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_document_id]"
                            title="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                            class="form-control alt" type="text"
                            placeholder="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                            value="<%=booking_line_resource.resource_user_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                </div>
                <div class="mb-form-row">
                  <div class="mb-form-group mb-col-md-4">
                    <label><?php echo esc_html_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_phone]"
                            title="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                            class="form-control alt" type="text"
                            placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                            value="<%=booking_line_resource.resource_user_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <div class="mb-form-group mb-col-md-4">
                    <label><?php echo esc_html_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                    <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_email]"
                            title="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                            class="form-control alt" type="text"
                            placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                            value="<%=booking_line_resource.resource_user_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                  </div>
                  <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>
                    <div class="mb-form-group mb-col-md-2">
                      <label><?php echo esc_html_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_height]"
                              title="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="number"
                              placeholder="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
                              value="<%=booking_line_resource.customer_height%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                  <% } %>
                  <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>
                    <div class="mb-form-group mb-col-md-2">
                      <label><?php echo esc_html_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_weight]"
                              title="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="number"
                              placeholder="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:"  min="0" max="200"
                              value="<%=booking_line_resource.customer_weight%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                  <% } %>
                </div>
                <% if (booking_line_resource.pax == 2) { %>
                  <h6 class="h6 border p-1 text-right"><?php echo esc_html_x( 'Pax 2', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h5>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-4">
                      <label><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_name]"
                              title="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="text"
                              placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                              value="<%=booking_line_resource.resource_user_2_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_surname]"
                              title="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="text"
                              placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                              value="<%=booking_line_resource.resource_user_2_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label><?php echo esc_html_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_document_id]"
                              title="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="text"
                              placeholder="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                              value="<%=booking_line_resource.resource_user_2_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                  </div>
                  <div class="mb-form-row">
                    <div class="mb-form-group mb-col-md-4">
                      <label><?php echo esc_html_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_phone]"
                              title="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="text"
                              placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                              value="<%=booking_line_resource.resource_user_2_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <div class="mb-form-group mb-col-md-4">
                      <label><?php echo esc_html_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                      <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_email]"
                              title="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                              class="form-control alt" type="text"
                              placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                              value="<%=booking_line_resource.resource_user_2_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                    </div>
                    <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>
                      <div class="mb-form-group mb-col-md-2">
                        <label><?php echo esc_html_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_height]"
                                title="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                class="form-control alt" type="number"
                                placeholder="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
                                value="<%=booking_line_resource.customer_2_height%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                      </div>
                    <% } %>
                    <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>
                      <div class="mb-form-group mb-col-md-2">
                        <label><?php echo esc_html_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_weight]"
                                title="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                class="form-control alt" type="number"
                                placeholder="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="200"
                                value="<%=booking_line_resource.customer_2_weight%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
                      </div>
                    <% } %>
                  </div>
                <% } %>
              <% } %>
          <% } %>
        </div>
      <% } %>

      <% if (booking.can_edit_online) { %>
        <button class="mb-button" id="btn_update_reservation">
            <?php echo esc_html_x( 'Update', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
        </button>
      <% } %>
    </form>
  <% } %>
</script>


<!-- PAYMENT BLOCK ------------------------------------------------------------>

<script type="text/tmpl" id="script_payment_detail">
  <div class="mb-section mb-panel-container">
    <div class="mybooking-payment_amount">
      <%= i18next.t('myReservation.pay.total_payment', {amount:configuration.formatCurrency(amount) }) %>
    </div>

    <% if (booking.total_paid == 0) {%>
      <div id="payment_amount_container" class="mb-alert info highlight">
        <%= i18next.t('complete.reservationForm.booking_amount', {amount:configuration.formatCurrency(amount) }) %>
      </div>
    <% } %>

    <form name="payment_form">
      <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) )?>
        </div>
        <div class="mybooking-payment_confirmation-box">
        <label class="mybooking-payment_custom-label" for="payments_paypal_standard">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </label>

        <label class="mybooking-payment_custom-label" for="payments_credit_card">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>"><?php echo wp_kses_post( _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
        </label>
        </div>
        <div id="payment_method_select_error"></div>  

      <% } else if (sales_process.payment_methods.paypal_standard) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
        </div>
        <div class="mybooking-payment_confirmation-box">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>
        <input type="hidden" name="payment_method_id" value="paypal_standard"/>

      <% } else if (sales_process.payment_methods.tpv_virtual) { %>
        <div class="mb-alert secondary" role="alert">
          <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
        </div>
        <div class="mybooking-payment_confirmation-box">
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
        </div>

        <input type="hidden" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>"/>
      <% } %>

      <% if (sales_process.can_pay_deposit) { %>
        <input type="hidden" name="payment" value="deposit"/>
      <% } else if (booking.total_paid == 0) {%>
        <input type="hidden" name="payment" value="total"/>
      <% } else { %>
        <input type="hidden" name="payment" value="pending"/>
      <% } %>

      <button class="mb-button block" id="btn_pay" type="submit">
        <%= i18next.t('myReservation.pay.payment_button', {amount:configuration.formatCurrency(amount) }) %>
      </button>

      <div id="payment_error" class="mb-alert danger" style="display:none"></div>
    </form>
  </div>
</script>

<!-- CONTRACT BLOCK ----------------------------------------------------------->

<script type="text/tmpl" id="script_contract_required_data">

  <div class="mb-alert danger" role="alert">
    <?php echo esc_html_x( 'The contract can not be signed. Please, check the errors.', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
  </div>

  <ul>
  <% for (property in contract_errors) { %>
    <li><%= contract_errors[property] %></li>
  <% } %>
  </ul>

</script>

<!-- PASSENGERS  BLOCK ----------------------------------------------------------->
<script type="text/tmpl" id="script_passengers_table">
  <div id="passengers_list">
    <div id="passengers_list__not_data" style="display:none">
      <?php echo esc_html_x("No passengers found in reservation", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
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
          <?php echo esc_html_x("Name", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
          *
        </label>
        <input class="form-control" id="passenger_name" name="passenger_name" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x("Name", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>"
        value=""
        maxlength="40" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <div class="mb-form-group mb-col-md-6">
        <label for="">
          <?php echo esc_html_x("Surname", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
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
          <?php echo esc_html_x("ID card or passport", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
          *
        </label>
        <input class="form-control" id="passenger_document_id" name="passenger_document_id" type="text"
          placeholder="<%=configuration.escapeHtml(" <?php echo esc_attr_x("ID card or passport", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>")%>" value=""
        maxlength="50" <% if (!booking.can_edit_online){%>disabled<%}%>>
      </div>
      <!-- <div class="mb-form-group mb-col-md-6">
        <label for="passenger_document_id_date">
          <?php echo esc_html_x('Date of Issue', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </label>
        <div class="custom-date-form">
          <div class="custom-date-item">
            <select name="passenger_document_id_date_day" id="passenger_document_id_date_day" class="form-control" <% if
              (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="custom-date-item">
            <select name="passenger_document_id_date_month" id="passenger_document_id_date_month" class="form-control" <%
              if (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
          <div class="custom-date-item">
            <select name="passenger_document_id_date_year" id="passenger_document_id_date_year" class="form-control" <% if
              (!booking.can_edit_online){%>disabled<%}%>></select>
          </div>
        </div>
        <input type="hidden" name="passenger_document_id_date" id="passenger_document_id_date"></input>
      </div> -->
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
      <div class="mb-form-group mb-col-xs-1" style="width: 5%; margin-right: 1rem;">
        <span class="mb-badge info" style="position: relative; top: -0.1rem;"><%= index %></span>
      </div>
      <div class="mb-form-group mb-col-xs-9" style="width: 85%;">
        <h6 style="margin: 0;">
          <%= passenger.name %> <%= passenger.surname %> 
        </h6>
      </div>
      <div class="mb-form-group mb-col-xs-2" style="width: 10%;">
        <button class="btn float-right" id="btn_remove_passenger" title="<?php echo esc_attr_x("Remove", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>" data-id="<%= passenger.id %>">
          <i class="mb-button icon"><span class="dashicons dashicons-trash"></span></i>
        </button>
      </div>
    </div>
    <div class="mb-form-row">
      <div class="mb-form-group mb-col-sm-4">
        <b>
          <?php echo esc_html_x("ID card or passport", 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <%= passenger.document_id %>
      </div>
      <!-- <div class="mb-form-group mb-col-sm-4">
        <b>
          <?php echo esc_html_x('Date of Issue', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
      </div> -->
      <div class="mb-form-group mb-col-sm-4">
        <b>
          <?php echo esc_html_x('Email address', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <%= passenger.email %>
      </div>
      <div class="mb-form-group mb-col-sm-4">
        <b>
          <?php echo esc_html_x('Phone number', 'renting_my_reservation_passenger', 'mybooking-wp-plugin') ?>
        </b>
        <br />
        <%= passenger.phone_number %>
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
