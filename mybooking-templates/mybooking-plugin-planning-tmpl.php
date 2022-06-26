<?php
/**
 *   MYBOOKING ENGINE - PLANNING TMPL
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting select product step
 *   This template can be overridden by copying it to your
 *   theme /mybooking-templates/mybooking-plugin-planning-tmpl.php
 *
 */
?>

<!-- ======================================================= -->
<!-- Template that represents a reservation in the planning  -->
<!-- ======================================================= -->
<script type="text/template" id="planning_reservation">
  <div id="<%%=origin%><%=idResource%>"
                     data-origin="<%=origin%>"
                     data-id="<%=id%>"
                     data-category="<%=category%>"
                     data-date-from="<%=dateFrom%>" 
                     data-time-from="<%=timeFrom%>" 
                     data-date-to="<%=dateTo%>" 
                     data-time-to="<%=timeTo%>" 
                     data-return-place="<%=returnPlace%>"
                     data-resource="<%=resource%>"
                     data-id-resource="<%=idResource%>"
                     data-booking-title="<%=booking_title%>"
                     data-planning-color="<%=backgroundColor%>"
                     data-detail="<%=detail%>"
                     style="display: inline-block; position: absolute; border: 1px solid; border-color: rgb(255,0,0); color: rgb(255,255,255); background-color: rgb(255,0,0) overflow:hidden; opacity: 0.8">
    <span>
      <%= timeFrom %> - <%= timeTo %>
    </span>
  </div>
</script>