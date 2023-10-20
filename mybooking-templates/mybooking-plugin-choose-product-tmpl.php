<?php
/**
 *   MYBOOKING ENGINE - CHOOSE PRODUCT TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-choose-product-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>


<!-- RESERVATION SUMMARY ------------------------------------------------------>

<?php mybooking_engine_get_template('mybooking-plugin-reservation-summary-tmpl.php', $args); ?>


<!-- PRODUCT LOOP ------------------------------------------------------------->

<?php 
  if ( array_key_exists('choose_product_layout', $args) && ( in_array( $args['choose_product_layout'], ['list', 'list_only'] ) ) ):
      mybooking_engine_get_template('mybooking-plugin-reservation-product-card-list-tmpl.php', $args); 
  else: 
      mybooking_engine_get_template('mybooking-plugin-reservation-product-card-grid-tmpl.php', $args);
  endif;
?>


<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->

<script type="text/tmpl" id="script_product_modal">
  <div class="mybooking-modal_product-detail mb-row">

    <% if (product.photos && product.photos.length > 0) { %>
      <div class="mybooking-modal_product-container <% if (!product.description || product.description.replace(/<p><br><\/p>/g, '') === '') { %>mb-col-md-12<% } else { %>mb-col-md-8<% } %>">
        <div id="mybooking-modal_product-gallery" class="mybooking-modal_product-gallery">
          <% if (product.video_source && product.video_source !== '' &&  product.video_url && product.video_url !== '' && product.video_source == 'youtube') { %>
            <span class="js-product-toogle-video" data-target="video">
              <?php echo esc_html_x( 'Show video', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </span>
            <span class="js-product-toogle-video" data-target="image" style="display: none">
              <?php echo esc_html_x( 'Show gallery', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </span>
          <% } %>
          <br />
          <div class="mybooking-carousel-inner">
            <% for (var idx=0; idx<product.photos.length; idx++) { %>
              <div class="mybooking-carousel-item">
                <img class="mybooking-carousel_item-image" src="<%=product.photos[idx].full_photo_path%>" alt="<%=product.name%>">
              </div>
            <% } %>
          </div>
          <div id="mybooking_transfer_product_detail_video"></div>
        </div>
      </div>
    <% } %>

    <% if (product.description && product.description.replace(/<p><br><\/p>/g, '') !== '') { %>
      <div class="mybooking-modal_product-info  <% if (!product.photos && product.photos.length === 0) { %>mb-col-md-12<% } else { %>mb-col-md-4<% } %>">
        <h2 class="mybooking-product_name"><%=product.name%></h2>
        <h3 class="mybooking-product_short-description"><%=product.short_description%></h3>
        <div class="mybooking-product_description">
          <%=product.description%>
        </div>
        <div class="mybooking-product_description-overlay"></div>
      </div>
    <% } %>
    
  </div>
</script>

<!-- Script that shows the product variant selection -->   
<script type="text/tpml" id="script_variant_product_resume">
  <div class="card-static_variant_resume__container">
    <div class="card-static_variant_resume__container_inside">
      <% for (var idxV=0;idxV<variantsSelected.length;idxV++) { %>
        <div class="card-static_variant_resume__box"><span class="card-static_variant_resume__box_inside"><%= variantsSelected[idxV]['quantity'] %></span> <span class="card-static_variant_resume__box_inside"><%= variantsSelected[idxV]['name'] %></span></div>
      <% } %>
    </div>
    <% if (total > 0) { %>
    <strong><span class="float-right"><%=configuration.formatCurrency(total)%></span></strong>
    <% } %>
  </div>
</script>

<script type="text/tpml" id="script_variant_product">
  <form name="variant_product_form">
    <div id="variant_product_selectors" class="mb-row">
      <% if (!configuration.multipleProductsSelection) { %>
        <div class="mb-form-group mb-col-sm-12">
          <select name="<%= product.code %>" id="<%= product.code %>" class="form-control variant_product_selector">
            <option value="0"><?php echo esc_html_x( 'Select', 'renting_choose_product', 'mybooking-wp-plugin') ?></option>
            <% for (var idxV=0;idxV<variants.length;idxV++) { %>
              <% var variant = variants[idxV]; %>
              <option value="<%= variant.code %>" <% if  (variantsSelected[variant.code]) { %>selected<% } %>><%= variant.variant_name %> - <%=configuration.formatCurrency(variant.price)%></option>
            <% } %>
          </select>
        </div>
      <% } else { %>
        <% for (var idxV=0;idxV<variants.length;idxV++) { %>
          <% var variant = variants[idxV]; %>
          <div class="mb-form-group mb-col-sm-12 mb-col-md-4">
            <label for="<%= variant.code %>">
              <%= variant.variant_name %>
            </label>
            <select name="<%= variant.code %>" id="<%= variant.code %>" <% if  (variant.available < 1) { %>disabled<% } %> class="form-control variant_product_selector">
              <option value="0"><?php echo esc_html_x( 'Select units', 'renting_choose_product', 'mybooking-wp-plugin') ?></option>
              <% for (var idxVO=1;idxVO<=variant.available;idxVO++) { %>
                <option value="<%= idxVO %>"  <% if  (variantsSelected[variant.code] && variantsSelected[variant.code] === idxVO) { %>selected<% } %>><%= idxVO %> <% if  (idxVO > 1) { %><?php echo esc_html_x( 'units', 'renting_choose_product', 'mybooking-wp-plugin') ?><% } else { %><?php echo esc_html_x( 'unit', 'renting_choose_product', 'mybooking-wp-plugin') ?><% } %> - <%=configuration.formatCurrency(variant.price * idxVO)%></option>
              <% } %>
              </select>
          </div>
        <% } %>
      <% } %>
    </div>
    <div class="mb-row">
      <div class="mb-col-sm-10">
        <h4>Total</h4>
      </div>
      <div class="mb-col-sm-2">
        <h4 id="variant_product_total">
          <span id="variant_product_total_quantity"> <%=configuration.formatCurrency(total)%></span>
        </h4>
      </div>
    </div>
  </form>
</script>

<!-- PRODUCT DETAIL MODAL VIDEO ----------------------------------------------------->

  <!-- Video template -->
  <script type="text/tmpl" id="script_transfer_product_detail_video">
    <% if (product.video_source && product.video_source !== '' &&  product.video_url && product.video_url !== '' && product.video_source == 'youtube') { %>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/<%= product.video_url %>" title="<%= product.name %>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="mybooking-video-inner"></iframe>
    <% } %>
  </script>

