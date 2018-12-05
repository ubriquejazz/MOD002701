<?php require_once('../private/initialize.php'); ?>

<?php

  if(isset($_GET['id'])) {
    $subject_id = $_GET['id'];
    $subject = find_subject_by_id($subject_id, ['visible' => false]);
    if(!$subject) {
      redirect_to(url_for('/index.php'));
    }
  } else {
    // nothing selected; show the homepage
  }
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <?php include(SHARED_PATH . '/public_navigation.php'); ?>

  <div id="page">

    <?php
      if(isset($subject)) {        
        $page_set = find_pages_by_subject_id($subject_id, ['visible'=>true]);
    ?>
        <table class="list">
          <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Tytuł</th>
            <th>Nazwisko</th>
            <th>Imię</th>
            <th>Roku</th>
            <th>Available</th>
            <th>Amount</th>
          </tr>
          <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
            <?php $subject = find_subject_by_id($page['subject_id']); ?>
            <tr>
              <td><?php echo h($page['id']); ?></td>
              <td><?php echo '900-123'; ?></td>
              <td><b><?php echo h($page['menu_name']); ?></b></td>
              <td> LastName </td>
              <td> FirstName </td>           
              <td> 2012 </td>
              <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
              <td><?php echo '1'; //echo h($page['content']); ?></td>
            </tr>
          <?php } ?>
        </table>

    <?php
      } else {
        // The homepage content could:
        // * be static content (here or in a shared file)
        // * show the first page from the nav
        // * be in the database but add code to hide in the nav
        include(SHARED_PATH . '/static_homepage.php');
      }
    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
