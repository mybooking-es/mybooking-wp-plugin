<div style="position:absolute">
  <div class="modal fade" 
       id="choose_productModal" tabindex="-1" role="dialog" aria-labelledby="choose_productModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar reserva</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form
            name="search_form"
            method="get"
            enctype="application/x-www-form-urlencoded">
            
		        <!-- Entrega -->
		        <div class="form-row">
		          <div class="form-group col-md-12">
		              <label for="date_from">Lugar de entrega</label>
		              <select class="form-control" name="pickup_place" id="pickup_place"></select>
		          </div>
		        </div>

		        <div class="form-row">
		          <div class="form-group col-md-6">
		              <label for="date_from">Fecha de entrega</label>
		              <input type="text" class="form-control" name="date_from" id="date_from" autocomplete="off">
		          </div>
		          <div class="form-group col-md-6">
		              <label for="time_to">Hora de entrega</label>
		              <select class="form-control" name="time_from" id="time_from"></select>
		          </div>
		        </div>

		        <!-- Devolución -->
		        <div class="form-row">
		          <div class="form-group col-md-12">
		            <label for="date_from">Lugar de devolución</label>
		            <select class="form-control" name="return_place" id="return_place"></select>
		          </div>
		        </div>       

		        <div class="form-row">
		          <div class="form-group col-md-6">
		              <label for="date_from">Fecha de devolución</label>
		              <input type="text" class="form-control" name="date_to" id="date_to" autocomplete="off">
		          </div>
		          <div class="form-group col-md-6">
		              <label for="time_to">Hora de devolución</label>
		              <select class="form-control" name="time_to" id="time_to"></select>
		          </div>
		        </div>
        
            
            <div class="form-row">
              <div class="form-group col-md-12">
                <input class="btn btn-success" type="submit" value="Nueva búsqueda" />
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>