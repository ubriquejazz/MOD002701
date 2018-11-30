<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php 

$user1 = $_SESSION["user_id"];

if (isset($_POST['submit'])) {

  	// Process the form
  	$user2 = $_POST["user2"];
  	$subject = $_POST["subject"];
  	$request = $_POST["request"];
	$feedback = $_POST["feedback"];

	$old = fopen("images/feedbacks.txt", "r+t");
	$old_feedbacks = fread($old, 1024);
	fclose($old);

	$write = fopen ("images/feedbacks.txt", "w+");
	$string = "<b>User1:</b> " . $user1 . "; <b>User2:</b> " . $user2 
			. "; <b>Subject:</b> " . $subject . "; <b>Request:</b> " . $request . "<br>" 
			. $feedback. "<br>\n" . $old_feedbacks;
	fwrite($write, $string);
	fclose($write);

	// Failure
	$_SESSION["message"] = "Email sent, your feedback will be taken into account. Thanks!";
	redirect_to("user.php");

} else {
  // This is probably a GET request

	if (isset($_GET["role"])) {	
		$current_role = $_GET["role"];
	} else {
		$current_role = "2"; // default
	}	

} // end: if (isset($_POST['submit']))

?>

<div id="main">
  <div id="navigation">
		<br />
		<a href="show_page.php?inquirer="<?php echo $current_role;?>>&laquo; Back</a><br/>
  </div>
  <div id="page">

	<h2>Feedback</h2>
    <form action="feedback.php" method="post">
      <table>
        <td> From(*): 
        	<input type="text" name="user1" value="<?php echo $user1; ?>" readonly />
        </td>
        <td> To: 
        	<input type="text" name="user2" value="User ID" />	
		</td>
      </table>
      <p>Subject:
		<?php
			if ($current_role == "1") {
				$subject = "feedback to an inquirer";
			} elseif ($current_role == "0") {
				$subject = "feedback to a contributor";
			} else {
				$subject = "edit subject";
			}
		?>
        <input type="text" name="subject" value="<?php echo $subject; ?>" />
      </p>
       <p>Request:
        <input type="text" name="request" />
      </p>   
      <p>Feedback:<br />
        <textarea name="feedback" rows="5" cols="80"></textarea>
      </p>
      <input type="submit" name="submit" value="Submit" />
    </form>
    <br><br>
    (*) This field is not editable (internal use only)
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>