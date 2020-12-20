<?php
  /**
   * The Template for showing the renting complete step - JS microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-complete-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>
<!-- Extra representation -->
<script type="text/template" id="script_detailed_extra">

  <% if (coverages && coverages.length > 0) {%>
    <h4 class="complete-section-title"><?php echo esc_html_x( 'Coverage', 'renting_complete', 'mybooking-wp-plugin') ?></h4>
    <div class="extra-wrapper">
      <% for (var idx=0;idx<coverages.length;idx++) { %>
        <% var coverage = coverages[idx]; %>
        <% var value = (extrasInShoppingCart[coverage.code]) ? extrasInShoppingCart[coverage.code] : 0; %>
        <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>
        <div class="row extra-card <%=bg%> <% if (value > 0) {%>selected-coverage<%}%>" data-extra="<%=coverage.code%>">
          <% if (coverage.photo_path) { %>
          <div class="col-md-2">
            <img
              class="extra-img js-extra-info-btn"
              src="<%=coverage.photo_path%>"
              alt="<%=coverage.name%>"
              data-extra="<%=coverage.code%>">
          </div>
          <div class="col-md-4">
            <div class="extra-name"><b><%=coverage.name%></b></div>
          </div>
          <% } else { %>
            <div class="col-md-6">
              <div class="extra-name"><b><%=coverage.name%></b></div>
            </div>
          <% } %>
          <div class="col-md-3">
            <% if (coverage.max_quantity > 1) { %>
              <div class="extra-plus-minus">
                <button class="btn btn-primary btn-minus-extra"
                        data-value="<%=coverage.code%>"
                        data-max-quantity="<%=coverage.max_quantity%>">-</button>
                <input type="text" id="extra-<%=coverage.code%>-quantity"
                       class="form-control disabled text-center extra-input"
                       value="<%=value%>"
                       data-extra-code="<%=coverage.code%>"
                       readonly/>
                <button class="btn btn-primary btn-plus-extra"
                        data-value="<%=coverage.code%>"
                        data-max-quantity="<%=coverage.max_quantity%>">+</button>
              </div>
            <% } else { %>
              <div class="extra-check">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input extra-checkbox" id="checkboxl<%=coverage.code%>" data-value="<%=coverage.code%>"
                  <% if (extrasInShoppingCart[coverage.code] &&  extrasInShoppingCart[coverage.code] > 0) { %> checked="checked" <% } %>>
                  <label class="custom-control-label" for="checkboxl<%=coverage.code%>"></label>
                </div>
              </div>
            <% } %>
          </div>
          <div class="col-md-3">
           <p class="extra-price">
              <b><%= configuration.formatExtraAmount(i18next, coverage.one_unit_price, coverage.price_calculation,
                                                     shopping_cart.days, shopping_cart.hours,
                                                     coverage.unit_price)%></b>
           </p>
          </div>
        </div>
      <% } %>
    </div>
  <% } %>

  <% if (extras && extras.length > 0) {%>
    <h4 class="complete-section-title"><?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin') ?></h4>
    <div class="extra-wrapper">
      <% for (var idx=0;idx<extras.length;idx++) { %>
        <% var extra = extras[idx]; %>
        <% var value = (extrasInShoppingCart[extra.code]) ? extrasInShoppingCart[extra.code] : 0; %>
        <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>
        <div class="row extra-card <%=bg%>" data-extra="<%=extra.code%>">
          <% if (extra.photo_path) { %>
            <div class="col-md-2">
              <img class="extra-img js-extra-info-btn"
                    src="<%=extra.photo_path%>"
                    alt="<%=extra.name%>"
                    data-extra="<%=extra.code%>">
            </div>
            <div class="col-md-4">
              <div class="extra-name"><b><%=extra.name%></b></div>
            </div>
          <% } else { %>
            <div class="col-md-6">
              <div class="extra-name"><b><%=extra.name%></b></div>
            </div>
          <% } %>
          <div class="col-md-3">
            <% if (extra.max_quantity > 1) { %>
              <div class="extra-plus-minus">
                <button class="btn btn-primary btn-minus-extra"
                        data-value="<%=extra.code%>"
                        data-max-quantity="<%=extra.max_quantity%>">-</button>
                <input type="text" id="extra-<%=extra.code%>-quantity"
                       class="form-control disabled text-center extra-input" value="<%=value%>" data-extra-code="<%=extra.code%>" readonly/>
                <button class="btn btn-primary btn-plus-extra"
                        data-value="<%=extra.code%>"
                        data-max-quantity="<%=extra.max_quantity%>">+</button>
              </div>
            <% } else { %>
              <div class="extra-check">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input extra-checkbox" id="checkboxl<%=extra.code%>" data-value="<%=extra.code%>"
                  <% if (extrasInShoppingCart[extra.code] &&  extrasInShoppingCart[extra.code] > 0) { %> checked="checked" <% } %>>
                  <label class="custom-control-label" for="checkboxl<%=extra.code%>"></label>
                </div>
              </div>
            <% } %>
          </div>
          <div class="col-md-3">
           <p class="extra-price">
              <b><%= configuration.formatExtraAmount(i18next, extra.one_unit_price, extra.price_calculation,
                                                     shopping_cart.days, shopping_cart.hours,
                                                     extra.unit_price)%></b>
           </p>
          </div>
        </div>
      <% } %>
    </div>
  <% } %>

</script>


<!-- Script that shows the extra detail -->
<script type="text/tmpl" id="script_extra_modal">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <% for (var idx=0; idx<extra.photos.length; idx++) { %>
            <div class="carousel-item <% if (idx==0) {%>active<%}%>">
              <img class="d-block w-100" src="<%=extra.photos[idx].full_photo_path%>" alt="<%=extra.name%>">
            </div>
            <% } %>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">&lt;</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">&gt;</span>
          </a>
        </div>
        <div class="mt-3 text-muted"><%=extra.description%></div>
      </div>
    </div>
  </div>

</script>

<!-- Reservation summary -->
<script type="text/tmpl" id="script_reservation_summary">
  <div class="complete-reservation-summary-card ">
    <div class="card mb-3">
      <div class="card-header">
        <b><?php echo esc_html_x( 'Reservation summary', 'renting_complete', 'mybooking-wp-plugin') ?></b>
      </div>
      <ul class="list-group list-group-flush">
        <% if (configuration.pickupReturnPlace) {%>
        <li class="list-group-item reservation-summary-card-detail"><%=shopping_cart.pickup_place_customer_translation%></li>
        <% } %>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-calendar-o"></i>&nbsp;
          <%=shopping_cart.date_from_full_format%>
          <% if (configuration.timeToFrom) { %>
            <%=shopping_cart.time_from%>
          <% } %>
        </li>
        <% if (configuration.pickupReturnPlace) {%>
        <li class="list-group-item reservation-summary-card-detail"><%=shopping_cart.return_place_customer_translation%></li>
        <% } %>
        <li class="list-group-item reservation-summary-card-detail">
          <i class="fa fa-calendar-o"></i>&nbsp;
          <%=shopping_cart.date_to_full_format%>
          <% if (configuration.timeToFrom) { %>
            <%=shopping_cart.time_to%>
          <% } %>
        </li>
        <% if (shopping_cart.days > 0) { %>
          <li class="list-group-item reservation-summary-card-detail"><%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?></li>
        <% } else if (shopping_cart.hours > 0) { %>
          <li class="list-group-item reservation-summary-card-detail"><%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_complete', 'mybooking-wp-plugin' ) ?></li>
        <% } %>
        <li class="list-group-item">
          <button id="modify_reservation_button" class="btn btn-primary w-100"><?php echo esc_html_x( 'Edit', 'renting_complete', 'mybooking-wp-plugin' ) ?></button>
        </li>
      </ul>
    </div>

    <% if (configuration.promotionCode) { %>
      <!-- Promotion code -->
      <div class="card mb-3">
          <div class="card-header">
            <b><?php echo esc_html_x( 'Promotion Code', 'renting_complete', 'mybooking-wp-plugin' ) ?></b>
          </div>
          <div class="card-body">
            <form name="complete_promotion_code" class="form-inline">
              <input type="text" class="form-control mb-2 mr-sm-2" size="20" maxlength="30"
                     id="promotion_code" placeholder="<?php echo esc_attr_x( 'Promotion Code', 'renting_complete', 'mybooking-wp-plugin' ) ?>"
                     <%if (shopping_cart.promotion_code){%>value="<%=shopping_cart.promotion_code%>" disabled<%}%>>
              <button type="button" class="btn btn-primary mb-2" id="apply_promotion_code_btn" <%if (shopping_cart.promotion_code){%>disabled<%}%>><?php echo esc_html_x( 'Apply', 'renting_complete', 'mybooking-wp-plugin' ) ?></button>
            </form>
          </div>
      </div>
    <% } %>

    <!-- Products -->
    <% if (shopping_cart.items.length > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo MyBookingEngineContext::getInstance()->getProduct() ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <% for (var idx=0;idx<shopping_cart.items.length;idx++) { %>
          <li class="list-group-item reservation-summary-card-detail">
             <!-- Photo -->
             <img class="product-img" style="width: 120px" src="<%=shopping_cart.items[idx].photo_medium%>"/>
             <br>
             <!-- Description -->
             <span class="product-name"><b><%=shopping_cart.items[idx].item_description_customer_translation%></b></span>
             <!-- Quantity -->
             <% if (configuration.multipleProductsSelection) { %>
             <span class="badge badge-info"><%=shopping_cart.items[idx].quantity%></span>
             <% } %>
             <!-- Price -->
             <span class="product-amount pull-right">
               <%=configuration.formatCurrency(shopping_cart.items[idx].item_cost)%>
             </span>
             <!-- Offer/Promotion Code Appliance -->
             <% if (shopping_cart.items[idx].item_unit_cost_base != shopping_cart.items[idx].item_unit_cost) { %>
               <br>
               <div class="pull-right">
                 <!-- Offer -->
                 <% if (typeof shopping_cart.items[idx].offer_name !== 'undefined' &&
                        shopping_cart.items[idx].offer_name !== null && shopping_cart.items[idx].offer_name !== '') { %>
                    <span class="badge badge-info"><%=shopping_cart.items[idx].offer_name%></span>
                    <% if (shopping_cart.items[idx].offer_discount_type === 'percentage' && shopping_cart.items[idx].offer_value !== '') {%>
                      <span class="text-danger"><%=parseInt(shopping_cart.items[idx].offer_value)%>&#37;</span>
                    <% } %>
                 <% } %>
                 <!-- Promotion Code -->
                 <% if (typeof shopping_cart.promotion_code !== 'undefined' && shopping_cart.promotion_code !== '' &&
                        typeof shopping_cart.items[idx].promotion_code_value !== 'undefined' && shopping_cart.items[idx].promotion_code_value !== '') { %>
                    <span class="badge badge-success"><%=shopping_cart.promotion_code%></span>
                    <% if (shopping_cart.items[idx].promotion_code_discount_type === 'percentage' && shopping_cart.items[idx].promotion_code !== '') {%>
                      <span class="text-danger"><%=parseInt(shopping_cart.items[idx].promotion_code_value)%>&#37;</span>
                    <% } %>
                 <% } %>
                 <span class="text-muted">
                   <del><%=configuration.formatCurrency(shopping_cart.items[idx].item_unit_cost_base * shopping_cart.items[idx].quantity)%></del>
                 </span>
               </div>
             <% } %>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>
    <!-- Extras -->
    <% if (shopping_cart.extras.length > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
          <li class="list-group-item reservation-summary-card-detail">
              <span class="extra-name"><b><%=shopping_cart.extras[idx].extra_description%></b></span>
              <span class="badge badge-info"><%=shopping_cart.extras[idx].quantity%></span>
              <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%></span>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>
    <!-- Supplements -->
    <% if (shopping_cart.time_from_cost > 0 ||
          shopping_cart.pickup_place_cost > 0 ||
          shopping_cart.time_to_cost > 0 ||
          shopping_cart.return_place_cost > 0 ||
          shopping_cart.driver_age_cost > 0 ||
          shopping_cart.category_supplement_1_cost > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( 'Supplements', 'renting_complete', 'mybooking-wp-plugin' ) ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <!-- Supplements -->
          <% if (shopping_cart.time_from_cost > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.time_from_cost)%></span>
          </li>
          <% } %>
          <% if (shopping_cart.pickup_place_cost > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x( 'Pick-up place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.pickup_place_cost)%></span>
          </li>
          <% } %>
          <% if (shopping_cart.time_to_cost > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x( 'Return time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.time_to_cost)%></span>
          </li>
          <% } %>
          <% if (shopping_cart.return_place_cost > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x( 'Return place supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.return_place_cost)%></span>
          </li>
          <% } %>
          <% if (shopping_cart.driver_age_cost > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x( "Driver's age supplement", 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.driver_age_cost)%></span>
          </li>
          <% } %>
          <% if (shopping_cart.category_supplement_1_cost > 0) { %>
          <li class="list-group-item">
            <span class="product-amount pull-right"><?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking-wp-plugin' ) ?></span>
            <span
              class="extra-price"><%=configuration.formatCurrency(shopping_cart.category_supplement_1_cost)%></span>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>
    <!-- Deposit -->
    <% if (shopping_cart.total_deposit > 0) { %>
      <div class="card mb-3">
        <div class="card-header">
          <b><?php echo esc_html_x( "Deposit", 'renting_complete', 'mybooking-wp-plugin' ) ?></b>
        </div>
        <ul class="list-group list-group-flush">
          <!-- Deposit -->
          <% if (shopping_cart.total_deposit > 0) { %>
          <li class="list-group-item">
            <span class="extra-name"><?php echo esc_html_x('Deposit', 'renting_complete', 'mybooking-wp-plugin') ?></span>
            <span class="product-amount pull-right"><%=configuration.formatCurrency(shopping_cart.total_deposit)%></span>
          </li>
          <% } %>
        </ul>
      </div>
    <% } %>
    <!-- Total -->
    <div class="jumbotron mb-3">
      <h2 class="h5 text-center"><?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?></h2>
      <h2 class="h3 text-center"><%=configuration.formatCurrency(shopping_cart.total_cost)%></h2>
    </div>
  </div>
</script>

<!-- Payment detail -->
<script type="text/tmpl" id="script_payment_detail">
    <%
       var paymentAmount = 0;
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
         }
         else {
            paymentAmount = shopping_cart.total_cost;
         }
       }
    %>

    <!-- Payment -->

    <% if (sales_process.can_pay) { %>
      <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <!-- The payment method will be selected later -->
        <input type="hidden" name="payment" value="none">
      <% } else if (sales_process.payment_methods.paypal_standard) { %>
        <!-- Fixed paypal standard -->
        <input type="hidden" name="payment" value="paypal_standard">
      <% } else  if (sales_process.payment_methods.tpv_virtual) { %>
        <!-- Fixed tpv -->
        <input type="hidden" name="payment" value="<%=sales_process.payment_methods.tpv_virtual%>">
      <% } %>
    <% } else { %>
      <input type="hidden" name="payment" value="none">
    <% } %>

    <% if (selectionOptions > 1) { %>
      <hr>
      <div class="form-row">
         <% if (sales_process.can_request) { %>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="complete_action" value="request_reservation" class="complete_action">&nbsp;<?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
             </label>
           </div>
         <% } %>
         <% if (sales_process.can_pay_on_delivery) { %>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="complete_action" value="pay_on_delivery" class="complete_action">&nbsp;<?php echo esc_html_x( 'Pay on arrival', 'renting_complete', 'mybooking-wp-plugin' ) ?>
             </label>
           </div>
         <% } %>
         <% if (sales_process.can_pay) { %>
         <div class="form-group col-md-12">
           <label for="payments_paypal_standard">
            <input type="radio" name="complete_action" value="pay_now" class="complete_action">&nbsp;<?php echo esc_html_x( 'Pay now', 'renting_complete', 'mybooking-wp-plugin' ) ?>
           </label>
         </div>
         <% } %>
      </div>
    <% } %>

    <!-- Request reservation -->

    <% if (sales_process.can_request) { %>
    <div id="request_reservation_container" <% if (selectionOptions > 1 || !sales_process.can_request) { %>style="display:none"<%}%>>

        <div class="border p-4">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="payments_paypal_standard">
                <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">&nbsp;
                <?php if ( empty($args['terms_and_conditions']) ) { ?>
                  <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                <?php } else { ?>
                  <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                         'renting_complete', 'mybooking-wp-plugin' ),
                                                     $args['terms_and_conditions'] ) )?>
                <?php } ?>
              </label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary"><?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?></button>
            </div>
          </div>
        </div>

    </div>
    <% } %>

    <% if (sales_process.can_pay) { %>

        <% if (sales_process.can_pay_on_delivery) { %>
        <!-- Pay on delivery -->
        <div id="payment_on_delivery_container" <% if (selectionOptions > 1 || !sales_process.can_pay_on_delivery) { %>style="display:none"<%}%>>

            <div class="border p-4">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="payments_paypal_standard">
                      <input type="checkbox" id="conditions_read_payment_on_delivery" name="conditions_read_payment_on_delivery">&nbsp;
                      <?php if ( empty($args['terms_and_conditions']) ) { ?>
                        <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                      <?php } else { ?>
                        <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                               'renting_complete', 'mybooking-wp-plugin' ),
                                                           $args['terms_and_conditions'] ) ) ?>
                      <?php } ?>
                    </label>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><?php echo esc_html_x( 'Confirm', 'renting_complete', 'mybooking-wp-plugin' ) ?></button>
                  </div>
                </div>
            </div>

        </div>
        <% } %>

        <!-- Pay now -->

        <div id="payment_now_container" <% if (selectionOptions > 1 || !sales_process.can_pay) { %>style="display:none"<%}%>>

            <div class="border p-4">
                <h4><%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%></h4>
                <br>

                <!-- Payment amount -->

                <div class="alert alert-info">
                   <p><%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%></p>
                </div>

                <% if (sales_process.payment_methods.paypal_standard &&
                       sales_process.payment_methods.tpv_virtual) { %>
                    <div class="form-row">
                       <div class="form-group col-md-12">
                         <label for="payments_paypal_standard">
                          <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard">&nbsp;<?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                         </label>
                       </div>
                       <div class="form-group col-md-12">
                         <label for="payments_credit_card">
                          <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;<?php echo _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                          <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
                         </label>
                       </div>
                    </div>
                    <div id="payment_method_select_error" class="form-row">
                    </div>
                <% } else if (sales_process.payment_methods.paypal_standard) { %>
                    <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                <% } else if (sales_process.payment_methods.tpv_virtual) { %>
                    <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                    <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
                <% } %>

                <hr>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="payments_paypal_standard">
                      <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">&nbsp;
                          <?php if ( empty($args['terms_and_conditions']) ) { ?>
                            <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                          <?php } else { ?>
                            <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental',
                                                                   'renting_complete', 'mybooking-wp-plugin' ),
                                                               $args['terms_and_conditions'] ) )?>
                          <?php } ?>
                    </label>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%></a>
                  </div>
                </div>
            </div>

        </div>
    <% } %>
</script>
