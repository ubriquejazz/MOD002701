<?php

require_once('../../../private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/ksiazki/index.php'));
}
$id = $_GET['id'];
$ksiazka = Ksiazka::find_by_id($id);
if($ksiazka == false) {
  redirect_to(url_for('/staff/ksiazki/index.php'));
}

if(is_post_request()) {
  // Delete ksiazka
  $result = $ksiazka->delete();
  $session->message('The book was deleted successfully.');
  redirect_to(url_for('/staff/ksiazki/index.php'));
} else {
  // Display form
}

?>

<?php $page_title = 'Delete Book'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/ksiazki/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle delete">
    <h1>Delete Book</h1>
    <p>Are you sure you want to delete this book?</p>
    <p class="item"><?php echo h($ksiazka->name()); ?></p>

    <form action="<?php echo url_for('/staff/ksiazki/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Book" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
