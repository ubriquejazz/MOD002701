
<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$member = find_member_by_id($id);

?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php
if (isset($_POST['submit'])) {

  $delete_register = (int) $_POST["delete_register"];
  $new_register = (int) $_POST["new_register"];
  $result = 0;

  if ($delete_register > 0){
    $query  = "DELETE FROM registers ";
    $query .= "WHERE  user_id = '{$member["id"]}' ";
    $query .= "AND page_id = '{$delete_register}'";
        
    echo $query;
    $result = mysqli_query($connection, $query);
  }

  if ($new_register > 0){
    $query  = "INSERT INTO registers (";
    $query .= "  user_id, page_id";
    $query .= ") VALUES (";
    $query .= "  '{$member["id"]}', '{$new_register}'";
    $query .= ")";
    echo $query;
    $result = mysqli_query($connection, $query);
  }

  if ($result) {
    // Success
    $_SESSION["message"] = "Register list updated.";
    redirect_to("edit_registers.php?id=" . u($member["id"]));
  } else {
    // Failure
    $_SESSION["message"] = "Register creation failed.";
  }

} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php');?>">&laquo; Back to List</a>

  <div class="admin show">

    <?php echo display_errors($errors); ?>
    
    <h2>User's registers: <?php echo $member["first_name"] . $member["last_name"];?></h2>
    <ul>
      <?php 
        $user_registers = find_registers_for_user($member["id"]);
        while($response = mysqli_fetch_assoc($user_registers)) {
          $register_id = $response["id"];
          $register = find_register_by_id($register_id);
          echo "<li>";
          echo h($register["page_id"]);
          echo "</li>";
        }
      ?>
    </ul>

    <form action="edit_registers.php?id=<?php echo u($member["id"]); ?>" method="post">
      <p> Delete register:
        <select name="delete_register">
        <?php
           echo "<option value=\"0\">None</option>";
           $user_registers = find_registers_for_user($member["id"]);
           while($response = mysqli_fetch_assoc($user_registers)) {
              $register_id = $response["id"];
              $register = find_register_by_id($register_id);
              echo "<option value=\"{$register["page_id"]}\">{$register["page_id"]}</option>";
           }
           mysqli_free_result($user_set);
        ?>
        </select>
      </p>

      <p> New register:
        <select name="new_register">
        <?php
           echo "<option value=\"0\">None</option>";
           $pages_set = find_all_pages();
           while($page = mysqli_fetch_assoc($pages_set)) {
              echo "<option value=\"{$page["id"]}\">{$page["menu_name"]}</option>";
              //echo "<option value=\'12\''>{$page["menu_name"]}</option>";
           }
           mysqli_free_result($pages_set);
        ?>
        </select>
      </p>
      <input type="submit" name="submit" value="Update list of skills" />
    </form>

    <br />
    <a href="show.php?id=<?php echo u($member["id"]); ?>">Cancel</a>
    
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
