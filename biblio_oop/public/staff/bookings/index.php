<?php

  require_once('../../../private/initialize.php');
  require_login(); 

  $bookings = Booking::find_all();

?>

<?php $page_title = 'Bookings'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="bookings listing">
    <h1>Bookings</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/bookings/new.php'); ?>">Add Booking</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Member</th>
        <th>Bicycle</th>
        <th>Check in</th>
        <th>Check out</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($bookings as $booking) { ?>
        <tr>
          <td><?php echo h($booking->id); ?></td>
          <td><?php echo h($booking->user_id); ?></td>
          <td><?php echo h($booking->bike_id); ?></td>
          <td><?php echo h($booking->check_in); ?></td>
          <td><?php echo h($booking->check_out); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/bookings/show.php?id=' . h(u($booking->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/bookings/edit.php?id=' . h(u($booking->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/bookings/delete.php?id=' . h(u($booking->id))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
