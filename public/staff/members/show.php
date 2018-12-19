<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$member = find_member_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
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

  </div>

</div>
