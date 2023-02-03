<?php
/**
 *   MYBOOKING ENGINE - CHOOSE PRODUCT TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-choose-product-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<!-- RESERVATION SUMMARY ------------------------------------------------------>

<script type="text/tmpl" id="script_reservation_summary">

  <!-- // Summary details -->

  <div class="mb-section mybooking-details_container">
    <div class="mybooking-summary_header">
      <div class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
      </div>

      <div class="mybooking-summary_edit" id="modify_reservation_button" role="link">
        <i class="mb-button icon"><span class="dashicons dashicons-edit"></span></i><?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
      </div>
    </div>

    <% if (configuration.rentDateSelector === 'date_from_duration') { %>
      <div class="mybooking-summary_detail">
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <%=shopping_cart.date_from_full_format%>
            <!-- Half Day : show the turns -->
            <% if (typeof shopping_cart.half_day !== 'undefined' &&
                   shopping_cart.half_day && halfDayTurns && halfDayTurns.length > 0) { %>
                <form name="mybooking-choose-product_duration-form" class="mybooking-choose-product_duration-form">
                  <% for (var idx=0; idx<halfDayTurns.length; idx++) { %>
                    <input type="radio" class="mybooking-summary-duration-turn"
                           name="turn" value="<%=halfDayTurns[idx].time_from%>-<%=halfDayTurns[idx].time_to%>"
                      <% if (shopping_cart.time_from === halfDayTurns[idx].time_from &&
                             shopping_cart.time_to === halfDayTurns[idx].time_to) {%>checked<%}%>>
                      <% if (halfDayTurns[idx].name && halfDayTurns[idx].name !== '') { %>
                        &nbsp;<%=halfDayTurns[idx].name%>
                      <% } else { %>        
                        <%=halfDayTurns[idx].time_from%>-<%=halfDayTurns[idx].time_to%>
                      <% } %>  
                    </input>
                  <% } %>
                </form>
            <% } else {%>
              <% if (configuration.timeToFrom) { %>
                ,&nbsp;<%= shopping_cart.time_from %>
              <% } %>
              &nbsp;(<%=shopping_cart.renting_duration_literal%>)
            <% } %>
          </span>
          <% if (configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_place">
              <%=shopping_cart.pickup_place_customer_translation%>
            </span>
          <% } %>
        </span>
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_duration">
            <%=shopping_cart.renting_duration_literal%>
          </span>
        </span>
      </div>

    <% } else { %>

      <div class="mybooking-summary_detail">
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <%=shopping_cart.date_from_full_format%>
            <% if (configuration.timeToFrom) { %>
              <%=shopping_cart.time_from%>
            <% } %>
          </span>
          <% if (configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_place">
              <%=shopping_cart.pickup_place_customer_translation%>
            </span>
          <% } %>
        </span>

        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <%=shopping_cart.date_to_full_format%>
            <% if (configuration.timeToFrom) { %>
              <%=shopping_cart.time_to%>
            <% } %>
          </span>
          <% if (configuration.pickupReturnPlace) { %>
            <span class="mybooking-summary_place">
              <%=shopping_cart.return_place_customer_translation%>
            </span>
          <% } %>
        </span>

        <% if (shopping_cart.days > 0) { %>
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_duration"><%=shopping_cart.days%> <?php echo MyBookingEngineContext::getInstance()->getDuration() ?></span>
          </span>
        <% } else if (shopping_cart.hours > 0) { %>
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_duration"><%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></span>
          </span>
        <% } %>
      </div>

    <% } %>

  </div>
</script>


<!-- PRODUCT LOOP ------------------------------------------------------------->

<script type="text/tpml" id="script_detailed_product">

  <div class="mybooking-product_container <?php if ( array_key_exists('choose_product_layout', $args) && ( in_array( $args['choose_product_layout'], ['grid', 'grid_only'] ) ) ): ?>mybooking-product_grid<?php else: ?>mybooking-product_list<?php endif;?>">

    <?php if ( array_key_exists('choose_product_layout', $args) && ( in_array( $args['choose_product_layout'], ['grid', 'list'] ) ) ): ?>
      <div class="mybooking-product_filter">
        <div class="mybooking-product_filter-btn-group">
          <span class="mybooking-product_filter-legend"><?php echo esc_html_x( 'Order', 'renting_choose_product', 'mybooking-wp-plugin') ?></span>
          <span class="mybooking-product_filter-btn grid js-mb-grid" title="Grid view"><i class="mb-button icon"><span class="dashicons dashicons-grid-view"></span></i></span>
          <span class="mybooking-product_filter-btn list js-mb-list" title="List view"><i class="mb-button icon"><span class="dashicons dashicons-list-view"></span></i></span>
        </div>
      </div>
    <?php endif; ?>

    <% for (var idx=0;idx<products.length; idx++) { %>
      <% var product = products[idx]; %>
      <div class="mybooking-product_column">
        <div class="mybooking-product">

          <div class="mybooking-product_block">
            <div class="mybooking-product_image-container">
              <span class="mybooking-product_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
                <span class="dashicons dashicons-plus-alt"></span> INFO
              </span>

              <% if (product.full_photo && product.full_photo !== '') { %>
                <img class="mybooking-product_image" src="<%=product.full_photo%>">
              <% } else { %>
                <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
              <% } %>
            </div>

            <% if (product.highlight_message && product.highlight_message != '') { %>
              <div class="mybooking-product_custom-message"><%=product.highlight_message%></div>
            <% } %>
          </div>

          <div class="mybooking-product_block">

            <% if (!configuration.multipleProductsSelection) { %>
              <% if (!configuration.hidePriceIfZero || +product.price > 0) { %>
                <div class="mybooking-product_header">
                  <div class="mybooking-product_price">

                    <!-- // Price (single product selection) -->
                    <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                      <% if (!configuration.multipleProductsSelection && (product.availability || !configuration.hidePriceIfNotAvailable)) { %>
                        <div class="mybooking-product_amount">
                          <%=configuration.formatCurrency(+product.price +
                            (+product.category_supplement_1_cost || 0) +
                            (+product.category_supplement_2_cost || 0) +
                            (+product.category_supplement_3_cost || 0))
                          %>
                        </div>
                        <% if (product.price != product.base_price) { %>
                          <span class="mybooking-product_original-price"><%= configuration.formatCurrency(product.base_price)%></span>
                        <% } %>
                      <% } %>
                    <% } %>

                  </div>

                  <!-- // Offer (single product selection) -->
                  <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                    <% if (!configuration.multipleProductsSelection && (product.availability || !configuration.hidePriceIfNotAvailable) ) { %>
                      <span class="mybooking-product_discount">

                        <!-- // Taxes included -->
                        <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
                          <span class="mybooking-product_taxes">
                            <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                          </span>
                        <?php endif; ?>

                        <% if (product.offer_discount_type == 'percentage' || product.offer_discount_type == 'amount') { %>
                          <span class="mybooking-product_discount-badge mb-badge info"><%=new Number(product.offer_value)%>% <%=product.offer_name%></span>
                        <% } else if (typeof shoppingCart.promotion_code !== 'undefined' && shoppingCart.promotion_code !== null && shoppingCart.promotion_code !== '' && (product.promotion_code_discount_type == 'percentage' || product.promotion_code_discount_type == 'amount') ) { %>
                          <span class="mybooking-product_discount-badge mb-badge success"><%=new Number(product.promotion_code_value)%>% <%=shoppingCart.promotion_code%></span>
                        <% } %>
                      </span>
                    <% } %>
                  <% } %>
                </div>
              <% } %>
            <% } %>

            <div class="mybooking-product_body">

              <!-- // Product name and description -->
              <h2 class="mybooking-product_name"><%=product.name%></h2>
              <% if (product.name != product.short_description) { %>
                <h3 class="mybooking-product_short-description"><%=product.short_description%></h3>
              <% } %>

              <!-- // Few units warning -->
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
                  <small><b><%=configuration.formatCurrency(product.category_supplement_1_cost)%></b>&nbsp;<?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking-wp-plugin' ) ?></small>
                </div>
              </div>
              <% } %>
            </div>

            <!-- // Key characteristics -->

            <div class="mybooking-product_characteristics">
              <% if (product.key_characteristics) { %>
                <% for (characteristic in product.key_characteristics) { %>
                  <div class="mybooking-product_characteristics-item">
                    <% var characteristic_image_path = '<?php echo esc_url( plugin_dir_url( __DIR__ ).'assets/images/key_characteristics/' ) ?>'+characteristic+'.svg'; %>
                    <img class="mybooking-product_characteristics-img" src="<%=characteristic_image_path%>" />
                    <span class="mybooking-product_characteristics-key"><%=product.key_characteristics[characteristic]%> </span>
                  </div>
                <% } %>
              <% } %>
            </div>


            <div class="mybooking-product_footer <% if (product.variants_enabled) { %>mybooking-product_variant_footer<% } %>">

              <!-- // Exceeds max duration -->
              <% if (product.exceeds_max) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>


              <!-- // Less than min duration -->
              <% } else if (product.be_less_than_min) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>

              <!-- // Available -->
              <% } else if (product.availability) { %>
                <% if (product.variants_enabled) { %>
                  <div class="product-variant-resume" data-product-code="<%=product.code%>"></div>
                  
                  <!-- // Button -->
                  <div class="card-static_btn">
                    <button class="button btn btn-choose-variant" data-toggle="modal" data-target="#modalVariantSelector" data-product="<%=product.code%>"><% if (configuration.multipleProductsSelection) { %><?php echo esc_html_x('Select units', 'renting_choose_product', 'mybooking-wp-plugin') ?><% } else { %><?php echo esc_html_x('Select options', 'renting_choose_product', 'mybooking-wp-plugin') ?><% } %></button>
                  </div>
                <% } else { %>
                  <% if (configuration.multipleProductsSelection) { %>
                    <!-- // Selector -->
                    <div class="car-listing-selector">
                      <select class="form-control select-choose-product" data-value="<%=product.code%>">
                        <option value="0"><%=i18next.t('chooseProduct.selectUnits')%></option>
                        <% for (var idx2=1;idx2<=(product.available);idx2++) { %>
                        <option value="<%=idx2%>"
                          <% if (shoppingCartProductQuantities[product.code] && idx2 == shoppingCartProductQuantities[product.code]) { %>
                          selected="selected" <%}%>
                          ><%=i18next.t('chooseProduct.units', {count: idx2})%>
                          (<%= configuration.formatCurrency(product.price * idx2) %>) </option>
                        <% } %>
                      </select>
                    </div>
                  <% } else { %>
                    <!-- // Button -->
                    <div class="card-static_btn">
                      <a class="button btn btn-choose-product"
                        data-product="<%=product.code%>"><?php echo esc_html_x('Book it!', 'renting_choose_product', 'mybooking') ?></a>
                    </div>
                  <% } %>
                <% } %>

              <!-- // Not available -->
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
    <button id="go_to_complete" class="mb-button btn-confirm-selection">
      <?php echo esc_html_x( 'Next', 'renting_choose_product', 'mybooking-wp-plugin') ?>
      <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
    </button>
  <% } %>
</script>


<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->

<script type="text/tmpl" id="script_product_modal">

  <div class="mybooking-modal_product-detail">
    <div class="mybooking-modal_product-container">
      <div class="mybooking-carousel-inner">
        <% for (var idx=0; idx<product.photos.length; idx++) { %>
          <div class="mybooking-carousel-item">
            <img class="mybooking-carousel_item-image" src="<%=product.photos[idx].full_photo_path%>" alt="<%=product.name%>">
          </div>
        <% } %>
      </div>
    </div>
    <div class="mybooking-modal_product-description" style="display: none">
      <%=product.description%>
    </div>
  </div>
  <div class="mybooking-modal_product-actions">
    <button id="modal_product_photos"><?php echo esc_html_x( "Photos", 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
    <button id="modal_product_info"><?php echo esc_html_x( "Info", 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
  </div>

</script>
<!-- Script that shows the product variant selection -->   
<script type="text/tpml" id="script_variant_product_resume">
  <div class="card-static_variant_resume__container">
    <div class="card-static_variant_resume__container_inside">
      <% for (var idxV=0;idxV<variantsSelected.length;idxV++) { %>
        <div class="card-static_variant_resume__box"><span class="card-static_variant_resume__box_inside"><%= variantsSelected[idxV]['quantity'] %></span> <span class="card-static_variant_resume__box_inside"><%= variantsSelected[idxV]['name'] %></span></div>
      <% } %>
    </div>
    <% if (total > 0) { %>
    <strong><span class="float-right"><%=configuration.formatCurrency(total)%></span></strong>
    <% } %>
  </div>
</script>
<script type="text/tpml" id="script_variant_product">
  <form name="variant_product_form">
    <div id="variant_product_selectors" class="mb-row">
      <% if (!configuration.multipleProductsSelection) { %>
        <div class="mb-form-group mb-col-sm-12">
          <select name="<%= product.code %>" id="<%= product.code %>" class="form-control variant_product_selector">
            <option value="0">Seleccionar variante</option>
            <% for (var idxV=0;idxV<variants.length;idxV++) { %>
              <% var variant = variants[idxV]; %>
              <option value="<%= variant.code %>" <% if  (variantsSelected[variant.code]) { %>selected<% } %>><%= variant.variant_name %> - <%=configuration.formatCurrency(variant.unit_price)%></option>
            <% } %>
          </select>
        </div>
      <% } else { %>
        <% for (var idxV=0;idxV<variants.length;idxV++) { %>
          <% var variant = variants[idxV]; %>
          <div class="mb-form-group mb-col-sm-12 mb-col-md-4">
            <label for="<%= variant.code %>">
              <%= variant.variant_name %>
            </label>
            <select name="<%= variant.code %>" id="<%= variant.code %>" <% if  (variant.available < 1) { %>disabled<% } %> class="form-control variant_product_selector">
              <option value="0">Seleccionar unidades</option>
              <% for (var idxVO=1;idxVO<=variant.available;idxVO++) { %>
                <option value="<%= idxVO %>"  <% if  (variantsSelected[variant.code] && variantsSelected[variant.code] === idxVO) { %>selected<% } %>><%= idxVO %> <% if  (idxVO > 1) { %>unidades<% } else { %>unidad<% } %> - <%=configuration.formatCurrency(variant.unit_price * idxVO)%></option>
              <% } %>
              </select>
          </div>
        <% } %>
      <% } %>
    </div>
    <div class="mb-row">
      <div class="mb-col-sm-10">
        <h4>Total</h4>
      </div>
      <div class="mb-col-sm-2">
        <h4 id="variant_product_total">
          <span id="variant_product_total_quantity"> <%=configuration.formatCurrency(total)%></span>
        </h4>
      </div>
    </div>
  </form>
</script>
