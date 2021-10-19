<?php
/**
 *   MYBOOKING ENGINE - MY RESERVATION
 *   ---------------------------------------------------------------------------
 *   The Template for showing the renting summary step
 *   This template can be overridden by copying it to your theme
 *   /mybooking-templates/mybooking-plugin-summary.php
 */
?>

<?php $theme = wp_get_theme(); // gets the current theme
if (
  'Twenty Twenty' == $theme->name ||
  'Twenty Twenty' == $theme->parent_theme ||
  'Twenty Twenty-One' == $theme->name ||
  'Twenty Twenty-One' == $theme->parent_theme )
  {
    $alignwide = 'alignwide';
  } ?>

<section class="mybooking mybooking-process_reservation <?php echo $alignwide ?>">
  <div class="mb-row">

    <!-- Reservation summary -->
    <div id="reservation_detail"></div>
  </div>
</section>
