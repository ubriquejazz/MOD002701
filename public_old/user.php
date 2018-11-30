<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <h2>User Menu</h2>
    <p>Welcome to the user area, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
    <ul>
      <li><a href="show_page.php?inquirer=0">My inquires</a></li>
      <li><a href="show_page.php?inquirer=1">My contributions</a></li>
      <li><a href="show_user.php">My details</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
