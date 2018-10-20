<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_user = find_user_by_id($_GET["user"]);
	if (!$current_user) {
		// user ID was missing or invalid or 
		// user couldn't be found in database
		redirect_to("manage_user.php");
	}

	$user_skills = find_skills_for_user($current_user["id"]);
	if (mysqli_num_rows($user_skills) > 0) {
		$_SESSION["message"] = "Can't delete an user with skills.";
		redirect_to("manage_user.php?user={$current_user["id"]}");
	}
	
	$id = $current_user["id"];
	$query = "DELETE FROM users WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);

	if ($result && mysqli_affected_rows($connection) == 1) {
		// Success
		$_SESSION["message"] = "user deleted.";
		redirect_to("manage_user.php");
	} else {
		// Failure
		$_SESSION["message"] = "user deletion failed.";
		redirect_to("manage_user.php?user={$id}");
	}
	
?>
