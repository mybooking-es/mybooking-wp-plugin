<?php
/**
 *   MYBOOKING ENGINE - CHOOSE TRANSFER TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-transfer-choose-vehicle-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<!-- RESERVATION SUMMARY ------------------------------------------------------>
<?php mybooking_engine_get_template('mybooking-plugin-transfer-reservation-summary-tmpl.php', $args); ?>

<!-- PRODUCT LOOP ------------------------------------------------------------->

<script type="text/tmpl" id="script_transfer_detailed_product">

  <!-- // Product filter -->

  <div class="mybooking-product_filter">

    <% if (available > 0) { %>
      <div class="mybooking-product_results-found">
        <%=i18next.t('transfer.chooseVehicle.vehicleFound', {available: available})%>
      </div>
    <% } else { %>
      <div class="mybooking-product_results-found">
        <%=i18next.t('transfer.chooseVehicle.vehicleNotFound')%>
      </div>
    <% } %>

    <!-- // Here will be the product switch view component -->
  </div>

  <div class="mybooking-product_container mybooking-product_grid">

    <!-- // Product list -->

    <% for ( var idxP=0;idxP<products.length;idxP++ ) { %>
      <% var product = products[idxP]; %>
      <div class="mybooking-product_column">
        <div class="mybooking-product">

          <!-- // Product image block -->
          <div class="mybooking-product_block">
            <div class="mybooking-product_image-container">

              <!-- // Image -->
              <% if ( product.photo_url ) { %>
                <img class="mybooking-product_image" src="<%=product.photo_url%>" alt="<%=product.name%>" data-product="<%=product.id%>">
              <% } %>
            </div>
          </div>

          <!-- // Product content block -->
          <div class="mybooking-product_block">

            <!-- // Header -->
            <div class="mybooking-product_header">
              <div class="mybooking-product_price">
                <div class="mybooking-product_amount">
                  <%= configuration.formatCurrency( product.price )%>
                </div>
              </div>
            </div>

            <!-- // Product description -->
            <div class="mybooking-product_body">

              <!-- // Product name and description -->
              <h2 class="mybooking-product_name">
                <%=product.name%>
              </h2>
              <h3 class="mybooking-product_short-description">
                <%=product.short_description%>
              </h3>
              <div class="mybooking-product_description">
                <%=product.description%>
              </div>
            </div>

            <!-- // Product footer -->
            <div class="mybooking-product_footer">

              <!-- // Button -->
              <button class="mb-button btn-choose-product" data-product="<%=product.id%>">
                <?php echo esc_html_x( 'Book it!', 'transfer_choose_product', 'mybooking-wp-plugin' ) ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    <% } %>
  </div>

</script>
