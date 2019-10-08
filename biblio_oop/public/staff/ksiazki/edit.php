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
  // Save record using post parameters (HTML forms for OOP)
  $args = $_POST['ksiazka'];
  $ksiazka->merge_attributes($args);
  $result = $ksiazka->save();

  if($result === true) {
    $session->message('The book was updated successfully.');
    redirect_to(url_for('/staff/ksiazki/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {
  // display the form
}

?>

<?php $page_title = 'Edit Book'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/ksiazki/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Book</h1>

    <?php echo display_errors($ksiazka->errors); ?>

    <form action="<?php echo url_for('/staff/ksiazki/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit Book" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
