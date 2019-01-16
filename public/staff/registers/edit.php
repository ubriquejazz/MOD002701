<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/registers/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $register = [];
  $register['id'] = $id;
  $register['user_id'] = $_POST['user_id'] ?? '';
  $register['page_id'] = $_POST['page_id'] ?? '';
  $register['check_in'] = $_POST['check_in'] ?? '';
  $register['check_out'] = $_POST['check_out'] ?? '';

  $result = update_register($register);
  if($result === true) {
    $_SESSION['message'] = 'The register was updated successfully.';
    redirect_to(url_for('/staff/registers/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $register = find_register_by_id($id);
}

?>

<?php $page_title = 'Edit Register'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($register['user_id']))); ?>">&laquo; Back to Subject register</a>

  <div class="page edit">
    <h1>Edit Register</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/registers/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Id</dt>
        <dd>
          <input type="number" name="id" disabled value="<?php echo h($register['id']); ?>" />
        </dd>
      </dl>  
      <dl>
        <dt>Page</dt>
        <dd>
          <input type="number" name="page_id" disabled value="<?php echo h($register['page_id']); ?>" />
        </dd>
      </dl>                   
      <dl>
        <dt>Check In</dt>
        <dd><input type="text" name="check_in" value="<?php echo h($register['check_in']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Check Out</dt>
        <dd><input type="text" name="check_out" value="<?php echo h($register['check_out']); ?>" /></dd>
      </dl>
      <hr/>
      <div id="operations">
        <input type="submit" value="Edit register" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
