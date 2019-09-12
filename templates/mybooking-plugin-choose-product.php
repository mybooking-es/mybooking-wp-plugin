			<div class="reservation-step">
				<div class="columns">
          <aside class="column">
            <div class="tile is-ancestor has-background-light">
              <div class="tile is-parent is-vertical">
	              <form
	                name="search_form"
	                action="choose-product"
	                method="get"
	                enctype="application/x-www-form-urlencoded">
	                <!-- Entrega -->
	                <div class="field">
	                  <label class="label">Entrega</label>
	                </div>  
	                <div class="field field-body">
		                <div class="field">
		                  <div class="control">
		                    <div class="select is-fullwidth">
		                      <select id="pickup_place" name="pickup_place"> </select>
		                    </div>
		                  </div>
		                </div>
                  	<div class="field">
	                    <div class="control is-expanded">
	                      <input
	                              type="text"
	                              id="date_from"
	                              name="date_from"
	                              class="input"
	                              autocomplete="off"
	                            />
	                    </div>
	                  </div>
	                  <div class="field">
	                    <div class="control">
	                      <div class="select is-fullwidth">
	                        <select id="time_from" name="time_from"> </select>
	                      </div>
	                    </div>
	                  </div>
	                </div>

	                <!-- Devolución -->
	                <div class="field">
	                  <label class="label">Devolución</label>        
	                </div>
	                
	                <div class="field field-body">
	                	<div class="field">
		                  <div class="control return_place">
		                    <div class="select is-fullwidth">
		                      <select id="return_place" name="return_place"> </select>
		                    </div>
		                  </div> 	     
	                  </div>           	
	                  <div class="field">
	                    <div class="control is-expanded">
	                      <input type="text" id="date_to" name="date_to" autocomplete="off" class="input"/>
	                    </div>
	                  </div>
	                  <div class="field">
	                    <div class="control">
	                      <div class="select is-fullwidth">
	                        <select id="time_to" name="time_to"> </select>
	                      </div>
	                    </div>
	                  </div>
	                </div>

	                <div class="field is-horizontal">
	                  <div class="field-body">
	                    <div class="field">
	                      <div class="control">
	                        <input class="button is-primary" type="submit" value="Buscar" />
	                      </div>
	                    </div>
	                  </div>
	                </div>        
	              </form>								              	
              </div>
            </div>
          </aside>					
				</div>
        <div class="columns">
          <div class="column">
            <div id="product_listing"></div>
          </div>
        </div>
      </div>