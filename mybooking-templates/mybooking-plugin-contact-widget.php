    <section class="widget widget_mybooking_engine_contact">
      <form id="widget_contact_form" name="widget_contact_form" autocomplete="off">

              <div class="field field-body">
                <div class="field">
                  <label class="label">Nombre*</label>
                  <div class="control is-expanded">
                      <input name="customer_name" id="customer_name" type="text" class="input" placeholder="Nombre:*">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Apellidos*</label>
                  <div class="control is-expanded">
                      <input name="customer_surname" id="customer_surname" type="text" class="input"  placeholder="Apellidos:*">
                  </div>
                </div>
              </div>

              <div class="field">
                <label class="label">Correo electrónico*</label>
                <div class="control is-expanded">
                    <input name="customer_email" id="customer_email" type="text" class="input"  placeholder="Correo electrónico:*">
                </div>
              </div>

              <div class="field">
                <label class="label">Teléfono*</label>
                <div class="control is-expanded">
                    <input name="customer_phone" id="customer_phone" type="text" class="input"  placeholder="Teléfono:*">
                </div>
              </div>

              <div class="field">
                <label class="label">Mensaje*</label>
                <div class="control is-expanded">
                    <textarea name="comments" id="comments" class="textarea" placeholder="Mensaje"></textarea>
                </div>
              </div>

              <div class="field">
                  <div class="message is-danger" id="contact_form_errors" style="display: none">
                   </div>
              </div>

              <div class="field is-grouped">
                <div class="control">
                  <button id="send_message_button" type="submit" class="button is-primary">Enviar</a>
                </div>
              </div>  

      </form>
    </section>