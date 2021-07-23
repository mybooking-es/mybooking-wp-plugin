<?php
  /**
   * The Template for showing the renting select product step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-choose-product-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>


<!-- RESERVATION SUMMARY -->

<script type="text/tmpl" id="script_reservation_summary">

  <div class="mybooking-summary_details">
    <div class="mybooking-summary_details-title"><?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></div>

    <% if (configuration.timeToFrom) { %>
      <span class="mybooking-summary_item">
        <strong>
          <%=shopping_cart.date_to_full_format%>
          <%=shopping_cart.time_from%>
        </strong>
        <% if (configuration.pickupReturnPlace) { %>
          →&nbsp;<%=shopping_cart.pickup_place_customer_translation%>
        <% } %>
      </span>
    <% } %>

    <% if (configuration.timeToFrom || configuration.pickupReturnPlace) { %>
      <span class="mybooking-summary_item">
        <strong>
          <%=shopping_cart.date_to_full_format%>
          <%=shopping_cart.time_to%>
        </strong>
        <% if (configuration.pickupReturnPlace) { %>
          →&nbsp;<%=shopping_cart.return_place_customer_translation%>
        <% } %>
      </span>
    <% } %>

    <% if (shopping_cart.days > 0) { %>
      <span class="mybooking-summary_item">
        <strong><%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?></strong>
      </span>
    <% } else if (shopping_cart.hours > 0) { %>
      <span class="mybooking-summary_item">
        <strong><%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></strong>
      </span>
    <% } %>

    <a class="mybooking-summary_edit" id="modify_reservation_button"><?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></a>
  </div>
</script>



<!-- PRODUCT LOOP -->

<script type="text/tpml" id="script_detailed_product">

  <div class="mybooking-list">
    <% for (var idx=0;idx<products.length; idx++) { %>
      <% var product = products[idx]; %>
      <div class="mybooking-column">
        <div class="mybooking-product">

          <div class="mybooking-product_block">
            <div class="mybooking-product_image-container">
              <img class="mybooking-product_image" src="<%=product.full_photo%>">
              <i class="mybooking-product_info-button fa fa-info-circle js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>"></i>
            </div>

            <% if (product.highlight_message && product.highlight_message != '') { %>
              <div class="mybooking-product_custom-message"><%=product.highlight_message%></div>
            <% } %>
          </div>

          <div class="mybooking-product_block">

            <% if (!configuration.multipleProductsSelection) { %>
              <div class="mybooking-product_header">
                <div class="mybooking-product_price">

                  <!-- Price (single product selection) -->
                  <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                    <% if (!configuration.multipleProductsSelection) { %>
                      <div class="mybooking-product_amount">
                        <%=configuration.formatCurrency(+product.price +
                          (+product.category_supplement_1_cost || 0) +
                          (+product.category_supplement_2_cost || 0) +
                          (+product.category_supplement_3_cost || 0))
                        %>
                      </div>
                    <% } %>
                  <% } %>

                  <!-- Taxes included -->
                  <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
                    <span class="mybooking-product_taxes">
                      <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                    </span>
                  <?php endif; ?>
                </div>

                <!-- Offer (single product selection) -->
                <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                  <% if (!configuration.multipleProductsSelection) { %>
                    <% if (product.price != product.base_price) { %>
                      <% if (product.offer_discount_type == 'percentage' || product.offer_discount_type == 'amount') { %>
                        <span class="mybooking-product_discount">
                          <span class="mybooking-product_discount-badge mb-badge info"><%=new Number(product.offer_value)%>% <%=product.offer_name%></span>
                          <span class="mybooking-product_original-price"><%= configuration.formatCurrency(product.base_price)%></span>
                        </span>
                      <% } else if (typeof shoppingCart.promotion_code !== 'undefined' && shoppingCart.promotion_code !== null
                                    && shoppingCart.promotion_code !== '' &&
                                    (product.promotion_code_discount_type == 'percentage' || product.promotion_code_discount_type == 'amount') ) { %>
                        <span class="mybooking-product_discount">
                          <span class="mybooking-product_discount-badge mb-badge success"><%=new Number(product.promotion_code_value)%>% <%=shoppingCart.promotion_code%></span>
                          <span class="mybooking-product_original-price"><%= configuration.formatCurrency(product.base_price)%></span>
                        </span>
                      <% } %>
                    <% } %>
                  <% } %>
                <% } %>
              </div>
            <% } %>

            <div class="mybooking-product_body">

              <!-- Product name and description -->
              <div class="mybooking-product_product-name"><%=product.name%></div>
              <div class="mybooking-product_product-short-description"><%=product.short_description%></div>
              <!-- <div class="mybooking-product_product-description"><%=product.description%></div> -->

              <!-- Few units warning -->
              <% if (product.few_available_units) { %>
                <span class="mybooking-product_low-availability">
                  <?php echo esc_html_x( 'Few units left!', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                </span>
              <% } %>

              <% if (+product.category_supplement_1_cost > 0) { %>
              <div class="mybooking-product_price_supplement p-b-1">
                <div class="mybooking-product_price_supplement_price">
                  <small><b><%=configuration.formatCurrency(product.price)%></b>&nbsp;<?php echo esc_html( MyBookingEngineContext::getInstance()->getProduct() )?></small>
                </div>
                <div class="mybooking-product_price_supplement_supplement_1">
                  <small><b><%=configuration.formatCurrency(product.category_supplement_1_cost)%></b>&nbsp;<?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking' ) ?></small>
                </div>
              </div>
              <% } %>
            </div>

            <!-- Key characteristics -->
            <% if (product.key_characteristics) { %>
              <div class="mybooking-product_characteristics">
                <% for (characteristic in product.key_characteristics) { %>
                  <div class="mybooking-product_characteristics-item">
                    <% var characteristic_image_path = '<?php echo esc_url( plugin_dir_url( __DIR__ ).'assets/images/key_characteristics/' ) ?>'+characteristic+'.svg'; %>
                    <img class="mybooking-product_characteristics-img" src="<%=characteristic_image_path%>" />
                    <span class="mybooking-product_characteristics-key"><%=product.key_characteristics[characteristic]%> </span>
                  </div>
                <% } %>
              </div>
            <% } %>

            <div class="mybooking-product_footer">

              <!-- Exceeds max duration -->
              <% if (product.exceeds_max) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>


              <!-- Less than min duration -->
              <% } else if (product.be_less_than_min) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>

              <!-- Available -->
              <% } else if (product.availability) { %>
                <% if (configuration.multipleProductsSelection) { %>

                  <!-- Selector -->
                  <select class="mybooking-product_select select-choose-product" data-value="<%=product.code%>">
                    <option value="0">
                      <%=i18next.t('chooseProduct.selectUnits')%>
                    </option>
                    <% for (var idx2=1;idx2<=(product.available);idx2++) { %>
                      <option value="<%=idx2%>"
                        <% if (shoppingCartProductQuantities[product.code] && idx2 == shoppingCartProductQuantities[product.code]) { %> selected="selected" <% } %>
                        ><%=i18next.t('chooseProduct.units', {count: idx2})%>
                        ( <%= configuration.formatCurrency(product.price * idx2) %> )
                      </option>
                    <% } %>
                  </select>
                <% } else { %>

                  <!-- Button -->
                  <button class="mybooking-button btn-choose-product" data-product="<%=product.code%>">
                    <?php echo _x( 'Book it!', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                  </button>
                <% } %>

              <!-- Not available -->
              <% } else { %>

                <span class="mybooking-product_not-available">
                  <?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?>
                </span>
              <% } %>

            </div>
          </div>
        </div>
      </div>
    <% } %>
  </div>

  <% if (configuration.multipleProductsSelection) { %>
    <div class="mybooking-grid">
      <div class="mybooking-column">
        <button id="go_to_complete" class="mybooking-button"><?php echo esc_html_x( 'Next', 'renting_choose_product', 'mybooking') ?></button>
      </div>
    </div>
  <% } %>
</script>


<!-- PRODUCT DETAIL MODAL -->

<script type="text/tmpl" id="script_product_modal">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            <% for (var idx=0; idx<product.photos.length; idx++) { %>
            <div class="carousel-item <% if (idx==0) {%>active<%}%>">
              <img class="d-block w-100" src="<%=product.photos[idx].full_photo_path%>" alt="<%=product.name%>">
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

        <div class="mt-3 text-muted"><%=product.description%></div>
      </div>
    </div>
  </div>

</script>
