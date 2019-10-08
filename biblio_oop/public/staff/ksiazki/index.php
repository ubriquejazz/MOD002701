<?php

  require_once('../../../private/initialize.php');
  require_login(); 

  $current_page = $_GET['page'] ?? 1;
  $per_page = 20;
  $total_count = Ksiazka::count_all();
  $pagination = new Pagination($current_page, $per_page, $total_count);

  // Find all ksiazki; use pagination instead
  $ksiazki = Ksiazka::find_by_category('Mountain');

  $sql = "SELECT * FROM ksiazki ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $ksiazki = Ksiazka::find_by_sql($sql);

?>

<?php $page_title = 'Books'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="bicycle listing">
    <h1>Books</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/ksiazki/new.php'); ?>">Add Book</a>
    </div>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Year</th>
        <th>Category</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($ksiazki as $ksiazka) { ?>
        <tr>
          <td><?php echo h($ksiazka->id); ?></td>
          <td><?php echo h($ksiazka->title); ?></td>
          <td><?php echo h($ksiazka->year); ?></td>
          <td><?php echo h($ksiazka->category); ?></td>
          <td><?php echo h($ksiazka->author()); ?></td>
          <td><?php echo h($ksiazka->publisher); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/ksiazki/show.php?id=' . h(u($ksiazka->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/ksiazki/edit.php?id=' . h(u($ksiazka->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/ksiazki/delete.php?id=' . h(u($ksiazka->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
    $url = url_for('/staff/ksiazki/index.php');
    echo $pagination->page_links($url);
    ?>

  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
