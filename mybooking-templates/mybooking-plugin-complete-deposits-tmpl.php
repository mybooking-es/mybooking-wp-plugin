<?php
if ( ! defined( 'ABSPATH' ) ) exit;
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
<%
	var validVisibilityModes = ['always', 'never', 'greater_than_zero'];
	var showExcessMode = validVisibilityModes.indexOf(settings.show_excess) >= 0 ? settings.show_excess : 'legacy';
	var showDepositMode = validVisibilityModes.indexOf(settings.show_deposit) >= 0 ? settings.show_deposit : 'legacy';
	var isFranchise = booking.deposit_hold_product_deposit_cost === 'not_hold' && configuration.literalDepositFranchise === 'franchise';
	var hasMultipleDeposits = booking.count_deposit > 1;

	var isVisibleByMode = function(mode, amount, legacyCondition) {
		if (mode === 'always') {
			return true;
		}
		if (mode === 'never') {
			return false;
		}
		if (mode === 'greater_than_zero') {
			return amount > 0;
		}
		return legacyCondition;
	};

	var showFranchiseDeposit = isFranchise && isVisibleByMode(showExcessMode, booking.product_deposit_total, true);
	var showFranchiseGuarantee = isFranchise && isVisibleByMode(showDepositMode, booking.total_deposit, booking.total_deposit > 0);
	var showHoldDeposit = !isFranchise && hasMultipleDeposits &&
		booking.deposit_hold_product_deposit_cost === 'hold' &&
		isVisibleByMode(showDepositMode, booking.product_deposit_total, booking.product_deposit_total > 0);
	var showGuarantee = !isFranchise && hasMultipleDeposits &&
		isVisibleByMode(showDepositMode, booking.product_guarantee_total, booking.product_guarantee_total > 0);
	var showDriverAgeDeposit = !isFranchise && hasMultipleDeposits &&
		isVisibleByMode(showDepositMode, booking.driver_age_deposit, booking.driver_age_deposit > 0);
	var showTotalDeposit = !isFranchise &&
		isVisibleByMode(showDepositMode, booking.total_deposit, booking.total_deposit > 0);
	var showDepositBox = showFranchiseDeposit || showFranchiseGuarantee || showHoldDeposit ||
		showGuarantee || showDriverAgeDeposit || showTotalDeposit;
%>
<% if (showDepositBox) { %>
	<!-- Booking deposits -->
	<div class="mybooking-summary_deposit-total-box">
		<% if (isFranchise) { %>
			<!-- Franchise special case -->
			<% if (showFranchiseDeposit) { %>
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
						<%=configuration.depositLiteral%>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.product_deposit_total)%>
					</span>
				</div>
			<% } %>
			<% if (showFranchiseGuarantee) { %>
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
			<% if (showHoldDeposit) { %>
				<!-- Deposit -->
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
						<%= configuration.depositLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency( booking.product_deposit_total ) %>
					</span>
				</div>
			<% } %>
			<% if (showGuarantee) { %>
				<!-- Guarantee -->
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
						<%= configuration.guaranteeLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency( booking.product_guarantee_total ) %>
					</span>
				</div>
			<% } %>
			<% if (showDriverAgeDeposit) { %>
				<!-- Driver age deposit-->
				<div class="mybooking-summary_deposit-total">
					<span class="mybooking-summary_extra-name">
						<%= configuration.driverDepositLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency( booking.driver_age_deposit ) %>
					</span>
				</div>
			<% } %>
			<% if (showTotalDeposit) { %>
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
