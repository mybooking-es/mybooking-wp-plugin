    <!-- Reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="tile is-parent is-vertical">

        <!-- Summary message -->
        <div class="hero <% if (booking.status == 'confirmed'){ %>is-primary<%} else if (booking.status == 'pending_confirmation') {%>is-warning<%}%> ">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                <%= booking.summary_status %>
              </h1>
            </div>
          </div>
        </div>
        <br>
        <div class="hero">
          <div class="hero-body">
            <div class="container">
              <h2 class="subtitle">
                LOCALIZADOR: <%= booking.id %>
              </h2>
            </div>
          </div>
        </div>
        <!-- Pickup/return information -->
        <div class="tile is-parent notification">
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Entrega</p>
              <ul>
                <li><%=booking.pickup_place_customer_translation%></li>
                <li><%=booking.date_from_full_format%> <%=booking.time_from%></li>
              </ul>
              <p class="has-text-weight-semibold">Duración del alquiler: <%=booking.days%> día/s</p>
            </div>
          </div> 
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Devolución</p>
              <ul>
                <li><%=booking.return_place_customer_translation%></li>
                <li><%=booking.date_to_full_format%> <%=booking.time_to%></li>
              </ul>
            </div>
          </div>
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Modelo</p>
              <% for (var idx=0; idx<booking.booking_lines.length; idx++) { %>
                <p><%=booking.booking_lines[idx].item_description_customer_translation%></p>
                <p>GRUPO <%=booking.booking_lines[idx].item_id%></p>
                <img src="<%=booking.booking_lines[idx].photo_medium%>"/>  
              <% } %>              
            </div>
          </div>            
        </div>
        <!-- Extras -->
        <% if (booking.booking_extras.length > 0) { %>
        <div class="tile is-parent is-vertical notification">
          <div class="tile is-child notification has-background-light">
            <p class="title">Extras seleccionados</h4>
            <div class="content">
              <ul>
            <% for (var idx=0; idx<booking.booking_extras.length; idx++) { %>
              <li><%=booking.booking_extras[idx].quantity%>x <%=booking.booking_extras[idx].extra_description_customer_translation%> <span class="is-pulled-right"><%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%></span></li>
            <% } %>
              </ul>          
            </div>
          </div>
        </div>
        <% } %>
        <!-- Driver information -->
        <div class="tile is-parent notification">
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Datos del conductor</p>
              <ul>
                <li>Nombre: <%=booking.customer_name%></li>
                <li>Apellidos: <%=booking.customer_surname%></li>
                <li>Fecha de nacimiento: <%=booking.driver_date_of_birth%>
                <li>Documento de identidad: <%=booking.driver_document_id%></li>
              </ul>
            </div>
          </div> 
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Datos de contacto</p>
              <ul>
                <li>Email: <%=booking.customer_email%></li>
                <li>Teléfono: <%=booking.customer_phone%> <%=booking.customer_mobile_phone%></li>
                <li>Dirección: <% if (booking.driver_address) { %>
                    <%=booking.driver_address.street%> <%=booking.driver_address.number%> <%=booking.driver_address.complement%>
                    <% } %>
                </li>
                <li>Ciudad/Lugar: <% if (booking.driver_address) { %>
                    <%= booking.driver_address.city %>
                    <% } %>
                </li>
              </ul>
            </div>
          </div>
          <div class="tile is-child notification has-background-light">
            <div class="content">
              <p class="subtitle has-text-weight-semibold has-text-grey">Resumen</p>
              <ul>
                <li>Total vehículo: <%=configuration.formatCurrency(booking.item_cost)%></li>
                <li>Extras: <%= configuration.formatCurrency(booking.extras_cost)%></li>  
                <li>Total alquiler: <%= configuration.formatCurrency(booking.total_cost)%></li>         
            </div>
          </div>            
        </div>
        <% if (booking.total_paid > 0) { %>
        <div class="hero is-warning">
          <div class="hero-body">
            <div class="container">
              <p class="subtitle">
                El importe restante (<%= configuration.formatCurrency(booking.total_pending)%>) deberá ser pagado en el momento de la 
                recogida del vehículo
              </p>
            </div>
          </div>
        </div>
        <% } %>  
      </div>
    </script>

    <!-- Payment -->
    <script type="text/tmpl" id="script_payment_detail">
      <input type="hidden" name="payment" value="redsys256" data-payment-method="redsys256">
      <div class="field is-grouped">
        <div class="control">
          <button type="submit" class="button is-primary">Pagar</a>
        </div>
      </div>  
    </script>