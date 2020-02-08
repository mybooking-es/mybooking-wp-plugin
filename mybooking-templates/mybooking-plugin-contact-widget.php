    <section class="widget widget_mybooking_engine_contact">
      <form id="widget_contact_form" name="widget_contact_form" autocomplete="off">

              <div class="form-row">
                <div class="form-group col-md-6">
                <label for="customer_name">Nombre*</label>
                <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Nombre:*">
                </div>
                <div class="form-group col-md-6">
                <label for="customer_surname">Apellidos*</label>
                <input type="text" class="form-control" name="customer_surname" id="customer_surname" placeholder="Apellidos:*">
                </div>
              </div>

              <div class="form-group">
                <label for="customer_email">Correo electrónico*</label>
                <input type="text" class="form-control" name="customer_email" id="customer_email" placeholder="Correo electrónico:*">
              </div>

              <div class="form-group">
                <label for="customer_phone">Teléfono*</label>
                <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Teléfono:*">
              </div>                    

              <div class="form-group">
                <label for="customer_name">Mensaje*</label>
                <textarea class="form-control" name="comments" id="comments" placeholder="Mensaje"></textarea>
              </div>   

              <div class="form-group">
                <div class="alert alert-danger" id="contact_form_errors" style="display: none"></div>
              </div>

              <div class="form-group">
                <button id="send_message_button" type="submit" class="btn btn-primary">Enviar</a> 
              </div>  

      </form>
    </section>