<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_user(false); ?>

<?php
  // Can't edit this page unless we have a user as a parent!
  if (!$current_user) {
    // page ID was missing or invalid or 
    // page couldn't be found in database
    redirect_to("manage_user.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  $delete_skill = (int) $_POST["delete_skill"];
  $new_skill = (int) $_POST["new_skill"];
  $result = 0;

  if ($delete_skill > 0){

    $pages_set = find_pages_for_skill($delete_skill);
    if (mysqli_num_rows($pages_set) > 0) {
      $_SESSION["message"] = "Can't delete a skill with pages.";
      redirect_to("edit_skill_list.php?user=" . urlencode($current_user["id"]));
    }
    else {
        $query  = "DELETE FROM skilL_list ";
        $query .= "WHERE  user_id = '{$current_user["id"]}' ";
        $query .= "AND skill_id = '{$delete_skill}';";
        $result = mysqli_query($connection, $query);
    }
  }

  if ($new_skill > 0){
    $query  = "INSERT INTO skill_list (";
    $query .= "  user_id, skill_id";
    $query .= ") VALUES (";
    $query .= "  '{$current_user["id"]}', {$new_skill}";
    $query .= ")";
    $result = mysqli_query($connection, $query);
  }

  if ($result) {
    // Success
    $_SESSION["message"] = "Skill list updated.";
    redirect_to("edit_skill_list.php?user=" . urlencode($current_user["id"]));
  } else {
    // Failure
    $_SESSION["message"] = "Skill creation failed.";
  }

} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_user(false); ?>

<div id="main">
  <div id="navigation">
    <?php echo user_nav($current_user); ?>
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>User's skills: <?php echo find_username($current_user["id"]);?></h2>
    <ul>
    <?php 
      $user_skills = find_skills_for_user($current_user["id"]);
      while($response = mysqli_fetch_assoc($user_skills)) {
        $skill_id = $response["skill_id"];
        $skill = find_skill_by_id($skill_id, false);
        echo "<li>";
        echo htmlentities($skill["menu_name"]);
        echo "</li>";
      }
    ?>
    </ul>
    <form action="edit_skill_list.php?user=<?php echo urlencode($current_user["id"]); ?>" method="post">
      <p> Delete skill:
        <select name="delete_skill">
        <?php
           echo "<option value=\"0\">None</option>";
           $user_skills = find_skills_for_user($current_user["id"]);
           while($response = mysqli_fetch_assoc($user_skills)) {
              $skill_id = $response["skill_id"];
              $skill = find_skill_by_id($skill_id, false);
              echo "<option value=\"{$skill["id"]}\">{$skill["menu_name"]}</option>";
           }
           mysqli_free_result($user_set);
        ?>
        </select>
      </p>
      <p> New skill:
        <select name="new_skill">
        <?php
           echo "<option value=\"0\">None</option>";
           $skill_set = find_all_skills(false);
           while($skill = mysqli_fetch_assoc($skill_set)) {
              echo "<option value=\"{$skill["id"]}\">{$skill["menu_name"]}</option>";
           }
           mysqli_free_result($user_set);
        ?>
        </select>
      </p>
      <input type="submit" name="submit" value="Update list of skills" />
    </form>
    <br />
    <a href="manage_user.php?user=<?php echo urlencode($current_user["id"]); ?>">Cancel</a>
    <br /> <br />
    (*) You can not delete a skill where there are requests hanging from.
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

