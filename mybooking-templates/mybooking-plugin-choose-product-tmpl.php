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
              <% if (product.full_photo && product.full_photo !== '') { %>
                <img class="mybooking-product_image" src="<%=product.full_photo%>">
              <% } else { %>
                <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
              <% } %>
              <i class="mybooking-product_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
                <span class="dashicons dashicons-info"></span>
              </i>
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

                    <% if (product.price != product.base_price) { %>
                      <span class="mybooking-product_original-price"><%= configuration.formatCurrency(product.base_price)%></span>
                    <% } %>
                  </div>

                  <!-- // Offer (single product selection) -->
                  <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                    <% if (!configuration.multipleProductsSelection) { %>
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
              <div class="mybooking-product_description">
                <%=product.description%>
              </div>

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
                  <small><b><%=configuration.formatCurrency(product.category_supplement_1_cost)%></b>&nbsp;<?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking' ) ?></small>
                </div>
              </div>
              <% } %>
            </div>

            <!-- // Key characteristics -->
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

              <!-- // Exceeds max duration -->
              <% if (product.exceeds_max) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>


              <!-- // Less than min duration -->
              <% } else if (product.be_less_than_min) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>

              <!-- // Available -->
              <% } else if (product.availability) { %>
                <% if (configuration.multipleProductsSelection) { %>

                  <!-- // Selector -->
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

                  <!-- // Button -->
                  <button class="mb-button btn-choose-product" data-product="<%=product.code%>">
                    <?php echo _x( 'Book it!', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                  </button>
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
    <div class="mb-row">
      <div class="mb-col-md-12">
        <button id="go_to_complete" class="mb-button btn-confirm-selection">
          <?php echo esc_html_x( 'Next', 'renting_choose_product', 'mybooking') ?>
          <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
        </button>
      </div>
    </div>
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
