<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($member)) {
  redirect_to(url_for('/staff/members/index.php'));
}
?>

<dl>
  <dt>First name</dt>
  <dd><input type="text" name="member[first_name]" value="<?php echo h($member->first_name); ?>" /></dd>
</dl>

<dl>
  <dt>Last name</dt>
  <dd><input type="text" name="member[last_name]" value="<?php echo h($member->last_name); ?>" /></dd>
</dl>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="member[email]" value="<?php echo h($member->email); ?>" /></dd>
</dl>

<dl>
  <dt>Phone</dt>
  <dd><input type="text" name="member[phone]" value="<?php echo h($member->phone); ?>" /></dd>
</dl>


