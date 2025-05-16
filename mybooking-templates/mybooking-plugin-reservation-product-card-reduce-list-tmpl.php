<?php
/**
 *   MYBOOKING ENGINE - Choose product card list single rates  TEMPLATE
 *   ---------------------------------------------------------------------------
 *   The Template for showing the planning component
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-product-card-list-tmpl.php
 * 
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tpml" id="script_detailed_product">
<div class="mybooking-product_container mybooking-product_reduce_list">
  <% if (products.length > 0) { %>
    <% for (var idx=0;idx<products.length; idx++) { %>
      <% var product = products[idx]; %>
      <div class="mybooking-product_column">
        <div class="mybooking-product">
					<div class="mybooking-product_body">
						<!-- // Few units warning -->
						<% if (product.few_available_units) { %>
							<span class="mybooking-product_low-availability">
								<?php echo esc_html_x( 'Few units left!', 'renting_choose_product', 'mybooking-reservation-engine') ?>
							</span>
						<% } %>

						<div class="mybooking-product_block mybooking-product_block-image">
							<% if (product.full_photo && product.full_photo !== '') { %>
								<img class="mybooking-product_image" src="<%=product.full_photo%>">
							<% } else { %>
								<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
							<% } %>

							<% if (product.highlight_message && product.highlight_message != '') { %>
								<div class="mybooking-product_custom-message"><%=product.highlight_message%></div>
							<% } %>
						</div>

						<div class="mybooking-product_block mybooking-product_block-info">
							<!-- // Product short description -->
							<% if (product.short_description != '') { %>
								<h3 class="mybooking-product_short-description"><%=product.short_description%></h3>
							<% } %>
							<% if ((product.rate_type && product.rate_type.description && product.rate_type.description  != '') || (product.description && product.description != '')) { %>
								<div class="mybooking-product_includes">
									<% if (product.description && product.description != '') { %>
										<div class="mybooking-product_description">
											<div>
												<%=product.description%>
											</div>
										</div>
									<% } %>
									<% if (product.rate_type && product.rate_type.description && product.rate_type.description != '') { %>
										<div class="mybooking-product_rate_type_description">
											<%=product.rate_type.description%>
										</div>
									<% } %>
									<div class="mybooking-product_includes-overlay"></div>
								</div>
							<% } %>
							<div class="mybooking-product_excess_usage">
									<% if (new Number(product.guarantee) > 0) { %>
										<div class="mb-col-md-6">
											<small>
												<span class="mybooking-process_excess_concept"><%= configuration.guaranteeLiteral %>:</span>
												<%=configuration.formatCurrency(product.guarantee)%>
											</small>
										</div>
									<% } %>
									<% if (new Number(product.deposit) > 0 || configuration.holdProductDepositCost === 'not_hold') { %>
										<div class="mb-col-md-6">
											<small>
												<span class="mybooking-process_excess_concept"><%=configuration.depositLiteral%>:</span> 
												<%=configuration.formatCurrency(product.deposit)%>
											</small>
										</div>
									<% } %>
									<% if (new Number(product.usage_included) > 0) { %>
										<div class="mb-col-md-6">			
											<small>
												<span class="mybooking-process_excess_concept"><?php echo esc_html_x( 'Daily Km', 'renting_choose_product', 'mybooking-reservation-engine') ?>:</span>  
												<%= new Number(product.usage_included).toFixed(0) %>Km
											</small>
										</div>
										<div class="mb-col-md-6">										
											<small>
											<span class="mybooking-process_excess_concept"><?php echo esc_html_x( 'Extra Km', 'renting_choose_product', 'mybooking-reservation-engine') ?>:</span> 
												<%=configuration.formatCurrency(product.usage_extra_unit_cost)%>
											</small>
										</div>
									<% } %>
							</div>
							<% if (product.category_supplement_1_cost > 0) { %>
								<div class="mybooking-product_price_supplement p-b-1">
									<div class="mybooking-product_price_supplement_price">
										<small><b><%=configuration.formatCurrency(product.price)%></b>&nbsp;<?php echo esc_html( MyBookingEngineContext::getInstance()->getProduct() )?></small>
									</div>

									<div class="mybooking-product_price_supplement_supplement_1">
										<small><b><%=configuration.formatCurrency(product.category_supplement_1_cost)%></b>&nbsp;<?php echo esc_html_x( "Petrol supplement", 'renting_complete', 'mybooking-reservation-engine' ) ?></small>
									</div>
								</div>
							<% } %>
						</div>

						<div class="mybooking-product_block mybooking-product_block-prices">
							<% if (!configuration.multipleProductsSelection) { %>
                <% if (!configuration.hidePriceIfZero || +product.price > 0) { %>
									<div class="mybooking-product_price">
										<!-- // Price (single product selection) -->
										<% if (!product.exceeds_max && !product.be_less_than_min) { %>
											<% if (!configuration.multipleProductsSelection && (product.availability || !configuration.hidePriceIfNotAvailable)) { %>
												
												<% if (product.price != product.base_price) { %>
													<div class="mybooking-product_original-price">
														<%= configuration.formatCurrency(product.base_price)%>
													</div>
													<!-- // Offer (single product selection) -->
													<span class="mybooking-product_discount">
														<% if (product.offer_discount_type == 'percentage' || product.offer_discount_type == 'amount') { %>
															<span class="mybooking-product_discount-badge mb-badge info">
															<% if (product.offer_discount_type == 'percentage') { %><%=new Number(product.offer_value) %> %<% } else { %><%=configuration.formatCurrency(product.offer_value) %><% } %> <%=product.offer_name%></span>
														<% } %>
														<% if (typeof shoppingCart.promotion_code !== 'undefined' && shoppingCart.promotion_code !== null && shoppingCart.promotion_code !== '' && (product.promotion_code_discount_type == 'percentage' || product.promotion_code_discount_type == 'amount') ) { %>
															<span class="mybooking-product_discount-badge mb-badge success"><% if (product.promotion_code_discount_type == 'percentage') { %><%=new Number(product.promotion_code_value)%> % <% } else { %><%=configuration.formatCurrency(product.promotion_code_value)%><% } %> <%=shoppingCart.promotion_code%></span>
														<% } %>
													</span>
												<% } %>					

												<div class="mybooking-product_amount">
													<%=configuration.formatCurrency(+product.price +
														(+product.category_supplement_1_cost || 0) +
														(+product.category_supplement_2_cost || 0) +
														(+product.category_supplement_3_cost || 0))
													%>
												</div>

												<br>
												
												<div class="mybooking-product_daily_amount">
													<%=configuration.formatCurrency(+product.unit_price) %>
													<% if (product.price_units === 'days') { %>
														/ <?php echo esc_html( MyBookingEngineContext::getInstance()->getDurationSingular() ) ?>
													<% } %>
												</div>

												<!-- // Taxes included -->
												<?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
													<span class="mybooking-product_taxes">
														<?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-reservation-engine') ?>
													</span>
												<?php endif; ?>

											<% } %>
										<% } %>
									</div>
                <% } %>
              <% } %>

							<!-- // Exceeds max duration -->
              <% if (product.exceeds_max) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.max_duration', {duration: i18next.t('common.'+product.price_units, {count: product.max_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
							
              <!-- // Less than min duration -->
              <% } else if (product.be_less_than_min) { %>
                <span class="mb-badge danger"><%= i18next.t('chooseProduct.min_duration', {duration: i18next.t('common.'+product.price_units, {count: product.min_value, interpolation: {escapeValue: false}} ), interpolation: {escapeValue: false}}) %></span>
							
              <!-- // Available -->
              <% } else if (product.availability) { %>
                <% if (product.variants_enabled) { %>
                  <div class="product-variant-resume" data-product-code="<%=product.code%>"></div>
                  <!-- // Button -->
                  <button class="mb-button btn-choose-variant" data-toggle="modal" data-target="#modalVariantSelector" data-product="<%=product.code%>"><% if (configuration.multipleProductsSelection) { %><?php echo esc_html_x('Select units', 'renting_choose_product', 'mybooking-reservation-engine') ?><% } else { %><?php echo esc_html_x('Select options', 'renting_choose_product', 'mybooking-reservation-engine') ?><% } %></button>
                <% } else { %>
                  <% if (configuration.multipleProductsSelection) { %>
                    <!-- // Selector -->
                    <div class="car-listing-selector">
                      <select class="mybooking-product_select select-choose-product" data-value="<%=product.code%>">
                        <option value="0"><%=i18next.t('chooseProduct.selectUnits')%></option>
                        <% for (var idx2=1;idx2<=(product.available);idx2++) { %>
                        <option value="<%=idx2%>"
                          <% if (shoppingCartProductQuantities[product.code] && idx2 == shoppingCartProductQuantities[product.code]) { %>
                          selected="selected" <%}%>
                          ><%=i18next.t('chooseProduct.units', {count: idx2})%>
                          (<%= configuration.formatCurrency(product.price * idx2) %>) </option>
                        <% } %>
                      </select>
                    </div>
                  <% } else { %>
                    <!-- // Button -->
                    <button class="mb-button btn-choose-product" data-product="<%=product.code%>"><?php echo esc_html_x('Book it!', 'renting_choose_product', 'mybooking-reservation-engine') ?></button>
                  <% } %>
                <% } %>

              <!-- // Not available -->
              <% } else { %>
                <span class="mybooking-product_not-available">
                  <?php echo esc_html( MyBookingEngineContext::getInstance()->getNotAvailableMessage() ) ?>
                </span>
              <% } %>
						</div>
					</div>

					<div class="mybooking-product_footer">
						<div class="mybooking-product_footer_left">
							<div class="mybooking-product_names">
								<!-- // Name -->
								<h2 class="mybooking-product_name"><%=product.name%></h2>
							</div>

							<!-- // Characteristics -->
							<div class="mybooking-product_block_charateristics">
								<!-- // Key characteristics -->
								<% if (product.key_characteristics) { %>
									<div class="mybooking-product_characteristics">
									<% for (characteristic in product.key_characteristics) { %>
										<div class="mybooking-product_characteristics-item">
											<% var characteristic_image_path = '<?php echo esc_url( mybooking_engine_get_characteristics_icons_url() ); ?>'+characteristic+'.svg'; %>
											<img class="mybooking-product_characteristics-img" src="<%=characteristic_image_path%>" />
											<span class="mybooking-product_characteristics-key"><%=product.key_characteristics[characteristic]%> 
											  <% if (characteristic === 'load') { %>Kg<% } %>
												<% if (characteristic === 'capacity') { %>m<sup>3</sup><% } %>
											</span>
										</div>
									<% } %>
									</div>
								<% } %>

								<!-- // Textual characteristics -->
								<% if ((product.characteristic_length && product.characteristic_length != 0) ||
									(product.characteristic_width && product.characteristic_width != 0) ||
									(product.characteristic_height && product.characteristic_height != 0) || 
									(product.optional_external_driver && product.optional_external_driver != '')) { %>
									<div class="mybooking-product_characteristics-nautical">                  
										<div class="mybooking-product_characteristics-text">
											<!-- Length Eslora -->
											<% if (product.characteristic_length && product.characteristic_length != 0) { %>
												<span class="mybooking-product_characteristics-text-item">
													<small><?php echo esc_html( MyBookingEngineContext::getInstance()->getLength() ) ?> <%=product.characteristic_length%> m.</small>
												</span>
											<% } %>
											<!-- Width Manga -->
											<% if (product.characteristic_width && product.characteristic_width != 0) { %>
												<span class="mybooking-product_characteristics-text-item"><small><?php echo esc_html( MyBookingEngineContext::getInstance()->getWidth() ) ?> <%=product.characteristic_width%> m.</small></span>
											<% } %>
											<!-- Height Calado -->
											<% if (product.characteristic_height && product.characteristic_height != 0) { %>
												<span class="mybooking-product_characteristics-text-item"><small><?php echo esc_html( MyBookingEngineContext::getInstance()->getHeight() ) ?> <%=product.characteristic_height%> m.</small></span>
											<% } %>
											</div>
											<div class="mybooking-product_characteristics-text">
											<!-- Optional external driver (skipper) -->
											<% if (product.optional_external_driver && product.optional_external_driver !== '') { %>
												<span class="mybooking-product_characteristics-text-item mb-badge secondary">
													<%=product.optional_external_driver_name%>
											</span>
											&nbsp;
											<% } %>
											<!-- Driving license -->
											<% if (product.optional_external_driver && product.optional_external_driver !== 'required' && 
														product.driving_license_type_name && product.driving_license_type_name !== '') { %>
												<span class="mybooking-product_characteristics-text-item mb-badge secondary">
													<%=product.driving_license_type_name%>
												</span>
											<% } %>
										</div>
									</div>
								<% } %>
							</div>
						</div>

						<!-- // Info button -->
						<% if (product.description && product.description.replace(/<p><br><\/p>/g, '') !== '' || product.photos && product.photos.length > 0) { %>
							<span class="mybooking-product_info-button js-product-info-btn" data-toggle="modal" data-target="#infoModal" data-product="<%=product.code%>">
								<span class="dashicons dashicons-plus-alt"></span> INFO
							</span>
						<% } %>
					</div>
				</div>
      </div>
    <% } %>
  <% } else { %>
    <div class="mb-alert light">
      <?php echo esc_html_x( 'No items found', 'renting_choose_product', 'mybooking-reservation-engine') ?>
    </div>
  <% } %>
</div>
</script>
