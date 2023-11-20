<!-- Static cards (Special case multiple rate types) -->
<script type="text/tpml" id="script_detailed_product_multiple_rates">
  
  <div class="cards-static-container" style="flex-direction: column;">
    <% for (var idx=0;idx<products.length; idx++) { %>
      <% var product = products[idx]; %>  
      <div class="row"  style="background-color: var(--card-image-bg-color);">
        <!-- Main detail -->          
        <div class="col-md-4 col-sm-12">


              <div class="card-static_image-container">
                <!-- // Few units warning -->
                <% if (product.few_available_units) { %>
                  <span class="card-static_low-availability">
                    <?php echo esc_html_x('Few units left!','renting_choose_product','mybooking') ?>
                  </span>
                <% } %>
                
                <span class="mybooking-card_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
                  <span class="dashicons dashicons-plus-alt"></span> INFO
                </span>

                <img class="card-static_image" style="border-radius: 0" src="<%=product.full_photo%>">

                <% if (product.highlight_message && product.highlight_message != '') { %>
                  <div class="card-static_custom-message"><%=product.highlight_message%></div>
                <% } %>
              </div>  
              <div class="card-static_body">
                <!-- // Product name and description -->
                <h2 class="card-static_product-name text-center">
                  <%=product.name%>
                </h2>

                <% if (+product.category_supplement_1_cost > 0) { %>
                  <div class="card-static_price_supplement p-b-1">
                    <div class="card-static_price_supplement_price">
                      <small><b><%=configuration.formatCurrency(product.price)%></b>&nbsp;<?php echo esc_html( MyBookingEngineContext::getInstance()->getProduct() )?></small>
                    </div>
                    <div class="card-static_price_supplement_supplement_1">
                      <small><b><%=configuration.formatCurrency(product.category_supplement_1_cost)%></b>&nbsp;<?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking' ) ?></small>
                    </div>
                  </div>
                <% } %>

              </div>              
              <div class="card-static_footer">
                <!-- Key characteristics -->
                <div class="card-static_icons">
                  <% if (product.key_characteristics) { %>
                    <% for (characteristic in product.key_characteristics) { %>
                      <div class="icon">
                        <% var characteristic_image_path = '<?php echo esc_url( get_stylesheet_directory_uri().'/images/key_characteristics/' ) ?>'+characteristic+'.svg'; %>
                        <img src="<%=characteristic_image_path%>" />
                        <span><%=product.key_characteristics[characteristic]%> </span>
                      </div>
                    <% } %>
                  <% } %>
                </div>
              </div>              

        </div>
        <!-- Rate types -->
        <div class="col-md-8 col-sm-12 p-5">  
            <div class="row">   
              <% for (var rateIdx=0;rateIdx<product.detailed_prices.length; rateIdx++) { %>
                <% if (product.detailed_prices[rateIdx].price.price > 0) { %> 
                  <div class="col-md-4">
                    <h3 class="h4"> <%= product.detailed_prices[rateIdx].name %></h3>
                    <hr>

                    <!-- // Offer (single product selection) -->
                    <% if (!product.exceeds_max && !product.be_less_than_min) { %>
                      <% if (!configuration.multipleProductsSelection && (product.availability || !configuration.hidePriceIfNotAvailable) ) { %>
                        <% if (product.detailed_prices[rateIdx].price.price != product.detailed_prices[rateIdx].price.base_price) { %>
                          <% if (product.detailed_prices[rateIdx].price.offer_discount_type == 'percentage' || 
                                 product.detailed_prices[rateIdx].price.offer_discount_type == 'amount') { %>
                            <span class="card-static_discount mb-2">
                              <span class="card-static_discount-badge badge badge-info"><%=new Number(product.detailed_prices[rateIdx].price.offer_value)%>% <%=product.detailed_prices[rateIdx].price.offer_name%></span>
                              <span class="card-static_original-price"><%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.base_price)%></span>
                            </span>
                          <% } else if (typeof shoppingCart.promotion_code !== 'undefined' && shoppingCart.promotion_code !== null
                                        && shoppingCart.promotion_code !== '' &&
                                        (product.detailed_prices[rateIdx].price.promotion_code_discount_type == 'percentage' || 
                                        product.detailed_prices[rateIdx].price.promotion_code_discount_type == 'amount') ) { %>
                            <span class="card-static_discount mb-2">
                              <span class="card-static_discount-badge badge badge-info"><%=new Number(product.detailed_prices[rateIdx].price.promotion_code_value)%>% <%=shoppingCart.promotion_code%></span>
                              <span class="card-static_original-price"><%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.base_price)%></span>
                            </span>
                          <% } %>
                        <% } %>
                      <% } %>
                    <% } %>

                    <div>
                      <%= product.detailed_prices[rateIdx].description %>
                    </div> 
                    <div class="card-static_btn">
                      <!-- // Exceeds max duration -->
                      <% if (product.exceeds_max) { %>
                        <div class="mybooking-card_product-availability-msg">
                          <%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %>
                        </div>

                      <!-- // Less than min duration -->
                      <% } else if (product.be_less_than_min) { %>
                        <div class="mybooking-card_product-availability-msg">
                          <%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %>
                        </div>

                      <!-- // Not available -->
                      <% } else if (!product.availability) { %>
                        <div class="mybooking-card_product-availability-msg">
                          <?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?>
                        </div>
                      <% } else { %>
                        <a class="button btn btn-choose-product"
                          data-product="<%=product.code%>"
                          data-rate-type-id="<%=product.detailed_prices[rateIdx].id%>">
                          <%= configuration.formatCurrency(product.detailed_prices[rateIdx].price.price) %>
                        </a>
                      <% } %>  
                    </div>
                  </div>
                <% } %>
              <% } %>
            </div>    
        </div>
      </div>
      <br>
    <% } %>
  </div>  


</script>