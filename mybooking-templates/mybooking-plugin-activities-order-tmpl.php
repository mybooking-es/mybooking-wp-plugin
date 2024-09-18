<?php
/**
 *   MYBOOKING ENGINE - MY RESERVATION ACTIVITY TEMPLATES
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting summary step
 *   This template can be overridden by copying it to your theme
 *   /mybooking-templates/mybooking-plugin-activities-order-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<script type="text/tpml" id="script_order">
  <div class="mb-row-flex">
    <div class="mb-col-md-6 mb-col-lg-8">
      <!-- // Reservation status message -->
      <div class="mybooking-summary_status">
        <%= order.summary_status %>
      </div>

      <div class="mb-section mb-panel-container mybooking-details_container">
        <div class="mybooking-summary_locator">
          <?php echo esc_html_x( 'Reservation Id', 'renting_summary', 'mybooking-wp-plugin') ?>:
          <span class="mybooking-summary_locator-id"><%=order.id%></span>
        </div>
      </div>

      <!-- // Products -->
      <% var customers_data = false; %>
      <% for (idx in order.items) { %>
        <% if (typeof order.items[idx].customers !== 'undefined' && typeof order.items[idx].customer_questions !== 'undefined') { %>
            <% customers_data = true; %>
        <% } %>
        
        <div class="mb-section">
          <div class="mb-card">
            <!-- // Product photo -->
            <% if (order.items[idx].photo_full != null) { %>
              <img class="mybooking-product_image" src="<%=order.items[idx].photo_full%>" alt="">
            <% } else { %>
              <div class="mybooking-product_image-fallback">
                <i class="fa fa-camera" aria-hidden="true"></i>
              </div>
            <% } %>

            <div class="mb-card_body">
              <!-- // Product name -->
              <span class="mybooking-product_name">
                <%=order.items[idx].item_description_customer_translation%>
              </span>

              <div class="mybooking-activity_date">
                <span class="mybooking-activity_date-item">
                  <%= configuration.formatDate(order.items[idx].date) %>
                </span>
                <span class="mybooking-activity_date-item">
                  <%= order.items[idx].time %>
                </span>
              </div>

              <% if (order.allow_select_places_for_reservation || order.use_rates) { %>
                <% if (order.allow_select_places_for_reservation) { %>
                  <% if (order.use_rates) { %>
                    <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                      <div class="mybooking-summary_activities">
                        <div class="mybooking-summary_activity-item">
                          <span class="mb-badge info mybooking-summary_activity-quantity">
                            <%=order.items[idx]['items'][x].quantity %>
                          </span>
                          <span class="mybooking-summary_activity-name">
                            <%=order.items[idx]['items'][x].item_price_description %> x
                          </span>
                          <span class="mybooking-summary_activity-amount">
                            <%=configuration.formatCurrency(order.items[idx]['items'][x].item_unit_cost) %>
                          </span>
                        </div>
                        <span class="mybooking-summary_activity-amount">
                          <%=configuration.formatCurrency(order.items[idx]['items'][x].item_cost) %>
                        </span>
                      </div>
                    <% } %>
                  <% } else { %>
                    <% for (var x=0; x<order.items[idx]['items'].length; x++) { %>
                      <div class="mybooking-summary_activities">
                        <span class="mybooking-summary_activity-quantity">
                          <%=order.items[idx]['items'][x].quantity %>
                        </span>
                        <span class="mybooking-summary_activity-name">
                          <%=order.items[idx]['items'][x].item_price_description %>
                        </span>
                      </div>
                    <% } %>
                  <% } %>
                <% } %>
              <% } %>
            </div>
          </div>
        </div>
      <% } %>

      <!-- // Show the total -->
      <% if (order.use_rates) { %>
        <div class="mb-section mb-panel-container">
          <div class="mybooking-summary_activities-total  mybooking-summary_activities-total--notborder">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Total', 'activity_shopping_cart_item', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount">
              <%=configuration.formatCurrency(order.items[idx]['total'])%>
            </span>
          </div>

          <div class="mybooking-summary_activities-total">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Paid', 'activity_summary', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount">
              <%=configuration.formatCurrency(order.total_paid)%>
            </span>
          </div>

          <div class="mybooking-summary_activities-total">
            <span class="mybooking-summary_activity-total-label">
              <?php echo esc_html_x( 'Pending', 'activity_summary', 'mybooking-wp-plugin' ) ?>
            </span>
            <span class="mybooking-summary_activity-total-amount mb-text-danger">
              <%=configuration.formatCurrency(order.total_pending)%>
            </span>
          </div>
        </div>
      <% } %>

      <br />

      <!-- // Customers data -->
      <% if (customers_data || order.request_customer_address) { %>
        <div id="customers_data" class="mb-section mb-panel-container">
          <form class="mybooking-form" id="order_information_form" name="order_information_form">
            <div class="mb-alert lighter">
              <?php echo esc_html_x( 'Please complete the information to speed up the delivery process on the scheduled date', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
            </div>

            <!-- // Address -->
            <% if (order.request_customer_address) { %>
              <h3 class="mb-form_title">
                <?php echo esc_html_x( 'Customer address', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
              </h3>

              <div class="mb-form-row">
              <!-- Country -->
                <div class="mb-form-group mb-col-md-6">
                  <label for="country">
                    <?php echo esc_html_x( 'Country', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <select name="customer_address[country]" id="country" class="mb-form-control"
                          data-state-selector-name=".customer_address_state_code_container"
                          data-state-input-name="input[name=customer_address\\[state\\]]"
                          data-city-selector-name=".customer_address_city_code_container"
                          data-city-input-name="input[name=customer_address\\[city\\]]">
                  </select>
                </div>
                
                <!-- State -->
                <div class="mb-form-group mb-col-md-6">
                  <label for="state">
                    <?php echo esc_html_x( 'State', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <% if (configuration.sesHospedajes) { %>
                    <div class="customer_address_state_code_container" 
                         <% if (order.address_country !== 'ES') { %>style="display: none;"<%}%>>
                      <select id="customer_address[state_code]" name="customer_address[state_code]" class="mb-form-control" 
                              data-select-name="customer_address[city_code]" 
                              data-select-value="address_city_code"
                              data-code-value="<%=order.address_state_code%>"
                              data-text-value="<%=order.address_state%>">
                      </select>
                    </div>
                  <% } %>
                  <input class="mb-form-control" id="state" name="customer_address[state]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'State', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
                    value="<%=order.address_state%>"  max_length="60"
                    <% if (configuration.sesHospedajes && order.address_country === 'ES') { %>style="display: none"<%}%>>
                </div>
              </div>
              <div class="mb-form-row">
                <!-- City -->
                <div class="mb-form-group mb-col-md-6">
                  <label for="city">
                    <?php echo esc_html_x( 'City', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <% if (configuration.sesHospedajes) { %>
                    <div class="customer_address_city_code_container"
                         <% if (order.address_country !== 'ES') { %>style="display: none;"<%}%>>
                      <select id="customer_address[city_code]" name="customer_address[city_code]" class="mb-form-control" 
                         <% if (!order.address_state_code || order.address_state_code == ''){%>disabled<%}%> 
                          data-code-value="<%=order.address_city_code%>"
                          data-text-value="<%=order.address_city%>">
                      </select>
                    </div>
                  <% } %>
                  <input class="mb-form-control" id="city" name="customer_address[city]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'City', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" 
                    value="<%=order.address_city%>" max_length="60" 
                    <% if (configuration.sesHospedajes && order.address_country === 'ES') { %>style="display: none;"<%}%>>
                </div>

                <!-- Zip -->
                <div class="mb-form-group mb-col-md-6">
                  <label for="zip">
                    <?php echo esc_html_x( 'Postal Code', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <input class="mb-form-control" id="zip" name="customer_address[zip]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Postal Code', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=order.address_zip%>"  max_length="10">
                </div>
              </div>

              <div class="mb-form-row">
                <!-- Street -->
                <div class="mb-form-group mb-col-md-6">
                  <label for="street">
                    <?php echo esc_html_x( 'Address', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <input class="mb-form-control" id="street" name="customer_address[street]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Address', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=order.address_street%>" maxlength="60">
                </div>

                <!-- Number -->
                <div class="mb-form-group mb-col-md-3">
                  <label for="number">
                    <?php echo esc_html_x( 'Number', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <input class="mb-form-control" id="number" name="customer_address[number]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Number', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=order.address_number%>" maxlength="10">
                </div>

                <!-- Complement -->
                <div class="mb-form-group mb-col-md-3">
                  <label for="complement">
                    <?php echo esc_html_x( 'Complement', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
                  </label>
                  <input class="mb-form-control" id="complement" name="customer_address[complement]" type="text"
                    placeholder="<%=configuration.escapeHtml("<?php echo esc_attr_x( 'Complement', 'activity_my_reservation', 'mybooking-wp-plugin') ?>")%>" value="<%=order.address_complement%>"  max_length="20">
                </div>
              </div>
            <% } %>

            <!-- // Customer information -->
            <% if (customers_data) { %>
              <% var index = 0; %>
              <% for (idx in order.items) { %>

                <!-- // Customer questions and details -->
                <% if (typeof order.items[idx].customers !== 'undefined' && typeof order.items[idx].customer_questions !== 'undefined') { %>
                  <% var customer_questions = order.items[idx].customer_questions; %>
                  <h3 class="mb-form_tile mybooking-summary_activity-group-title mb-alert light">
                    <%=order.items[idx].item_description_customer_translation%>
                    <%= configuration.formatDate(order.items[idx].date) %>
                    <%= order.items[idx].time %>
                  </h3>

                  <% for (var idxCustomers=0; idxCustomers<order.items[idx].customers.length; idxCustomers++) { %>
                      <% order_item_customer= order.items[idx].customers[idxCustomers]; %>
                      <% index += 1; %>
                      <input type="hidden" name="order_item_customers[<%=index%>][id]" value="<%=order_item_customer.id%>"/>

                      <h4 class="mb-form_tile mb-alert lighter">
                        <?php echo esc_html_x( 'Participant', 'activity_my_reservation', 'mybooking-wp-plugin' ) ?> #<%=index%>
                      </h4>

                      <div class="mb-form-row">
                        <div class="mb-form-group mb-col-md-6">
                          <label for="customer_name"><?php echo esc_html_x( 'Name', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="order_item_customers[<%=index%>][customer_name]"
                                  title="<?php echo esc_attr_x( 'Name', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                  class="mb-form-control" type="text"
                                  placeholder="<?php echo esc_attr_x( 'Name', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                  value="<%=order_item_customer.customer_name%>">
                        </div>
                        <div class="mb-form-group mb-col-md-6">
                          <label for="customer_name"><?php echo esc_html_x( 'Surname', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                          <input name="order_item_customers[<%=index%>][customer_surname]"
                                  title="<?php echo esc_attr_x( 'Surname', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                  class="mb-form-control" type="text"
                                  placeholder="<?php echo esc_attr_x( 'Surname', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
                                  value="<%=order_item_customer.customer_surname%>">
                        </div>
                      </div>

                      <div class="mb-form-row">
                        <% if (customer_questions.request_customer_document_id) { %>
                          <div class="mb-form-group mb-col-md-6">
                            <label for="customer_document_id"><?php echo esc_html_x( 'Document ID', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="order_item_customers[<%=index%>][customer_document_id]"
                                    title="<?php echo esc_attr_x( 'Document ID', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                    class="mb-form-control" type="text"
                                    placeholder="<?php echo esc_attr_x( 'Document ID', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                    value="<%=order_item_customer.customer_document_id%>">
                          </div>
                        <% } %>

                        <% if (customer_questions.request_customer_date_of_birth) { %>
                          <div class="mb-form-group mb-col-md-6">
                            <label for="customer_date_of_birth"><?php echo esc_html_x( 'Date of birth', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="order_item_customers[<%=index%>][customer_date_of_birth]"
                                    title="<?php echo esc_attr_x( 'Date of birth', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                    class="mb-form-control" type="date"
                                    placeholder="<?php echo esc_attr_x( 'Date of birth', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                    value="<%=order_item_customer.customer_date_of_birth%>">
                          </div>
                        <% } %>
                      </div>

                      <div class="mb-form-row">

                        <% if (customer_questions.request_customer_phone) { %>
                          <div class="mb-form-group mb-col-md-6">
                            <label for="customer_phone"><?php echo esc_html_x( 'Phone number', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="order_item_customers[<%=index%>][customer_phone]"
                                    title="<?php echo esc_attr_x( 'Phone number', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                    class="mb-form-control" type="text"
                                    placeholder="<?php echo esc_attr_x( 'Phone number', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                    value="<%=order_item_customer.customer_phone%>">
                          </div>
                        <% } %>

                        <% if (customer_questions.request_customer_email) { %>
                          <div class="mb-form-group mb-col-md-6">
                            <label for="customer_email"><?php echo esc_html_x( 'E-mail', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            <input name="order_item_customers[<%=index%>][customer_email]"
                                    title="<?php echo esc_attr_x( 'E-mail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                    class="mb-form-control" type="text"
                                    placeholder="<?php echo esc_attr_x( 'E-mail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
                                    value="<%=order_item_customer.customer_email%>">
                          </div>
                          <% } %>
                      </div>

                      <% if (customer_questions.request_customer_height || customer_questions.request_customer_weight) { %>
                        <div class="mb-form-row">
                          <% if (customer_questions.request_customer_height) { %>
                            <div class="mb-form-group mb-col-md-6">
                              <label for="customer_height"><?php echo esc_html_x( 'Height (cm)', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <input name="order_item_customers[<%=index%>][customer_height]"
                                      title="<?php echo esc_attr_x( 'Height (cm)', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-form-control" type="number"
                                      placeholder="<?php echo esc_attr_x( 'Height (cm)', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
                                      value="<%=order_item_customer.customer_height%>">
                            </div>
                          <% } %>

                          <% if (customer_questions.request_customer_weight) { %>
                            <div class="mb-form-group mb-col-md-6">
                              <label for="customer_weight"><?php echo esc_html_x( 'Weight (kg)', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <input name="order_item_customers[<%=index%>][customer_weight]"
                                      title="<?php echo esc_attr_x( 'Weight (kg)', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-form-control" type="number"
                                      placeholder="<?php echo esc_attr_x( 'Weight (kg)', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="200"
                                      value="<%=order_item_customer.customer_weight%>">
                            </div>
                          <% } %>
                        </div>
                      <% } %>

                      <% if (customer_questions.request_customer_allergies_intolerances) { %>
                        <div class="mb-form-row">
                          <div class="mb-form-group mb-col-md-3">
                            <div class="mb-form_checkbox">
                              <input name="order_item_customers[<%=index%>][customer_allergies]"
                                      title="<?php echo esc_html_x( 'Allergies', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-input_checkbox" type="checkbox"
                                      <% if (order_item_customer.customer_allergies){%>checked<%}%>>
                              <label for="customer_allergies" class="form-check-label"><?php echo esc_html_x( 'Allergies', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            </div>
                          </div>
                          <div class="mb-form-group mb-col-md-9">
                              <label for="customer_allergies_detail"><?php echo esc_html_x( 'Allergies detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <textarea name="order_item_customers[<%=index%>][customer_allergies_detail]"
                                        title="<?php echo esc_attr_x( 'Allergies detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                        class="mb-form-control" type="number"
                                        placeholder="<?php echo esc_attr_x( 'Allergies detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" rows="5"><%=order_item_customer.customer_allergies_detail%></textarea>
                          </div>
                        </div>
                        <div class="mb-form-row">
                          <div class="mb-form-group mb-col-md-3">
                            <div class="mb-form_checkbox">
                              <input name="order_item_customers[<%=index%>][customer_intolerances]"
                                      title="<?php echo esc_attr_x( 'Intolerances', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-input_checkbox" type="checkbox"
                                      <% if (order_item_customer.customer_intolerances){%>checked<%}%>>
                              <label for="customer_intolerances" class="form-check-label"><?php echo esc_html_x( 'Intolerances', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            </div>
                          </div>
                          <div class="mb-form-group mb-col-md-9">
                              <label for="customer_intolerances_detail"><?php echo esc_html_x( 'Intolerances detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <textarea name="order_item_customers[<%=index%>][customer_intolerances_detail]"
                                        title="<?php echo esc_attr_x( 'Intolerances detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                        class="mb-form-control" type="number"
                                        placeholder="<?php echo esc_attr_x( 'Intolerances detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" rows="5"><%=order_item_customer.customer_intolerances_detail%></textarea>
                          </div>
                        </div>
                      <% } %>
                      <% if (customer_questions.request_customer_slight_injuries) { %>
                        <div class="mb-form-row">
                          <div class="mb-form-group mb-col-md-3">
                            <div class="mb-form_checkbox">
                              <input name="order_item_customers[<%=index%>][customer_slight_injuries]"
                                      title="<?php echo esc_attr_x( 'Slight injuries', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-input_checkbox" type="checkbox"
                                      <% if (order_item_customer.customer_slight_injuries){%>checked<%}%>>
                              <label for="customer_slight_injuries" class="form-check-label"><?php echo esc_html_x( 'Slight injuries', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            </div>
                          </div>
                          <div class="mb-form-group mb-col-md-9">
                              <label for="customer_slight_injuries_detail"><?php echo esc_html_x( 'Slight injuries detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <textarea name="order_item_customers[<%=index%>][customer_slight_injuries_detail]"
                                        title="<?php echo esc_attr_x( 'Slight injuries detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                        class="mb-form-control" type="number"
                                        placeholder="<?php echo esc_attr_x( 'Slight injuries detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" rows="5"><%=order_item_customer.customer_slight_injuries_detail%></textarea>
                          </div>
                        </div>
                      <% } %>
                      <% if (customer_questions.request_customer_diseases) { %>
                        <div class="mb-form-row">
                          <div class="mb-form-group mb-col-md-3">
                            <div class="mb-form_checkbox">
                              <input name="order_item_customers[<%=index%>][customer_diseases]"
                                      title="<?php echo esc_attr_x( 'Diseases', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                      class="mb-input_checkbox" type="checkbox"
                                      <% if (order_item_customer.customer_diseases){%>checked<%}%>>
                              <label for="customer_diseases" class="form-check-label"><?php echo esc_html_x( 'Diseases', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                            </div>
                          </div>
                          <div class="mb-form-group mb-col-md-9">
                              <label for="customer_diseases_detail"><?php echo esc_html_x( 'Diseases detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?></label>
                              <textarea name="order_item_customers[<%=index%>][customer_diseases_detail]"
                                        title="<?php echo esc_attr_x( 'Diseases detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
                                        class="mb-form-control" type="number"
                                        placeholder="<?php echo esc_attr_x( 'Diseases detail', 'activity_my_reservation', 'mybooking-wp-plugin') ?>:" rows="5"><%=order_item_customer.customer_diseases_detail%></textarea>
                          </div>
                        </div>
                      <% } %>

                      <% if (customer_questions.request_customer_experience) { %>
                        <div class="mb-form-row">
                            <div class="mb-col-md-12">
                              <h3 class="mb-form_title">
                                <%=customer_questions.request_customer_experience_products_text%>
                              </h3>
                            </div>
                            <% if (customer_questions.request_customer_experience_product_1) { %>
                            <div class="mb-form-group mb-col-md-6">
                              <label for="customer_experience_product_1" class="form-check-label"><%=customer_questions.request_customer_experience_product_1_text%></label>
                              <select name="order_item_customers[<%=index%>][customer_experience_product_1]"
                                      class="mb-form-control">
                                <option value=""><?php echo esc_html_x( 'Select the option', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="0" <% if (order_item_customer.customer_experience_product_1 == '0'){%>selected<%}%>><?php echo esc_html_x( 'Never', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="1" <% if (order_item_customer.customer_experience_product_1 == '1'){%>selected<%}%>><?php echo esc_html_x( 'Once', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="2" <% if (order_item_customer.customer_experience_product_1 == '2'){%>selected<%}%>><?php echo esc_html_x( 'Twice', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="3" <% if (order_item_customer.customer_experience_product_1 == '3'){%>selected<%}%>><?php echo esc_html_x( 'Three or more times', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                              </select>
                            </div>
                            <% } %>

                            <% if (customer_questions.request_customer_experience_product_2) { %>
                            <div class="mb-form-group mb-col-md-6">
                              <label for="customer_experience_product_2" class="form-check-label"><%=customer_questions.request_customer_experience_product_2_text%></label>
                              <select name="order_item_customers[<%=index%>][customer_experience_product_2]"
                                      class="mb-form-control">
                                <option value=""><?php echo esc_html_x( 'Select the option', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="0" <% if (order_item_customer.customer_experience_product_2 == '0'){%>selected<%}%>><?php echo esc_html_x( 'Never', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="1" <% if (order_item_customer.customer_experience_product_2 == '1'){%>selected<%}%>><?php echo esc_html_x( 'Once', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="2" <% if (order_item_customer.customer_experience_product_2 == '2'){%>selected<%}%>><?php echo esc_html_x( 'Twice', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                                <option value="3" <% if (order_item_customer.customer_experience_product_2 == '3'){%>selected<%}%>><?php echo esc_html_x( 'Three or more times', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                              </select>
                            </div>
                            <% } %>
                        </div>
                      <% } %>

                      <% if (customer_questions.request_customer_experience_course || customer_questions.request_customer_experience_activity) { %>
                      <div class="mb-form-row">
                        <% if (customer_questions.request_customer_experience_course) { %>
                        <div class="mb-form-group mb-col-md-6">
                          <label for="customer_experience_tecnical_course" class="form-check-label"><%=customer_questions.request_customer_experience_course_text%></label>
                          <select name="order_item_customers[<%=index%>][customer_experience_tecnical_course]"
                                  class="mb-form-control">
                            <option value=""><?php echo esc_html_x( 'Select the option', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                            <option value="false" <% if (!order_item_customer.customer_experience_tecnical_course){%>selected<%}%>><?php echo esc_html_x( 'No', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                            <option value="true" <% if (order_item_customer.customer_experience_tecnical_course){%>selected<%}%>><?php echo esc_html_x( 'Yes', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                          </select>
                        </div>
                        <% } %>

                        <% if (customer_questions.request_customer_experience_activity) { %>
                        <div class="mb-form-group mb-col-md-6">
                          <label for="customer_experience_activities" class="form-check-label"><%=customer_questions.request_customer_experience_activity_text%></label>
                          <select name="order_item_customers[<%=index%>][customer_experience_activities]"
                                  class="mb-form-control">
                            <option value=""><?php echo esc_html_x( 'Select the option', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                            <option value="false" <% if (!order_item_customer.customer_experience_activities){%>selected<%}%>><?php echo esc_html_x( 'No', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                            <option value="true" <% if (order_item_customer.customer_experience_activities){%>selected<%}%>><?php echo esc_html_x( 'Yes', 'activity_my_reservation', 'mybooking-wp-plugin') ?></option>
                          </select>
                        </div>
                        <% } %>
                      </div>
                    <% } %>
                  <% } %>
                <% } %>
              <% } %>
            <% } %>

            <button class="mb-button" id="btn_update_order" type="button">
              <?php echo esc_html_x( 'Update', 'activity_my_reservation', 'mybooking-wp-plugin') ?>
            </button>
          </form>
        </div>
      <% } %>
    </div>

    <div class="mb-col-md-6 mb-col-lg-4">
      <!-- // Payment -->
      <% if (canPay && paymentAmount > 0) { %>
        <div class="mb-section mb-panel-container">
          <form name="payment_form">
            <div id="payment_now_container">
              <div class="mybooking-payment_amount">
                <%=i18next.t('activities.payment.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%>
              </div>

              <!-- // Payment amount -->
              <% if (payment === 'deposit' || payment === 'total') { %>
                <div id="payment_amount_container" class="mb-alert info highlight">
                  <%=i18next.t('activities.payment.deposit_amount',{amount: configuration.formatCurrency(paymentAmount)})%>
                </div>
              <% } else if (payment === 'pending') { %>
                <div id="payment_amount_container" class="mb-alert info highlight">
                  <%=i18next.t('activities.payment.pending_amount',{amount: configuration.formatCurrency(paymentAmount)})%>
                </div>
              <% } %>

              <!-- // Payment method -->
              <% if (order.payment_methods.paypal_standard && order.payment_methods.tpv_virtual) { %>
                <div class="mb-alert secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to the <b>payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) )?>
                </div>
                <div class="mybooking-payment_confirmation-box">
                <label class="mybooking-payment_custom-label" for="payments_paypal_standard">
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                  <input type="radio" id="payments_paypal_standard" name="payment_method_select" class="payment_method_select" value="paypal_standard"><?php echo esc_html_x( 'Paypal', 'renting_complete', 'mybooking-wp-plugin' ) ?>
                </label>

                <label class="mybooking-payment_custom-label" for="payments_credit_card">
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
                  <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=order.payment_methods.tpv_virtual%>"><?php echo wp_kses_post( _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
                </label>
                </div>
                <div class="mb-row">
                  <div class="mb-form-group mb-col-md-12">
                    <div id="payment_method_select_error"></div>
                  </div>
                </div>  

              <% } else if (order.payment_methods.paypal_standard) { %>
                <div class="mb-alert secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
                </div>
                <div class="mybooking-payment_confirmation-box">
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>              
                  <input type="hidden" name="payment_method_value" value="paypal_standard">
                </div>

              <% } else if (order.payment_methods.tpv_virtual) { %>
                <div class="mb-alert secondary" role="alert">
                  <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
                </div>
                <div class="mybooking-payment_confirmation-box">
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
                  <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
                </div>
                <input type="hidden" name="payment_method_value" value="<%=order.payment_methods.tpv_virtual%>"/>
              <% } %>

              <button class="mb-button block" id="btn_pay" type="submit">
                <%=i18next.t('activities.payment.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%>
              </button>
              
              <div id="payment_error" class="mb-alert danger" style="display:none"></div>

            </div>
          </form>
        </div>
      <% } %>

      <!-- // Customers detail -->
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( "Customer's details", 'renting_summary', 'mybooking-wp-plugin') ?>
        </div>
        <ul class="mb-list border">
          <li class="mb-list-item">
            <span class="dashicons dashicons-businessperson"></span>
            &nbsp;
            <%=order.customer_name%> <%=order.customer_surname%>
          </li>

          <% if (order.customer_phone && order.customer_phone != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-phone"></span>
              &nbsp;
              <%=order.customer_phone%> <%=order.customer_mobile_phone%>
            </li>
          <% } %>

          <% if (order.customer_email && order.customer_email != '') { %>
            <li class="mb-list-item">
              <span class="dashicons dashicons-email"></span>
              &nbsp;
              <%=order.customer_email%>
            </li>
          <% } %>

          <% if (configuration.activityCustomerVehicle) { %>
              <li class="mb-list-item">
                <% if (order.customer_stock_brand && order.customer_stock_brand != '') { %>
                  <%=order.customer_stock_brand%>
                <% } %>  
                <% if (order.customer_stock_model && order.customer_stock_model != '') { %>
                  <%=order.customer_stock_model%>
                <% } %>  
                <% if (order.customer_stock_plate && order.customer_stock_plate != '') { %>  
                  <%=order.customer_stock_plate%>
                <% } %>  
                <% if (order.customer_stock_color && order.customer_stock_color != '') { %>
                  <%=order.customer_stock_color%>
                <% } %>
              </li>
          <% } %>
        </ul>
      </div>
    </div>
  </div>
</script>
