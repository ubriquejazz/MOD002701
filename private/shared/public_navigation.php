<?php
  // Default values to prevent errors
  $subject_id = $subject_id ?? '';
?>

<navigation>
  <?php $nav_subjects = find_all_subjects(['visible' => true]); ?>
  <ul class="subjects">
    <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
      <?php //if(!$nav_subject['visible']) { continue; } ?>
        <li class="<?php if($nav_subject['id'] == $subject_id) { echo 'selected'; } ?>">
        <a href="<?php echo url_for('index.php?id=' . h(u($nav_subject['id'])) ); ?>">
          <?php echo h($nav_subject['menu_name']); ?>
        </a>

      </li>
    <?php } // while $nav_subjects ?>
  </ul>
  <?php mysqli_free_result($nav_subjects); ?>
</navigation>
