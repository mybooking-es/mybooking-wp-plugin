		    <!-- Modal to change selection -->
		    <div class="modal">
		      <div class="modal-background">
		      </div>
		      <div class="modal-card">
		        <header class="modal-card-head">
		          <p class="modal-card-title">Modificar búsqueda</p>
		          <button id="close_modal_button" class="delete" aria-label="close"></button>
		        </header>        
		        <section class="modal-card-body">
		          <form
		            name="search_form"
		            method="get"
		            enctype="application/x-www-form-urlencoded">
		            <!-- Entrega -->
		            <div class="field">
		              <label class="label">Entrega</label>
		              <div class="control">
		                <div class="select is-fullwidth">
		                  <select id="pickup_place" name="pickup_place"> </select>
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
		            <div class="field field-body">
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
		              <div class="control return_place">
		                <div class="select is-fullwidth">
		                  <select id="return_place" name="return_place"> </select>
		                </div>
		              </div>          
		            </div>
		            <div class="field field-body">
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
		                    <input class="button is-primary" type="submit" value="Nueva búsqueda" />
		                  </div>
		                </div>
		              </div>
		            </div>        
		          </form>
		        </section>
		      </div>
		    </div> 