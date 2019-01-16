<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>

<div id="main">
  <div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		
		<?php echo navigation($current_skill, $current_page); ?>
		<br />
		<a href="new_skill.php">+ Add a skill</a>
  </div>
  <div id="page">
		<?php echo message(); ?>
		<?php if ($current_skill) { ?>
	    <h2>Manage Skill</h2>
			Menu name: <?php echo htmlentities($current_skill["menu_name"]); ?><br />
			Position: <?php echo $current_skill["position"]; ?><br />
			Visible: <?php echo $current_skill["visible"] == 1 ? 'yes' : 'no'; ?><br />
			<br />
			<a href="edit_skill.php?skill=<?php echo urlencode($current_skill["id"]); ?>">Edit Skill</a>
			
			<div style="margin-top: 2em; border-top: 1px solid #000000;">
				<h3>Pages in this skill:</h3>
				<ul>
				<?php 
					$skill_pages = find_pages_for_skill($current_skill["id"]);
					while($page = mysqli_fetch_assoc($skill_pages)) {
						echo "<li>";
						$safe_page_id = urlencode($page["id"]);
						echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
						echo htmlentities($page["menu_name"]);
						echo "</a>";
						echo "</li>";
					}
				?>
				</ul>
				<br />
				+ <a href="new_page.php?skill=<?php echo urlencode($current_skill["id"]); ?>">Add a new page to this skill</a>
			</div>

		<?php } elseif ($current_page) { ?>
			<h2>Manage Request</h2>
			Menu name: <?php echo htmlentities($current_page["menu_name"]); ?><br />
			Position: <?php echo $current_page["position"]; ?><br />
			Visible: <?php echo $current_page["visible"] == 1 ? 'yes' : 'no'; ?><br />
			Content:<br />
			<div class="view-content">
				<?php echo htmlentities($current_page["content"]); ?>
			</div>
			<br />
		    <table>
		      <tr>
		        <th style="text-align: left; width: 90px;"></th>
		        <th style="text-align: left; width: 90px;">User</th>
		        <th colspan="2" style="text-align: left;">Feedback</th>
		      </tr>	 
		      <tr>
		      	<td> Inquirer </td>
		        <td><?php echo find_username($current_page["inquirer"]); ?></td>
		        <td><?php echo htmlentities($current_page["rate_inq"]); ?></td>
		      </tr>
		      <tr>
				<td> Contributor </td>      
		        <td><?php echo find_username($current_page["contributor"]); ?></td>
		        <td><?php echo htmlentities($current_page["rate_cont"]); ?></td>
		      </tr>
		    </table>

      <br />
      <a href="edit_page.php?page=<?php echo urlencode($current_page['id']); ?>">Edit request</a>
	  	<?php } else { ?>
			<h2>Manage Content</h2>
			Please select a skill or a page.
		<?php }?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
