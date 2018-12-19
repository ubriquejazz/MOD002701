<?php

require_once('../../../private/initialize.php');

require_login();

$member_set = find_all_members();

?>

<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="admins listing">
    <h1>Members</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/members/new.php'); ?>">Create New Member</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Phone</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($member = mysqli_fetch_assoc($member_set)) { ?>
        <tr>
          <td><?php echo h($member['id']); ?></td>
          <td><?php echo h($member['first_name']); ?></td>
          <td><?php echo h($member['last_name']); ?></td>
          <td><?php echo h($member['email']); ?></td>
          <td><?php echo h($member['phone']); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($member['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/edit.php?id=' . h(u($member['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/delete.php?id=' . h(u($member['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($member_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
