    <script type="text/tmpl" id="script_reservation_summary">
        <hr>
        <div class="jumbotron mb-3">
          <h2 class="h4">Resumen de la reserva</h2>
          <hr>
          <% if (shopping_cart.days) { %>
          <p class="lead">Duración del alquiler: <span class="pull-right"><%=shopping_cart.days%> día/s</span></p>
          <% } else if (shopping_cart.hours) { %>
					<p class="lead">Duración del alquiler: <span class="pull-right"><%=shopping_cart.hours%> hora/s</span></p>
          <% } %>
          <p class="lead">Importe total: <span class="pull-right"><%=configuration.formatCurrency(shopping_cart.total_cost)%></span></p>
        </div>

    </script>