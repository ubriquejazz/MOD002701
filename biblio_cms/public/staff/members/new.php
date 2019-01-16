<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
  $subject = [];
  $member['first_name'] = $_POST['first_name'] ?? '';
  $member['last_name'] = $_POST['last_name'] ?? '';
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';

  $result = insert_member($member);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'Member created.';
    redirect_to(url_for('/staff/members/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $member = [];
  $member["first_name"] = '';
  $member["last_name"] = '';
  $member["email"] = '';
  $member["phone"] = '';
}

?>

<?php $page_title = 'Create Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create Member</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/members/new.php'); ?>" method="post">
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
        <dt>Email </dt>
        <dd><input type="text" name="email" value="<?php echo h($member['email']); ?>" /><br /></dd>
      </dl>

      <br/>

      <div id="operations">
        <input type="submit" value="Create Member" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
