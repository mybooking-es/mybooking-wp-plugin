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
<% if ( (booking.deposit_hold_product_deposit_cost === 'not_hold' &&
				 configuration.literalDepositFranchise === 'franchise') || booking.total_deposit > 0 ) { %>
	<!-- Booking deposits -->
	<div class="mybooking-summary_deposit-total-box">
		<% if (booking.deposit_hold_product_deposit_cost === 'not_hold' &&
		       configuration.literalDepositFranchise === 'franchise') { %>
				<!-- Franchise special case -->
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
					<%=configuration.depositLiteral%>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.product_deposit_total)%>
					</span>
				</div>
				<% if ( booking.total_deposit > 0 ) { %>
					<div class="mybooking-summary_deposit-total">
						<span class="mybooking-summary_extra-name">
							<%= configuration.guaranteeLiteral %>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%=configuration.formatCurrency( booking.total_deposit )%>
						</span>
					</div>
				<% } %>				
		<% } else { %>
			<% if ( booking.count_deposit > 1) { %>
				<!-- Deposit -->
				<% if (booking.deposit_hold_product_deposit_cost === 'hold' && 
							 booking.product_deposit_total > 0) { %>
					<div class="mybooking-summary_deposit-total">
						<span class="mybooking-summary_extra-name">
							<%= configuration.depositLiteral %>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%= configuration.formatCurrency( booking.product_deposit_total ) %>
						</span>
					</div>
				<% } %>
				<!-- Guarantee -->
				<% if (booking.product_guarantee_total > 0) { %>
					<div class="mybooking-summary_deposit-total">
						<span class="mybooking-summary_extra-name">
							<%= configuration.guaranteeLiteral %>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%= configuration.formatCurrency( booking.product_guarantee_total ) %>
						</span>
					</div>
				<% } %>
				<!-- Driver age deposit-->
				<% if (booking.driver_age_deposit > 0) { %>
					<div class="mybooking-summary_deposit-total">
						<span class="mybooking-summary_extra-name">
							<%= configuration.driverDepositLiteral %>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%= configuration.formatCurrency( booking.driver_age_deposit ) %>
						</span>
					</div>	
				<% } %>	
			<% } %> 
			<% if ( booking.total_deposit > 0 ) { %>
				<!-- Total deposit  -->
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
						<%= configuration.depositTotalLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency( booking.total_deposit )%>
					</span>
				</div>
			<% } %>
		<% } %>

	</div>
<% } %>
