    <script type="text/tmpl" id="script_reservation_summary">
        <div class="tile is-parent is-vertical">
          <div class="tile is-child notification has-background-light">
            <p class="title">Reserva</h4>
            <div class="content">
              <p class="has-text-weight-semibold">Duración del alquiler: <%=shopping_cart.days%> día/s</p>
            </div> 
          </div> 
          <div class="tile is-child notification has-background-light">
            <p class="title">Importe total</p>
            <p class="subtitle"><span class="is-pulled-right"><%= configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
          </div>
        </div>
    </script>