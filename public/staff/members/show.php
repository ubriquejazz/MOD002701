<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$member = find_member_by_id($id);
$register_set = find_registers_for_user($id);

?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>Member: <?php echo h($member['email']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/members/edit.php?id=' . h(u($member['id']))); ?>">Edit</a>
      <a class="action" href="<?php echo url_for('/staff/members/delete.php?id=' . h(u($member['id']))); ?>">Delete</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($member['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($member['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($member['email']); ?></dd>
      </dl>
      <dl>
        <dt>Phone</dt>
        <dd><?php echo h($member['phone']); ?></dd>
      </dl>
    </div>

    <hr/>

    <div class="pages listing">
    <h2>Registers</h2>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/registers/new.php?subject_id=' . h(u($subject['id']))); ?>">Create New register</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Book</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($register = mysqli_fetch_assoc($register_set)) { ?>
        <?php $page = find_page_by_id($register['page_id'], ['visible' => false]); ?>
        <tr>
          <td><?php echo h($register['id']); ?></td>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($register['check_in']); ?></td>
          <td><?php echo h($register['check_out']); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/registers/show.php?id=' . h(u($register['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/registers/edit.php?id=' . h(u($register['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/registers/delete.php?id=' . h(u($register['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php mysqli_free_result($register_set); ?>


  </div>

</div>