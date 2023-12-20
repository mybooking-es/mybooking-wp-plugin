<?php
/**
 *   MYBOOKING ENGINE - PLANNING component TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the planning component
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-planning-tmpl.php
 * 
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<!-- PRODUCT DETAIL MODAL ----------------------------------------------------->
<script type="text/tmpl" id="script_product_modal">
  <div class="mybooking-modal_product-detail mb-row">
    <% if (product.photos && product.photos.length > 0) { %>
      <div class="mybooking-modal_product-container <% if (!product.description || product.description.replace(/<p><br><\/p>/g, '') === '') { %>mb-col-md-12<% } else { %>mb-col-sm-12 mb-col-md-6 mb-col-lg-8<% } %>">
        <div id="mybooking-modal_product-gallery" class="mybooking-modal_product-gallery">
          <div class="mybooking-carousel-inner">
            <% for (var idx=0; idx<product.photos.length; idx++) { %>
              <div class="mybooking-carousel-item">
                <img class="mybooking-carousel_item-image" src="<%=product.photos[idx].full_photo_path%>" alt="<%=product.name%>">
              </div>
            <% } %>
          </div>
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