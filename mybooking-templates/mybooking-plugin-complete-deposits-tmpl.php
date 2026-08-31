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
  var resolveVisibilityMode = function(value) {
    if (value === null) return 'never';
    return validVisibilityModes.indexOf(value) >= 0 ? value : 'legacy';
  };
  var showExcessMode = resolveVisibilityMode(settings ? settings.show_excess : undefined);
  var showDepositMode = resolveVisibilityMode(settings ? settings.show_deposit : undefined);
  var isFranchise = booking.deposit_hold_product_deposit_cost === 'not_hold' && configuration.literalDepositFranchise === 'franchise';

  var isVisibleByMode = function(mode, amount, legacyCondition) {
    if (mode === 'always') return true;
    if (mode === 'never') return false;
    if (mode === 'greater_than_zero') return amount > 0;
    return legacyCondition;
  };

  var showFE = isFranchise && isVisibleByMode(showExcessMode, booking.product_deposit_total, booking.product_deposit_total > 0);
  var showFD = isFranchise && isVisibleByMode(showDepositMode, booking.total_deposit, booking.total_deposit > 0);
  var showNFE = !isFranchise && isVisibleByMode(showExcessMode, booking.product_deposit_total, booking.product_deposit_total > 0);
  var showNFD = !isFranchise && isVisibleByMode(showDepositMode, booking.product_guarantee_total, booking.product_guarantee_total > 0);
  var showDA = booking.driver_age_deposit > 0;
  var showTT = showFE || showFD || showNFE || showNFD || showDA;
  var showBox = showTT || showDA;
%>
<% if (showBox) { %>
	<!-- Booking deposits -->
	<div class="mybooking-summary_deposit-total-box">
		<% if (isFranchise) { %>
			<% if (showFE) { %>
				<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--franchise mybooking-summary_deposit-total--excess">
					<span class="mybooking-summary_extra-name">
						<%=configuration.depositLiteral%>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.product_deposit_total)%>
					</span>
				</div>
			<% } %>
			<% if (showFD) { %>
				<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--franchise mybooking-summary_deposit-total--deposit">
					<span class="mybooking-summary_extra-name">
						<%= configuration.guaranteeLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%=configuration.formatCurrency(booking.total_deposit)%>
					</span>
				</div>
			<% } %>
		<% } else { %>
			<% if (showNFE) { %>
				<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--non-franchise mybooking-summary_deposit-total--excess">
					<span class="mybooking-summary_extra-name">
						<%= configuration.depositLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency(booking.product_deposit_total) %>
					</span>
				</div>
			<% } %>
			<% if (showNFD) { %>
				<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--non-franchise mybooking-summary_deposit-total--deposit">
					<span class="mybooking-summary_extra-name">
						<%= configuration.guaranteeLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency(booking.product_guarantee_total) %>
					</span>
				</div>
			<% } %>
			<% if (showDA) { %>
				<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--driver-age">
					<span class="mybooking-summary_extra-name">
						<%= configuration.driverDepositLiteral %>
					</span>
					<span class="mybooking-summary_extra-amount">
						<%= configuration.formatCurrency(booking.driver_age_deposit) %>
					</span>
				</div>
			<% } %>
		<% } %>
		<% if (showTT) { %>
			<!-- Total deposit -->
			<div class="mybooking-summary_deposit-total mybooking-summary_deposit-total--total">
				<span class="mybooking-summary_extra-name">
					<%= configuration.depositTotalLiteral %>
				</span>
				<span class="mybooking-summary_extra-amount">
					<%=configuration.formatCurrency(booking.total_deposit)%>
				</span>
			</div>
		<% } %>
	</div>
<% } %>
