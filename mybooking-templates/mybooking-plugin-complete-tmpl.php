<?php
/**
 *   MYBOOKING ENGINE - COMPLETE TEMPLATE
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

<?php mybooking_engine_get_template('mybooking-plugin-reservation-complete-summary-tmpl.php', $args); ?>

<!-- RESERVATION DETAILS ----------------------------------------------------->

<script type="text/tmpl" id="script_reservation_summary">

  <!-- // Summary details -->
  <div class="mb-section mb-panel-container">
    <div class="mybooking-summary_header">
      <div class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
      </div>

      <div class="mybooking-summary_edit" id="modify_reservation_button" role="link">
        <i class="mb-button icon"><span class="dashicons dashicons-edit"></span></i><?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
      </div>
    </div>

    <div class="mybooking-summary_detail">
      <span class="mybooking-summary_item">
        <span class="mybooking-summary_date">
          <span class="dashicons dashicons-arrow-right-alt"></span>
          <%=booking.date_from_full_format%>
          <% if (configuration.timeToFrom) { %>
            <%=booking.time_from%>
          <% } %>
        </span>
        <% if (configuration.pickupReturnPlace) { %>
          <span class="mybooking-summary_place">
            <%=booking.pickup_place_customer_translation%>
          </span>
        <% } %>
      </span>

      <span class="mybooking-summary_item">
        <span class="mybooking-summary_date">
          
          <% if (configuration.rentDateSelector === 'date_from_duration') { %>
            <span class="dashicons dashicons-clock"></span>
            <!-- Duration -->
            <%= booking.renting_duration_literal %>
            <% if ( (typeof booking.half_day !== 'undefined' && booking.half_day) || (booking.days == 0) ){ %>
              <% if ( typeof booking.turn_description !== 'undefined' && booking.turn_description !== null && booking.turn_description !== '') { %>
                - <%= booking.turn_description %> 
              <% } else { %>
                ( <%= booking.time_from %> - <%= booking.time_to %> ) 
              <% } %>
            <% } %>
          <% } else { %>
            <!-- Date To -->
            <span class="dashicons dashicons-arrow-left-alt"></span>
            <%=booking.date_to_full_format%>
            <% if (configuration.timeToFrom) { %>
              <%=booking.time_to%>
            <% } %>
          <% } %>  
        
        </span>
        <% if (configuration.pickupReturnPlace) { %>
          <span class="mybooking-summary_place">
            <%=booking.return_place_customer_translation%>
          </span>
        <% } %>
      </span>

      <!-- // Duration -->
      <% if (configuration.rentDateSelector === 'date_from_date_to') { %>
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
      <% } %>

    </div>
  </div>

  <!-- // Product details -->
  <% if (booking.items.length > 0) { %>
    <div class="mb-section mb-panel-container">
      <% if ( !configuration.multipleProductsSelection ) { %>
        <!-- DETAIL IN ONE RESERVATION -->
        <div id="mybooking-summary_product_item_detail">
          <?php mybooking_engine_get_template( 'mybooking-plugin-complete-one-item-detail-tmpl.php' ); ?>
        </div>
      <% } %>

      <!-- // Extras -->
      <% if (booking.extras.length > 0) { %>
        <div class="mb-section">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>

          <% for (var idx=0;idx<booking.extras.length;idx++) { %>
            <div class="mybooking-summary_extras">
              <div class="mybooking-summary_extra-item">
                <span class="mb-badge info mybooking-summary_extra-quantity">
                  <%=booking.extras[idx].quantity%>
                </span>
                <span class="mybooking-summary_extra-name">
                  <%=booking.extras[idx].extra_description_customer_translation%>
                </span>
              </div>
              <span class="mybooking-summary_extra-amount">
                <%=configuration.formatCurrency(booking.extras[idx].extra_cost)%>
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
            booking.driver_age_cost > 0 ||
            booking.category_supplement_1_cost > 0) { %>

        <div class="mb-section">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Supplements', 'renting_complete', 'mybooking-wp-plugin' ) ?>
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
      <% if (!configuration.hidePriceIfZero || booking.total_cost > 0) { %>
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
      <% } %>
    </div>
  <% } %>

  <% if ( (booking.driver_age_rule_description && booking.driver_age_rule_description !== '') || configuration.promotionCode ) { %>
    <div class="mb-section mb-panel-container">
      <!-- Age rule applicate  -->
      <% if (booking.driver_age_rule_description && booking.driver_age_rule_description !== '') { %>
        <div class="mb-section">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Driver age', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>
          <div>
            <%= booking.driver_age_rule_description %>
          </div>
        </div>
      <% } %>

      <!-- // Promotion code -->
      <% if (configuration.promotionCode) { %>
        <div class="mb-section">
          <div class="mybooking-summary_details-title">
            <?php echo esc_html_x( 'Promotion Code', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          </div>
          <form class="form-inline mybooking-form" name="complete_promotion_code">
            <div class="mb-form-group">
            <input type="text" class="form-control" size="20" maxlength="30" id="promotion_code" placeholder="<?php echo esc_attr_x( 'Promotion Code', 'renting_complete', 'mybooking-wp-plugin' ) ?>" <%if (booking.promotion_code){%>value="<%=booking.promotion_code%>" disabled<%}%>>
            <button class="mb-button block" id="apply_promotion_code_btn" type="button" <%if (booking.promotion_code){%>disabled<%}%>>
              <?php echo esc_html_x( 'Apply', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            </button>
            </div>
          </form>
        </div>
      <% } %>
    </div>
  <% } %>

</script>

<!-- RESERVATION PRODUCT MULTIPLE TABLE ------------------------------------------------------>

<?php mybooking_engine_get_template( 'mybooking-plugin-complete-multiple-items-table-tmpl.php' ); ?>

<!-- EXTRAS LISTING ----------------------------------------------------------->

<script type="text/template" id="script_detailed_extra">
  <% if (coverages && coverages.length > 0 || (extras && extras.length > 0 && extras.filter((theExtra) => theExtra.available).length > 0)) {%>
    <div class="mb-section mb-panel-container mb--mb-2">
      <% if (coverages && coverages.length > 0) {%>
        <div class="mb-section">
          <h3 class="mb-section_title">
            <?php echo esc_html_x( 'Coverage', 'renting_complete', 'mybooking-wp-plugin') ?>
          </h3>

          <div class="mybooking-extra_container">
            <% for (var idx=0;idx<coverages.length;idx++) { %>
              <% var coverage = coverages[idx]; %>
              <% var value = (extrasInShoppingCart[coverage.code]) ? extrasInShoppingCart[coverage.code] : 0; %>
              <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>

              <div class="mybooking-extra_item <% if (value > 0) {%>selected-coverage<%}%>" data-extra="<%=coverage.code%>">

                <div class="mybooking-extra_block">

                  <% if (coverage.photo_path && coverage.photo_path !== '') { %>
                    <div class="mb-col-md-3 mb-col-sm-12 mybooking-extra_box-img">
                      <img class="mybooking-extra_img" src="<%=coverage.photo_path%>" alt="<%=coverage.name%>">
                    </div>
                    <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                      <div class="mybooking-extra_name">
                        <%=coverage.name%>
                      </div>

                      <% if (coverage.description && coverage.description.replace(/<p><br><\/p>/g, '') !== '') { %>
                        <div class="mybooking-extra_description">
                          <%=coverage.description%>
                          <div class="mybooking-extra_description-overlay"></div>
                        </div>
                      <% } %>

                      <span class="js-extra-info-btn mybooking-extra_info-btn" data-toggle="modal" data-target="#infoModal" data-extra="<%=coverage.code%>">
                        <span class="dashicons dashicons-plus-alt"></span> INFO
                      </span>
                    </div>

                  <% } else { %>
                    <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                      <div class="mybooking-extra_name">
                        <%=coverage.name%>
                      </div>

                      <% if (coverage.description && coverage.description.replace(/<p><br><\/p>/g, '') !== '') { %>
                        <div class="mybooking-extra_description">
                          <%=coverage.description%>
                          <div class="mybooking-extra_description-overlay"></div>
                        </div>

                        <span class="js-extra-info-btn mybooking-extra_info-btn" data-toggle="modal" data-target="#infoModal" data-extra="<%=coverage.code%>">
                          <span class="dashicons dashicons-plus-alt"></span> INFO
                        </span>
                      <% } %>
                    </div>
                  <% } %>
                </div>

                <div class="mybooking-extra_block">
                  <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-price">
                    <div class="mybooking-extra_price">
                      <%= configuration.formatExtraAmount( i18next, coverage.one_unit_price, coverage.price_calculation, coverage.days, coverage.hours, coverage.unit_price )%>
                    </div>
                  </div>

                  <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-control">

                    <% if (coverage.max_quantity > 1) { %>
                      <div class="mybooking-extra_control">
                        <button class="mb-button control btn-minus-extra" data-value="<%=coverage.code%>" data-max-quantity="<%=coverage.max_sellable_quantity%>">-</button>
                        <input class="mb-input extra-input" type="text" id="extra-<%=coverage.code%>-quantity" value="<%=value%>" data-extra-code="<%=coverage.code%>" readonly/>
                        <button class="mb-button control btn-plus-extra" data-value="<%=coverage.code%>" data-max-quantity="<%=coverage.max_sellable_quantity%>">+</button>
                      </div>

                    <% } else { %>
                      <div class="mybooking-extra_control">
                        <input class="mb-checkbox extra-checkbox" type="checkbox" id="checkboxl<%=coverage.code%>" data-value="<%=coverage.code%>" <% if (extrasInShoppingCart[coverage.code] &&  extrasInShoppingCart[coverage.code] > 0) { %> checked="checked" <% } %>>
                        <label class="mb-label" for="checkboxl<%=coverage.code%>"></label>
                      </div>
                    <% } %>
                  </div>
                </div>
              </div>
            <% } %>
          </div>
        </div>
      <% } %>

      <!-- Check for available extras -->
      <% if (extras && extras.length > 0 && extras.filter((theExtra) => theExtra.available).length > 0) {%>
        <div class="mb-section">
          <h3 class="mb-section_title">
            <?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin') ?>
          </h3>
          <div class="mybooking-extra_container">

            <% for (var idx=0;idx<extras.length;idx++) { %>
              <% var extra = extras[idx]; %>
              <% if (extra.available) { %>
                <% var value = (extrasInShoppingCart[extra.code]) ? extrasInShoppingCart[extra.code] : 0; %>
                <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>

                <div class="mybooking-extra_item" data-extra="<%=extra.code%>">

                  <div class="mybooking-extra_block">

                    <% if (extra.photo_path && extra.photo_path !== '') { %>
                      <div class="mb-col-md-3 mb-col-sm-12 mybooking-extra_box-img">
                        <img class="mybooking-extra_img" src="<%=extra.photo_path%>" alt="<%=extra.name%>">
                      </div>
                      <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                        <div class="mybooking-extra_name">
                          <%=extra.name%>
                        </div>
                        <% if (extra.description && extra.description.replace(/<p><br><\/p>/g, '') !== '') { %>
                          <div class="mybooking-extra_description">
                            <%=extra.description%>
                            <div class="mybooking-extra_description-overlay"></div>
                          </div>
                        <% } %>

                        <span class="js-extra-info-btn mybooking-extra_info-btn" data-toggle="modal" data-target="#infoModal" data-extra="<%=extra.code%>">
                          <span class="dashicons dashicons-plus-alt"></span> INFO
                        </span>
                      </div>

                    <% } else { %>
                      <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                        <div class="mybooking-extra_name">
                          <%=extra.name%>
                        </div>

                        <% if (extra.description && extra.description.replace(/<p><br><\/p>/g, '') !== '') { %>
                          <div class="mybooking-extra_description">
                            <%=extra.description%>
                            <div class="mybooking-extra_description-overlay"></div>
                          </div>

                          <span class="js-extra-info-btn mybooking-extra_info-btn" data-toggle="modal" data-target="#infoModal" data-extra="<%=extra.code%>">
                            <span class="dashicons dashicons-plus-alt"></span> INFO
                          </span>
                        <% } %>
                      </div>
                    <% } %>
                  </div>

                  <div class="mybooking-extra_block">
                    <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-price">
                    <div class="mybooking-extra_price">
                      <%= configuration.formatExtraAmount(i18next, extra.one_unit_price, extra.price_calculation, extra.days, extra.hours, extra.unit_price)%>
                    </div>
                    </div>

                    <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-control">
                      <% if (extra.max_quantity > 1) { %>
                        <div class="mybooking-extra_control">
                          <button class="mb-button control btn-minus-extra" data-value="<%=extra.code%>" data-max-quantity="<%=extra.max_sellable_quantity%>">-</button>
                          <input class="mb-input extra-input" type="text" id="extra-<%=extra.code%>-quantity" value="<%=value%>" data-extra-code="<%=extra.code%>" readonly/>
                          <button class="mb-button control btn-plus-extra" data-value="<%=extra.code%>" data-max-quantity="<%=extra.max_sellable_quantity%>">+</button>
                        </div>

                      <% } else { %>
                        <div class="mybooking-extra_control">
                          <input class="mb-checkbox extra-checkbox" type="checkbox" id="checkboxl<%=extra.code%>" data-value="<%=extra.code%>" <% if (extrasInShoppingCart[extra.code] &&  extrasInShoppingCart[extra.code] > 0) { %> checked="checked" <% } %>>
                          <label class="mb-label" for="checkboxl<%=extra.code%>"></label>
                        </div>
                      <% } %>
                    </div>
                  </div>
                </div>
              <% } %>  
            <% } %>
          </div>
        </div>
      <% } %>
    </div>
  <% } %>
</script>


<!-- PAYMENT BLOCK ------------------------------------------------------------>

<script type="text/tmpl" id="script_payment_detail">

  <?php
    $mybooking_engine_privacy_page = get_privacy_policy_url();
  ?>

  <% var paymentAmount = 0;
     var selectionOptions = 0;
     if (sales_process.can_request) {
       selectionOptions += 1;
     }
     if (sales_process.can_pay_on_delivery) {
       selectionOptions += 1;
     }
     if (sales_process.can_pay) {
       selectionOptions += 1;
       if (sales_process.can_pay_deposit) {
          paymentAmount = shopping_cart.booking_amount;
       } else {
          paymentAmount = shopping_cart.total_cost;
       }
     } %>

  <!-- // Payment hidden inputs -->

  <% if (sales_process.can_pay) { %>

    <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
      <!-- // The payment method will be selected later -->
      <input type="hidden" name="payment" value="none">

    <% } else if (sales_process.payment_methods.paypal_standard) { %>
      <!-- // Fixed paypal standard -->
      <input type="hidden" name="payment" value="paypal_standard">

    <% } else  if (sales_process.payment_methods.tpv_virtual) { %>
      <!-- // Fixed tpv -->
      <input type="hidden" name="payment" value="<%=sales_process.payment_methods.tpv_virtual%>">
    <% } %>

  <% } else { %>
    <input type="hidden" name="payment" value="none">
  <% } %>

  <!-- // Payment options -->
  <div class="mb-section mybooking-payment_options">
    
  <!-- // Request reservation -->
    <% if ( sales_process.can_request ) { %>
      <!-- // Request reservation INPUT -->
      <% if ( selectionOptions > 1 ) { %>
        <label class="mybooking-payment_option-label" for="complete_action_request_reservation">
          <input class="mybooking-payment_option-input" type="radio" id="complete_action_request_reservation" name="complete_action" value="request_reservation" class="complete_action">
          <?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </label>
       <% } %>

      <!-- // Request reservation PANEL -->
      <div id="request_reservation_container" <% if ( selectionOptions > 1 ) { %>style="display:none"<%}%> class="mb--p-1">
        <!-- Conditions -->
        <label for="conditions_read_request_reservation">
          <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">

          <?php if ( empty($args['terms_and_conditions']) ) { ?>
            <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          <?php } else { ?>
            <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) )?>
          <?php } ?>
        </label>

        <?php if ( !empty($mybooking_engine_privacy_page) ) { ?>
          <br/>
          <!-- Privacy -->
          <label for="privacy_read_request_reservation">
            <input type="checkbox" id="privacy_read_request_reservation" name="privacy_read_request_reservation">
              <?php echo wp_kses_post ( sprintf( _x( 'I have read and accept the <a href="%s" target="_blank">privacy policy</a>', 'renting_complete', 'mybooking-wp-plugin' ), $mybooking_engine_privacy_page ) )?>
          </label>
        <?php } ?>

        <br />

        <button type="submit" class="mb-button btn-confirm-reservation">
          <?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
        </button>
      </div>
    <% } %>

    <!-- // Pay on delivery -->
    <% if ( sales_process.can_pay_on_delivery ) { %>
      <!-- // Pay on delivery INPUT -->
      <% if ( selectionOptions > 1 ) { %>
        <label class="mybooking-payment_option-label" for="complete_action_pay_on_delivery">
          <input class="mybooking-payment_option-input" type="radio" id="complete_action_pay_on_delivery" name="complete_action" value="pay_on_delivery" class="complete_action">
          <?php echo esc_html_x( 'Book now and pay on arrival', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </label>
      <% } %>

      <!-- // Pay on delivery PANEL -->
      <div id="payment_on_delivery_container" <% if ( selectionOptions > 1 ) { %>style="display:none"<%}%> class="mb--p-1">
        <!-- Conditions -->
        <label for="conditions_read_payment_on_delivery">
          <input type="checkbox" id="conditions_read_payment_on_delivery" name="conditions_read_payment_on_delivery">

          <?php if ( empty($args['terms_and_conditions']) ) { ?>
            <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          <?php } else { ?>
            <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) ) ?>
          <?php } ?>
        </label>

        <?php if ( !empty($mybooking_engine_privacy_page) ) { ?>
          <br/>
          <!-- Privacy -->
          <label for="privacy_read_payment_on_delivery">
              <input type="checkbox" id="privacy_read_payment_on_delivery" name="privacy_read_payment_on_delivery">
              <?php echo wp_kses_post ( sprintf( _x( 'I have read and accept the <a href="%s" target="_blank">privacy policy</a>', 'renting_complete', 'mybooking-wp-plugin' ), $mybooking_engine_privacy_page ) )?>
          </label>
        <?php } ?>

        <br />

        <button type="submit" class="mb-button btn-confirm-reservation">
          <?php echo esc_html_x( 'Confirm', 'renting_complete', 'mybooking-wp-plugin' ) ?>
          <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
        </button>
      </div>
    <% } %>

    <!-- // Pay now -->
    <% if ( sales_process.can_pay ) { %>
      <!-- // Pay now INPUT -->
      <% if ( selectionOptions > 1 ) { %>
        <label class="mybooking-payment_option-label" for="complete_action_pay_now">
          <input class="mybooking-payment_option-input" type="radio" id="complete_action_pay_now" name="complete_action" value="pay_now" class="complete_action">
          <?php echo esc_html_x( 'Book now and pay now', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </label>
      <% } %>

      <!-- // Pay now PANEL -->
      <div id="payment_now_container" <% if ( selectionOptions > 1 ) { %>style="display:none"<%}%> class="mb--p-1">
        <div class="mybooking-payment_confirmation-info">

          <!-- // Payment amount -->
          <div class="mybooking-payment_amount">
            <%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%>
          </div>

          <!-- // Payment info -->
          <div class="mb-alert info highlight">
            <%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%>
          </div>

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

          <% } else if (sales_process.payment_methods.tpv_virtual) { %>
            <div class="mb-alert secondary" role="alert">
              <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
            </div>
            <div class="mybooking-payment_confirmation-box">
              <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
              <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
            </div>
          <% } %>
        </div>

        <div>
          <!-- Conditions -->
          <label for="conditions_read_pay_now">
            <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">

            <?php if ( empty($args['terms_and_conditions']) ) { ?>
              <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            <?php } else { ?>
              <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) )?>
            <?php } ?>
          </label>

          <?php if ( !empty($mybooking_engine_privacy_page) ) { ?>
            <br/>
            <!-- Privacy -->
            <label for="privacy_read_pay_now">
              <input type="checkbox" id="privacy_read_pay_now" name="privacy_read_pay_now">
                <?php echo wp_kses_post ( sprintf( _x( 'I have read and accept the <a href="%s" target="_blank">privacy policy</a>', 'renting_complete', 'mybooking-wp-plugin' ), $mybooking_engine_privacy_page ) )?>
            </label>
          <?php } ?>

          <br />
          
          <button type="submit" class="mb-button btn-confirm-reservation">
            <%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%>
            <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
          </button>
        </div>
      </div>
    <% } %>
  </div>
</script>

<!-- LOGIN / REGISTER --------------------------------------------------------->

<!-- Existing customer / New customer -->
<script type="text/template" id="script_complete_complement">

  <div class="mybooking-account_login" id="reservation_complement_container">
    <form class="mybooking-account_login-type mybooking-form" name="mybooking_select_user_form">
      <div class="mb-tabs">

        <!-- Have account -->
        <label class="mb-tabs_item">
          <input class="mb-input_hidden" type="radio" name="registered_customer" id="mybooking_engine_registered_customer" value="true" checked>
          <span class="mb-tabs_item-text"><?php echo esc_html_x( "Have account", 'login', 'mybooking-wp-plugin') ?></span>
        </label>

        <!-- New customer -->
        <label class="mb-tabs_item">
          <input class="mb-input_hidden" type="radio" name="registered_customer" id="mybooking_engine_unregistered_customer" value="false">
          <span class="mb-tabs_item-text"><?php echo esc_html_x( "New customer", 'login', 'mybooking-wp-plugin') ?></span>
        </label>
      </div>
    </form>

    <form class="mybooking-account_login-form mybooking-form mybooking_login_form_element" name="mybooking_login_form" autocomplete="off">
      <div class="mb-form-group">
        <label for="mybooking_login_username"><?php echo esc_html_x( "Username or email", 'login', 'mybooking-wp-plugin') ?></label>
        <input type="text" name="username" class="form-control" id="mybooking_login_username" placeholder="<?php echo esc_html_x( "Enter username or email", 'login', 'mybooking-wp-plugin') ?>">
      </div>
      <div class="mb-form-group">
        <label for="mybooking_login_password"><?php echo esc_html_x( "Password", 'login', 'mybooking-wp-plugin') ?></label>
        <input type="password" name="password" class="form-control" id="mybooking_login_password" placeholder="<?php echo esc_html_x( "Password", 'login', 'mybooking-wp-plugin') ?>">
      </div>
      <div class="mybooking-selector_footer">
        <button type="submit" class="mb-button"><?php echo esc_html_x( "Login", 'login', 'mybooking-wp-plugin') ?></button>
        <span class="mb-button link mybooking_login_password_forgotten">
          <?php echo esc_html_x( "Forgot password?", 'login', 'mybooking-wp-plugin') ?>
        </span>
      </div>
    </form>
  </div>
</script>

<!-- Password forgotten -->

<script type="text/template" id="script_password_forgotten">

  <div class="mb-row">
    <div class="mb-col-md-12">
      <div class="mb-alert light">
        <p><?php echo esc_html_x( "Please, fill the form with the username or email and send to reset your password", 'password_forgotten', 'mybooking-wp-plugin') ?></p>
      </div>
      <form name="mybooking_password_forgotten_form" autocomplete="off" class="mybooking-form">
        <div class="mb-form-group">
          <label for="mybooking_password_forgotten_username"><?php echo esc_html_x( "Username or email", 'password_forgotten', 'mybooking-wp-plugin') ?></label>
          <input type="text" name="username" class="mb-form-control" id="mybooking_password_forgotten_username" placeholder="<?php echo esc_html_x( "Enter username or email", 'password_forgotten', 'mybooking-wp-plugin') ?>">
        </div>
        <div class="mybooking-selector_footer">
          <button type="submit" class="mb-button"><?php echo esc_html_x( "Send", 'password_forgotten', 'mybooking-wp-plugin') ?></button>
        </div>
      </form>
    </div>
  </div>
</script>

<!-- Welcome user message -->

<script type="text/template" id="script_welcome_customer">
  <br>
  <div class="mb-alert highlight">
    <%=i18next.t('common.welcomeConnectedUser', {name: user.full_name})%>
  </div>
</script>

<!-- Create account -->

<script type="text/template" id="script_create_account">
  <div class="form-group mybooking_rent_create_account_selector_container">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="create_customer_account" id="mybooking_engine_rent_create_customer_account" value="true" checked>
      <label class="form-check-label" for="registered_customer">
        <?php echo esc_html_x( "Create account and book a reservation", 'renting_complete_create_account', 'mybooking-wp-plugin') ?>
      </label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="create_customer_account" id="mybooking_engine_rent_not_create_customer_account" value="false">
      <label class="form-check-label" for="unregistered_customer">
        <?php echo esc_html_x( "Only book a reservation", 'renting_complete_create_account', 'mybooking-wp-plugin') ?>
      </label>
    </div>
  </div>
  <div class="form-group mybooking_rent_create_account_fields_container">
    <label for="account_password"><?php echo esc_html_x( 'Password', 'renting_complete_create_account', 'mybooking-wp-plugin') ?></label>
    <input type="password" class="mb-form-control" name="account_password" id="account_password"  autocomplete="off" placeholder="<?php echo esc_attr_x( 'Password', 'renting_complete_create_account', 'mybooking-wp-plugin') ?>:" maxlength="20">
    <small class="form-text text-muted"><?php echo esc_html_x( "Password must contain upper case letter, lower case letter, digit and symbol (@ ! * - _)", 'renting_complete_create_account', 'mybooking-wp-plugin') ?></small>
  </div>
</script>


<!-- MODAL ------------------------------------------------------------------->

<!-- Script that shows the extra detail -->
<script type="text/tmpl" id="script_extra_modal">
  <div class="mybooking-modal_product-detail mb-row">

    <% if (extra.photos && extra.photos.length > 0) { %>
      <div class="mybooking-modal_product-container <% if (!extra.description || extra.description.replace(/<p><br><\/p>/g, '') === '') { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-8<% } %>">
        <div id="mybooking-modal_extra-gallery" class="mybooking-modal_extra-gallery">
          <% if (extra.video_source && extra.video_source !== '' &&  extra.video_url && extra.video_url !== '' && extra.video_source == 'youtube') { %>
            <span class="js-extra-toogle-video product-toogle-video-btn" data-target="video">
              <?php echo esc_html_x( 'Show video', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </span>
            <span class="js-extra-toogle-video product-toogle-video-btn" data-target="image" style="display: none">
              <?php echo esc_html_x( 'Show gallery', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </span>
          <% } %>
          <br />
          <div class="mybooking-carousel-inner">
            <% for (var idx=0; idx<extra.photos.length; idx++) { %>
              <div class="mybooking-carousel-item">
                <img class="mybooking-carousel_item-image" src="<%=extra.photos[idx].full_photo_path%>" alt="<%=extra.name%>">
              </div>
            <% } %>
          </div>
          <div id="mybooking_transfer_extra_detail_video"></div>
        </div>
       </div>
    <% } %>
    <% if (extra.description && extra.description.replace(/<p><br><\/p>/g, '') !== '') { %>
      <div class="mybooking-modal_product-info  <% if (!extra.photos || extra.photos.length === 0) { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-4<% } %>">
        <div class="mybooking-modal_product-description">      
          <%=extra.description%>
        </div>
      </div>
    <% } %>
  </div>
</script>

<!-- EXTRA MODAL VIDEO ----------------------------------------------------->

  <!-- Video template -->
  <script type="text/tmpl" id="script_transfer_extra_detail_video">
    <% if (extra.video_source && extra.video_source !== '' &&  extra.video_url && extra.video_url !== '' && extra.video_source == 'youtube') { %>
      <div class="mb-video-responsive">
        <iframe src="https://www.youtube.com/embed/<%= extra.video_url %>" title="<%= extra.name %>" frameborder="0" allowfullscreen class="mybooking-video-inner"></iframe>
      </div>
    <% } %>
  </script>

