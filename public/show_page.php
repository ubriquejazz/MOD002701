<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php 

	$current_user = $_SESSION["user_id"];

	if (isset($_GET["inquirer"])) {	
		$inquirer = $_GET["inquirer"];
	} else {
		$inquirer = "1"; // contributor (default)
	}
	if (isset($_GET["page"])) {
		$current_page = find_page_by_id($_GET["page"], false);
	} else {
		$current_page = null;
	}
?>

<div id="main">
  <div id="navigation">
		<br />
		<a href="user.php">&laquo; Main menu</a><br />
		
		<?php 
			echo user_request_nav($current_page, $inquirer, $current_user); 
		?>
  </div>
  <div id="page">
		<?php if ($current_page) { ?>
			<h2>Request Information</h2>
			Reference: <?php echo htmlentities($current_page["menu_name"]); ?><br />
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
    
      	<?php } else { ?>
			<h2>User: <?php echo htmlentities($_SESSION["username"]); ?></h2>
			Please select a page.
		<?php }?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
