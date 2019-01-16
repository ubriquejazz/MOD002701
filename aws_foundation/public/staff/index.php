<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <h2>Admin Menu</h2>
    <p>Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
    <ul>
      <li><a href="manage_content.php">Manage Website Content</a></li>
      <li><a href="manage_user.php">Manage Website Users</a></li>
      <li><a href="manage_admins.php">Manage Admin Users</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
      <div style="margin-top: 2em; border-top: 1px solid #000000;">
        <h3>Comments from the users:</h3>
        <?php
          //
          $read = fopen("images/comments.txt", "r+t");
          echo fread($read, 1024);
          fclose($read);
        ?>
        <h3>Feedbacks from the users:</h3>
        <?php
          //
          $read = fopen("images/feedbacks.txt", "r+t");
          echo fread($read, 1024);
          fclose($read);
        ?>
      </div>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
