<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->
<script type="text/tmpl" id="script_product_modal">
  <div class="mybooking-modal_product-detail">
    <div class="mybooking-modal_product-container">
      <div class="mybooking-carousel-inner">
        <% for (var idx=0; idx<product.photos.length; idx++) { %>
          <div class="mybooking-carousel-item">
            <img class="mybooking-carousel_item-image" src="<%=product.photos[idx].full_photo_path%>" alt="<%=product.name%>">
          </div>
        <% } %>
      </div>
    </div>
    <div class="mybooking-modal_product-description" style="display: none">
      <%=product.description%>
    </div>
  </div>
  <div class="mybooking-modal_product-actions">
    <button id="modal_product_photos"><?php echo esc_html_x( "Photos", 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
    <button id="modal_product_info"><?php echo esc_html_x( "Info", 'renting_choose_product', 'mybooking-wp-plugin') ?></button>
  </div>
</script>