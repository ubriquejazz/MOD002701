<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
  // Unlike new_page.php, we don't need a skill_id to be sent
  // We already have it stored in pages.skill_id.
  if (!$current_page) {
    // page ID was missing or invalid or 
    // page couldn't be found in database
    redirect_to("manage_content.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  $id = $current_page["id"];
  $menu_name = mysql_prep($_POST["menu_name"]);
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];
  $content = mysql_prep($_POST["content"]);
  $inquirer = (int) $_POST["inquirer"];
  $contributor = (int) $_POST["contributor"];
  $rate_inq = (int) $_POST["rate_inq"];
  $rate_cont = (int) $_POST["rate_cont"];

  // validations
  $required_fields = array("menu_name", "position", "visible", "content", 
                     "inquirer", "contributor", "rate_inq", "rate_cont");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    
    // Perform Update

    $query  = "UPDATE pages SET ";
    $query .= "menu_name = '{$menu_name}', ";
    $query .= "position = {$position}, ";
    $query .= "inquirer = {$inquirer}, ";
    $query .= "rate_inq = {$rate_inq}, ";
    $query .= "contributor = {$contributor}, ";
    $query .= "rate_cont = {$rate_cont}, ";
    $query .= "visible = {$visible}, ";
    $query .= "content = '{$content}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Request updated.";
      redirect_to("manage_content.php?page={$id}");
    } else {
      // Failure
      $_SESSION["message"] = "Request update failed.";
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
    
    <h2>Edit Request: <?php echo htmlentities($current_page["menu_name"]); ?></h2>
    <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
      <p>Menu name:
        <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>" />
      </p>
      <p>Position:
        <select name="position">
        <?php
          $page_set = find_pages_for_skill($current_page["skill_id"]);
          $page_count = mysqli_num_rows($page_set);
          for($count=1; $count <= $page_count; $count++) {
            echo "<option value=\"{$count}\"";
            if ($current_page["position"] == $count) {
              echo " selected";
            }
            echo ">{$count}</option>";
          }
        ?>
        </select>
      </p>
      <p>Visible:
        <input type="radio" name="visible" value="0" <?php if ($current_page["visible"] == 0) { echo "checked"; } ?> /> No
        &nbsp;
        <input type="radio" name="visible" value="1" <?php if ($current_page["visible"] == 1) { echo "checked"; } ?>/> Yes
      </p> 
      <p>Content:<br />
        <textarea name="content" rows="10" cols="80"><?php echo htmlentities($current_page["content"]); ?></textarea>
      </p>
      <table>
          <tr>
            <th style="text-align: left; width: 90px;"></th>
            <th style="text-align: left; width: 120px;">User</th>
            <th colspan="2" style="text-align: left;">Feedback</th>
          </tr>
          <tr>
            <td>Inquirer </td>
            <td> 
              <select name="inquirer"><?php echo find_inquirer();?></select>
            </td>
            <td><p>
                <input type="radio" name="rate_inq" value="-1" <?php if ($current_page["rate_inq"] == -1) { echo "checked"; } ?> /> -
                &nbsp;
                <input type="radio" name="rate_inq" value="0" <?php if ($current_page["rate_inq"] == 0) { echo "checked"; } ?> /> =
                &nbsp;
                <input type="radio" name="rate_inq" value="1" <?php if ($current_page["rate_inq"] == 1) { echo "checked"; } ?>/> +
            </p></td>
          </tr>
          <tr>
            <td>Contributor </td>
            <td>
              <select name="contributor"><?php echo find_contributor();?></select>
            </td>
            <td><p>
                <input type="radio" name="rate_cont" value="-1" <?php if ($current_page["rate_cont"] == -1) { echo "checked"; } ?> /> -
                &nbsp;
                <input type="radio" name="rate_cont" value="0" <?php if ($current_page["rate_cont"] == 0) { echo "checked"; } ?> /> =
                &nbsp;
                <input type="radio" name="rate_cont" value="1" <?php if ($current_page["rate_cont"] == 1) { echo "checked"; } ?>/> +
            </p></td>
          </tr>
      </table>
      <br />
      <input type="submit" name="submit" value="Edit Page" />
    </form>
    <br />
    <a href="manage_content.php?page=<?php echo urlencode($current_page["id"]); ?>">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete_page.php?page=<?php echo urlencode($current_page["id"]); ?>" onclick="return confirm('Are you sure?');">Delete request</a>
    
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
