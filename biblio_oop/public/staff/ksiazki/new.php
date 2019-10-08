<?php

require_once('../../../private/initialize.php');
require_login();

if(is_post_request()) {

  // Create record using post parameters (HTML forms for OOP)
  $args = $_POST['ksiazka'];
  $ksiazka = new Ksiazka($args);
  $result = $ksiazka->save();

  if($result === true) {
    $new_id = $ksiazka->id;
    $session->message('The book was created successfully.');
    redirect_to(url_for('/staff/ksiazki/show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $ksiazka = new Ksiazka;
}

?>

<?php $page_title = 'Create Book'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/ksiazki/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle new">
    <h1>Create Book</h1>

    <?php echo display_errors($ksiazka->errors); ?>

    <form action="<?php echo url_for('/staff/ksiazki/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Book" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
