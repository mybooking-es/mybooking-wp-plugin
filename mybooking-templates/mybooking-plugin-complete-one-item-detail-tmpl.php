<?php
/**
 *   MYBOOKING ENGINE - SINGLE ITEM SHOPPING CART 
 *   ---------------------------------------------------------------------------
 *   The Template for showing a section with the item - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-complete-one-item-detail-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% for (var idx=0;idx<booking.items.length;idx++) { %>
	<div class="mybooking-product_info-block mb-card">
		<div class="mb-col-md-12">
			<% if (booking.items[idx].photo_full && booking.items[idx].photo_full !== '') { %>
				<!-- // Product photo -->
				<img class="mybooking-product_image" src="<%=booking.items[idx].photo_full%>"/>
			<% } else { %>
				<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
			<% } %>  

			<!-- Product name -->
			<div class="mybooking-product_name">
				<% if (typeof booking.items[idx].item_performance_id !== 'undefined' && 
							 booking.items[idx].item_performance_id !== null) { %>
					<%=booking.items[idx].item_performance_description_customer_translation%>
				<% } else { %>		
					<%=booking.items[idx].item_description_customer_translation%>
				<% } %>
			</div>
			
			<% if (typeof booking.items[idx].item_rate_type_name !== 'undefined' && 
			       booking.items[idx].item_rate_type_name && booking.items[idx].item_rate_type_name !== '') { %>
        <!-- Product rate type -->
				<div class="mybooking-product_description">
					<%=booking.items[idx].item_rate_type_name%>
				</div>
			<% } %>
			
			<% if (typeof booking.items[idx].item_performance_id === 'undefined' || 
						 booking.items[idx].item_performance_id === null) { %>
				<!-- Optional external driver + driving license -->
				<% if ((typeof booking.optional_external_driver !== '' &&
								booking.optional_external_driver) ||
								(typeof booking.item_driving_license_type_name !== '' &&
								booking.item_driving_license_type_name) ) { %>   
					<% if (typeof booking.optional_external_driver !== '' &&
									booking.optional_external_driver) { %>
							<span class="mb-badge secondary"><%=booking.optional_external_driver%></span>    
					<% } %>
					<% if (typeof booking.item_driving_license_type_name !== '' &&
									booking.item_driving_license_type_name) { %>
							<span class="mb-badge secondary"><%=booking.item_driving_license_type_name%></span>    
					<% } %>
				<% } %>

				<!-- // Product description -->
				<div class="mybooking-product_description">
					<%=booking.items[idx].item_full_description_customer_translation%>
				</div>
			<% } %>

		</div>

		<!-- // Price box -->
		<% if (!configuration.hidePriceIfZero || booking.item_cost > 0) { %>
			<div class="mybooking-summary_price">
				<div>
					<!-- Discount -->
					<div class="mybooking-product_discount">
						<% if (booking.items[idx].item_unit_cost_base != booking.items[idx].item_unit_cost) { %>
							<div class="mybooking-product_price">
								<% if (booking.items[idx].item_unit_cost_base != booking.items[idx].item_unit_cost) { %>
									<!-- // Original price -->
									<span class="mybooking-product_original-price">
										<%=configuration.formatCurrency(booking.items[idx].item_unit_cost_base * booking.items[idx].quantity)%>
									</span>
								<% } %>

								<!-- // Offer -->
								<% if (typeof booking.items[idx].offer_name !== 'undefined' && booking.items[idx].offer_name !== null && booking.items[idx].offer_name !== '') { %>
									<span class="mybooking-product_discount-badge mb-badge info">
										<% if (booking.items[idx].offer_discount_type === 'percentage' && booking.items[idx].offer_value !== '') {%>
											<%=parseInt(booking.items[idx].offer_value)%>&#37;
										<% } %>
										<%=booking.items[idx].offer_name%>
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
						<%=configuration.formatCurrency(booking.items[idx].item_cost)%>
					</div>
				</div>
			</div>
		<% } %>
	</div>
<% } %>