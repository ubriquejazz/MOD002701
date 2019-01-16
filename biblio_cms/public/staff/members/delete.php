<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/members/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $result = delete_member($id);
  $_SESSION['message'] = 'Admin deleted.';
  redirect_to(url_for('/staff/members/index.php'));
} else {
  $member = find_member_by_id($id);
}

?>

<?php $page_title = 'Delete Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin delete">
    <h1>Delete member</h1>
    <p>Are you sure you want to delete this member?</p>
    <p class="item"><?php echo h($member['email']); ?></p>

    <form action="<?php echo url_for('/staff/members/delete.php?id=' . h(u($member['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Member" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
