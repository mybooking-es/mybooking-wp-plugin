    <!-- Activity One Time Selector -->

    <script type="text/tmpl" id="script_one_time_selector">

        <div class="tile is-parent is-vertical">
          <div class="tile is-child">
            <form name="select_date_form" id="select_date_form">
              <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>
              <div id="tickets"></div>
            </form>
          </div>
        </div>  

    </script>

    <!-- Activity Multiple Dates Selector -->

    <script type="text/tmpl" id="script_multiple_dates_selector">

        <div class="tile is-parent is-vertical">
          <div class="tile is-child">
            <h4 class="title is-6 has-text-grey" style="margin-top: 10px">Seleccionar fecha</h4>
          <div>
          <div class="tile is-child">
            <form name="select_date_form" id="select_date_form">
              <input type="hidden" name="activity_id" id="activity_id" value="<%=activity.id%>"/>
              <select name="activity_date_id" id="activity_date_id"
                      class="selectpicker" data-live-search="true" data-width="auto"
                      data-toggle="tooltip" title="Select" data-container="body">
              </select>
              <div id="tickets"></div>
            </form>
          </div>
        </div>  

    </script>

    <!-- Activity Cyclic Calendar -->

    <script type="text/tmpl" id="script_cyclic_calendar">

        <div class="tile is-parent is-vertical">
          <div class="tile is-child">
            <h4 class="title is-6 has-text-weight-semibold">Seleccionar fecha</h4>
          </div>
          <div class="tile is-child">
            <form name="select_date_form" id="select_date_form">
              <input type="hidden" name="activity_id" id="activity_id" value="<%=activity_id%>"/>
              <div id="datepicker"></div>
              <div id="turns"></div>
              <div id="tickets"></div>
            </form>
          </div>
         </div>

    </script>

    <script type="text/tmpl" id="script_cyclic_turns">

            <% if (turns.length == 0) {%>
              <p class="is-6 has-text-grey">Lo sentimos, no hay horarios disponibles</p>
            <% } else { %>
              <br>
              <h4 class="title is-6 has-text-weight-semibold">Seleccionar hora</h4>
              <div class="field">
                <div class="control">
                  <% for (var idx=0;idx<turns.length;idx++) { %>
                    <input type="radio" name="turn" value="<%=turns[idx]%>">&nbsp;<%=turns[idx]%></input>
                  <% } %>
                </div>
              </div>
            <% } %>

    </script>

    <script type="text/tmpl" id="script_tickets">
        <br>
        <h4 class="title is-6 has-text-weight-semibold">Seleccionar personas</h4>
        <% for (item in tickets) { %>
          <div class="field">
            <div class="control">
              <div class="select is-fullwidth">
                <select name="quantity_rate_<%=item%>" id="quantity_rate_<%=item%>" class="quantity_rate form-control">
                  <% for (var idx=0; idx<tickets[item].length; idx++) { %>
                  <option value="<%=tickets[item][idx]["number"]%>" data-total="<%=tickets[item][idx]["total"]%>"><%=tickets[item][idx]["description"]%></option>
                  <% } %>
                </select>
              </div>  
            </div>
          </div>
        <% } %>
        <br>
        <div class="field">
          <div class="control">
            <a id="btn_reservation" href="#" class="button is-primary is-fullwidth" role="button">Reservar</a>
          </div>
        </div>

    </script>