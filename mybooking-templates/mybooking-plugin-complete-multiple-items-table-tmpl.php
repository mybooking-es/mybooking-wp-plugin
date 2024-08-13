<?php
/**
 *   MYBOOKING ENGINE - MULTIPLE ITEMS SHOPPING CART in a table
 *   ---------------------------------------------------------------------------
 *   The Template for showing a table with multiple items partial - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-complete-multiple-items-table-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<script type="text/tmpl" id="script_mybooking_summary_product_detail_table">
<% if ( configuration.multipleProductsSelection ) { %>
	<% if ( bookings && bookings.length > 0 ) { %>
		<div class="mybooking-products_table">
			<div class="mb-row mybooking-products_table-head">
				<div class="mb-col-md-2 mb-col-sm-hidden"></div>
				<div class="mb-col-md-4 mb-col-sm-hidden"></div>
				<div class="mb-col-md-2 mb-col-sm-hidden">
					<span class="mybooking-summary_extra-name">
						<?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
					</span>
				</div>
				<div class="mb-col-md-2 mb-col-sm-hidden">
					<span class="mybooking-summary_extra-name">
						<?php echo esc_html_x( "Guarantee", 'renting_summary', 'mybooking-wp-plugin' ) ?>
					</span>
				</div>
				<div class="mb-col-md-2 mb-col-sm-hidden">
					<span class="mybooking-summary_extra-name">
						<?php echo esc_html_x( "Price", 'renting_summary', 'mybooking-wp-plugin' ) ?>
					</span>
				</div>
			</div>
			
			<div class="mybooking-products_table-body">
				<% for (var idx=0;idx<bookings.length;idx++) { %>
					<div class="mb-row">
						<!-- // Product photo -->
						<div class="mb-col-sm-12 mb-col-md-2">
							<% if (bookings[idx].photo_medium && bookings[idx].photo_medium !== '') { %>
								<img class="mybooking-product_image" src="<%=bookings[idx].photo_medium%>"/>
							<% } else { %>
								<img class="mybooking-product_image" src="<?php echo esc_url( plugin_dir_url(__DIR__).'/assets/images/default-image-product.png' ) ?>">
							<% } %>
						</div>
					
						<!-- // Product name and description -->
						<div class="mb-col-sm-12 mb-col-md-4">
							<div class="mybooking-product_name">
								<%=bookings[idx].item_description_customer_translation%>
							</div>
							<% if (typeof bookings[idx].item_rate_type_name !== 'undefined' && 
										bookings[idx].item_rate_type_name && bookings[idx].item_rate_type_name !== '') { %>
								<!-- Product rate type -->
								<div class="mybooking-product_description">
									<%=bookings[idx].item_rate_type_name%>
								</div>
							<% } %>
							<div class="mybooking-product_description">
								<%=bookings[idx].item_description_customer_translation%>
							</div>
						</div>

						<!-- Product deposit -->
						<div class="mb-col-sm-12 mb-col-md-2">
							<% if ( bookings[idx].product_deposit_cost > 0 ) { %>
								<span class="mybooking-summary_extra-name mb-col-md-hidden mb-col-lg-hidden">
									<?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
								</span>
								<span class="mybooking-summary_extra-amount">
									<%=configuration.formatCurrency(bookings[idx].product_deposit_cost)%>
									<% if ( bookings[idx].product_deposit_reduction_amount > 0 ) { %>
										<br />
										- <%=configuration.formatCurrency(bookings[idx].product_deposit_reduction_amount)%>
									<% } %>
								</span>
							<% } %>
						</div>

						<!-- Product guarantee -->
						<div class="mb-col-sm-12 mb-col-md-2">
							<% if ( bookings[idx].product_guarantee_cost > 0 ) { %>
								<span class="mybooking-summary_extra-name mb-col-md-hidden mb-col-lg-hidden">
									<?php echo esc_html_x( "Guarantee", 'renting_summary', 'mybooking-wp-plugin' ) ?>
								</span>
								<span class="mybooking-summary_extra-amount">
									<%=configuration.formatCurrency(bookings[idx].product_guarantee_cost)%>
									<% if ( bookings[idx].product_guarantee_reduction_amount > 0 ) { %>
										<br />
										- <%=configuration.formatCurrency(bookings[idx].product_guarantee_reduction_amount)%>
									<% } %>
								</span>
							<% } %>
						</div>

						<!-- // Price box -->
						<div class="mb-col-sm-12 mb-col-md-2">
							<% if (!configuration.hidePriceIfZero || booking.item_cost > 0) { %>
								<span class="mybooking-summary_extra-name mb-col-md-hidden mb-col-lg-hidden">
									<?php echo esc_html_x( "Price", 'renting_summary', 'mybooking-wp-plugin' ) ?>
								</span>
								<div class="mybooking-summary_price">
									<div>
										<!-- Discount -->
										<div class="mybooking-product_discount">
											<% if (bookings[idx].item_unit_cost_base != bookings[idx].item_unit_cost) { %>
												<div class="mybooking-product_price">
													<% if (bookings[idx].item_unit_cost_base != bookings[idx].item_unit_cost) { %>
														<!-- // Original price -->
														<span class="mybooking-product_original-price">
															<%=configuration.formatCurrency(bookings[idx].item_unit_cost_base * bookings[idx].quantity)%>
														</span>
													<% } %>

													<!-- // Offer -->
													<% if (typeof bookings[idx].offer_name !== 'undefined' && bookings[idx].offer_name !== null && bookings[idx].offer_name !== '') { %>
														<span class="mybooking-product_discount-badge mb-badge info">
															<% if (bookings[idx].offer_discount_type === 'percentage' && bookings[idx].offer_value !== '') {%>
																<%=parseInt(bookings[idx].offer_value)%>&#37;
															<% } %>
															<%=bookings[idx].offer_name%>
														</span>
													<% } %>
												</div>
											<% } %>
										</div>
									</div>

									<!-- // Price -->
									<div class="mybooking-product_price">
										<!-- // Quantity -->
										<span class="mybooking-product_quantity">
											<%=configuration.formatCurrency(bookings[idx].item_unit_cost)%>
											x
											<%=bookings[idx].quantity%>
										</span>

										<!-- // Amount -->
										<div class="mybooking-product_amount">
											<%=configuration.formatCurrency(bookings[idx].item_cost)%>
										</div>
									</div>
								</div>
							<% } %>
						</div>
					</div>
				<% } %>
			</div>
		</div>
	<% } else { %>
		<div class="mb-alert">
			<?php echo esc_html_x( "No items found", 'renting_summary', 'mybooking-wp-plugin' ) ?>
		</div>
	<% } %>
<% } %>
</script>
