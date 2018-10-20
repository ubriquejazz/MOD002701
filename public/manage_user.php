<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_user(false); ?>

<div id="main">
  <div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		
		<?php echo user_nav($current_user); ?>
		<br />
		<a href="new_user.php">+ Add an user</a>
  </div>
  <div id="page">
		<?php echo message(); ?>
		<?php if ($current_user) { ?>
			<h2>Manage User</h2>
			<table>
			<tr><td>
				Email: <?php echo $current_user["email"]; ?><br />
				Area: <?php echo $area[$current_user["area"]]; ?><br />
				Visible: <?php echo $current_user["visible"] == 1 ? 'yes' : 'no'; ?><br />
				Address:<br />
				<div class="view-content">
					<?php echo htmlentities($current_user["address"]); ?>
				</div>
			</td>
			<td>
				<img src="images/female.png" alt="Avatar" style="width:150px;height:110px;">
			</td></tr>
			</table>
			<br />
	      	<a href="edit_user.php?user=<?php echo urlencode($current_user['id']); ?>">Edit user</a>
		  	<div style="margin-top: 2em; border-top: 1px solid #000000;">
				<h3>Skills of this user:</h3>
				<ul>
				<?php 
					$user_skills = find_skills_for_user($current_user["id"], false);
					while($response = mysqli_fetch_assoc($user_skills)) {
						$skill_id = $response["skill_id"];
						$skill = find_skill_by_id($skill_id, false);
						echo "<li>";
						echo "<a href=\"manage_content.php?skill={$skill_id}\">";
						echo htmlentities($skill["menu_name"]);
						echo "</a>";
						echo "</li>";
					}
				?>
				</ul>
				<br />
				+ <a href="edit_skill_list.php?user=<?php echo urlencode($current_user["id"]); ?>">Edit skills</a>
			</div>
		  	<div style="margin-top: 2em; border-top: 1px solid #000000;">
				<h3>Feedbacks for this user:</h3>
				<ul>
				<?php
					echo "<li> N = ";
					$inquires_set = find_inquires($current_user["id"]);
					$N = mysqli_num_rows($inquires_set);
					echo $N . " inquires + ";
					$contributions_set = find_contributions($current_user["id"]);
					echo mysqli_num_rows($contributions_set);
					$N += mysqli_num_rows($contributions_set);
					echo " contributions </li>";

					echo "<li> Rate = ";
					$rate_inq = 0;
					while ($response = mysqli_fetch_assoc($inquires_set)){
						$rate_inq += $response["rate_inq"];
					}
					echo $rate_inq . " (inquirer) ";			
					$rate_cont = 0;
					while ($response = mysqli_fetch_assoc($contributions_set)){
						$rate_cont += $response["rate_cont"];
					}
					if ($rate_cont >= 0)
						echo "+ ";
					echo $rate_cont . " (contributor) </li>";
					$rate = 100 * ($rate_inq + $rate_cont) / $N;

					echo "<li> Positive Feedback = Rate / N x 100 = ";
					echo round($rate) . "% </li>";
				?>
				</ul>
			</div>	
		<?php } else { ?>
			<h2>Manage User</h2>
			Please select an user.
		<?php }?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
