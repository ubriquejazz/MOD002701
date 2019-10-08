<?php

require_once('../../../private/initialize.php');
require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['booking'];
  $booking = new Booking($args);
  $result = $booking->save();

  if($result === true) {
    $new_id = $booking->id;
    $session->message('The booking was created successfully.');
    redirect_to(url_for('/staff/bookings/show.php?id=' . $new_id));
  } else {
    // show errors
    // echo $booking->errors[0]; 
  }

} else {
  // display the form
  $booking = new Booking;
  $booking->user_id = $_GET['user_id'] ?? '1';
  $booking->renew_dates();
}

?>

<?php $page_title = 'Create Booking'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ); ?>">&laquo; Back to Member</a>

  <div class="booking new">
    <h1>Create Booking</h1>

    <?php echo display_errors($booking->errors); ?>

    <form action="<?php echo url_for('/staff/bookings/new.php?id=' . h(u($booking->user_id)) ); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Booking" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
