<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
  // Can't add a new page unless we have a skill as a parent!
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
  $required_fields = array("menu_name", "position", "inquirer", "visible", "content");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    // Perform Create

    // make sure you add the skill_id!
    $skill_id = $current_skill["id"];
    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int) $_POST["position"];
    $inquirer = (int) $_POST["inquirer"];
    $contributor = (int) $_POST["contributor"];
    $visible = (int) $_POST["visible"];
    // be sure to escape the content
    $content = mysql_prep($_POST["content"]);
  
    $query  = "INSERT INTO pages (";
    $query .= "  skill_id, menu_name, position, inquirer, contributor, visible, content";
    $query .= ") VALUES (";
    $query .= "  {$skill_id}, '{$menu_name}', {$position}, {$inquirer}, {$contributor}, {$visible}, '{$content}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Page created.";
      redirect_to("manage_content.php?skill=" . urlencode($current_skill["id"]));
    } else {
      // Failure
      $_SESSION["message"] = "Page creation failed.";
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
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    <h2>Create Page</h2>
    <form action="new_page.php?skill=<?php echo urlencode($current_skill["id"]); ?>" method="post">
      <p>Menu name:
        <input type="text" name="menu_name" value="" />
      </p>
      <p>Position:
        <select name="position">
        <?php
          $page_set = find_pages_for_skill($current_skill["id"]);
          $page_count = mysqli_num_rows($page_set);
          for($count=1; $count <= ($page_count + 1); $count++) {
            echo "<option value=\"{$count}\">{$count}</option>";
          }
        ?>
        </select>
      </p>
      <p>Inquirer:
        <select name="inquirer">
        <?php
           $user_set = find_all_users(true);
           while ($user = mysqli_fetch_assoc($user_set)){
              $email = htmlentities($user["email"]);
              $uname = explode("@", $email);
              echo "<option value=\"{$user["id"]}\">{$uname[0]}</option>";
           }
           mysqli_free_result($user_set);
        ?>
        </select>
      </p>
      <p>Contributor:
        <select name="contributor">
        <?php
           $user_set = find_users_for_skill($current_skill["id"], false);
           while ($response = mysqli_fetch_assoc($user_set)){
              $user_id = $response["user_id"];
              $user = find_user_by_id($user_id);
              $email = htmlentities($user["email"]);
              $uname = explode("@", $email);
              echo "<option value=\"{$user["id"]}\">{$uname[0]}</option>";
           }
           mysqli_free_result($user_set);
        ?>
        </select>
      </p>
      <p>Visible:
        <input type="radio" name="visible" value="0" /> No
        &nbsp;
        <input type="radio" name="visible" value="1" /> Yes
      </p>
      <p>Content:<br />
        <textarea name="content" rows="15" cols="80"></textarea>
      </p>
      <input type="submit" name="submit" value="Create Page" />
    </form>
    <br />
    <a href="manage_content.php?skill=<?php echo urlencode($current_skill["id"]); ?>">Cancel</a>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
