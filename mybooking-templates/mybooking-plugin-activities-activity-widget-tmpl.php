    <!-- Micro templates -->

    <!-- Activity One Time Selector -->

    <script type="text/tmpl" id="script_one_time_selector">

        <form name="select_date_form" id="select_date_form">
          <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>
          <div id="tickets"></div>
        </form>

    </script>

    <!-- Activity Multiple Dates Selector -->

    <script type="text/tmpl" id="script_multiple_dates_selector">

        <h2 class="h5 mt-3 mb-3"><b>Seleccionar fecha</b></h2>
        <form name="select_date_form" id="select_date_form">
          <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>
          <div class="form-group">
            <select name="activity_date_id" id="activity_date_id" class="form-control">
            </select>
          </div>
          <div id="tickets"></div>
        </form>          

    </script>

    <!-- Activity Cyclic Calendar -->

    <script type="text/tmpl" id="script_cyclic_calendar">

        <h2 class="h5 mt-3 mb-3 text-muted"><b>Seleccionar fecha</b></h2>
        <form name="select_date_form" id="select_date_form">
          <input type="hidden" name="activity_id" id="activity_id" value="<%=activity_id%>"/>
          <div id="datepicker"></div>
          <div id="turns"></div>
          <div id="tickets"></div>
        </form>             
       
    </script>

    <script type="text/tmpl" id="script_cyclic_turns">

        <% if (turns.length == 0) {%>
          <div class="alert alert-warning">
             <p>Lo sentimos, no hay horarios disponibles</p>
          </div>
        <% } else { %>
          <br>
          <h2 class="h5 mt-3 mb-3 text-muted"><b>Seleccionar hora</b></h2>

          <div class="form-group">
          <% for (var idx=0;idx<turns.length;idx++) { %>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="turn" id="turn" value="<%=turns[idx]%>">
              <label class="form-check-label" for="turn"><%=turns[idx]%></label>
            </div>
          <% } %>
          </div>
        <% } %>

    </script>

    <script type="text/tmpl" id="script_tickets">

        <h2 class="h5 mt-5 mb-3 text-muted"><b>Seleccionar personas</b></h2>

        <% for (item in tickets) { %>
           <div class="form-group">
              <select name="quantity_rate_<%=item%>" id="quantity_rate_<%=item%>" class="quantity_rate form-control">
                <% for (var idx=0; idx<tickets[item].length; idx++) { %>
                <option value="<%=tickets[item][idx]["number"]%>" data-total="<%=tickets[item][idx]["total"]%>"><%=tickets[item][idx]["description"]%></option>
                <% } %>
              </select>
           </div>
        <% } %>

        <div class="form-group">
          <button type="button" id="btn_reservation" class="btn btn-primary w-100">Reservar</button>
          <!--a id="btn_reservation" href="#" class="btn btn-primary w-100" role="button">Reservar</a-->
        </div>  

    </script>
