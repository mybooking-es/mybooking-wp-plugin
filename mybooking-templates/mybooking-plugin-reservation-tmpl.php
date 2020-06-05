    <!-- Reservation summary -->
    <script type="text/tmpl" id="script_reservation_summary">
      <div class="jumbotron mb-3">
        <h2 class="h3 text-center"><%= booking.summary_status %></h2>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <b><?php echo _x( 'Reservation summary', 'renting_my_reservation', 'mybooking-wp-plugin') ?></b>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item reservation-summary-card-detail h3"><%=booking.id%></li>
                  <% if (configuration.pickupReturnPlace) {%>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.pickup_place_customer_translation%></li>
                  <% } %>
                  <li class="list-group-item reservation-summary-card-detail">
                    <i class="fa fa-calendar-o"></i>&nbsp;
                    <%=booking.date_from_full_format%>
                    <% if (configuration.timeToFrom) { %>
                      <%=booking.time_from%>
                    <% } %>  
                  </li>
                  <% if (configuration.pickupReturnPlace) {%>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.return_place_customer_translation%></li>
                  <% } %>
                  <li class="list-group-item reservation-summary-card-detail">
                    <i class="fa fa-calendar-o"></i>&nbsp;
                    <%=booking.date_to_full_format%>
                    <% if (configuration.timeToFrom) { %>
                      <%=booking.time_to%>
                    <% } %> 
                  </li>
                  <li class="list-group-item reservation-summary-card-detail"><?php echo _x( 'Rental duration', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>: <%=booking.days%> <?php echo _x( 'day(s)', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></li>
                </ul>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card mb-3">
                <div class="card-header">
                  <b><?php echo _x( "Customer's details", 'renting_my_reservation', 'mybooking-wp-plugin') ?></b>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_name%> <%=booking.customer_surname%></li>
                  <% if (booking.customer_phone && booking.customer_phone != '') { %>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_phone%> <%=booking.customer_mobile_phone%></li>
                  <% } %>
                  <% if (booking.customer_email && booking.customer_email != '') { %>
                  <li class="list-group-item reservation-summary-card-detail"><%=booking.customer_email%></li>
                  <% } %>
                </ul>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="reservation_form_container" style="display:none"></div>
            </div>
          </div>

        </div>

        <!-- Sidebar summary -->
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( 'Products', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
            </div>  
            <ul class="list-group list-group-flush">
              <% for (var idx=0;idx<booking.booking_lines.length;idx++) { %>
              <li class="list-group-item reservation-summary-card-detail">
                 <img class="product-img" style="width: 120px" src="<%=booking.booking_lines[idx].photo_medium%>"/>
                 <br>
                 <span class="product-name"><b><%=booking.booking_lines[idx].item_description_customer_translation%></b></span>
                 <% if (configuration.multipleProductsSelection) { %>
                 <span class="badge badge-info"><%=booking.booking_lines[idx].quantity%></span>
                 <% } %>
                 <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_lines[idx].item_cost)%></span>
              </li>
              <% } %>
            </ul>
          </div>
          <% if (booking.booking_extras.length > 0) { %>
          <div class="card mb-3">
            <div class="card-header">
              <b><?php echo _x( 'Extras', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
            </div>  
            <ul class="list-group list-group-flush">
              <% for (var idx=0;idx<booking.booking_extras.length;idx++) { %>
              <li class="list-group-item reservation-summary-card-detail">
                  <span class="extra-name"><b><%=booking.booking_extras[idx].extra_description%></b></span>
                  <span class="badge badge-info"><%=booking.booking_extras[idx].quantity%></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.booking_extras[idx].extra_cost)%></span>
              </li>
              <% } %>       
            </ul>
          </div>
          <% } %>   
          <% if (booking.time_from_cost > 0 ||
                booking.pickup_place_cost > 0 ||
                booking.time_to_cost > 0 ||
                booking.return_place_cost > 0 ||
                booking.driver_age_cost > 0 ||
                booking.category_supplement_1_cost > 0) { %>
            <!-- Supplements -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( 'Supplements', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Supplements -->
                <% if (booking.time_from_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up time supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_from_cost)%></span>
                </li>
                <% } %>
                <% if (booking.pickup_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Pick-up place supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.pickup_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.time_to_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return time supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.time_to_cost)%></span>
                </li>
                <% } %>
                <% if (booking.return_place_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( 'Return place supplement', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.return_place_cost)%></span>
                </li>
                <% } %>
                <% if (booking.driver_age_cost > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x( "Driver's age supplement", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.driver_age_cost)%></span>
                </li>
                <% } %>
                <% if (booking.category_supplement_1_cost > 0) { %>
                <li class="list-group-item">
                  <span class="product-amount pull-right"><?php echo _x( "Petrol supplement", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></span>
                  <span
                    class="extra-price"><%=configuration.formatCurrency(booking.category_supplement_1_cost)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>
          <% if (booking.total_deposit > 0) { %>
            <!-- Deposit -->
            <div class="card mb-3">
              <div class="card-header">
                <b><?php echo _x( "Deposit", 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></b>
              </div>     
              <ul class="list-group list-group-flush">
                <!-- Deposit -->
                <% if (booking.total_deposit > 0) { %>
                <li class="list-group-item">
                  <span class="extra-name"><?php echo _x('Deposit', 'renting_my_reservation', 'mybooking') ?></span>
                  <span class="product-amount pull-right"><%=configuration.formatCurrency(booking.total_deposit)%></span>
                </li>
                <% } %>
              </ul>
            </div>
          <% } %>

          <div class="jumbotron mb-3">
            <h2 class="h5 text-center"><?php echo _x( 'Total', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></h2>
            <h2 class="h3 text-center"><%=configuration.formatCurrency(booking.total_cost)%></h2>
          </div>  

          <table class="table">
            <tr class="table-success">
              <td><?php echo _x( 'Total', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right"><b><%=configuration.formatCurrency(booking.total_cost)%></b></td>
            </tr>  
            <tr>
              <td><?php echo _x( 'Paid', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right"><%=configuration.formatCurrency(booking.total_paid)%></td>
            </tr>  
            <tr>
              <td><?php echo _x( 'Pending', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></td>
              <td class="text-right <% if (booking.total_pending > 0) {%>text-danger<% } %>"><%=configuration.formatCurrency(booking.total_pending)%></td>
            </tr>  
          </table>

          <div id="payment_detail" class="bg-white shadow-bottom py-3" style="display:none"></div>          
        </div>      
      </div>

    </script>

    <!-- Reservation form -->
    <script type="text/tmpl" id="script_reservation_form">

      <% if (configuration.rentingFormFillDataAddress || configuration.rentingFormFillDataDriverDetail || configuration.rentingFormFillDataNamedResources) { %>
        <form id="form-reservation" name="booking_information_form" autocomplete="off">
        <div class="card">
          <div class="card-header">
             <?php echo _x( 'Complete reservation', 'renting_my_reservation', 'mybooking-wp-plugin') ?>
          </div>
          <div class="card-body">
            <div class="alert alert-info">
              <p><?php echo _x( 'Please complete the information to speed up the delivery process on the scheduled date', 'renting_my_reservation', 'mybooking-wp-plugin') ?></p>
            </div> 
            <% if (configuration.rentingFormFillDataAddress) { %>
              <h3 class="h4 card-title border p-3 bg-light"><?php echo _x( 'Customer address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h3>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="street"><?php echo _x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="street" name="customer_address[street]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Address', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_street%>" maxlength="60">
                </div>
                <div class="form-group col-md-3">
                  <label for="number"><?php echo _x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="number" name="customer_address[number]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_number%>" maxlength="10">
                </div>
                <div class="form-group col-md-3">
                  <label for="complement"><?php echo _x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="complement" name="customer_address[complement]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Complement', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_complement%>"  max_length="20">
                </div>
              </div> 
              <div class="form-row"> 
                <div class="form-group col-md-6">
                  <label for="city"><?php echo _x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="city" name="customer_address[city]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'City', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_city%>" max_length="60">
                </div>
                <div class="form-group col-md-6">
                  <label for="state"><?php echo _x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="state" name="customer_address[state]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'State', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_state%>"  max_length="60">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="country"><?php echo _x( 'Country', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <select name="customer_address[country]" id="country" class="form-control">
                      <option value="AF">Afganistán</option>
                      <option value="AL">Albania</option>
                      <option value="DE">Alemania</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antártida</option>
                      <option value="AG">Antigua y Barbuda</option>
                      <option value="AN">Antillas Holandesas</option>
                      <option value="SA">Arabia Saudí</option>
                      <option value="DZ">Argelia</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaiyán</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrein</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BE">Bélgica</option>
                      <option value="BZ">Belice</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermudas</option>
                      <option value="BY">Bielorrusia</option>
                      <option value="MM">Birmania</option>
                      <option value="BO">Bolivia</option>
                      <option value="BA">Bosnia y Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BR">Brasil</option>
                      <option value="BN">Brunei</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="BT">Bután</option>
                      <option value="CV">Cabo Verde</option>
                      <option value="KH">Camboya</option>
                      <option value="CM">Camerún</option>
                      <option value="CA">Canadá</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CY">Chipre</option>
                      <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comores</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo, República Democrática del</option>
                      <option value="KR">Corea</option>
                      <option value="KP">Corea del Norte</option>
                      <option value="CI">Costa de Marfíl</option>
                      <option value="CR">Costa Rica</option>
                      <option value="HR">Croacia (Hrvatska)</option>
                      <option value="CU">Cuba</option>
                      <option value="DK">Dinamarca</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egipto</option>
                      <option value="SV">El Salvador</option>
                      <option value="AE">Emiratos Árabes Unidos</option>
                      <option value="ER">Eritrea</option>
                      <option value="SI">Eslovenia</option>
                      <option value="ES" selected>España</option>
                      <option value="US">Estados Unidos</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Etiopía</option>
                      <option value="FJ">Fiji</option>
                      <option value="PH">Filipinas</option>
                      <option value="FI">Finlandia</option>
                      <option value="FR">Francia</option>
                      <option value="GA">Gabón</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GD">Granada</option>
                      <option value="GR">Grecia</option>
                      <option value="GL">Groenlandia</option>
                      <option value="GP">Guadalupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GY">Guayana</option>
                      <option value="GF">Guayana Francesa</option>
                      <option value="GN">Guinea</option>
                      <option value="GQ">Guinea Ecuatorial</option>
                      <option value="GW">Guinea-Bissau</option>
                      <option value="HT">Haití</option>
                      <option value="HN">Honduras</option>
                      <option value="HU">Hungría</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IQ">Irak</option>
                      <option value="IR">Irán</option>
                      <option value="IE">Irlanda</option>
                      <option value="BV">Isla Bouvet</option>
                      <option value="CX">Isla de Christmas</option>
                      <option value="IS">Islandia</option>
                      <option value="KY">Islas Caimán</option>
                      <option value="CK">Islas Cook</option>
                      <option value="CC">Islas de Cocos o Keeling</option>
                      <option value="FO">Islas Faroe</option>
                      <option value="HM">Islas Heard y McDonald</option>
                      <option value="FK">Islas Malvinas</option>
                      <option value="MP">Islas Marianas del Norte</option>
                      <option value="MH">Islas Marshall</option>
                      <option value="UM">Islas menores de Estados Unidos</option>
                      <option value="PW">Islas Palau</option>
                      <option value="SB">Islas Salomón</option>
                      <option value="SJ">Islas Svalbard y Jan Mayen</option>
                      <option value="TK">Islas Tokelau</option>
                      <option value="TC">Islas Turks y Caicos</option>
                      <option value="VI">Islas Vírgenes (EEUU)</option>
                      <option value="VG">Islas Vírgenes (Reino Unido)</option>
                      <option value="WF">Islas Wallis y Futuna</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italia</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japón</option>
                      <option value="JO">Jordania</option>
                      <option value="KZ">Kazajistán</option>
                      <option value="KE">Kenia</option>
                      <option value="KG">Kirguizistán</option>
                      <option value="KI">Kiribati</option>
                      <option value="KW">Kuwait</option>
                      <option value="LA">Laos</option>
                      <option value="LS">Lesotho</option>
                      <option value="LV">Letonia</option>
                      <option value="LB">Líbano</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libia</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lituania</option>
                      <option value="LU">Luxemburgo</option>
                      <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                      <option value="MG">Madagascar</option>
                      <option value="MY">Malasia</option>
                      <option value="MW">Malawi</option>
                      <option value="MV">Maldivas</option>
                      <option value="ML">Malí</option>
                      <option value="MT">Malta</option>
                      <option value="MA">Marruecos</option>
                      <option value="MQ">Martinica</option>
                      <option value="MU">Mauricio</option>
                      <option value="MR">Mauritania</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">México</option>
                      <option value="FM">Micronesia</option>
                      <option value="MD">Moldavia</option>
                      <option value="MC">Mónaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="MS">Montserrat</option>
                      <option value="MZ">Mozambique</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Níger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk</option>
                      <option value="NO">Noruega</option>
                      <option value="NC">Nueva Caledonia</option>
                      <option value="NZ">Nueva Zelanda</option>
                      <option value="OM">Omán</option>
                      <option value="NL">Países Bajos</option>
                      <option value="PA">Panamá</option>
                      <option value="PG">Papúa Nueva Guinea</option>
                      <option value="PK">Paquistán</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Perú</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PF">Polinesia Francesa</option>
                      <option value="PL">Polonia</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="UK">Reino Unido</option>
                      <option value="CF">República Centroafricana</option>
                      <option value="CZ">República Checa</option>
                      <option value="ZA">República de Sudáfrica</option>
                      <option value="DO">República Dominicana</option>
                      <option value="SK">República Eslovaca</option>
                      <option value="RE">Reunión</option>
                      <option value="RW">Ruanda</option>
                      <option value="RO">Rumania</option>
                      <option value="RU">Rusia</option>
                      <option value="EH">Sahara Occidental</option>
                      <option value="KN">Saint Kitts y Nevis</option>
                      <option value="WS">Samoa</option>
                      <option value="AS">Samoa Americana</option>
                      <option value="SM">San Marino</option>
                      <option value="VC">San Vicente y Granadinas</option>
                      <option value="SH">Santa Helena</option>
                      <option value="LC">Santa Lucía</option>
                      <option value="ST">Santo Tomé y Príncipe</option>
                      <option value="SN">Senegal</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leona</option>
                      <option value="SG">Singapur</option>
                      <option value="SY">Siria</option>
                      <option value="SO">Somalia</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="PM">St Pierre y Miquelon</option>
                      <option value="SZ">Suazilandia</option>
                      <option value="SD">Sudán</option>
                      <option value="SE">Suecia</option>
                      <option value="CH">Suiza</option>
                      <option value="SR">Surinam</option>
                      <option value="TH">Tailandia</option>
                      <option value="TW">Taiwán</option>
                      <option value="TZ">Tanzania</option>
                      <option value="TJ">Tayikistán</option>
                      <option value="TF">Territorios franceses del Sur</option>
                      <option value="TP">Timor Oriental</option>
                      <option value="TG">Togo</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad y Tobago</option>
                      <option value="TN">Túnez</option>
                      <option value="TM">Turkmenistán</option>
                      <option value="TR">Turquía</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UA">Ucrania</option>
                      <option value="UG">Uganda</option>
                      <option value="UY">Uruguay</option>
                      <option value="UZ">Uzbekistán</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela</option>
                      <option value="VN">Vietnam</option>
                      <option value="YE">Yemen</option>
                      <option value="YU">Yugoslavia</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabue</option>
                  </select>                  
                </div>  
                <div class="form-group col-md-6">
                  <label for="zip"><?php echo _x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                  <input class="form-control" id="zip" name="customer_address[zip]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo _x( 'Postal Code', 'renting_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=booking.address_zip%>"  max_length="10">
                </div>
              </div>
            <% } %>
            <% if (configuration.rentingFormFillDataNamedResources) { %>
              <% for (var idx=0; idx<booking.booking_lines.length; idx++) { %>
                 <% var booking_line = booking.booking_lines[idx]; %>
                 <h3 class="h4 card-title border p-3 bg-light"><%=booking_line.quantity%> x <%=booking_line.item_description%></h3>
                 <% for (var idxResource=0; idxResource<booking.booking_lines[idx].booking_line_resources.length; idxResource++) { %>
                    <% var booking_line_resource = booking.booking_lines[idx].booking_line_resources[idxResource]; %>
                    <input type="hidden" name="booking_line_resources[<%=booking_line_resource.id%>][id]" value="<%=booking_line_resource.id%>"/>
                    <% if (booking_line_resource.pax == 1) { %>
                      <h5 class="h5 border p-2"><?php echo _x( 'Participant', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                    <% } else if (booking_line_resource.pax == 2) { %>
                      <h5 class="h5 border p-2"><?php echo _x( 'Participants', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
                      <h6 class="h6 border p-1 text-right"><?php echo _x( 'Pax 1', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
                    <% } %>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_name]"
                               title="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                               value="<%=booking_line_resource.resource_user_name%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_surname]"
                               title="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                               value="<%=booking_line_resource.resource_user_surname%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_document_id]"
                               title="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                               value="<%=booking_line_resource.resource_user_document_id%>">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_phone]"
                               title="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                               value="<%=booking_line_resource.resource_user_phone%>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="customer_name"><?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                        <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_email]"
                               title="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                               class="form-control alt" type="text"
                               placeholder="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                               value="<%=booking_line_resource.resource_user_email%>">
                      </div>             
                      <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>   
                        <div class="form-group col-md-2">
                          <label for="customer_name"><?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_height]"
                                 title="<?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="3"
                                 value="<%=booking_line_resource.customer_height%>">
                        </div>
                      <% } %>
                      <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>                        
                        <div class="form-group col-md-2">
                          <label for="customer_name"><?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_weight]"
                                 title="<?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="3"
                                 value="<%=booking_line_resource.customer_weight%>">
                        </div>
                      <% } %>
                    </div>    
                    <% if (booking_line_resource.pax == 2) { %>
                      <h6 class="h6 border p-1 text-right"><?php echo _x( 'Pax 2', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h5>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_name]"
                                 title="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                 value="<%=booking_line_resource.resource_user_2_name%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_surname]"
                                 title="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                 value="<%=booking_line_resource.resource_user_2_surname%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_document_id]"
                                 title="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                 value="<%=booking_line_resource.resource_user_2_document_id%>">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_phone]"
                                 title="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
                                 value="<%=booking_line_resource.resource_user_2_phone%>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="customer_name"><?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_email]"
                                 title="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                 class="form-control alt" type="text"
                                 placeholder="<?php echo _x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
                                 value="<%=booking_line_resource.resource_user_2_email%>">
                        </div>        
                        <% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>           
                          <div class="form-group col-md-2">
                            <label for="customer_name"><?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_height]"
                                   title="<?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                   class="form-control alt" type="text"
                                   placeholder="<?php echo _x( 'Height', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="3"
                                   value="<%=booking_line_resource.customer_2_height%>">
                          </div>
                        <% } %>
                        <% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>                             
                          <div class="form-group col-md-2">
                            <label for="customer_name"><?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_weight]"
                                   title="<?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                   class="form-control alt" type="text"
                                   placeholder="<?php echo _x( 'Weight', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="3"
                                   value="<%=booking_line_resource.customer_2_weight%>">
                          </div>
                        <% } %>
                      </div>  
                    <% } %>            
                 <% } %>
                 <hr>
              <% } %>
            <% } %>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary pull-right" id="btn_update_reservation"><?php echo _x( 'Update', 'renting_my_reservation', 'mybooking-wp-plugin') ?></button>
          </div>  
        </div>  

        </form> 
      <% } %> 
    </script>

    <!-- Payment detail -->
    <script type="text/tmpl" id="script_payment_detail">
      <hr>
      <h4 class="brand-primary my-3"><?php echo _x( 'Pay', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?></h4>
      <% if (booking.total_paid == 0) {%>
        <div id="payment_amount_container" class="alert alert-info">
          <%= i18next.t('complete.reservationForm.booking_amount', {amount:configuration.formatCurrency(booking.booking_amount) }) %>
        </div>
      <% } %>
      <form name="payment_form">
        <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
        <div class="form-row">
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="paypal_standard">&nbsp<?php echo _x( 'Paypal', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
             </label>
           </div>
           <div class="form-group col-md-12">
             <label for="payments_paypal_standard">
              <input type="radio" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>">&nbsp;<?php echo _x( 'Credit or debit card', 'renting_my_reservation', 'mybooking-wp-plugin' ) ?>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
             </label>
           </div>
        </div>
        <% } else if (sales_process.payment_methods.paypal_standard) {%>
          <div class="form-row">
            <div class="form-group col-md-12">
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-paypal.jpg"/>
            </div>
          </div>
          <input type="hidden" name="payment_method_id" value="paypal_standard" data-payment-method="paypal_standard">
        <% } else if (sales_process.payment_methods.tpv_virtual) {%>
          <div class="form-row">
            <div class="form-group col-md-12">
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-visa.jpg"/>
              <img src="<?php echo plugin_dir_url(__DIR__) ?>/assets/images/pm-mastercard.jpg"/>
            </div>
          </div>

          <input type="hidden" name="payment_method_id" value="<%=sales_process.payment_methods.tpv_virtual%>"/>
        <% } %>
        <% if (sales_process.can_pay_deposit) { %>
          <input type="hidden" name="payment" value="deposit"/>
        <% } else if (booking.total_paid == 0) {%>
          <input type="hidden" name="payment" value="total"/>
        <% } else { %>
          <input type="hidden" name="payment" value="pending"/>
        <% } %>
        <div class="form-row">
          <div class="form-group col-md-12">
            <button class="btn btn-outline-dark" id="btn_pay" type="submit"><?php echo _x('Pay', 'renting_my_reservation', 'mybooking') ?></button>
          </div>
        </div>
      </div>

    </script>
    