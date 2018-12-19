<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
	// Process the form
	
	$email = mysql_prep($_POST["email"]);
	$area = (int) $_POST["area"];
	$visible = (int) $_POST["visible"];
	$address = mysql_prep($_POST["address"]);
	
	// validations
	$required_fields = array("email", "area", "visible", "address");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("email" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("new_user.php");
	}
	
	$query  = "INSERT INTO users (";
	$query .= "  email, area, visible, address";
	$query .= ") VALUES (";
	$query .= "  '{$email}', {$area}, {$visible}, '{$address}'";
	$query .= ")";
	$result = mysqli_query($connection, $query);

	if ($result) {
		// Success
		$_SESSION["message"] = "user created.";
		redirect_to("manage_user.php");
	} else {
		// Failure
		$_SESSION["message"] = "user creation failed.";
		redirect_to("new_user.php");
	}
	
} else {
	// This is probably a GET request
	redirect_to("new_user.php");
}

?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
