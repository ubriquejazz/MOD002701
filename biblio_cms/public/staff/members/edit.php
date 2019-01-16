<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/members/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $member = [];
  $member['id'] = $id;
  $member['first_name'] = $_POST['first_name'] ?? '';
  $member['last_name'] = $_POST['last_name'] ?? '';
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';

  $result = update_member($member);
  if($result === true) {
    $_SESSION['message'] = 'Member updated.';
    redirect_to(url_for('/staff/members/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $member = find_member_by_id($id);
}

?>

<?php $page_title = 'Edit Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Edit Member</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/members/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($member['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($member['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Phone</dt>
        <dd><input type="text" name="phone" value="<?php echo h($member['phone']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($member['email']); ?>" /><br /></dd>
      </dl>

      <br />

      <div id="operations">
        <input type="submit" value="Edit Member" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
