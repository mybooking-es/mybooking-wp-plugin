<?php
  /** 
   * The Template for showing the transfer select vehicle step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-choose-vehicle-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound 
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
    <!-- Script detailed product for choose_product -->   
    <script type="text/tmpl" id="script_transfer_detailed_product">
      <% if (available > 0) { %>
        <h2 class="h5"><%=i18next.t('transfer.chooseVehicle.vehicleFound', {available: available})%></h2>
      <% } else { %>
        <h2 class="h5"><%=i18next.t('transfer.chooseVehicle.vehicleNotFound')%></h2>  
      <% } %>    

      <div class="row">
        <% for (var idxP=0;idxP<products.length;idxP++) { %>
          <% if (idxP % 3 == 0 && idxP > 0) { %>
            </div>
            <div class="row">
          <% } %>
          <% var product = products[idxP]; %>
          <div class="col-md-4">
            <div class="product-card card d-flex flex-column mb-2">
              <div class="card-img">
                <% if (product.photo_url) { %>
                  <img class="card-img-top js-product-info-btn" src="<%=product.photo_url%>" alt="<%=product.name%>"
                      data-product="<%=product.id%>">
                <% } %>    
                <!--i type="button" class="fa fa-info-circle js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.id%>"></i-->                    
              </div>
              <div class="card-body">
                <p class="card-text text-center text-muted"><%=product.name%></p>
                <!-- Price -->
                <h3 class="text-center mt-5 mb-2">
                   <%= configuration.formatCurrency(product.price)%>
                </h3>
              </div>
              <div class="card-body mt-3">                
                <button class="btn btn-primary btn-choose-product w-100" data-product="<%=product.id%>"><?php echo _x( 'Book it!', 'transfer_choose_vehicle', 'mybooking-wp-plugin') ?></button>                
              </div>
            </div>
          </div>
        <% } %>
      </div>

    </script>
    
    <!-- Script detailed for reservation summary -->
    <script type="text/tmpl" id="script_transfer_reservation_summary">

      <div class="reservation-summary-card">
        <div class="card mb-3">
          <div class="card-header">
            <b><?php echo esc_html_x( 'Reservation summary', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>
          </div>
          <div class="row" style="padding: 1rem">
            <div class="col-md-4">
              <% if (shopping_cart.round_trip) { %>
                <p class="text-muted"><?php echo esc_html_x( 'Round trip', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></p>
              <% } else { %>
                <p class="text-muted"><?php echo esc_html_x( 'One Way', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></p>
              <% } %>
              <ul>
                <li><b><?php echo esc_html_x( 'Date', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.date%> <%=shopping_cart.time%></li>
                <li><b><?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.origin_point_name%></li>
                <li><b><?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.destination_point_name%></li>
              </ul>
              <% if (shopping_cart.round_trip) { %>
                <h2 class="h5"><?php echo esc_html_x( 'Return', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></h2>
                <ul>
                  <li><b><?php echo esc_html_x( 'Date', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.date%> <%=shopping_cart.time%></li>
                  <li><b><?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.date%> <%=shopping_cart.time%>: <%=shopping_cart.origin_point_name%></li>
                  <li><b><?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.destination_point_name%></li>
                </ul>              
              <% } %>
            </div>
            <div class="col-md-4">
              <p class="text-muted"><?php echo esc_html_x( 'Places', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></p>
              <ul>
                <li><b><?php echo esc_html_x( 'Adults', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.number_of_adults%></li>
                <li><b><?php echo esc_html_x( 'Children', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.number_of_children%></li>
                <li><b><?php echo esc_html_x( 'Infants', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></b>: <%=shopping_cart.number_of_infants%></li>
              </ul>              
            </div>
            <div class="col-md-4">
              <button id="mybooking_transfer_modify_reservation_button" class="btn btn-primary w-100 mt-3"><?php echo esc_html_x( 'Modify reservation', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?></button>              
            </div>
          </div>  
        </div>
      </div>

    </script> 