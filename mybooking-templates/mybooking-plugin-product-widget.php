    <div id="product_selector" data-code="<? echo $args['code']?>" class="container is-desktop">
      <div class="columns">
        <div class="column is-full">
          <form
            name="search_form"
            method="get"
            enctype="application/x-www-form-urlencoded">
            
            <!-- Entrega -->
            <div class="field">
              <div class="control">
                <div class="select is-fullwidth">
                  <select id="pickup_place" name="pickup_place" placeholder="Seleccionar lugar de entrega"> </select>
                </div>
              </div>
            </div>
            <div class="field">
              <div class="control">
                <label class="checkbox">
                    <input type="checkbox" id="same_pickup_return_place" name="same_pickup_return_place" 
                           checked/>&nbsp;&nbsp;Devolver en la misma oficina
                </label>
              </div>
            </div>

            <!-- Devolución -->
            <div class="field return_place" style="display: none">
              <div class="control">
                <div class="select is-fullwidth">
                  <select id="return_place" name="return_place" placeholder="Seleccionar lugar de devolución"> </select>
                </div>
              </div>          
            </div>
            
            <div class="field">
              <div class="control is-expanded">
                <input id="date" type="hidden" name="date"/>
                <div id="date-container" class="disabled-picker"></div>
              </div>
            </div>

            <div class="field field-body">
                <div class="field">
                  <div class="control is-expanded">
                    <div class="select is-fullwidth">
                      <select id="time_from" name="time_from" placeholder="hh:mm" disabled> </select>
                    </div>
                  </div>
                </div>              
                <div class="field">
                  <div class="control">
                    <div class="select is-fullwidth">
                      <select id="time_to" name="time_to" placeholder="hh:mm" disabled> </select>
                    </div>
                  </div>  
                </div>
            </div>

            <hr>

            <div id="reservation_detail" class="field">
            </div>

            <hr>

            <div class="field is-horizontal">
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input id="add_to_shopping_cart_btn" class="button is-primary is-fullwidth" type="submit" value="Reservar" disabled/>
                  </div>
                </div>
              </div>
            </div>        
            
          </form>

      </div>
      </div>
    </div>