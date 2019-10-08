<?php 

require_once('../../../private/initialize.php');
require_login(); 

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$member = Member::find_by_id($id);
if($member == false) {
  redirect_to(url_for('/staff/members/index.php'));
}
$bookings = Booking::find_by_user_id($id);

?>

<?php $page_title = 'Show Member: ' . h($member->full_name()); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="member show">

    <h1>Member: <?php echo h($member->full_name()); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($member->first_name); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($member->last_name); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($member->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($member->phone); ?></dd>
      </dl>
    </div>

    <hr />

    <div class="bookings listing">
      <h2>Bookings</h2>

      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/bookings/new.php?user_id=' . h(u($member->id)) ); ?>">Add Booking</a>
      </div>

      <table class="list">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Check in</th>
          <th>Check out</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

        <?php foreach($bookings as $booking) { ?>
          <?php $bike_id = h($booking->bike_id); ?>
          <?php $bike = Bicycle::find_by_id($bike_id); ?>
          <tr>
            <td><?php echo $bike_id; ?></td>
            <td><?php echo $bike->name(); ?></td>
            <td><?php echo h($booking->date_in); ?></td>
            <td><?php echo ($booking->is_expired())? "LATE!" : h($booking->date_out); ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/bookings/show.php?id=' . h(u($booking->id))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/bookings/edit.php?id=' . h(u($booking->id))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/bookings/delete.php?id=' . h(u($booking->id))); ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>

    </div>


  </div>

</div>
