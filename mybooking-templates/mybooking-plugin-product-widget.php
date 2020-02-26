    <div id="product_selector" data-code="<?php echo $args['code']?>" class="container is-desktop">
      <div class="row">
        <div class="col-xs-12">
          <form
            name="search_form"
            method="get"
            enctype="application/x-www-form-urlencoded"
            class="form-horizontal">
            
            <!-- Entrega -->
            <div class="form-group">
              <select id="pickup_place" name="pickup_place" 
                      placeholder="Seleccionar lugar de entrega" class="form-control w-100"> </select>
              </select>
            </div>

            <!-- Devolución -->
            <div class="form-group">
              <select id="return_place" name="return_place" 
                      placeholder="Seleccionar lugar de devolución" class="form-control w-100" disabled> </select>
              </select>
            </div>

            <!-- Date Selector -->            
            <div class="form-group">
              <input id="date" type="hidden" name="date"/>
              <div id="date-container" class="disabled-picker"></div>
            </div>

            <!-- Hora de entrega -->
            <div class="form-group">
              <select id="time_from" name="time_from" 
                      placeholder="hh:mm" class="form-control" disabled> </select>
              </select>
            </div>

            <!-- Hora de devolución -->
            <div class="form-group">
              <select id="time_to" name="time_to" 
                      placeholder="hh:mm" class="form-control" disabled> </select>
              </select>
            </div>

            <div id="reservation_detail" class="form-group">
            </div>

            <div class="form-group">
               <input id="add_to_shopping_cart_btn" 
                      class="btn btn-primary w-100" 
                      type="submit" value="Reservar" disabled/>
            </div>                  
            
          </form>

        </div>
      </div>
    </div>