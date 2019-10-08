<?php 
  
  require_once('../../../private/initialize.php');
  require_login(); 
  
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $bicycle = Bicycle::find_by_id($id);

  // available?
  $available = true;
  if (!is_unbooked_bicycle($id) ){
    $available = false;

    // there is an user at least
    $bookings = Booking::find_by_bike_id($id);
    $users = [];
    foreach($bookings as $booking) {
      $users[] = $booking->user_id;
    }
    $user_id = $users[0];
    $member = Member::find_by_id($user_id);
  }

?>

<?php $page_title = 'Show Bicycle: ' . h($bicycle->name()); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/bicycles/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle show">

    <h1>Bicycle: <?php echo h($bicycle->name()); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Brand</dt>
        <dd><?php echo h($bicycle->brand); ?></dd>
      </dl>
      <dl>
        <dt>Model</dt>
        <dd><?php echo h($bicycle->model); ?></dd>
      </dl>
      <dl>
        <dt>Year</dt>
        <dd><?php echo h($bicycle->year); ?></dd>
      </dl>
      <dl>
        <dt>Category</dt>
        <dd><?php echo h($bicycle->category); ?></dd>
      </dl>
      <dl>
        <dt>Color</dt>
        <dd><?php echo h($bicycle->color); ?></dd>
      </dl>
      <dl>
        <dt>Gender</dt>
        <dd><?php echo h($bicycle->gender); ?></dd>
      </dl>
      <dl>
        <dt>Weight</dt>
        <dd><?php echo h($bicycle->weight_kg()) . ' / ' . h($bicycle->weight_lbs()); ?></dd>
      </dl>
      <dl>
        <dt>Condition</dt>
        <dd><?php echo h($bicycle->condition()); ?></dd>
      </dl>
      <dl>
        <dt>Price</dt>
        <dd><?php echo h(money_format('$%i', $bicycle->price)); ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo h($bicycle->description); ?></dd>
      </dl>
    </div>

    <hr />

    <div class="bookings listing">
      <h3> Availability</h3>

      <?php if ($available){ ?>
          Item currently available.
       <?php  } else { ?>
          In these moments the item has been booked by <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($member->id)));?>"> <?php echo $member->full_name(); ?></a>
        <?php } ?>

    </div>

  </div>

</div>
