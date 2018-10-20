<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_skill = find_skill_by_id($_GET["skill"], false);
	if (!$current_skill) {
		// skill ID was missing or invalid or 
		// skill couldn't be found in database
		redirect_to("manage_content.php");
	}
	
	$pages_set = find_pages_for_skill($current_skill["id"]);
	if (mysqli_num_rows($pages_set) > 0) {
		$_SESSION["message"] = "Can't delete a skill with pages.";
		redirect_to("manage_content.php?skill={$current_skill["id"]}");
	}

	$user_set = find_users_for_skill($current_skill["id"], false);
	if (mysqli_num_rows($user_set) > 0) {
		$_SESSION["message"] = "Can't delete a skill with users.";
		redirect_to("manage_content.php?skill={$current_skill["id"]}");
	}
	
	$id = $current_skill["id"];
	$query = "DELETE FROM skills WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);

	if ($result && mysqli_affected_rows($connection) == 1) {
		// Success
		$_SESSION["message"] = "skill deleted.";
		redirect_to("manage_content.php");
	} else {
		// Failure
		$_SESSION["message"] = "skill deletion failed.";
		redirect_to("manage_content.php?skill={$id}");
	}
	
?>
