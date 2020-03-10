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
              <img class="card-img-top js-product-info-btn" src="<%=product.full_photo%>" alt="<%=product.name%>"
                    data-product="<%=product.code%>">
              <div class="card-body">
                <h5 class="card-title text-center"><%=product.short_description%></h5>
                <p class="card-text text-center text-muted"><%=product.name%></p>
                <!-- Multiple products -->
                <% if (configuration.multipleProductsSelection) { %>  
                  <% if (product.availability) { %>
                  <div class="car-listing-selector">
                    <select class="form-control select-choose-product" data-value="<%=product.code%>">
                      <% for (var idx=0;idx<=(product.available);idx++) { %>
                        <option value="<%=idx%>" <% if (shoppingCartProductQuantities[product.code] && idx == shoppingCartProductQuantities[product.code]) { %>selected="selected"<%}%>>
                          <%=idx%> (<%= configuration.formatCurrency(product.price * idx) %>)
                        </option>
                      <% } %>
                      </select>
                    </div>
                  <% } else { %>
                    <p class="text-center text-muted">No hay productos disponibles</p>
                  <% } %>
                <% } else { %>  
                  <!-- Offer name -->
                  <% if (product.price != product.base_price) { %>
                    <% if (product.offer_discount_type == 'percentage' || product.offer_discount_type == 'amount') { %>
                      <div class="product-card-info-container">
                         <div class="product-card-info">
                            <span class="badge badge-info"><%=new Number(product.offer_value)%>% <%=product.offer_name%></span>
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
                  </h3>
                  <!-- Few units -->
                  <% if (product.availability && product.few_available_units) { %>
                    <div class="product-card-info-container">
                       <div class="product-card-info text-danger">
                          <span class="text-danger"><small>¡Quedan pocas unidades!</small></span>
                       </div>  
                    </div>
                  <% } %>
                <% } %>  
              </div>
              <% if (!configuration.multipleProductsSelection) { %>
              <div class="card-body">
                  <% if (product.availability) { %>
                    <button class="btn btn-primary btn-choose-product w-100" data-product="<%=product.code%>">Reservar</button>
                  <% } else { %>
                    <div class="card-info-container">
                       <div class="card-info">
                          <span class="badge badge-dark">Modelo no disponible en la oficina y fechas seleccionadas</span>
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
          <button id="go_to_complete" class="btn btn-primary">Siguiente</button>
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
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
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
            <b>Su reserva</b>
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
            <li class="list-group-item reservation-summary-card-detail">Duración del alquiler: <%=shopping_cart.days%> día/s</li>
            <li class="list-group-item">
              <button id="modify_reservation_button" class="btn btn-primary w-100">Modificar reserva</button>
            </li>
          </ul>
        </div>
      </div>
    </script> 