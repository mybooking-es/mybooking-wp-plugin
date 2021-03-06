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
    <!-- Script to show product search -->
    <script type="text/tpml" id="script_detailed_product">
      <div class="row">
        <% for (var idxP=0;idxP<products.length;idxP++) { %>
          <% if (idxP % 2 == 0 && idxP > 0) { %>
            </div>
            <div class="row">
          <% } %>
          <% var product = products[idxP]; %>
          <div class="col-md-6">
            <div class="product-card card d-flex flex-column mb-2">
              <div class="card-img">
                <img class="card-img-top js-product-info-btn" src="<%=product.full_photo%>" alt="<%=product.name%>"
                    data-product="<%=product.code%>">
                <i type="button" class="fa fa-info-circle js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>"></i>                    
              </div>
              <div class="card-body">
                <h5 class="card-title text-center"><%=product.short_description%></h5>
                <p class="card-text text-center text-muted"><%=product.name%></p>

                <div class="product-card-characteristics">
                  <% if (product.key_characteristics) { %> 
                    <% for (characteristic in product.key_characteristics) { %>
                      <div class="icon">
                        <% var characteristic_image_path = '<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/key_characteristics/' ) ?>'+characteristic+'.svg'; %>
                        <img src="<%=characteristic_image_path%>"/>
                        <span><%=product.key_characteristics[characteristic]%> </span>
                      </div>
                    <% } %>
                  <% } %>
                </div>

                <!-- Multiple products -->
                <% if (configuration.multipleProductsSelection) { %>  
                  <!-- Exceeds max duration -->
                  <% if (product.exceeds_max) { %>
                    <div class="card-info-container">
                       <div class="card-info">
                          <span class="badge badge-danger w-100 text-center"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
                       </div>  
                    </div>
                  <!-- Less than min duration -->  
                  <% } else if (product.be_less_than_min) { %>
                    <div class="card-info-container">
                       <div class="card-info">
                          <span class="badge badge-danger w-100 text-center"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
                       </div>  
                    </div> 
                  <!-- Available -->
                  <% } else if (product.availability) { %>
                    <div class="car-listing-selector">
                      <select class="form-control select-choose-product" data-value="<%=product.code%>">
                        <option value="0"><%=i18next.t('chooseProduct.selectUnits')%></option>
                        <% for (var idx=1;idx<=(product.available);idx++) { %>
                          <option value="<%=idx%>" <% if (shoppingCartProductQuantities[product.code] && idx == shoppingCartProductQuantities[product.code]) { %>selected="selected"<%}%>>
                            <%=i18next.t('chooseProduct.units', {count: idx})%>
                            (<%= configuration.formatCurrency(product.price * idx) %>)
                          </option>
                        <% } %>
                      </select>
                    </div>
                  <!-- Not available -->  
                  <% } else { %>
                    <div class="card-info-container">
                       <div class="card-info">
                          <span class="badge badge-light w-100 text-center"><?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?></span>
                       </div>  
                    </div>
                  <% } %>
                <% } else { %>  
                  <!-- One product -->
                  <% if (product.exceeds_max || product.be_less_than_min) { %>
                     <h3 class="text-center mt-5 mb-2">&nbsp;</h3>
                  <% } else {%>
                    <!-- Offer name -->
                    <% if (product.price != product.base_price) { %>
                      <% if (product.offer_discount_type == 'percentage' || product.offer_discount_type == 'amount') { %>
                        <div class="product-card-info-container">
                           <div class="product-card-info">
                              <span class="badge badge-info"><%=new Number(product.offer_value)%>% <%=product.offer_name%></span>
                           </div>
                        </div>
                      <% } else if (typeof shoppingCart.promotion_code !== 'undefined' && shoppingCart.promotion_code !== null && shoppingCart.promotion_code !== '' &&
                                    (product.promotion_code_discount_type == 'percentage' || product.promotion_code_discount_type == 'amount') ) { %>
                        <div class="product-card-info-container">
                           <div class="product-card-info">
                              <span class="badge badge-success"><%=new Number(product.promotion_code_value)%>% <%=shoppingCart.promotion_code%></span>
                           </div>
                        </div>
                      <% } %>
                    <% } %>
                    <!-- Price -->
                    <h3 class="text-center mt-5 mb-2">
                       <% if (product.price != product.base_price) { %>
                         <small class="h6" style="text-decoration: line-through"><%= configuration.formatCurrency(product.base_price)%></small>
                       <% } %>
                       <%= configuration.formatCurrency(product.price)%>
                       <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
                         <br>
                         <small class="h6"><?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?></small>
                       <?php endif; ?>                     
                    </h3>
                    <!-- Few units -->
                    <% if (product.availability && product.few_available_units) { %>
                      <div class="product-card-info-container">
                         <div class="product-card-info text-danger">
                            <span class="text-danger"><small><?php echo esc_html_x( 'Few units left!', 'renting_choose_product', 'mybooking-wp-plugin') ?></small></span>
                         </div>  
                      </div>
                    <% } %>
                  <% } %>
                <% } %>  
              </div>
              <% if (!configuration.multipleProductsSelection) { %>
                <div class="card-body mt-3">
                    <!-- Exceeds max duration -->
                    <% if (product.exceeds_max) { %>
                      <div class="card-info-container">
                         <div class="card-info">
                            <span class="badge badge-danger w-100 text-center"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
                         </div>  
                      </div>
                    <!-- Less than min duration -->  
                    <% } else if (product.be_less_than_min) { %>
                      <div class="card-info-container">
                         <div class="card-info">
                            <span class="badge badge-danger w-100 text-center"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
                         </div>  
                      </div>                    
                    <!-- Available -->  
                    <% } else if (product.availability) { %>
                      <button class="btn btn-primary btn-choose-product w-100" data-product="<%=product.code%>"><?php echo _x( 'Book it!', 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
                    <!-- Not available -->  
                    <% } else { %>
                      <div class="card-info-container">
                         <div class="card-info">
                            <span class="badge badge-light w-100 text-center"><?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?></span>
                         </div>  
                      </div>
                    <% } %>
                </div>
              <% } %>
            </div>
          </div>
        <% } %>
      </div>
      <br>
      <% if (configuration.multipleProductsSelection) { %>
      <div class="row">
        <div class="col-md-12">
          <button id="go_to_complete" class="btn btn-primary"><?php echo esc_html_x( 'Next', 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
        </div>
      </div>
      <% } %>
    </script>

    <!-- Script that shows the product detail -->
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

    <!-- Script detailed for reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="reservation-summary-card">
        <div class="card mb-3">
          <div class="card-header">
            <b><?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></b>
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
              <li class="list-group-item reservation-summary-card-detail"><%=shopping_cart.hours%> <?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></li>
            <% } %>
            <li class="list-group-item">
              <button id="modify_reservation_button" class="btn btn-primary w-100"><?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?></button>
            </li>
          </ul>
        </div>
      </div>
    </script> 