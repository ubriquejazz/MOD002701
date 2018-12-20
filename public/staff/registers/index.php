<?php require_once('../../../private/initialize.php'); ?>

<?php

  require_login();
  $register_set = find_all_registers();

?>

<?php $register_title = 'Registers'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Registers</h1>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Member</th>
        <th>Book</th>
        <th>Check-in</th>
  	    <th>Check-out</th>
  	  </tr>

      <?php while($register = mysqli_fetch_assoc($register_set)) { ?>
        <?php $member = find_member_by_id($register['user_id']); ?>
        <?php $page = find_page_by_id($register['page_id']); ?>
        <tr>
          <td><?php echo h($register['id']); ?></td>
          <td><?php echo h($member['id']); ?></td>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($register['check_in']); ?></td>         
    	    <td><?php echo h($register['check_out']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($register_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
