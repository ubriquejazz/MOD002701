<?php 
  
  require_once('../../../private/initialize.php');
  require_login(); 
  
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $ksiazka = Ksiazka::find_by_id($id);

  // available? 
  $available = true;

?>

<?php $page_title = 'Show: ' . h($ksiazka->name()); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/ksiazki/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle show">

    <h1>Book: <?php echo h($ksiazka->title); ?></h1>

    <div class="attributes">

      <dl>
        <dt>Category</dt>
        <dd><?php echo h($ksiazka->category); ?></dd>
      </dl>
      <dl>
        <dt>ISBN</dt>
        <dd><?php echo h($ksiazka->isbn); ?></dd>
      </dl>

      <dl>
        <dt>Author</dt>
        <dd><?php echo h($ksiazka->author()); ?></dd>
      </dl>
      <dl>
        <dt>Publisher</dt>
        <dd><?php echo h($ksiazka->publisher); ?></dd>
      </dl>
      <dl>
        <dt>Year</dt>
        <dd><?php echo h($ksiazka->year); ?></dd>
      </dl>
      <dl>
        <dt>City</dt>
        <dd><?php echo h($ksiazka->city); ?></dd>
      </dl>
      <dl>
        <dt>Letter</dt>
        <dd><?php echo h($ksiazka->letter); ?></dd>
      </dl>
      <dl>
        <dt>Condition</dt>
        <dd><?php echo h($ksiazka->condition()); ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo h($ksiazka->description); ?></dd>
      </dl>
    </div>

    <hr />

    <div class="bookings listing">
      <h3> Availability</h3>

      <?php if ($available){ ?>
          Item currently available.
       <?php  } else { ?>
          In these moments the item has been booked by <a class="back-link" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($member->id)));?>"> <?php echo $member->full_name(); ?></a>
        <?php } ?>

    </div>

  </div>

</div>
