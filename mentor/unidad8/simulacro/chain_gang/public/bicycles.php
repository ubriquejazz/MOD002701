<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/images/AdobeStock_55807979_thumb.jpeg') ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Condition</th>
        <th>Price</th>
      </tr>

    <?php

      $parser = new ParseCSV(PRIVATE_PATH . '/used_bicycles.csv');
      $bike_array = $parser->parse();

      foreach ($bike_array as $args) {
          $bike = new Bicycle($args);
          echo "<tr><td>";
          echo h($bike->brand) . "</td><td>";
          echo h($bike->model) . "</td><td>";
          echo h($bike->year) . "</td><td>";
          echo h($bike->category) . "</td><td>";
          echo h($bike->gender) . "</td><td>";
          echo h($bike->color) . "</td><td>";
          echo h($bike->weight_kg()) . ' / ' . h($bike->weight_lbs()) ."</td><td>";
          echo h($bike->condition()) ."</td><td>";
          echo "$" . number_format(h($bike->price), 2) . "</td></tr>";  
      }
    ?>

    </table>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
