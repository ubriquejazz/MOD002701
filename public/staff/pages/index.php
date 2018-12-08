<?php require_once('../../../private/initialize.php'); ?>

<?php

  require_login();
  $page_set = find_all_pages();

?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="pages listing">
    <h1>Pages</h1>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>Visible</th>
  	    <th>Name</th>
  	  </tr>

      <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
        <?php $subject = find_subject_by_id($page['subject_id'], ['visible' => false]); ?>
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($subject['menu_name']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($page['menu_name']); ?></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($page_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
