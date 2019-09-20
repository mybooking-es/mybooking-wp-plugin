    <!-- Script to show product search -->
    <script type="text/tpml" id="script_detailed_product">
      <% for (var idxP=0;idxP<products.length;idxP++) { %>
        <% var product = products[idxP]; %>
        <div class="<% if (idxP % 2 == 1) {%>has-background-light<%}%>">
          <div class="columns">
            <div class="column">
              <h2 class="title"><%=product.name%></h2>
            </div>
          </div>
          <div class="columns">
            <div class="column is-one-third">
              <img src="<%=product.photo%>" alt="">           
            </div>
            <div class="column is-one-third">
              <%=product.description%>
            </div>
            <div class="column is-one-third">
              <div class="hero">
                <div class="hero-head">&nbsp;</div>
                <div class="hero-foot">
                  <!-- Offer -->
                  <% if (product.price != product.base_price) { %>             
                    <% if (product.offer_discount_type == 'percentage') { %>
                      <p><%=new Number(product.offer_value)%>% <%=product.offer_name%></p>
                    <% } %>
                    <p class="has-text-centered"><small style="text-decoration: line-through"><%= configuration.formatCurrency(product.base_price)%></small></p>
                  <% } %>
                  <h3 class="has-text-info is-size-3 has-text-weight-bold has-text-centered"><%= configuration.formatCurrency(product.price)%></h3>
                  <% if (product.availability) { %>
                    <% if (product.few_available_units) { %>
                    <p class="has-text-danger has-text-centered">¡Quedan pocas unidades!</p>  
                    <br>
                    <% } %>              
                    <a class="button is-primary btn-choose-product is-fullwidth" role="button" data-product="<%=product.code%>">Reservar</a>
                  <% } else { %>
                    <p class="has-text-centered">Modelo no disponible en la oficina y fechas seleccionadas</p>
                  <% } %>
                </div>
              </div>
            </div>
          </div>
        </div>
      <% } %>
    </script>

    <!-- Script detailed for reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="tile is-parent is-vertical">
        <div class="tile is-child notification has-background-light">
          <p class="title">Reserva</h4>
          <div class="content">
            <p class="subtitle has-text-weight-semibold has-text-grey">Entrega</p>
            <ul>
              <li><%=shopping_cart.pickup_place_customer_translation%></li>
              <li><%=shopping_cart.date_from_full_format%> <%=shopping_cart.time_from%></li>
            </ul>
          </div>
          <div class="content">
            <p class="subtitle has-text-weight-semibold has-text-grey">Devolución</p>
            <ul>
              <li><%=shopping_cart.return_place_customer_translation%></li>
              <li><%=shopping_cart.date_to_full_format%> <%=shopping_cart.time_to%></li>
            </ul>
          </div>
          <div class="content">
            <p class="has-text-weight-semibold">Duración del alquiler: <%=shopping_cart.days%> día/s</p>
            <div class="is-pulled-right">
              <button id="modify_reservation_button" class="button is-primary">Modificar reserva</button>  
            </div>  
          </div> 
        </div> 
      </div>
    </script> 