<?php
  /** 
   * The Template for showing the sticky bar in transfer choose product
   * This template can be overridden by copying it to your
   * theme /mybooking-templates/mybooking-plugin-reservation-summary-tmpl.php
	 * 
   * @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
   * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound   
   */
?>
<script type="text/tmpl" id="script_transfer_reservation_summary">

<div class="mb-section mybooking-details_container">
	<div class="mybooking-summary_header">
		<div class="mybooking-summary_details-title">
			<?php echo esc_html_x( 'Reservation summary', 'renting_choose_product', 'mybooking-wp-plugin' ) ?> ⟶

			<!-- // Type of reservation -->
			<% if (shopping_cart.round_trip) { %>
				<?php echo esc_html_x( 'Round trip', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>
			<% } else { %>
				<?php echo esc_html_x( 'One Way', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>
			<% } %>
		</div>

		<div class="mybooking-summary_edit" id="modify_reservation_button" role="link">
			<i class="mb-button icon">
				<span class="dashicons dashicons-edit"></span>
			</i>
			<?php echo esc_html_x( 'Edit', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
		</div>
	</div>

	<div class="mybooking-summary_detail">
		<span class="mybooking-summary_item">
			<span class="mybooking-summary_date">
				<%=configuration.formatDate(shopping_cart.date)%> <%=shopping_cart.time%>
			</span>
			<span class="mybooking-summary_place">
				<?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
				<%=shopping_cart.origin_point_name%>
			</span>
			<span class="mybooking-summary_place">
				<?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
				<%=shopping_cart.destination_point_name%>
			</span>
		</span>

		<% if (shopping_cart.round_trip) { %>
			<span class="mybooking-summary_item">
				<span class="mybooking-summary_date">
					<%=configuration.formatDate(shopping_cart.return_date)%> <%=shopping_cart.return_time%>
				</span>
				<span class="mybooking-summary_place">
					<?php echo esc_html_x( 'Origin', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
					<%=shopping_cart.return_origin_point_name%>
				</span>
				<span class="mybooking-summary_place">
					<?php echo esc_html_x( 'Destination', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?> ⟶
					<%=shopping_cart.return_destination_point_name%>
				</span>
			</span>
		<% } %>

		<span class="mybooking-summary_item">
			<?php echo esc_html_x( 'Adults', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_adults%></br>
			<?php echo esc_html_x( 'Children', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_children%></br>
			<?php echo esc_html_x( 'Infants', 'transfer_choose_vehicle', 'mybooking-wp-plugin' ) ?>: <%=shopping_cart.number_of_infants%>
		</span>
	</div>
</div>
</script>
