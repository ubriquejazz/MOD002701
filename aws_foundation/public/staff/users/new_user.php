<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

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
		
		<h2>Create user</h2>
		<form action="create_user.php" method="post">
		  <p>Email:
		    <input type="text" name="email" value="" />
		  </p>
	      <p>Area:
	        <select name="area">
	        <?php
	          for($count=0; $count < sizeof($area); $count++) {
	            echo "<option value=\"{$count}\">{$area[$count]}</option>";
	          }
	        ?>
	        </select>
	      </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" /> Yes
		  </p>
	      <p>Address:<br />
	        <textarea name="address" rows="3" cols="80"></textarea>
	      </p>
	      <p> Photo: <input type="file" name="fileToUpload" id="fileToUpload">
	      </p>
		  <input type="submit" name="submit" value="Create user" />
		</form>
		<br />
		<a href="manage_user.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
