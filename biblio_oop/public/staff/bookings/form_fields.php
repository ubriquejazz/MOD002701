<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($booking)) {
  redirect_to(url_for('/staff/bookings/index.php'));
}
?>

<dl>
  <dt>Member</dt>
  <dd><input type="text" name="booking[user_id]" value="<?php echo h($booking->user_id); ?>" /></dd>
</dl>

<dl>
  <dt>Bicycle</dt>
  <dd><input type="text" name="booking[bike_id]" value="<?php echo h($booking->bike_id); ?>" /></dd>
</dl>

<dl>
  <dt>Check In</dt>
  <dd><input type="datetime-local" name="booking[date_in]" value="<?php echo h($booking->date_in); ?>" /></dd>
</dl>

<dl>
  <dt>Check Out</dt>
  <dd><input type="datetime-local" name="booking[date_out]" value="<?php echo h($booking->date_out); ?>" /></dd>
</dl>

<dl>
  <dt>Description</dt>
  <dd><textarea name="booking[description]" rows="5" cols="50"><?php echo h($booking->description); ?></textarea></dd>
</dl>

