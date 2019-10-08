<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($ksiazka)) {
  redirect_to(url_for('/staff/ksiazki/index.php'));
}
?>

<dl>
  <dt>Title</dt>
  <dd><input type="text" name="ksiazka[title]" value="<?php echo h($ksiazka->title); ?>" /></dd>
</dl>

<dl>
  <dt>Category</dt>
  <dd>
    <select name="ksiazka[category]">
      <option value=""></option>
    <?php foreach(Ksiazka::CATEGORIES as $category) { ?>
      <option value="<?php echo $category; ?>" <?php if($ksiazka->category == $category) { echo 'selected'; } ?>><?php echo $category; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>ISBN</dt>
  <dd><input type="text" name="ksiazka[isbn]" value="<?php echo h($ksiazka->isbn); ?>" /></dd>
</dl>

<dl>
  <dt>First name</dt>
  <dd><input type="text" name="ksiazka[first_name]" value="<?php echo h($ksiazka->first_name); ?>" /></dd>
</dl>

<dl>
  <dt>Last name</dt>
  <dd><input type="text" name="ksiazka[last_name]" value="<?php echo h($ksiazka->last_name); ?>" /></dd>
</dl>

<dl>
  <dt>Publisher</dt>
  <dd><input type="text" name="ksiazka[publisher]" value="<?php echo h($ksiazka->publisher); ?>" /></dd>
</dl>

<dl>
  <dt>Year</dt>
  <dd>
    <select name="ksiazka[year]">
      <option value=""></option>
    <?php $this_year = idate('Y') ?>
    <?php for($year=$this_year-20; $year <= $this_year; $year++) { ?>
      <option value="<?php echo $year; ?>" <?php if($ksiazka->year == $year) { echo 'selected'; } ?>><?php echo $year; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>City</dt>
  <dd><input type="text" name="ksiazka[city]" value="<?php echo h($ksiazka->city); ?>" /></dd>
</dl>

<dl>
  <dt>Letter</dt>
  <dd><input type="text" name="ksiazka[letter]" value="<?php echo h($ksiazka->letter); ?>" /></dd>
</dl>

<dl>
  <dt>Condition</dt>
  <dd>
    <select name="ksiazka[condition_id]">
      <option value=""></option>
    <?php foreach(Ksiazka::CONDITION_OPTIONS as $cond_id => $cond_name) { ?>
      <option value="<?php echo $cond_id; ?>" <?php if($ksiazka->condition_id == $cond_id) { echo 'selected'; } ?>><?php echo $cond_name; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Description</dt>
  <dd><textarea name="ksiazka[description]" rows="5" cols="50"><?php echo h($ksiazka->description); ?></textarea></dd>
</dl>
