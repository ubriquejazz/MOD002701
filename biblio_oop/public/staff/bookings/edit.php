<?php

require_once('../../../private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/member/index.php'));
}
$id = $_GET['id'];
$booking = Booking::find_by_id($id);
if($booking == false) {
  redirect_to(url_for('/staff/members/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['booking'];
  $booking->merge_attributes($args);
  $result = $booking->save();

  if($result === true) {
    $session->message('The booking was updated successfully.');
    redirect_to(url_for('/staff/bookings/show.php?id=' . $id));
  } else {
    // show errors
  }
} else {
  // display the form
}

?>

<?php $page_title = 'Edit Booking'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ); ?>">&laquo; Back to Member</a>

  <div class="booking edit">
    <h1>Edit Booking</h1>

    <?php echo display_errors($booking->errors); ?>

    <form action="<?php echo url_for('/staff/bookings/edit.php?id=' . h(u($booking->id)) ); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit Booking" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
