<?php
  /**
   * The Template for showing the transfer select vehicle step - JS Microtemplates
   *
   * This template can be overridden by copying it to yourtheme/mybooking-templates/mybooking-plugin-transfer-choose-vehicle-tmpl.php
   *
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
   */
?>

<!-- RESERVATION SUMMARY ------------------------------------------------------>

<script type="text/tmpl" id="script_transfer_reservation_summary">

  <div class="mybooking-summary_header">
    <div class="mybooking-summary_details-title">
      <?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?> ⟶

      <!-- // Type of reservation -->
      <% if (shopping_cart.round_trip) { %>
        <?php echo esc_html_x( 'Round trip', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>
      <% } else { %>
        <?php echo esc_html_x( 'One Way', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>
      <% } %>
    </div>

    <div class="mybooking-summary_edit" id="modify_reservation_button" role="link">
      <i class="mb-button icon">
        <span class="dashicons dashicons-edit"></span>
      </i>
      <?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
    </div>
  </div>

  <div class="mybooking-summary_detail">
    <span class="mybooking-summary_item">
      <span class="mybooking-summary_date">
        <%=shopping_cart.date%> <%=shopping_cart.time%>
      </span>
      <span class="mybooking-summary_place">
        <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
        <%=shopping_cart.origin_point_name%>
      </span>
      <span class="mybooking-summary_place">
        <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
        <%=shopping_cart.destination_point_name%>
      </span>
    </span>

    <% if (shopping_cart.round_trip) { %>
      <span class="mybooking-summary_item">
        <span class="mybooking-summary_date">
          <%=shopping_cart.date%> <%=shopping_cart.time%>
        </span>
        <span class="mybooking-summary_place">
          <?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
          <%=shopping_cart.origin_point_name%>
        </span>
        <span class="mybooking-summary_place">
          <?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
          <%=shopping_cart.destination_point_name%>
        </span>
      </span>
    <% } %>

    <span class="mybooking-summary_item">
      <?php echo esc_html_x( 'Adults', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_adults%></br>
      <?php echo esc_html_x( 'Children', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_children%></br>
      <?php echo esc_html_x( 'Infants', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_infants%>
    </span>
  </div>
</script>


<!-- PRODUCT LOOP ------------------------------------------------------------->

<script type="text/tmpl" id="script_transfer_detailed_product">

  <div class="mybooking-product_container mybooking-product_grid">

    <!-- // Product view switch -->
    <div class="mybooking-product_filter">

      <% if (available > 0) { %>
        <div class="mybooking-process_choose-message">
          <%=i18next.t('transfer.chooseVehicle.vehicleFound', {available: available})%>
        </div>
      <% } else { %>
        <div class="mybooking-process_choose-message">
          <%=i18next.t('transfer.chooseVehicle.vehicleNotFound')%>
        </div>
      <% } %>

      <div class="mybooking-product_filter-btn-group">
        <span class="mybooking-product_filter-legend"><?php echo esc_html_x( 'Order', 'renting_choose_product', 'mybooking-wp-plugin') ?></span>
        <span class="mybooking-product_filter-btn grid js-mb-grid" title="Grid view"><i class="mb-button icon"><span class="dashicons dashicons-grid-view"></span></i></span>
        <span class="mybooking-product_filter-btn list js-mb-list" title="List view"><i class="mb-button icon"><span class="dashicons dashicons-list-view"></span></i></span>
      </div>
    </div>

    <!-- // Product list -->
      <% for ( var idxP=0;idxP<products.length;idxP++ ) { %>
        <% if (idxP % 3 == 0 && idxP > 0) { %>

        <% } %>
        <% var product = products[idxP]; %>
        <div class="mybooking-product_column">
          <div class="mybooking-product">

            <!-- // Product image block -->
            <div class="mybooking-product_block">
              <div class="mybooking-product_image-container">

                <!-- // Image -->
                <% if ( product.photo_url ) { %>
                  <img class="mybooking-product_image" src="<%=product.photo_url%>" alt="<%=product.name%>"
                      data-product="<%=product.id%>">
                <% } %>

                <!-- // Info icon -->
                <i class="mybooking-product_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
                  <span class="dashicons dashicons-info"></span>
                </i>
              </div>
            </div>

            <!-- // Product content block -->
            <div class="mybooking-product_block">

              <div class="mybooking-product_header">
                <div class="mybooking-product_price">
                  <div class="mybooking-product_amount">
                    <%= configuration.formatCurrency( product.price )%>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <p class="card-text text-center text-muted"><%=product.name%></p>
                <!-- Price -->
                <h3 class="text-center mt-5 mb-2">
                   <%= configuration.formatCurrency( product.price )%>
                </h3>
              </div>
              <div class="card-body mt-3">
                <button class="btn btn-primary btn-choose-product w-100" data-product="<%=product.id%>"><?php echo _x( 'Book it!', 'transfer_choose_vehicle', 'mybooking-wp-plugin') ?></button>
              </div>
            </div>
          </div>
        </div>
      <% } %>
    </div>

</script>
