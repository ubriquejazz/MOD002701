<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
	if (!$current_skill) {
		// skill ID was missing or invalid or 
		// skill couldn't be found in database
		redirect_to("manage_content.php");
	}
?>

<?php
if (isset($_POST['submit'])) {
	// Process the form
	
	// validations
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if (empty($errors)) {
		
		// Perform Update

		$id = $current_skill["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
	
		$query  = "UPDATE skills SET ";
		$query .= "menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible} ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);

		if ($result && mysqli_affected_rows($connection) >= 0) {
			// Success
			$_SESSION["message"] = "skill updated.";
			redirect_to("manage_content.php");
		} else {
			// Failure
			$message = "skill update failed.";
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
		<?php echo navigation($current_skill, $current_page); ?>
  </div>
  <div id="page">
		<?php // $message is just a variable, doesn't use the SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
		?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit skill: <?php echo htmlentities($current_skill["menu_name"]); ?></h2>
		<form action="edit_skill.php?skill=<?php echo urlencode($current_skill["id"]); ?>" method="post">
		  <p>Menu name:
		    <input type="text" name="menu_name" value="<?php echo htmlentities($current_skill["menu_name"]); ?>" />
		  </p>
		  <p>Position:
		    <select name="position">
				<?php
					$skill_set = find_all_skills(false);
					$skill_count = mysqli_num_rows($skill_set);
					for($count=1; $count <= $skill_count; $count++) {
						echo "<option value=\"{$count}\"";
						if ($current_skill["position"] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
				?>
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" <?php if ($current_skill["visible"] == 0) { echo "checked"; } ?> /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" <?php if ($current_skill["visible"] == 1) { echo "checked"; } ?>/> Yes
		  </p>
		  <input type="submit" name="submit" value="Edit skill" />
		</form>
		<br />
		<a href="manage_content.php">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_skill.php?skill=<?php echo urlencode($current_skill["id"]); ?>" onclick="return confirm('Are you sure?');">Delete skill</a>
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
