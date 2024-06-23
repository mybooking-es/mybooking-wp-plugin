<?php
/**
 *   MYBOOKING ENGINE - RESERVATION FORM NAMED RESOURCES TEMPLATE
 *   ---------------------------------------------------------------------------
 * 
 *   The Template for showing the form to fill the named resources information
 * 
 *   This template can be overridden by copying it to your
 *   theme/mybooking-templates/mybooking-plugin-reservation-form-named-resources-tmpl.php
 *
 *   @phpcs:disable PHPCompatibility.Miscellaneous.RemovedAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 *   @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */
?>
<% if (configuration.rentingFormFillDataNamedResources) { %>
	<div class="mb-section mb-panel-container">
		<% for (var idx=0; idx<booking.booking_lines.length; idx++) { %>
				<% var booking_line = booking.booking_lines[idx]; %>
				<h3 class="mb-form_title"><%=booking_line.quantity%> x <%=booking_line.item_description%></h3>
				<% for (var idxResource=0; idxResource<booking.booking_lines[idx].booking_line_resources.length; idxResource++) { %>
					<% var booking_line_resource = booking.booking_lines[idx].booking_line_resources[idxResource]; %>
					<input type="hidden" name="booking_line_resources[<%=booking_line_resource.id%>][id]" value="<%=booking_line_resource.id%>"/>
					<% if (booking_line_resource.pax == 1) { %>
						<h5 class="h5 border p-2"><?php echo esc_html_x( 'Participant', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
					<% } else if (booking_line_resource.pax == 2) { %>
						<h5 class="h5 border p-2"><?php echo esc_html_x( 'Participants', 'renting_my_reservation', 'mybooking-wp-plugin') ?> #<%=idxResource+1%></h5>
						<h6 class="h6 border p-1 text-right"><?php echo esc_attr_x( 'Pax 1', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h6>
					<% } %>
					<div class="mb-form-row">
						<div class="mb-form-group mb-col-md-4">
							<label><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
							<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_name]"
											title="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
											class="form-control alt" type="text"
											placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
											value="<%=booking_line_resource.resource_user_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</div>
						<div class="mb-form-group mb-col-md-4">
							<label><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
							<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_surname]"
											title="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
											class="form-control alt" type="text"
											placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
											value="<%=booking_line_resource.resource_user_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</div>
						<div class="mb-form-group mb-col-md-4">
							<label><?php echo esc_html_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
							<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_document_id]"
											title="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
											class="form-control alt" type="text"
											placeholder="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
											value="<%=booking_line_resource.resource_user_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</div>
					</div>
					<div class="mb-form-row">
						<div class="mb-form-group mb-col-md-4">
							<label><?php echo esc_html_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
							<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_phone]"
											title="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
											class="form-control alt" type="text"
											placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
											value="<%=booking_line_resource.resource_user_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</div>
						<div class="mb-form-group mb-col-md-4">
							<label><?php echo esc_html_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
							<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_email]"
											title="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
											class="form-control alt" type="text"
											placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
											value="<%=booking_line_resource.resource_user_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
						</div>
						<% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>
							<div class="mb-form-group mb-col-md-2">
								<label><?php echo esc_html_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][customer_height]"
												title="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="number"
												placeholder="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
												value="<%=booking_line_resource.customer_height%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
						<% } %>
						<% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>
							<div class="mb-form-group mb-col-md-2">
								<label><?php echo esc_html_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][customer_weight]"
												title="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="number"
												placeholder="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:"  min="0" max="200"
												value="<%=booking_line_resource.customer_weight%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
						<% } %>
					</div>
					<% if (booking_line_resource.pax == 2) { %>
						<h6 class="h6 border p-1 text-right"><?php echo esc_html_x( 'Pax 2', 'renting_my_reservation', 'mybooking-wp-plugin') ?></h5>
						<div class="mb-form-row">
							<div class="mb-form-group mb-col-md-4">
								<label><?php echo esc_html_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_name]"
												title="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="text"
												placeholder="<?php echo esc_attr_x( 'Name', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
												value="<%=booking_line_resource.resource_user_2_name%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
							<div class="mb-form-group mb-col-md-4">
								<label><?php echo esc_html_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_surname]"
												title="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="text"
												placeholder="<?php echo esc_attr_x( 'Surname', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="80"
												value="<%=booking_line_resource.resource_user_2_surname%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
							<div class="mb-form-group mb-col-md-4">
								<label><?php echo esc_html_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_document_id]"
												title="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="text"
												placeholder="<?php echo esc_attr_x( 'Document ID', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="50"
												value="<%=booking_line_resource.resource_user_2_document_id%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
						</div>
						<div class="mb-form-row">
							<div class="mb-form-group mb-col-md-4">
								<label><?php echo esc_html_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_phone]"
												title="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="text"
												placeholder="<?php echo esc_attr_x( 'Phone number', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="15"
												value="<%=booking_line_resource.resource_user_2_phone%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
							<div class="mb-form-group mb-col-md-4">
								<label><?php echo esc_html_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
								<input name="booking_line_resources[<%=booking_line_resource.id%>][resource_user_2_email]"
												title="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
												class="form-control alt" type="text"
												placeholder="<?php echo esc_attr_x( 'E-mail', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" maxlength="40"
												value="<%=booking_line_resource.resource_user_2_email%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
							</div>
							<% if (configuration.rentingFormFillDataNamedResourcesHeight) { %>
								<div class="mb-form-group mb-col-md-2">
									<label><?php echo esc_html_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
									<input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_height]"
													title="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
													class="form-control alt" type="number"
													placeholder="<?php echo esc_attr_x( 'Height (cm)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="250"
													value="<%=booking_line_resource.customer_2_height%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
								</div>
							<% } %>
							<% if (configuration.rentingFormFillDataNamedResourcesWeight) { %>
								<div class="mb-form-group mb-col-md-2">
									<label><?php echo esc_html_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?></label>
									<input name="booking_line_resources[<%=booking_line_resource.id%>][customer_2_weight]"
													title="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>" data-toggle="tooltip"
													class="form-control alt" type="number"
													placeholder="<?php echo esc_attr_x( 'Weight (kg)', 'renting_my_reservation', 'mybooking-wp-plugin') ?>:" min="0" max="200"
													value="<%=booking_line_resource.customer_2_weight%>" <% if (!booking.can_edit_online){%>disabled<%}%>>
								</div>
							<% } %>
						</div>
					<% } %>
				<% } %>
		<% } %>
	</div>
<% } %>