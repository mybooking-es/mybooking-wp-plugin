<?php
  /**
   * The Template for showing the transfer checkout step - JS microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-checkout-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>


<!-- RESERVATION DETAILS ------------------------------------------------------>

<script type="text/tmpl" id="script_transfer_reservation_summary">
  <div class="mb-section">

    <!-- // Product -->
    <div class="mybooking-product_info-block">

      <!-- // Photo -->
      <img class="mybooking-product_image" src="<%=shopping_cart.item_full_photo%>"/>

      <!-- // Description -->
      <div class="mybooking-product_name">
       <%=shopping_cart.item_name_customer_translation%>
      </div>

      <!-- // Price -->
      <div class="mybooking-product_price">
        <div class="mybooking-product_amount">
          <%=configuration.formatCurrency(shopping_cart.item_cost)%>
        </div>
      </div>
    </div>
  </div>


    <div class="mb-section">
      <div class="mybooking-summary_header">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( 'Reservation summary', 'transfer_checkout', 'mybooking-wp-plugin') ?>
        </div>
        <div class="mybooking-summary_edit" id="mybooking_transfer_modify_reservation_button" role="link">
          <i class="mb-button icon"><span class="dashicons dashicons-edit"></span></i><?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
        </div>

        <% if (shopping_cart.engine_modify_dates) { %>

        <% } %>
      </div>

      <div class="mybooking-summary_detail">

        <!-- // Date -->
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_date">
            <span class="dashicons dashicons-calendar-alt"></span>
            <%=configuration.formatDate(shopping_cart.date)%>&nbsp;<%=shopping_cart.time%>
          </span>
        </span>
        <!-- // Origin -->
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_place">
            <span class="dashicons dashicons-location"></span>
            <%=shopping_cart.origin_point_name_customer_translation%>
          </span>
        </span>
        <!-- // Destination -->
        <span class="mybooking-summary_item">
          <span class="mybooking-summary_place">
            <span class="dashicons dashicons-arrow-right-alt"></span>
            <%=shopping_cart.destination_point_name_customer_translation%>
          </span>
        </span>

        <hr>
        <% if (shopping_cart.round_trip) { %>
          <!-- // Date -->
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_date">
              <span class="dashicons dashicons-calendar-alt"></span>
              <%=configuration.formatDate(shopping_cart.return_date)%>&nbsp;<%=shopping_cart.return_time%>
            </span>
          </span>
          <!-- // Origin -->
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_place">
              <span class="dashicons dashicons-location"></span>
              <%=shopping_cart.return_origin_point_name_customer_translation%>
            </span>
          </span>
          <!-- // Destination -->
          <span class="mybooking-summary_item">
            <span class="mybooking-summary_place">
              <span class="dashicons dashicons-arrow-right-alt"></span>
              <%=shopping_cart.return_destination_point_name_customer_translation%>
            </span>
          </span>
        <% } %>

        <!-- // Seats -->
        <hr>
        <span class="mybooking-summary_seats">
          <span class="mybooking-summary_seat-item">
            <?php echo esc_html_x( 'Adults: ', 'transfer_checkout', 'mybooking-wp-plugin') ?>
            <%=shopping_cart.number_of_adults%>
          </span>
          <span class="mybooking-summary_seat-item">
            <?php echo esc_html_x( 'Children: ', 'transfer_checkout', 'mybooking-wp-plugin') ?>
            <%=shopping_cart.number_of_children%>
          </span>
          <span class="mybooking-summary_seat-item">
            <?php echo esc_html_x( 'Infants: ', 'transfer_checkout', 'mybooking-wp-plugin') ?>
            <%=shopping_cart.number_of_infants%>
          </span>
        </span>
      </div>
    </div>

    <!-- // Extras -->

    <% if (shopping_cart.extras.length > 0) { %>
      <div class="mb-section">
        <div class="mybooking-summary_details-title">
          <?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </div>

        <% for (var idx=0;idx<shopping_cart.extras.length;idx++) { %>
          <div class="mybooking-summary_extras">
            <div class="mybooking-summary_extra-item">
              <span class="mb-badge info mybooking-summary_extra-quantity">
                <%=shopping_cart.extras[idx].quantity%>
              </span>
              <span class="mybooking-summary_extra-name">
                <%=shopping_cart.extras[idx].extra_name_customer_translation%>
              </span>
            </div>
            <span class="mybooking-summary_extra-amount">
              <%=configuration.formatCurrency(shopping_cart.extras[idx].extra_cost)%>
            </span>
          </div>
        <% } %>
      </div>
    <% } %>

    <div class="mb-section">
      <div class="mybooking-summary_total">
        <div class="mybooking-summary_total-label">
          <?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>
        </div>
        <div class="mybooking-summary_total-amount">
          <%=configuration.formatCurrency(shopping_cart.total_cost)%>
        </div>
      </div>

      <?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
        <div class="mybooking-product_taxes">
          <?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</script>


<!-- EXTRAS LISTING ----------------------------------------------------------->

<script type="text/template" id="script_transfer_detailed_extra">

  <% if (extras && extras.length > 0) {%>
    <div class="mb-section">
      <h2 class="mb-section_title">
        <?php echo esc_html_x( 'Extras', 'transfer_checkout', 'mybooking-wp-plugin') ?>
      </h2>
      <div class="mybooking-extra_container">

        <% for (var idx=0;idx<extras.length;idx++) { %>
          <% var extra = extras[idx]; %>
          <% var value = (extrasInShoppingCart[extra.id]) ? extrasInShoppingCart[extra.id] : 0; %>
          <% var bg = ((idx % 2 == 0) ? 'bg-light' : ''); %>

          <div class="mybooking-extra_item <%=bg%>" data-extra="<%=extra.id%>">

            <div class="mybooking-extra_block">
              <% if (extra.photo_url) { %>
                <div class="mb-col-md-3 mb-col-sm-12 mybooking-extra_box-img">
                  <img class="extra-img js-extra-info-btn" src="<%=extra.photo_url%>" alt="<%=extra.name%>" data-extra="<%=extra.id%>">
                </div>
                <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                  <div class="mybooking-extra_name">
                    <%=extra.name%>
                  </div>
                  <% if (extra.description !='') { %>
                    <div class="mybooking-extra_description">
                      <%=extra.description%>
                    </div>
                  <% } %>
                </div>
              <% } else { %>
                <div class="mb-col-md-9 mb-col-sm-12 mybooking-extra_box-name">
                  <div class="mybooking-extra_name">
                    <%=extra.name%>
                  </div>
                  <% if (extra.description !='') { %>
                    <div class="mybooking-extra_description">
                      <%=extra.description%>
                    </div>
                  <% } %>
                </div>
              <% } %>
            </div>

            <div class="mybooking-extra_block">
              <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-price">
               <div class="mybooking-extra_price">
                  <%= configuration.formatCurrency(extra.price)%>
                </div>
               </div>

              <div class="mb-col-md-6 mb-col-sm-12 mybooking-extra_box-control">

                <% if (extra.max_quantity > 1) { %>
                  <div class="mybooking-extra_control">
                    <button class="mb-button control btn-minus-extra" data-value="<%=extra.id%>" data-max-quantity="<%=extra.max_quantity%>">-</button>
                    <input class="mb-input extra-input" type="text" id="extra-<%=extra.id%>-quantity" value="<%=value%>" data-extra-code="<%=extra.id%>" readonly/>
                    <button class="mb-button control btn-plus-extra" data-value="<%=extra.id%>" data-max-quantity="<%=extra.max_quantity%>">+</button>
                  </div>
                <% } else { %>
                  <div class="mybooking-extra_control">
                    <input class="mb-checkbox extra-checkbox" type="checkbox" id="checkboxl<%=extra.id%>" data-value="<%=extra.id%>" <% if (extrasInShoppingCart[extra.code] &&  extrasInShoppingCart[extra.code] > 0) { %> checked="checked" <% } %>>
                    <label class="mb-custom-label" for="checkboxl<%=extra.id%>"></label>
                  </div>
                <% } %>
              </div>
            </div>
          </div>
        <% } %>
      </div>
    </div>
  <% } %>
</script>


<!-- RESERVATION FORM --------------------------------------------------------->

<script type="text/tmpl" id="script_transfer_complete_form_tmpl">
  <div class="mb-form-group mb-form-row customer_component">
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_name">
        <?php echo esc_html_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="customer_name" id="customer_name" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Name', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
    </div>
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_surname">
        <?php echo esc_html_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="customer_surname" id="customer_surname" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Surname', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="40">
    </div>
  </div>

  <div class="mb-form-group mb-form-row customer_component">
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_email">
        <?php echo esc_html_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="customer_email" id="customer_email" autocomplete="off" placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
    </div>
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_email">
        <?php echo esc_html_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="confirm_customer_email" autocomplete="off" id="confirm_customer_email" placeholder="<?php echo esc_attr_x( 'Confirm E-mail', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="50">
    </div>
  </div>

  <div class="mb-form-group mb-form-row customer_component">
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_phone">
        <?php echo esc_html_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="customer_phone" id="customer_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:*" maxlength="15">
    </div>
    <div class="mb-col-md-6 mb-col-sm-12">
      <label for="customer_mobile_phone">
        <?php echo esc_html_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>
      </label>
      <input type="text" class="mb-form-control" name="customer_mobile_phone" id="customer_mobile_phone" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Alternative phone number', 'renting_complete', 'mybooking-wp-plugin') ?>:" maxlength="15">
    </div>
  </div>
  <hr>

  <% if (configuration.transfer_origin_destination_detailed_info_mode === 'only_address') { %>

    <!-- // Only Text detailed information -->

    <div class="mb-form-group">
      <label for="detailed_origin_address">
        <?php echo esc_html_x( 'Pickup address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Pickup address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
    </div>

    <% if (shopping_cart.round_trip) { %>
      <div class="mb-form-group">
        <label for="detailed_origin_address">
          <?php echo esc_html_x( 'Dropoff address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
        </label>
        <input type="text" class="mb-form-control" name="detailed_return_origin_address" id="detailed_return_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Dropoff address (hotel, resource, address, terminal)', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
      </div>
    <% } %>

  <% } else if (configuration.transfer_origin_destination_detailed_info_mode === 'flight_address') { %>

    <!-- // Standard pickup/dropoff -->

    <h3 class="mb-section_title complete-section-title">
      <?php echo esc_html_x( "Transfer details", 'transfer_checkout', 'mybooking-wp-plugin') ?>
    </h3>
    <legendclass="mb-form_legend">
      <?php echo esc_html_x( "Outward Journey Details", 'transfer_checkout', 'mybooking-wp-plugin') ?>
    </h4>
    <div class="mb-form-row mb-form-group customer_component">
      <div class="mb-col-md-6 mb-col-sm-12">
        <label for="detailed_origin_flight_number">
          <?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
        </label>
        <input type="text" class="mb-form-control" name="detailed_origin_flight_number" id="detailed_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
      </div>
      <div class="mb-col-md-6 mb-col-sm-12">
          <label for="detailed_origin_flight_estimated_time">
            <?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
          </label>
          <input type="time" class="mb-form-control" name="detailed_origin_flight_estimated_time" autocomplete="off" id="detailed_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
      </div>
    </div>

    <% if (shopping_cart.round_trip) { %>
      <h3 class="mb-section_title complete-section-title">
        <?php echo esc_html_x( "Return Journey Details", 'transfer_checkout', 'mybooking-wp-plugin') ?>
      </h3>
      <div class="mb-form-row mb-form-group customer_component">
        <div class="mb-col-md-6 mb-col-sm-12">
          <label for="detailed_return_origin_flight_number">
            <?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
          </label>
          <input type="text" class="mb-form-control" name="detailed_return_origin_flight_number" id="detailed_return_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>
        <div class="mb-col-md-6 mb-col-sm-12">
          <label for="detailed_return_origin_flight_estimated_time">
            <?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
          </label>
          <input type="time" class="mb-form-control" name="detailed_return_origin_flight_estimated_time" autocomplete="off" id="detailed_return_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
        </div>
      </div>
    <% } %>

    <h3 class="mb-section_title complete-section-title">
      <?php echo esc_html_x( "Accommodation", 'transfer_checkout', 'mybooking-wp-plugin') ?>
    </h3>
    <div class="mb-form-group">
      <label for="detailed_origin_address">
        <?php echo esc_html_x( 'Name of Hotel / Complex / Villa and address', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
      </label>
      <input type="text" class="mb-form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Name of Hotel / Complex / Villa and address', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
    </div>

  <% } else { %>

      <!-- // Trip -->

      <h3 class="mb-section_title complete-section-title">
        <?php echo esc_html_x( "Trip details", 'transfer_checkout', 'mybooking-wp-plugin') ?>
      </h3>

      <!-- // Going Origin -->
      <legend class="mb-form_legend">
        <span class="dashicons dashicons-location"></span>
        <?php echo esc_html_x( "Pickup", 'transfer_checkout', 'mybooking-wp-plugin') ?> ⟶
        <%= shopping_cart.origin_point_name_customer_translation%>
      </legend>

      <% if (shopping_cart.origin_point_detailed_info) { %>
        <% if (shopping_cart.origin_point_type === 'location') { %>
          <div class="mb-form-group">
            <label for="detailed_origin_address">
              <?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
            </label>
            <input type="text" class="mb-form-control" name="detailed_origin_address" id="detailed_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
          </div>

        <% } else { %>
          <div class="mb-form-group mb-form-row customer_component">
            <div class="mb-col-md-6 mb-col-sm-12">
              <label for="detailed_origin_flight_number">
                <?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
              </label>
              <input type="text" class="mb-form-control" name="detailed_origin_flight_number" id="detailed_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
            <div class="mb-col-md-6 mb-col-sm-12">
              <label for="detailed_origin_flight_estimated_time">
                <?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*
              </label>
              <input type="time" class="mb-form-control" name="detailed_origin_flight_estimated_time" autocomplete="off" id="detailed_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
          </div>
        <% } %>
      <% } %>

      <!-- // Going Destination -->
      <legend class="mb-form_legend">
        <span class="dashicons dashicons-location"></span>
        <?php echo esc_html_x( "Drop off", 'transfer_checkout', 'mybooking-wp-plugin') ?> ⟶
        <%= shopping_cart.destination_point_name_customer_translation%>
      </legend>

      <% if (shopping_cart.destination_point_detailed_info) { %>
        <% if (shopping_cart.destination_point_type === 'location') { %>
          <div class="mb-form-group">
            <label for="detailed_destination_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
            <input type="text" class="mb-form-control" name="detailed_destination_address" id="detailed_destination_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
          </div>

        <% } else { %>
          <div class="mb-form-group mb-form-row customer_component">
            <div class="mb-col-md-6 mb-col-sm-12">
              <label for="detailed_destination_flight_number"><?php echo esc_html_x( 'Flight or vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="mb-form-control" name="detailed_destination_flight_number" id="detailed_destination_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
            <div class="mb-col-md-6 mb-col-sm-12">
              <label for="detailed_destination_flight_estimated_time"><?php echo esc_html_x( 'Flight or vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="time" class="mb-form-control" name="detailed_destination_flight_estimated_time" autocomplete="off" id="detailed_destination_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
            </div>
          </div>
        <% } %>
      <% } %>

      <% if (shopping_cart.round_trip) { %>
        <h4 class="mb-section_title complete-section-title">
          <?php echo esc_html_x( "Round trip details", 'transfer_checkout', 'mybooking-wp-plugin') ?>
        </h4>

        <!-- // Return Origin -->
        <legend class="mb-form_legend">
          <span class="dashicons dashicons-location"></span>
          <?php echo esc_html_x( "Pickup", 'transfer_checkout', 'mybooking-wp-plugin') ?>
          <%= shopping_cart.return_origin_point_name_customer_translation%>
        </legend>

        <% if (shopping_cart.return_origin_point_detailed_info) { %>
          <% if (shopping_cart.return_origin_point_type === 'location') { %>
            <div class="mb-form-group">
              <label for="detailed_return_origin_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="mb-form-control" name="detailed_return_origin_address" id="detailed_return_origin_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
            </div>

          <% } else { %>
            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="detailed_return_origin_flight_number"><?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="mb-form-control" name="detailed_return_origin_flight_number" id="detailed_return_origin_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="detailed_return_origin_flight_estimated_time"><?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="time" class="mb-form-control" name="detailed_return_origin_flight_estimated_time" autocomplete="off" id="detailed_return_origin_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>
          <% } %>
        <% } %>

        <!-- // Return Destination -->
        <legend class="mb-form_legend">
          <span class="dashicons dashicons-location"></span>
          <?php echo esc_html_x( "Drop off", 'transfer_checkout', 'mybooking-wp-plugin') ?>
          <%= shopping_cart.return_destination_point_name_customer_translation%>
        </legend>

        <% if (shopping_cart.return_destination_point_detailed_info) { %>
          <% if (shopping_cart.return_destination_point_type === 'location') { %>
            <div class="mb-form-group">
              <label for="detailed_return_destination_address"><?php echo esc_html_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
              <input type="text" class="mb-form-control" name="detailed_return_destination_address" id="detailed_return_destination_address" rows="5" placeholder="<?php echo esc_attr_x( 'Address or hotel name', 'transfer_checkout', 'mybooking-wp-plugin') ?>">
            </div>

          <% } else { %>
            <div class="mb-form-group mb-form-row customer_component">
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="detailed_return_destination_flight_number"><?php echo esc_html_x( 'Flight or Vessel number', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="text" class="mb-form-control" name="detailed_return_destination_flight_number" id="detailed_return_destination_flight_number" autocomplete="off" placeholder="<?php echo esc_attr_x( 'Flight number', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
              <div class="mb-col-md-6 mb-col-sm-12">
                <label for="detailed_return_destination_flight_estimated_time"><?php echo esc_html_x( 'Flight or Vessel estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>*</label>
                <input type="time" class="mb-form-control" name="detailed_return_destination_flight_estimated_time" autocomplete="off" id="detailed_return_destination_flight_estimated_time" placeholder="<?php echo esc_attr_x( 'Flight estimated time', 'transfer_checkout', 'mybooking-wp-plugin') ?>:*" maxlength="50">
              </div>
            </div>
          <% } %>
        <% } %>
      <% } %>
  <% } %>
  <hr>

  <!-- // Additional info -->

  <h3 class="mb-section_title complete-section-title">
    <?php echo esc_html_x( "Additional information", 'renting_complete', 'mybooking-wp-plugin') ?>
  </h3>

  <div class="mb-form-group">
    <label for="comments"><?php echo esc_html_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?></label>
    <textarea class="mb-form-control" name="comments" id="comments" placeholder="<?php echo esc_attr_x( 'Comments', 'renting_complete', 'mybooking-wp-plugin') ?>"></textarea>
  </div>
  <br>

  <!-- // Reservation : payment (script_payment_detail) -->
  <div id="mybooking_transfer_payment_detail">
  </div>
</script>


<!-- PAYMENT BLOCK ------------------------------------------------------------>

<script type="text/tmpl" id="script_transfer_payment_detail">

  <% var paymentAmount = 0;
     var selectionOptions = 0;
     if (sales_process.can_request) {
       selectionOptions += 1;
     }
     if (sales_process.can_pay_on_delivery) {
       selectionOptions += 1;
     }
     if (sales_process.can_pay) {
       selectionOptions += 1;
       if (sales_process.can_pay_deposit) {
          paymentAmount = shopping_cart.booking_amount;
       } else {
          paymentAmount = shopping_cart.total_cost;
       }
     } %>

  <!-- // Payment hidden inputs -->

  <% if (sales_process.can_pay) { %>

    <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
      <!-- // The payment method will be selected later -->
      <input type="hidden" name="payment" value="none">

    <% } else if (sales_process.payment_methods.paypal_standard) { %>
      <!-- // Fixed paypal standard -->
      <input type="hidden" name="payment" value="paypal_standard">

    <% } else  if (sales_process.payment_methods.tpv_virtual) { %>
      <!-- // Fixed tpv -->
      <input type="hidden" name="payment" value="<%=sales_process.payment_methods.tpv_virtual%>">
    <% } %>

  <% } else { %>
    <input type="hidden" name="payment" value="none">
  <% } %>

  <!-- // Payment options -->

  <% if (selectionOptions > 1) { %>
    <div class="mb-section mybooking-payment_options">

       <% if (sales_process.can_request) { %>
         <label class="mybooking-payment_option-label" for="complete_action_request_reservation">
           <input class="mybooking-payment_option-input" type="radio" id="complete_action_request_reservation" name="complete_action" value="request_reservation" class="complete_action">
           <?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
         </label>
       <% } %>

       <% if (sales_process.can_pay_on_delivery) { %>
         <label class="mybooking-payment_option-label" for="payments_paypal_standard">
           <input class="mybooking-payment_option-input" type="radio" id="complete_action_pay_on_delivery" name="complete_action" value="pay_on_delivery" class="complete_action">
           <?php echo esc_html_x( 'Book now and pay on arrival', 'renting_complete', 'mybooking-wp-plugin' ) ?>
         </label>
       <% } %>

       <% if (sales_process.can_pay) { %>
         <label class="mybooking-payment_option-label" for="complete_action_pay_now">
           <input class="mybooking-payment_option-input" type="radio" id="complete_action_pay_now" name="complete_action" value="pay_now" class="complete_action">
           <?php echo esc_html_x( 'Book now and pay now', 'renting_complete', 'mybooking-wp-plugin' ) ?>
         </label>
       <% } %>
    </div>
  <% } %>

  <!-- // Request reservation -->

  <% if (sales_process.can_request) { %>
    <div class="mybooking-payment_confirmation-box" id="request_reservation_container" <% if (selectionOptions > 1 || !sales_process.can_request) { %>style="display:none"<%}%>>
      <label for="payments_paypal_standard">
        <input type="checkbox" id="conditions_read_request_reservation" name="conditions_read_request_reservation">&nbsp;

        <?php if ( empty($args['terms_and_conditions']) ) { ?>
          <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        <?php } else { ?>
          <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) )?>
        <?php } ?>
      </label>
      <button type="submit" class="mb-button btn-confirm-reservation">
        <?php echo esc_html_x( 'Request reservation', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
      </button>
    </div>
  <% } %>

  <!-- // Pay on delivery -->

  <% if (sales_process.can_pay_on_delivery) { %>

    <div class="mybooking-payment_confirmation-box" id="payment_on_delivery_container" <% if (selectionOptions > 1 || !sales_process.can_pay_on_delivery) { %>style="display:none"<%}%>>
      <label for="conditions_read_payment_on_delivery">
        <input type="checkbox" id="conditions_read_payment_on_delivery" name="conditions_read_payment_on_delivery">&nbsp;

        <?php if ( empty($args['terms_and_conditions']) ) { ?>
          <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        <?php } else { ?>
          <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) ) ?>
        <?php } ?>
      </label>
      <button type="submit" class="mb-button btn-confirm-reservation">
        <?php echo esc_html_x( 'Confirm', 'renting_complete', 'mybooking-wp-plugin' ) ?>
        <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
      </button>
    </div>
  <% } %>

  <!-- // Pay now -->

  <% if (sales_process.can_pay) { %>

    <div id="payment_now_container" <% if (selectionOptions > 1 || !sales_process.can_pay) { %>style="display:none"<%}%>>
      <div class="mybooking-payment_confirmation-info">

        <!-- // Payment amount -->
        <div class="mybooking-payment_amount">
          <%=i18next.t('complete.reservationForm.total_payment', {amount: configuration.formatCurrency(paymentAmount)})%>
        </div>

        <!-- // Payment info -->
        <div class="mb-alert info highlight">
           <%=i18next.t('complete.reservationForm.booking_amount',{amount: configuration.formatCurrency(paymentAmount)})%>
        </div>

        <% if (sales_process.payment_methods.paypal_standard && sales_process.payment_methods.tpv_virtual) { %>
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
            <input type="radio" id="payments_credit_card" name="payment_method_select" class="payment_method_select" value="<%=sales_process.payment_methods.tpv_virtual%>"><?php echo _x( 'Credit or debit card', 'renting_complete', 'mybooking-wp-plugin' ) ?>
           </label>
          </div>
          <div id="payment_method_select_error"></div>

        <% } else if (sales_process.payment_methods.paypal_standard) { %>
          <div class="mb-alert secondary" role="alert">
            <?php echo wp_kses_post( _x( 'You will be redirected to <b>Paypal payment platform</b> to make the confirmation payment securely. You can use <u>Paypal</u> or <u>credit card</u> to make the payment.', 'renting_complete', 'mybooking-wp-plugin' ) ) ?>
          </div>
          <div class="mybooking-payment_confirmation-box">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-paypal.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          </div>

        <% } else if (sales_process.payment_methods.tpv_virtual) { %>
          <div class="mb-alert secondary" role="alert">
            <?php echo wp_kses_post( _x( 'You will be redirected to the <b>credit card payment platform</b> to make the confirmation payment securely.', 'renting_complete', 'mybooking-wp-plugin' )  )?>
          </div>
          <div class="mybooking-payment_confirmation-box">
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-visa.jpg') ?>"/>
            <img src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/pm-mastercard.jpg') ?>"/>
          </div>
        <% } %>
      </div>

      <div class="mybooking-payment_confirmation-box">
        <label for="payments_paypal_standard">
          <input type="checkbox" id="conditions_read_pay_now" name="conditions_read_pay_now">

            <?php if ( empty($args['terms_and_conditions']) ) { ?>
              <?php echo esc_html_x( 'I have read and hereby accept the conditions of rental', 'renting_complete', 'mybooking-wp-plugin' ) ?>
            <?php } else { ?>
              <?php echo wp_kses_post ( sprintf( _x( 'I have read and hereby accept the <a href="%s" target="_blank">conditions</a> of rental', 'renting_complete', 'mybooking-wp-plugin' ), $args['terms_and_conditions'] ) )?>
            <?php } ?>
        </label>
        <button type="submit" class="mb-button btn-confirm-reservation">
          <%=i18next.t('complete.reservationForm.payment_button',{amount: configuration.formatCurrency(paymentAmount)})%>
          <i class="mb-button icon"><span class="dashicons dashicons-arrow-right-alt"></span></i>
        </button>
      </div>
    </div>
  <% } %>
</script>

<!-- Script that shows the extra detail -->
<!-- <script type="text/tmpl" id="script_transfer_extra_modal">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <% for (var idx=0; idx<extra.photos.length; idx++) { %>
            <div class="carousel-item <% if (idx==0) {%>active<%}%>">
              <img class="d-block w-100" src="<%=extra.photos[idx].full_photo_path%>" alt="<%=extra.name%>">
            </div>
            <% } %>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">&lt;</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">&gt;</span>
          </a>
        </div>
        <div class="mt-3 text-muted"><%=extra.description%></div>
      </div>
    </div>
  </div>
</script> -->
