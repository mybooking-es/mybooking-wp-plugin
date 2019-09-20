<div class="reservation-step">
    <div class="columns">
      <div class="column is-three-fifths">
        <!--div id="selected_product">
        </div-->
        <div id="extras_listing">
        </div>
        <!-- Reservation complete -->
        <form id="form-reservation" name="reservation_form" autocomplete="off">
                
                <h4 class="is-size-4 has-text-weight-semibold has-text-grey">Datos del conductor</h4>
                <br>

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

                <div class="field field-body">
                  <div class="field">
                    <label class="label">Correo electrónico*</label>
                    <div class="control is-expanded">
                        <input name="customer_email" id="customer_email" type="text" class="input"  placeholder="Correo electrónico:*">
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Confirmación correo electrónico*</label>
                    <div class="control is-expanded">
                        <input name="confirm_customer_email" id="confirm_customer_email" class="input"  type="text" placeholder="Confirmación del correo electrónico:*">
                    </div>
                  </div>
                </div>

                <div class="field field-body">
                  <div class="field">
                    <label class="label">Teléfono*</label>
                    <div class="control is-expanded">
                        <input name="customer_phone" id="customer_phone" type="text" class="input"  placeholder="Teléfono:*">
                    </div>
                  </div>
                  <div class="field">
                    <label class="label">Teléfono alternativo</label>
                    <div class="control is-expanded">
                        <input name="confirm_customer_email" id="confirm_customer_email" class="input"  type="text" placeholder="Teléfono alternativo:">
                    </div>
                  </div>
                </div>
                <br>
                <h4 class="is-size-4 has-text-weight-semibold has-text-grey">Información adicional</h4>
                <br>
                <div class="field field">
                  <label class="label">Comentarios</label>
                  <div class="control is-expanded">
                      <textarea name="comments" id="comments" class="textarea" placeholder="Comentarios"></textarea>
                  </div>
                </div>
            <!-- Reservation : payment -->
            <div id="payment_detail">
            </div>
        </form>
      </div>
      <aside class="column is-two-fifths">
        <div id="reservation_detail" class="tile is-ancestor">
        </div>
      </aside>
      <?php mybooking_engine_get_template('mybooking-plugin-modify-reservation.php') ?>
    </div>
</div>