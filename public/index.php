<?php require_once('../private/initialize.php'); ?>

<?php
if(isset($_GET['id'])) {
  $subject_id = $_GET['id'];
  $subject = find_subject_by_id($subject_id);
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

  <div id="subject">

    <?php
      if(isset($subject)) {        
        // echo $page['content'];
        $nav_subjects = find_pages_by_subject_id($subject['id']);
    ?>
        <ul class="subjects">
          <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
            <li>
              <a href="<?php echo url_for('index.php?id=' . h(u($nav_subject['id'])) ); ?>">
                <?php echo h($nav_subject['menu_name']); ?>
              </a>
            </li>
          <?php } // while $nav_subjects ?>
        </ul>

    <?php
      } else {
        // Show the homepage
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
