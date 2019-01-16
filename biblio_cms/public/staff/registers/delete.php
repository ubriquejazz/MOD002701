<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/registers/index.php'));
}
$id = $_GET['id'];
$register = find_register_by_id($id);

if(is_post_request()) {

  $result = delete_register($id);
  $_SESSION['message'] = 'The register was deleted successfully.';
  redirect_to(url_for('/staff/members/show.php?id=' . h(u($register['user_id']))));
}

?>

<?php $page_title = 'Delete register'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($register['user_id']))); ?>">&laquo; Back to user's register</a>

  <div class="page delete">
    <h1>Delete register</h1>
    <p>Are you sure you want to delete this register?</p>
    <p class="item"><?php echo h($register['id']); ?></p>

    <form action="<?php echo url_for('/staff/registers/delete.php?id=' . h(u($register['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete register" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
