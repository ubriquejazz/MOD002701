<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_user(false); ?>

<?php
	if (!$current_user) {
		// user ID was missing or invalid or 
		// it couldn't be found in database
		redirect_to("manage_user.php");
	}
?>

<?php
if (isset($_POST['submit'])) {
	
	// validations
	$required_fields = array("email", "area", "visible", "address");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("email" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		
		// Perform Update
		$id = $current_user["id"];
		$email = mysql_prep($_POST["email"]);
		$area = (int) $_POST["area"];
		$visible = (int) $_POST["visible"];
		$address = mysql_prep($_POST["address"]);
	
		$query  = "UPDATE users SET ";
		$query .= "email = '{$email}', ";
		$query .= "area = {$area}, ";
		$query .= "visible = {$visible}, ";
		$query .= "address = '{$address}' ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);

		if ($result && mysqli_affected_rows($connection) >= 0) {
			// Success
			$_SESSION["message"] = "user updated.";
			redirect_to("manage_user.php");
		} else {
			// Failure
			$message = "user update failed.";
		}
	
	}
} else {
	// This is probably a GET request
	
} // end: if (isset($_POST['submit']))

?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
		<?php echo user_nav($current_user); ?>
  </div>
  <div id="page">
		<?php // $message is just a variable, doesn't use the SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
		?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit user: <?php echo htmlentities($current_user["email"]); ?></h2>
		<form action="edit_user.php?user=<?php echo urlencode($current_user["id"]); ?>" method="post">
		  <p>Email:
		    <input type="text" name="email" value="<?php echo htmlentities($current_user["email"]); ?>" />
		  </p>
	      <p>Area:
	        <select name="area">
	        <?php
	          for($count=0; $count < sizeof($area); $count++) {
	            echo "<option value=\"{$count}\"";
	            if ($current_user["area"] == $count) {
	              echo " selected";
	            }
	            echo ">{$area[$count]}</option>";
	          }
	        ?>
	        </select>
	      </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" <?php if ($current_user["visible"] == 0) { echo "checked"; } ?> /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" <?php if ($current_user["visible"] == 1) { echo "checked"; } ?>/> Yes
		  </p>
	      <p>Address:<br>
	        <textarea name="address" rows="3" cols="80"><?php echo htmlentities($current_user["address"]); ?></textarea>
	      </p>
	      <p> Photo: <input type="file" name="fileToUpload" id="fileToUpload">
	      </p>
		  <input type="submit" name="submit" value="Edit user" />
		</form>
		<br />
		<a href="manage_user.php?user=<?php echo urlencode($current_user["id"]); ?>">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_user.php?user=<?php echo urlencode($current_user["id"]); ?>" onclick="return confirm('Are you sure?');">Delete user</a>

	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
