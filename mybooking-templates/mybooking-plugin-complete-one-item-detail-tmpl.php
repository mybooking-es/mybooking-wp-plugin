<% for (var idx=0;idx<shopping_cart.items.length;idx++) { %>
	<div class="mybooking-product_info-block mb-card">
		<div class="mb-col-md-12">
			<% if (shopping_cart.items[idx].photo_full && shopping_cart.items[idx].photo_full !== '') { %>
				<!-- // Product photo -->
				<img class="mybooking-product_image" src="<%=shopping_cart.items[idx].photo_full%>"/>
			<% } else { %>
				<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
			<% } %>  

			<!-- // Product name -->
			<div class="mybooking-product_name">
				<%=shopping_cart.items[idx].item_description_customer_translation%>
			</div>

			<!-- Optional external driver + driving license -->
			<% if ((typeof shopping_cart.optional_external_driver !== '' &&
							shopping_cart.optional_external_driver) ||
							(typeof shopping_cart.item_driving_license_type_name !== '' &&
							shopping_cart.item_driving_license_type_name) ) { %>   
				<% if (typeof shopping_cart.optional_external_driver !== '' &&
								shopping_cart.optional_external_driver) { %>
						<span class="mb-badge secondary"><%=shopping_cart.optional_external_driver%></span>    
				<% } %>
				<% if (typeof shopping_cart.item_driving_license_type_name !== '' &&
								shopping_cart.item_driving_license_type_name) { %>
						<span class="mb-badge secondary"><%=shopping_cart.item_driving_license_type_name%></span>    
				<% } %>
			<% } %>

			<!-- // Product description -->
			<div class="mybooking-product_description">
				<%=shopping_cart.items[idx].item_description_customer_translation%>
			</div>
		</div>

		<!-- // Price box -->
		<% if (!configuration.hidePriceIfZero || shopping_cart.item_cost > 0) { %>
			<div class="mybooking-summary_price">
				<div>
					<!-- Discount -->
					<div class="mybooking-product_discount">
						<% if (shopping_cart.items[idx].item_unit_cost_base != shopping_cart.items[idx].item_unit_cost) { %>
							<div class="mybooking-product_price">
								<% if (shopping_cart.items[idx].item_unit_cost_base != shopping_cart.items[idx].item_unit_cost) { %>
									<!-- // Original price -->
									<span class="mybooking-product_original-price">
										<%=configuration.formatCurrency(shopping_cart.items[idx].item_unit_cost_base * shopping_cart.items[idx].quantity)%>
									</span>
								<% } %>

								<!-- // Offer -->
								<% if (typeof shopping_cart.items[idx].offer_name !== 'undefined' && shopping_cart.items[idx].offer_name !== null && shopping_cart.items[idx].offer_name !== '') { %>
									<span class="mybooking-product_discount-badge mb-badge info">
										<% if (shopping_cart.items[idx].offer_discount_type === 'percentage' && shopping_cart.items[idx].offer_value !== '') {%>
											<%=parseInt(shopping_cart.items[idx].offer_value)%>&#37;
										<% } %>
										<%=shopping_cart.items[idx].offer_name%>
									</span>
								<% } %>
							</div>
						<% } %>
					</div>

					<!-- // Taxes -->
					<?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
						<div class="mybooking-product_taxes">
							<?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- // Price -->
				<div class="mybooking-product_price">
					<!-- // Amount -->
					<div class="mybooking-product_amount">
						<%=configuration.formatCurrency(shopping_cart.items[idx].item_cost)%>
					</div>
				</div>
			</div>
		<% } %>
	</div>
<% } %>