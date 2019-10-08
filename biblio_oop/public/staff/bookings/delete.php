<?php

require_once('../../../private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/member/index.php'));
}
$id = $_GET['id'];
$booking = Booking::find_by_id($id);

if($booking == false) {
  redirect_to(url_for('/staff/member/index.php'));
}

if(is_post_request()) {
  // Delete booking
  $result = $booking->delete();
  $session->message('The booking was deleted successfully.');
  redirect_to(url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ));
} else {
  // Display form
}

?>

<?php $page_title = 'Delete Booking'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($booking->user_id)) ); ?>">&laquo; Back to Member</a>


  <div class="booking delete">
    <h1>Delete Booking</h1>
    <p>Are you sure you want to delete this booking?</p>
    <p class="item"><?php echo h($booking->full_name()); ?></p>

    <form action="<?php echo url_for('/staff/bookings/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Booking" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
