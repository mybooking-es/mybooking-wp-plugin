<!-- Product detail (#selected_product) -->

<script type="text/tpml" id="script_product_detail">
  <h4 class="is-size-4 has-text-weight-semibold has-text-grey">Vehículos</h4>
  <% for (var idx=0; idx<shopping_cart.items.length; idx++) { %>
    <p><%=shopping_cart.items[idx].item_description_customer_translation%> <span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.items[idx].item_cost)%></span></p>
    <img src="<%=shopping_cart.items[idx].photo_medium%>"/>  
  <% } %>  

</script>

<!-- Extra representation -->

<script type="text/template" id="script_detailed_extra">
  <h4 class="is-size-4 has-text-weight-semibold has-text-grey">Extras</h4>
  <% for (var idx=0;idx<extras.length;idx++) { %>
    <% var extra = extras[idx]; %>
    <section class="hero <% if (idx % 2 == 0) { %>is-light<%}%>">
      <div class="hero-body">
        <div class="columns">
          <div class="column is-one-third">
            <label for="select<%=extra.code%>" class="is-size-5 has-text-weight-bold"><%=extra.name%></label>
            <% if (extra.photo_path != null) { %>
            <img src="<%=extra.photo_path%>"/>
            <% } %>
          </div>
          <div class="column is-one-third">
            <% if (extra.max_quantity > 1) { %>
              <div class="field is-grouped">
                <button class="button is-primary btn-minus-extra" 
                        data-value="<%=extra.code%>"
                        data-max-quantity="<%=extra.max_quantity%>">-</button>           
                <div class="field">
                  <div class="control">
                  <% value = (extrasInShoppingCart[extra.code]) ? extrasInShoppingCart[extra.code] : 0; %>
                  <input type="text" id="extra-<%=extra.code%>-quantity" 
                         class="has-text-centered" readonly size="3" value="<%=value%>"/>
                  </div>
                </div>
                <button class="button is-primary btn-plus-extra" 
                        data-value="<%=extra.code%>"
                        data-max-quantity="<%=extra.max_quantity%>">+</button>
              </div>
            <% } else { %>
              <input id="checkboxl<%=extra.code%>" type="checkbox" class="extra-checkbox" data-value="<%=extra.code%>" <% if (extrasInShoppingCart[extra.code] &&  extrasInShoppingCart[extra.code] > 0) { %> checked="checked" <% } %>>          
            <% } %>
          </div>
          <div class="column is-one-third">
            <p class="is-size-4 has-text-weight-bold"><%= configuration.formatCurrency(extra.unit_price)%></p>
          </div>  
        </div>
      </div>
    </div>
  </section>  
  <% } %>
</script>

<!-- Reservation summary -->

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
    <div class="tile is-child notification has-background-light">
      <p class="title">Tu vehículo</h4>
      <div class="content">
      <% for (var idx=0; idx<shopping_cart.items.length; idx++) { %>
        <p><%=shopping_cart.items[idx].item_description_customer_translation%> <span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.items[idx].item_cost)%></span></p>
        <img src="<%=shopping_cart.items[idx].photo_medium%>"/>  
      <% } %>
      </div>
    </div>
    <% if (shopping_cart.extras.length > 0) { %>
    <div class="tile is-child notification has-background-light">
      <p class="title">Tus extras</h4>
      <div class="content">
        <ul>
      <% for (var idx=0; idx<shopping_cart.extras.length; idx++) { %>
        <li><%=shopping_cart.extras[idx].extra_description_customer_translation%> <span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%></span></li>
      <% } %>
        </ul>          
      </div>
    </div>
    <% } %>
    <div class="tile is-child notification has-background-light">
      <p class="title">Importe total</p>
      <p class="subtitle"><span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
    </div>
  </div>
</script>

<!-- Payment detail -->

<script type="text/tmpl" id="script_payment_detail">
  
  <% if (sales_process.can_pay && sales_process.can_request) { %>

    <h4 class="is-size-4 has-text-weight-semibold has-text-grey">Confirmar</h4>
    <br>

    <div class="field">
      <div class="control">
        <label class="radio">
          <input type="radio" id="none" name="payment" value="none" data-payment-method="none">
          Solicitud de reserva
        </label>
        <label class="radio">
          <input type="radio" id="credit-card" name="payment" value="redsys256" data-payment-method="redsys256">
          Pagar
        </label>
      </div>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button type="submit" class="button is-primary">Confirmar</a>
      </div>
    </div>  

  <% } else if (sales_process.can_request) { %>

    <input type="hidden" name="payment" value="none" data-payment-method="none">
    <div class="field is-grouped">
      <div class="control">
        <button type="submit" class="button is-primary">Solicitar reserva</a>
      </div>
    </div>  

  <% } else if (sales_process.can_pay) { %>

    <input type="hidden" name="payment" value="redsys256" data-payment-method="redsys256">
    <div class="field is-grouped">
      <div class="control">
        <button type="submit" class="button is-primary">Pagar</a>
      </div>
    </div>  
  <% } %>  

</script>