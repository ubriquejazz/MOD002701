<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php 

$current_user = $_SESSION["user_id"];

if (isset($_POST['submit'])) {

  	// Process the form
  	$subject = $_POST["subject"];
	$comment = $_POST["comment"];

	$old = fopen("images/comments.txt", "r+t");
	$old_comments = fread($old, 1024);
	fclose($old);

	$write = fopen ("images/comments.txt", "w+");
	$string = "<b>User:</b> " . $current_user . "; <b>Subject:</b> " . $subject 
			. "<br>" . $comment. "<br>\n" . $old_comments;
	fwrite($write, $string);
	fclose($write);

	// Failure
	$_SESSION["message"] = "Email sent, your request will be served asap.";
	redirect_to("user.php");

} else {
  // This is probably a GET request

	if (isset($_GET["role"])) {	
		$current_role = $_GET["role"];
	} else {
		$current_role = "1"; // contributor (default)
	}	

} // end: if (isset($_POST['submit']))

?>

<div id="main">
  <div id="navigation">
		<br />
		<a href="<?php 
			if ($current_role) {
				echo "show_page.php?inquirer=" . $current_role;
			} else {
				echo "show_user.php";
			}
			?>">&laquo; Back</a><br/>
  </div>
  <div id="page">

	<h2>Comment</h2>
    <form action="contact.php" method="post">
      <p>User (*):
        <input type="text" name="user1" value="<?php echo $current_user; ?>" readonly />
      </p>
      <p>Subject:
		<?php
			if ($current_role == "1") {
				$subject = "accept inquire";
			} elseif ($current_role == "2") {
				$subject = "new inquire";
			} elseif ($current_role == "0") {
				$subject = "modify my details";
			} else {
				$subject = "edit subject";
			}
		?>
        <input type="text" name="subject" value="<?php echo $subject; ?>" />
      </p>
      <p>Description:<br />
        <textarea name="comment" rows="5" cols="80"></textarea>
      </p>
      <input type="submit" name="submit" value="Submit" />
    </form>
    <br><br>
    (*) This field is not editable (internal use only)
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>