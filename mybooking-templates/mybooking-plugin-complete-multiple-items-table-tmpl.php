<% for (var idx=0;idx<shopping_cart.items.length;idx++) { %>
	<div class="mybooking-products_table">
		<div class="mb-row">
			<div class="mb-col-sm-12 mb-col-md-2"></div>
			<div class="mb-col-sm-12 mb-col-md-4"></div>
			<div class="mb-col-sm-12 mb-col-md-2">
				<span class="mybooking-summary_extra-name">
					<?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
				</span>
			</div>
			<div class="mb-col-sm-12 mb-col-md-2">
				<span class="mybooking-summary_extra-name">
					<?php echo esc_html_x( "Guarantee", 'renting_summary', 'mybooking-wp-plugin' ) ?>
				</span>
			</div>
			<div class="mb-col-sm-12 mb-col-md-2">
				<span class="mybooking-summary_extra-name">
					<?php echo esc_html_x( "Price", 'renting_summary', 'mybooking-wp-plugin' ) ?>
				</span>
			</div>
		</div>
		<div class="mb-row">
			<!-- // Product photo -->
			<div class="mb-col-sm-12 mb-col-md-2">
				<% if (shopping_cart.items[idx].photo_full && shopping_cart.items[idx].photo_full !== '') { %>
					<img class="mybooking-product_image" src="<%=shopping_cart.items[idx].photo_full%>"/>
				<% } else { %>
					<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
				<% } %>
			</div>
		
			<!-- // Product name and description -->
			<div class="mb-col-sm-12 mb-col-md-4">
				<div class="mybooking-product_name">
					<%=shopping_cart.items[idx].item_description_customer_translation%>
				</div>

				<div class="mybooking-product_description">
					<%=shopping_cart.items[idx].item_description_customer_translation%>
				</div>
			</div>

			<!-- Product deposit -->
			<div class="mb-col-sm-12 mb-col-md-2">
				<% if ( shopping_cart.items[idx].product_deposit_cost > 0 ) { %>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(shopping_cart.items[idx].product_deposit_cost)%>
						<% if ( shopping_cart.items[idx].product_deposit_reduction_amount > 0 ) { %>
							<br />
							- <%=configuration.formatCurrency(shopping_cart.items[idx].product_deposit_reduction_amount)%>
						<% } %>
					</span>
				<% } %>
			</div>

			<!-- Product guarantee -->
			<div class="mb-col-sm-12 mb-col-md-2">
				<% if ( shopping_cart.items[idx].product_guarantee_cost > 0 ) { %>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(shopping_cart.items[idx].product_guarantee_cost)%>
						<% if ( shopping_cart.items[idx].product_guarantee_reduction_amount > 0 ) { %>
							<br />
							- <%=configuration.formatCurrency(shopping_cart.items[idx].product_guarantee_reduction_amount)%>
						<% } %>
					</span>
				<% } %>
			</div>

			<!-- // Price box -->
			<div class="mb-col-sm-12 mb-col-md-2">
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
							<!-- // Quantity -->
							<span class="mybooking-product_quantity">
								<%=configuration.formatCurrency(shopping_cart.items[idx].item_unit_cost)%>
								x
								<%=shopping_cart.items[idx].quantity%>
							</span>

							<!-- // Amount -->
							<div class="mybooking-product_amount">
								<%=configuration.formatCurrency(shopping_cart.items[idx].item_cost)%>
							</div>
						</div>
					</div>
				<% } %>
			</div>
		</div>
	</div>
<% } %>