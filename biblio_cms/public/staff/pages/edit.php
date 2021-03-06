<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $page = [];
  $page['id'] = $id;
  $page['subject_id'] = $_POST['subject_id'] ?? '';
  $page['menu_name'] = $_POST['menu_name'] ?? '';
  $page['visible'] = $_POST['visible'] ?? '';
  $page['content'] = $_POST['content'] ?? '';

  $result = update_page($page);
  if($result === true) {
    $_SESSION['message'] = 'The page was updated successfully.';
    redirect_to(url_for('/staff/pages/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $page = find_page_by_id($id);
}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>

  <div class="page edit">
    <h1>Edit Page</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
          <?php
            $subject_set = find_all_subjects();
            while($subject = mysqli_fetch_assoc($subject_set)) {
              echo "<option value=\"" . h($subject['id']) . "\"";
              if($page["subject_id"] == $subject['id']) {
                echo " selected";
              }
              echo ">" . h($subject['menu_name']) . "</option>";
            }
            mysqli_free_result($subject_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Id</dt>
        <dd>
          <input type="number" name="id" disabled value="<?php echo h($page['id']); ?>" />
        </dd>
      </dl>
      <dl>
        <dt>ISBN</dt>
      </dl>
      <hr/>
      <table>
        <tr>
          <td>
            <dl>
              <dt>Imię</dt>
              <dd> Juan </dd>
            </dl>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td>
            <dl>  
              <dt>Available</dt>
              <dd> No </dd>
            </dl>
          </td>
        </tr>
        <tr>
          <td>
            <dl>
              <dt>Nazwisko</dt>
              <dd> Gago </dd>
            </dl>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td>
            <dl>  
              <dt>Ilość</dt>
              <dd> 1 </dd>
            </dl>
          </td>
        </tr>
        <tr>
          <td>
            <dl>
              <dt>Wydawnictwo</dt>
              <dd> Planeta </dd>
            </dl>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td>
            <dl>  
              <dt>Litera</dt>
              <dd> A/Abc </dd>
            </dl>
          </td>
        </tr>
        <tr>
          <td>
            <dl>
              <dt>Miasto</dt>
              <dd> Wroclaw </dd>
            </dl>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td>
            <dl>  
              <dt>Adnotacja</dt>
              <dd>-</dd>
            </dl>
          </td>
        </tr>
        <tr>
          <td>
            <dl>
              <dt>Roku</dt>
              <dd> 1998 </dd>
            </dl>
          </td>
          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td>
            <dl>  
              <dt>Visible</dt>
              <dd>
                <input type="hidden" name="visible" value="0" />
                <input type="checkbox" name="visible" value="1"<?php if($page['subject_id'] == "1") { echo " checked"; } ?> />
              </dd>
            </dl>
          </td>
        </tr>
      </table>
      <hr/>
      <dl>
        <dt>Opis</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
        </dd>
      </dl>
      <hr/>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
