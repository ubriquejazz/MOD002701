<?php

  require_once('../../../private/initialize.php');
  require_login(); 

  $current_page = $_GET['page'] ?? 1;
  $per_page = 20;
  $total_count = Member::count_all();
  $pagination = new Pagination($current_page, $per_page, $total_count);

  // Find all members; use pagination instead
  // $members = Member::find_all();

  $sql = "SELECT * FROM members ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $members = Member::find_by_sql($sql);

?>

<?php $page_title = 'Members'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="members listing">
    <h1>Members</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/members/new.php'); ?>">Add Member</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Bookings</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($members as $member) { ?>

        <?php $user_id = h($member->id); ?>
        <?php $booking_count = Booking::count_by_user_id($user_id); ?>
        <tr>
          <td><?php echo $user_id; ?></td>
          <td><?php echo h($member->first_name); ?></td>
          <td><?php echo h($member->last_name); ?></td>
          <td><?php echo $booking_count; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($member->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/edit.php?id=' . h(u($member->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/delete.php?id=' . h(u($member->id))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
    $url = url_for('/staff/members/index.php');
    echo $pagination->page_links($url);
    ?>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
