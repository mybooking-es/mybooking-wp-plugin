<?php
/**
 *   MYBOOKING ENGINE - Choose product card list multiple rates  TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the planning component
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-product-card-list-multiple-rate-type-tmpl.php
 * 
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<!-- Static cards (Special case multiple rate types) -->
<script type="text/tpml" id="script_detailed_product_multiple_rates">
  <div class="mybooking-product_container mybooking-product_multiple_rate_list">
    <div class="mybooking-product_column">
      <% if (products.length > 0) { %>
        <% for (var idx=0;idx<products.length; idx++) { %>
          <% var product = products[idx]; %>  
          <div class="mybooking-product">
            <div class="mybooking-product_header">
              <!-- // Few units warning -->
              <% if (product.few_available_units) { %>
                <span class="mybooking-product_low-availability">
                  <?php echo esc_html_x( 'Few units left!', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                </span>
              <% } else { %>
                &nbsp;
              <% } %>

              <% if (product.description && product.description.replace(/<p><br><\/p>/g, '') !== '' || product.photos && product.photos.length > 0) { %>
                <span class="mybooking-product_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
                  <span class="dashicons dashicons-plus-alt"></span> INFO
                </span>
              <% } %>
            </div>

            <div class="mybooking-product_content">
              <!-- // Detail  card -->
              <div class="mybooking-product_block">
                <div class="mybooking-product_image-box">
                  <!-- Image -->
                  <% if (product.full_photo && product.full_photo !== '') { %>
                    <img class="mybooking-product_image" src="<%=product.full_photo%>">
                  <% } else { %>
                    <img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
                  <% } %>

                  <!-- Highlight message -->
                  <% if (product.highlight_message && product.highlight_message != '') { %>
                    <div class="mybooking-product_custom-message">
                      <%=product.highlight_message%>
                    </div>
                  <% } %>
                </div>

                <!-- // Product name and description -->
                <h2 class="mybooking-product_name">
                  <%=product.name%>
                </h2>
                <% if (product.name != product.short_description) { %>
                  <h3 class="mybooking-product_short-description">
                    <%=product.short_description%>
                  </h3>
                <% } %>

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
              </div>

              <!-- Rate types -->
              <div class="mybooking-product_block">
                <% for (var rateIdx=0;rateIdx<product.detailed_prices.length; rateIdx++) { %>
                  <% if (product.detailed_prices[rateIdx].price.price> 0) { %>
                    <div class="mybooking-product_rate">
                      <div>
                        <h3 class="mybooking-product_rate_name">
                          <%= product.detailed_prices[rateIdx].name %>
                        </h3>

                        <!-- // Offer (single product selection) -->
                        <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                          <% if (!configuration.multipleProductsSelection && (product.availability ||
                            !configuration.hidePriceIfNotAvailable) ) { %>
                            <% if (product.detailed_prices[rateIdx].price.price !=product.detailed_prices[rateIdx].price.base_price) {
                              %>
                              <% if (product.detailed_prices[rateIdx].price.offer_discount_type=='percentage' ||
                                product.detailed_prices[rateIdx].price.offer_discount_type=='amount' ) { %>
                                <div class="mybooking-product_discount">
                                  <span class="mybooking-product_original-price">
                                    <%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.base_price)%>
                                  </span>

                                  <span class="mybooking-product_discount-badge mb-badge info">
                                    <%=new Number(product.detailed_prices[rateIdx].price.offer_value)%>%
                                      <%=product.detailed_prices[rateIdx].price.offer_name%>
                                  </span>
                                </div>
                              <% } else if (typeof shoppingCart.promotion_code !=='undefined' && shoppingCart.promotion_code !==null
                                && shoppingCart.promotion_code !=='' &&
                                (product.detailed_prices[rateIdx].price.promotion_code_discount_type=='percentage' ||
                                product.detailed_prices[rateIdx].price.promotion_code_discount_type=='amount' ) ) { %>
                                <div class="mybooking-product_discount">
                                  <span class="mybooking-product_original-price">
                                    <%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.base_price)%>
                                  </span>

                                  <span class="mybooking-product_discount-badge mb-badge info">
                                    <%=new Number(product.detailed_prices[rateIdx].price.promotion_code_value)%>%
                                      <%=shoppingCart.promotion_code%>
                                  </span>
                                </div>
                              <% } %>
                            <% } %>
                          <% } %>
                        <% } %>

                        <div class="mybooking-product_description">
                          <%= product.detailed_prices[rateIdx].description %>
                        </div>
                      </div>

                      <!-- // Exceeds max duration -->
                      <% if (product.exceeds_max) { %>
                        <div class="mb-badge danger">
                          <%= i18next.t('chooseProduct.max_duration', {duration:
                            i18next.t('common.'+product.price_units, {count: product.max_value, interpolation:
                            {escapeValue: false}} ), interpolation: {escapeValue: false}}) %>
                        </div>
                      <!-- // Less than min duration -->
                      <% } else if (product.be_less_than_min) { %>
                        <div class="mb-badge danger">
                          <%= i18next.t('chooseProduct.min_duration', {duration:
                            i18next.t('common.'+product.price_units, {count: product.min_value, interpolation:
                            {escapeValue: false}} ), interpolation: {escapeValue: false}}) %>
                        </div>
                      <!-- // Not available -->
                      <% } else if (!product.availability) { %>
                        <div class="mb-badge danger">
                          <?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?>
                        </div>
                      <% } else { %>
                        <div class="mybooking-product_footer-btn">
                          <!-- // Button -->
                          <button class="mb-button btn-choose-product" data-product="<%=product.code%>"
                            data-rate-type-id="<%=product.detailed_prices[rateIdx].id%>">
                            <%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.price) %>
                          </button>

                          <!-- // Taxes included -->
                          <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
                            <span class="mybooking-product_taxes">
                              <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
                            </span>
                          <?php endif; ?>
                        </div>
                      <% } %>
                    </div>
                  <% } %>
                <% } %>
              </div>
            </div>
          </div>
          <br />
        <% } %>
      <% } else { %>
        <div class="mb-alert light">
          <?php echo esc_html_x( 'No items found', 'renting_choose_product', 'mybooking-wp-plugin') ?>
        </div>
      <% } %>
    </div>
  </div>  
</script>