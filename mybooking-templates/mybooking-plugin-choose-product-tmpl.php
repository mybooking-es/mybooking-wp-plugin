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
  if ( array_key_exists('choose_product_layout', $args) && ( in_array( $args['choose_product_layout'], ['list', 'list_only'] ) ) ) {
      mybooking_engine_get_template('mybooking-plugin-reservation-product-card-list-tmpl.php', $args); 
  } else if ( array_key_exists('choose_product_layout', $args) && ( in_array( $args['choose_product_layout'], ['reduce_list_only'] ) ) ) {
      mybooking_engine_get_template('mybooking-plugin-reservation-product-card-reduce-list-tmpl.php', $args);
  } else {
      mybooking_engine_get_template('mybooking-plugin-reservation-product-card-grid-tmpl.php', $args);
  }

  mybooking_engine_get_template('mybooking-plugin-reservation-product-card-list-multiple-rate-type-tmpl.php', $args);
?>


<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->

<script type="text/tmpl" id="script_product_modal">
  <div class="mybooking-modal_product-detail mb-row">

    <% if (product.photos && product.photos.length > 0) { %>
      <div class="mybooking-modal_product-container <% if (!product.description || product.description.replace(/<p><br><\/p>/g, '') === '') { %>mb-col-md-12<% } else { %>>mb-col-sm-12 mb-col-md-6 mb-col-lg-8<% } %>">
        <div id="mybooking-modal_product-gallery" class="mybooking-modal_product-gallery">
          <% if (product.video_source && product.video_source !== '' &&  product.video_url && product.video_url !== '' && product.video_source == 'youtube') { %>
            <span class="js-product-toogle-video product-toogle-video-btn" data-target="video">
              <?php echo esc_html_x( 'Show video', 'renting_choose_product', 'mybooking-wp-plugin') ?>
            </span>
            <span class="js-product-toogle-video product-toogle-video-btn" data-target="image" style="display: none">
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
      <div class="mybooking-modal_product-info  <% if (!product.photos || product.photos.length === 0) { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-4<% } %>">
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
      <div class="mb-col-md-9">
        <h4>Total</h4>
      </div>
      <div class="mb-col-md-3 text-right">
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
    <div class="mb-video-responsive">
      <iframe src="https://www.youtube.com/embed/<%= product.video_url %>" title="<%= product.name %>" frameborder="0" allowfullscreen class="mybooking-video-inner"></iframe>
    </div>
  <% } %>
</script>

<!-- FILTER TEMPLATES AND MODAL ----------------------------------------------------->
<script type="text/tpml" id="script_choose_product_filter_bar_content">
  <div id="mybooking_choose_product_filter_bar" class="mybooking-chose-product-filter-container">
    <form name="mybooking_choose_product_filter_bar_form" class="mybooking-chose-product-filter-form" novalidate>
      <ul class="mybooking-chose-product-filter">
        <% if (filters.families && filters.families.length > 1) { %>
          <li class="mybooking-chose-product-filter-item_section_toogle mybooking-chose-product-filter-item_section">
            <div class="mybooking-chose-product-filter-item_section-btn">
              <?php echo MyBookingEngineContext::getInstance()->getFamily() ?>
              &nbsp;
              <i class="dashicons dashicons-arrow-down"></i>
            </div>
            <ul class="mybooking-chose-product-filter-item_panel" style="display: none;">
              <% for (var idx=0; idx<filters.families.length; idx++) { %>
                <li data-filter="family_id" data-label>
                  <label class="mybooking-chose-product-filter-item_label" data-tree-parent="true">  
                    <input type="checkbox" name="family_id" value="<%= filters.families[idx].id %>"
                      <% if (model.family_id && model.family_id.indexOf(filters.families[idx].id) !== -1) { %>checked<% } %> />
                    <span><%= filters.families[idx].name %></span>
                  </label>
                  <% if (filters.families[idx].children && filters.families[idx].children.length > 1) { %>
                    <ul>
                      <% for (var idxB=0; idxB<filters.families[idx].children.length; idxB++) { %>
                        <li data-filter="family_id">
                          <label class="mybooking-chose-product-filter-item_label">
                            <input type="checkbox" name="family_id" value="<%= filters.families[idx].children[idxB].id %>"  
                              <% if (model.family_id && ( model.family_id.indexOf(filters.families[idx].id) !== -1 || model.family_id.indexOf(filters.families[idx].children[idxB].id) !== -1)) { %>checked<% } %> />
                            <span><%= filters.families[idx].children[idxB].name %></span>
                          </label>
                        </li>
                      <% } %>
                    </ul>
                  <% } %>
                </li>
              <% } %>
            </ul>
          </li>
        <% } %>
        <% if (filters.otherFilters.key_characteristics && filters.otherFilters.key_characteristics.length > 0) { %>
          <% for (var idxC=0; idxC<filters.otherFilters.key_characteristics.length; idxC++) { %>
            <% if (filters.otherFilters.key_characteristics[idxC].values && filters.otherFilters.key_characteristics[idxC].values.length > 1) { %>
              <li class="mybooking-chose-product-filter-item_section_toogle mybooking-chose-product-filter-item_section">
                <div class="mybooking-chose-product-filter-item_section-btn">
                  <%= filters.otherFilters.key_characteristics[idxC].name %>
                  &nbsp;
                  <i class="dashicons dashicons-arrow-down"></i>
                </div>
                <ul class="mybooking-chose-product-filter-item_panel" style="display: none;">
                  <% for (var idxD=0; idxD<filters.otherFilters.key_characteristics[idxC].values.length; idxD++) { %>
                    <li data-filter="other">
                      <label class="mybooking-chose-product-filter-item_label">
                        <% if (filters.otherFilters.key_characteristics[idxC].type === 'single_value' || filters.otherFilters.key_characteristics[idxC].type === 'range')  { %>
                          <input type="radio" name="<%= filters.otherFilters.key_characteristics[idxC].key %>" value="<%= filters.otherFilters.key_characteristics[idxC].values[idxD].value %>" 
                            <% if (model['key_characteristic_' + filters.otherFilters.key_characteristics[idxC].key] == filters.otherFilters.key_characteristics[idxC].values[idxD].value) { %>checked<% } %>  />
                        <% } else { %>
                          <input type="checkbox" name="<%= filters.otherFilters.key_characteristics[idxC].key %>" value="<%= filters.otherFilters.key_characteristics[idxC].values[idxD].value %>" 
                            <% if (model['key_characteristic_' + filters.otherFilters.key_characteristics[idxC].key] == filters.otherFilters.key_characteristics[idxC].values[idxD].value) { %>checked<% } %> />
                        <% } %>
                        <span>
                          <%= filters.otherFilters.key_characteristics[idxC].values[idxD].description %>
                          <% if (filters.otherFilters.key_characteristics[idxC].type === 'range')  { %>
                            +
                          <% } %>
                        </span>
                      </label>
                    </li>
                  <% } %>
                </ul>
              </li>
            <% } %>
          <% } %>
        <% } %>
      </ul>
      <% if ((filters.families && filters.families.length > 1) || (filters.otherFilters.key_characteristics && filters.otherFilters.key_characteristics.length > 0)) { %>
        <div class="mybooking-choose-product-filter-btns">
          <button id="mybooking_choose_product_filter_bar__send" type="submit" class="mybooking-choose-product-filter-btn"
            title="<?php echo esc_html_x( 'Filter', 'renting_choose_product', 'mybooking-wp-plugin') ?>">
            <i class="dashicons dashicons-filter"></i>
            <?php echo esc_html_x( 'Filter', 'renting_choose_product', 'mybooking-wp-plugin') ?>
          </button>
          <button  id="mybooking_choose_product_filter_bar__eraser" class="mybooking-choose-product-filter-btn"
          title="<?php echo esc_html_x( 'Eraser', 'renting_choose_product', 'mybooking-wp-plugin') ?>">
            <i class="dashicons dashicons-editor-removeformatting"></i>
          </button>
          <button id="mybooking_choose_product_filter__modal" class="mybooking-choose-product-filter-btn"
            title="<?php echo esc_html_x( 'More filters', 'renting_choose_product', 'mybooking-wp-plugin') ?>">
            <i class="dashicons dashicons-admin-settings"></i>
          </button>
        </div>
      <% } %>
    </form>
  </div>
</script>

<script type="text/tpml" id="script_choose_product_filter_modal_content">
  <div id="mybooking_choose_product_filter_modal" class="mybooking-chose-product-filter-container">
    <form name="mybooking_choose_product_filter_modal_form" class="mybooking-chose-product-filter-modal-form" novalidate>
      <ul class="mybooking-chose-product-filter-modal">
        <% if (filters.families && filters.families.length > 1) { %>
          <li class="mybooking-chose-product-filter-item_section mybooking-chose-product-filter-item">
            <span class="mybooking-chose-product-filter-item_title">
              <?php echo MyBookingEngineContext::getInstance()->getFamily() ?>
            </span>
            <ul class="mybooking-chose-product-filter-item_content">
              <% for (var idx=0; idx<filters.families.length; idx++) { %>
                <li data-filter="family_id" data-label>
                  <label class="mybooking-chose-product-filter-item_label" data-tree-parent="true">
                    <input type="checkbox" name="family_id" value="<%= filters.families[idx].id %>" 
                      <% if (model.family_id && model.family_id.indexOf(filters.families[idx].id) !== -1) { %>checked<% } %> />
                    <span><%= filters.families[idx].name %></span>
                  </label>
                  <% if (filters.families[idx].children && filters.families[idx].children.length > 1) { %>
                    <ul>
                      <% for (var idxB=0; idxB<filters.families[idx].children.length; idxB++) { %>
                        <li data-filter="family_id">
                          <label class="mybooking-chose-product-filter-item_label">
                            <input type="checkbox" name="family_id" value="<%= filters.families[idx].children[idxB].id %>" 
                              <% if (model.family_id && ( model.family_id.indexOf(filters.families[idx].id) !== -1 || model.family_id.indexOf(filters.families[idx].children[idxB].id) !== -1)) { %>checked<% } %> />
                            <span><%= filters.families[idx].children[idxB].name %></span>
                          </label>
                        </li>
                      <% } %>
                    </ul>
                  <% } %>
                </li>
              <% } %>
            </ul>
          </li>
        <% } %>

        <% if (filters.otherFilters.key_characteristics && filters.otherFilters.key_characteristics.length > 0) { %>
          <% for (var idxC=0; idxC<filters.otherFilters.key_characteristics.length; idxC++) { %>
            <% if (filters.otherFilters.key_characteristics[idxC].values && filters.otherFilters.key_characteristics[idxC].values.length > 1) { %>
              <li class="mybooking-chose-product-filter-item_section mybooking-chose-product-filter-item">
                <span class="mybooking-chose-product-filter-item_title">
                <%= filters.otherFilters.key_characteristics[idxC].name %>
                </span>
                <ul class="mybooking-chose-product-filter-item_content">
                  <% for (var idxD=0; idxD<filters.otherFilters.key_characteristics[idxC].values.length; idxD++) { %>
                    <li data-filter="other">
                      <label class="mybooking-chose-product-filter-item_label">
                        <% if (filters.otherFilters.key_characteristics[idxC].type === 'single_value' || filters.otherFilters.key_characteristics[idxC].type === 'range')  { %>
                          <input type="radio" name="<%= filters.otherFilters.key_characteristics[idxC].key %>" value="<%= filters.otherFilters.key_characteristics[idxC].values[idxD].value %>" 
                            <% if (model['key_characteristic_' + filters.otherFilters.key_characteristics[idxC].key] == filters.otherFilters.key_characteristics[idxC].values[idxD].value) { %>checked<% } %>  />
                        <% } else { %>
                          <input type="checkbox" name="<%= filters.otherFilters.key_characteristics[idxC].key %>" value="<%= filters.otherFilters.key_characteristics[idxC].values[idxD].value %>" 
                          <% if (model['key_characteristic_' + filters.otherFilters.key_characteristics[idxC].key] == filters.otherFilters.key_characteristics[idxC].values[idxD].value) { %>checked<% } %>  />
                        <% } %>
                        <span>
                          <%= filters.otherFilters.key_characteristics[idxC].values[idxD].description %>
                          <% if (filters.otherFilters.key_characteristics[idxC].type === 'range')  { %>
                            +
                          <% } %>
                        </span>
                      </label>
                    </li>
                  <% } %>
                </ul>
              </li>
            <% } %>
          <% } %>
        <% } %>
      </ul>
      <br />
      <div class="mybooking-choose-product-filter-btns">
        <button  id="mybooking_choose_product_filter_modal__eraser" class="mybooking-choose-product-filter-btn"
        title="<?php echo esc_html_x( 'Eraser', 'renting_choose_product', 'mybooking-wp-plugin') ?>">
          <i class="dashicons dashicons-editor-removeformatting"></i>
        </button>
        <button id="mybooking_choose_product_filter_modal__send" type="submit" class="mybooking-choose-product-filter-btn"
          title="<?php echo esc_html_x( 'Filter', 'renting_choose_product', 'mybooking-wp-plugin') ?>">
          <i class="dashicons dashicons-filter"></i>
          <?php echo esc_html_x( 'Filter', 'renting_choose_product', 'mybooking-wp-plugin') ?>
        </button>
      </div>
    </form>
  </div>
</script>

<!-- MODAL --------------------------------------------------------------------->
<div class="mybooking mybooking-detail_modal mybooking-modal modal-mybooking" tabindex="-1" role="dialog" id="mybooking_choose_product_filter_modal_MBM"  style="margin: 3rem 1rem;">
  <div class="mybooking-modal_body modal-product-detail-content"></div>
</div>

