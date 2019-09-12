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