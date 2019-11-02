    <script type="text/tpml" id="script_shopping_cart_empty">
      <h2 class="title is-3">Su compra</h2>
      <p class="subtitle has-text-gray">El carrito de la compra está vacío</p>
    </script>

    <script type="text/tpml" id="script_products_detail">

      <h2 class="title is-3">Su compra</h2>

      <% for (idx in shopping_cart.items) { %>
         <div class="columns">
            <div class="column is-one-third">
              <figure class="image is-4by3 is-fullwidth">
                <img src="<%=shopping_cart.items[idx].photo_full%>" alt=""/>
              </figure>
            </div>
            <div class="column is-two-thirds">
              <h3 class="has-text-weight-bold is-4"><%=shopping_cart.items[idx].item_description_customer_translation%></h3>
              <h4 class="is-5 has-text-gray"><%= configuration.formatDate(shopping_cart.items[idx].date) %> <%= shopping_cart.items[idx].time %></h4>
              <hr>
              <table class="table is-striped is-fullwidth">
                <tbody>
                  <% for (var x=0; x<shopping_cart.items[idx]['items'].length; x++) { %>
                    <tr>
                        <td><%=shopping_cart.items[idx]['items'][x].quantity %>
                            <%=shopping_cart.items[idx]['items'][x].item_price_description %> x
                            <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_unit_cost) %>
                        </td>
                        <td class="has-text-right">
                            <%=configuration.formatCurrency(shopping_cart.items[idx]['items'][x].item_cost) %>
                        </td>
                    </tr>
                  <% } %>    
                  <tr>
                    <td class="has-text-weight-bold">Total</td>
                    <td class="has-text-weight-bold has-text-right"><%=configuration.formatCurrency(shopping_cart.items[idx]['total'])%></td>
                </tbody>
              </table>
              <br>  
              <br>  
              <div>
                <button class="button is-danger btn-delete-shopping-cart-item is-pulled-right"
                       data-item-id="<%=shopping_cart.items[idx].item_id%>"
                       data-date="<%=shopping_cart.items[idx].date%>"
                       data-time="<%=shopping_cart.items[idx].time%>"
                       style="position:relative;top:-50px">Eliminar</button>
              </div>       
            </div>  
         </div>
         <br>
       <% } %>

    </script>

    <!-- Script used to render the reservation summary -->

    <script type="text/tmpl" id="script_reservation_summary">

      <div class="tile is-parent is-vertical">
        <div class="tile is-child notification has-background-light">
          <p class="title is-4">Detalle de la reserva</h4>

          <div class="tile is-child notification has-background-light">
            <p class="title is-5">Importe total</p>
            <p class="subtitle is-3 has-text-weight-bold"><span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
          </div>

        </div> 
      </div>

    </script>

    <!-- Script customer -->
    <script type="text/tmpl" id="script_reservation_form">

      
        <input type="hidden" name="customer_language" value="<%=language%>"/>
    
        <h3 class="is-size-4 has-text-weight-semibold has-background-info has-text-white">&nbsp;Cliente</h3>
        <br>
        <div class="field field-body">
          <div class="field">
            <label class="label">Nombre*</label>
            <div class="control is-expanded">
                <input name="customer_name" id="customer_name" type="text" class="input" placeholder="Nombre:*">
            </div>
          </div>
          <div class="field">
            <label class="label">Apellidos*</label>
            <div class="control is-expanded">
                <input name="customer_surname" id="customer_surname" type="text" class="input"  placeholder="Apellidos:*">
            </div>
          </div>
        </div>
        <div class="field field-body">
          <div class="field">
            <label class="label">Correo electrónico*</label>
            <div class="control is-expanded">
                <input name="customer_email" id="customer_email" type="text" class="input"  placeholder="Correo electrónico:*">
            </div>
          </div>
          <div class="field">
            <label class="label">Confirmación correo electrónico*</label>
            <div class="control is-expanded">
                <input name="confirm_customer_email" id="confirm_customer_email" class="input"  type="text" placeholder="Confirmación del correo electrónico:*">
            </div>
          </div>
        </div>
        <div class="field field-body">
          <div class="field">
            <label class="label">Teléfono*</label>
            <div class="control is-expanded">
                <input name="customer_phone" id="customer_phone" type="text" class="input"  placeholder="Teléfono:*">
            </div>
          </div>
          <div class="field">
            <label class="label">Teléfono alternativo</label>
            <div class="control is-expanded">
                <input name="confirm_customer_email" id="confirm_customer_email" class="input"  type="text" placeholder="Teléfono alternativo:">
            </div>
          </div>
        </div>

        <br>
        <h3 class="is-size-4 has-text-weight-semibold has-background-info has-text-white">&nbsp;Información adicional</h3>
        <br>
        <div class="field">
          <label class="label">Comentarios</label>
          <div class="control is-expanded">
              <textarea name="comments" id="comments" class="textarea" placeholder="Comentarios"></textarea>
          </div>
        </div>
      
    </script>

    <!-- Script payment -->

    <script type="text/tmpl" id="script_payment_detail">
      
      <br>
      <h3 class="is-size-4 has-text-weight-semibold has-background-warning">&nbsp;Confirmar</h3>
      
      <br>
      <div class="field">
        <div class="control">
          <label class="checkbox">
              <div>
                <input type="checkbox" id="accept" name="accept"/>&nbsp;He leído y acepto los Términos y condiciones
              </div>
          </label>
        </div>
      </div>

      <% if ((shopping_cart.can_pay_deposit || shopping_cart.can_pay_total) && shopping_cart.can_make_request) { %>
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
            <button id="btn_reservation" type="button" class="button is-primary">Confirmar</a>
          </div>
        </div>  

      <% } else if (shopping_cart.can_make_request) { %>

        <input type="hidden" name="payment" value="none" data-payment-method="none">
        <div class="field is-grouped">
          <div class="control">
            <button id="btn_reservation" type="button" class="button is-primary">Solicitar reserva</a>
          </div>
        </div>  

      <% } else if ((shopping_cart.can_pay_deposit || shopping_cart.can_pay_total)) { %>
        
        <input type="hidden" name="payment" value="redsys256" data-payment-method="redsys256">
        <div class="field is-grouped">
          <div class="control">
            <button id="btn_reservation" type="button" class="button is-primary">Pagar</a>
          </div>
        </div>  
      <% } %> 


    </script>