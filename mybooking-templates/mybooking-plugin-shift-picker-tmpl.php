<?php
/**
 *   MYBOOKING ENGINE - PRODUCT SHIFT PICKER
 *   ---------------------------------------------------------------------------
 *   The Template for showing the shift picker to create a reservation
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-shift-picker-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>

<!-- START TEMPLATES -->
<script type="text/tmpl" id="script_shiftpicker_units_option">
	<option value="<%=model.units%>">
		<%=model.units%>  <?php echo esc_html_x( 'Unit(s)', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
	</option>
</script>

<script type="text/tmpl" id="script_shiftpicker_turns_item">
	<li class="mybooking-rent-shift-picker-container-list-item shiftpicker-turn-item list-group-item" data-status="<%=model.availability ? 'enabled' : 'disabled'%>" data-time-from="<%=model.time_from%>" data-time-to="<%=model.time_to%>">
		<span class="mybooking-rent-shift-picker-container-list-item_text">
			<%=model.time_from%> - <%=model.time_to%>
		</span>
		<div>
			<% if (model.available_units) { %>
				<small>
					<i>
						<%=model.available_units ? model.available_units : 0%>
						&nbsp;
						<?php echo esc_html_x( 'Unit(s)', 'renting_shift_picker', 'mybooking-wp-plugin') ?> <?php echo esc_html_x( 'available', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</i>
				</small>
			<% } %>
			<% if (!model.availability) { %>
				<small>
					<i>
						<?php echo esc_html_x( 'Unavailable', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
					</i>
				</small>
			<% } %>
		</div>
		<input class="form-control" style="width:auto;" type="radio" name="time" value="<%=model.time_from%> - <%=model.time_to%>" <%=!model.availability ? 'disabled="disabled"' : ''%> class="mybooking-rent-shift-picker-container-list-item_value">
	</li>
</script>

<script type="text/tmpl" id="script_shiftpicker_info">
	<div class="card-static_resume__container mybooking-rent-shift-picker-container-info_content card">
		<div class="card-static_resume__container_inside">
			<h2 class="mybooking-summary_details-title">
        <?php echo esc_html_x( 'Reservation summary', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
      </h2>

			<!-- // Info -->
			<div>
				<strong>
					<% if (model.days > 0) { %>
						<span class="time">
								<%=model.days%>
						</span>
						&nbsp;
						<span class="time-format">
							<?php echo esc_html_x( 'day(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
						</span>
					<% } else if (model.hours > 0) { %>
						<span class="time">
								<%=model.hours%>
						</span>
						&nbsp;
						<span class="time-format">
							<?php echo esc_html_x( 'hour(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
						</span>
					<% } else if (model.minutes > 0) { %>
						<span class="time">
								<%=model.minutes%>
						</span>
						&nbsp;
						<span class="time-format">
							<?php echo esc_html_x( 'minute(s)', 'renting_choose_product', 'mybooking-wp-plugin' ) ?>
						</span>
					<% } %>
				</strong>
			</div>
			<div>
				<span class="units">
					<%=model.units%>
				</span>
				&nbsp;
				<?php echo esc_html_x( 'Unit(s)', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
			</div>
			<div class="date">
				<%=model.date%>
			</div>
			<div>
			<?php echo esc_html_x( 'From', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
				&nbsp;
				<span class="time-from"><%=model.time_from%></span>
				&nbsp;<?php echo esc_html_x( 'to', 'renting_shift_picker', 'mybooking-wp-plugin') ?>&nbsp;
				<span class="time-to"><%=model.time_to%></span>
				&nbsp;
				<?php echo esc_html_x( 'hours', 'renting_shift_picker', 'mybooking-wp-plugin') ?>
			</div>
			<!-- // End info -->

			<!-- // Extras -->
			<% if (model.shopping_cart.extras.length > 0) { %>
				<div class="mb-section">
					<div class="mybooking-summary_details-title">
						<?php echo esc_html_x( 'Extras', 'renting_complete', 'mybooking-wp-plugin' ) ?>
					</div>

					<% for (var idx=0;idx<model.shopping_cart.extras.length;idx++) { %>
						<div class="mybooking-summary_extras">
							<div class="mybooking-summary_extra-item">
								<span class="mb-badge info mybooking-summary_extra-quantity">
									<%=model.shopping_cart.extras[idx].quantity%>
								</span>
								<span class="mybooking-summary_extra-name">
									<%=model.shopping_cart.extras[idx].extra_description%>
								</span>
								<span class="mybooking-summary_extra-amount">
									<%=model.configuration.formatCurrency(model.shopping_cart.extras[idx].extra_cost)%>
								</span>
							</div>
						</div>
					<% } %>
				</div>
			<% } %>
			<!-- // End Extras -->

			<!-- // Supplements -->
			<div class="mybooking-summary_extras">
				<!-- // Pick-up time -->
				<% if (model.shopping_cart.time_from_cost > 0) { %>
					<div class="mybooking-summary_extra-item">
						<span class="mybooking-summary_extra-name">
							<?php echo esc_html_x( 'Pick-up time supplement', 'renting_complete', 'mybooking-wp-plugin' ) ?>
						</span>
						<span class="mybooking-summary_extra-amount">
							<%=model.configuration.formatCurrency(model.shopping_cart.time_from_cost)%>
						</span>
					</div>
				<% } %>
			</div>
			<!-- // End Supplements -->

			<!-- // Total -->
			<% if (!model.configuration.hidePriceIfZero || model.shopping_cart.total_cost > 0) { %>
				<hr class="my-4">
				<div class="mybooking-summary_total lead">
					<span class="mybooking-summary_total-label">
						<b><?php echo esc_html_x( "Total", 'renting_complete', 'mybooking-wp-plugin' ) ?>:</b>
					</span>
					<span class="mybooking-summary_total-amount">
						<b>
							<%=model.configuration.formatCurrency(model.shopping_cart.total_cost)%>
						</b>
					</span>
				</div>
				<?php if ( array_key_exists('show_taxes_included', $args) && ( $args['show_taxes_included'] ) ): ?>
					<div class="mybooking-product_taxes">
						<?php echo esc_html_x( 'Taxes included', 'renting_choose_product', 'mybooking-wp-plugin') ?>
					</div>
				<?php endif; ?>
				
			<% } %>
			<!-- // End Total -->
		</div>
	</div>
</script>
<!-- END TEMPLATES -->