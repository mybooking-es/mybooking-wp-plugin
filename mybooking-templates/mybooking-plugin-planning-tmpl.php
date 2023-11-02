<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->
<script type="text/tmpl" id="script_product_modal">
  <div class="mybooking-modal_product-detail mb-row">
    <% if (product.photos && product.photos.length > 0) { %>
      <div class="mybooking-modal_product-container <% if (!product.description || product.description.replace(/<p><br><\/p>/g, '') === '') { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-8<% } %>">
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
      <div class="mybooking-modal_product-description  <% if (!product.photos || product.photos.length === 0) { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-4<% } %>">
      <h3 class="mybooking-product_short-description"><%=product.short_description%></h3>
      <div class="mybooking-product_description">
        <%=product.description%>
      </div>
      <div class="mybooking-product_description-overlay"></div>
      </div>
    <% } %>
  </div>
</script>