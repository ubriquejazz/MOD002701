<?php 

require_once('../../../private/initialize.php');
require_login(); 

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$booking = Booking::find_by_id($id);
$bicycle = Bicycle::find_by_id(h($booking->bike_id));

if(is_post_request()) {
  // Renew booking
  $booking->renew_dates();
  $result = $booking->save();
  if($result === true) {
    $session->message('The booking was renewd successfully.');
    redirect_to(url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ));
  } else {
    // show errors
  }
} else {
  // display the form
}

?>

<?php $page_title = 'Show Booking: ' . h($booking->full_name()); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ); ?>">&laquo; Back to Member</a>

  <div class="booking show">

    <h1>Booking: <?php echo h($booking->full_name()); ?></h1>

    <?php echo display_errors($booking->errors); ?>

    <div class="attributes">
      <dl>
        <dt>Bicycle</dt>
        <dd><?php echo $bicycle->name(); ?></dd>
      </dl>
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($booking->bike_id); ?></dd>
      </dl>
      <dl>
        <dt>Check in</dt>
        <dd><?php echo h($booking->date_in); ?></dd>
      </dl>
      <dl>
        <dt>Check out</dt>
        <dd><?php echo h($booking->date_out); ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo h($booking->description); ?></dd>
      </dl>
    </div>

    <form action="<?php echo url_for('/staff/bookings/show.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Renew Booking" />
      </div>

    </form>

  </div>

</div>
