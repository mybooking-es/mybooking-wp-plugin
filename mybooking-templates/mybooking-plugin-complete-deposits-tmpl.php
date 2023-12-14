<?php
/**
 *   MYBOOKING ENGINE - DEPOSITS PARTIAL
 *   ---------------------------------------------------------------------------
 *   The Template for showing the deposit partial - JS Microtemplates
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-complete-deposits-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<!-- // Deposits -->
<% if ( booking.total_deposit > 0 ) { %>
	<!-- Booking deposits -->
	<div class="mybooking-summary_deposit-total-box">
	<% if (
			( booking.driver_age_deposit > 0 && booking.product_deposit_cost > 0 ) || 
			( booking.driver_age_deposit > 0 && booking.product_guarantee_cost > 0 ) || 
			( booking.product_deposit_cost > 0 && booking.product_guarantee_cost > 0 ) ||
			booking.product_deposit_reduction_amount > 0 || booking.product_guarantee_reduction_amount > 0
		) { %>
			<div class="mybooking-summary_details-title">
				<?php echo esc_html_x( 'Deposits', 'renting_summary', 'mybooking-wp-plugin' ) ?>
			</div>

			<!-- Driver age deposit -->
			<% if ( booking.driver_age_deposit > 0 ) { %>
				<div class="mybooking-summary_deposit-pretotal">
					<span class="mybooking-summary_extra-name">
						<?php echo esc_html_x( "Driver age deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.driver_age_deposit)%>
					</span>
				</div>
			<% } %>

			<!-- Deposit (total) -->
			<% if ( booking.product_deposit_cost > 0 ) { %>
				<div class="mybooking-summary_deposit-pretotal">
					<span class="mybooking-summary_extra-name">
						<?php echo esc_html_x( "Deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
						<% if ( booking.product_deposit_reduction_amount > 0 ) { %>
							<br/>
							<?php echo esc_html_x( "Reduction", 'renting_summary', 'mybooking-wp-plugin' ) ?>
						<% } %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.product_deposit_cost)%>
						<% if ( booking.product_deposit_reduction_amount > 0 ) { %>
							<br />
							- <%=configuration.formatCurrency(booking.product_deposit_reduction_amount)%>
						<% } %>
					</span>
				</div>
			<% } %>
			
			<!-- Guarantee (total) -->
			<% if ( booking.product_guarantee_cost > 0 ) { %>
					<div class="mybooking-summary_deposit-pretotal">
						<span class="mybooking-summary_extra-name">
							<?php echo esc_html_x( "Guarantee", 'renting_summary', 'mybooking-wp-plugin' ) ?>
							<% if ( booking.product_deposit_reduction_amount > 0 ) { %>
								<br/>
								<?php echo esc_html_x( "Reduction", 'renting_summary', 'mybooking-wp-plugin' ) ?>
							<% } %>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%=configuration.formatCurrency(booking.product_guarantee_cost)%>
							<% if ( booking.product_deposit_reduction_amount > 0 ) { %>
								<br />
								- <%=configuration.formatCurrency(booking.product_guarantee_reduction_amount)%>
							<% } %>
						</span>
					</div>
			<% } %>
		<% } %>

		<!-- Total deposit  -->
		<% if ( booking.total_deposit > 0 ) { %>
			<div class="mybooking-summary_deposit-total">
				<span class="mybooking-summary_extra-name">
					<?php echo esc_html_x( "Total deposit", 'renting_summary', 'mybooking-wp-plugin' ) ?>
				</span>
				<span class="mybooking-summary_extra-amount">
					<%=configuration.formatCurrency( booking.total_deposit )%>
				</span>
			</div>
		<% } %>
	</div>
<% } %>
