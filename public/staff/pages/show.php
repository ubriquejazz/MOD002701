<?php require_once('../../../private/initialize.php'); ?>

<?php

require_login();
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page = find_page_by_id($id);
$subject = find_subject_by_id($page['subject_id']);

?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">&laquo; Back to Subject Page</a>

  <div class="page show">

    <h1>Page: <?php echo h($page['menu_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Kategoria</dt>
        <dd><?php echo h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Tytuł</dt>
        <dd><?php echo h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Id</dt>
        <dd><?php echo h($page['id']); ?></dd>
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
              <dt>Dostępność</dt>
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
              <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
          </td>
        </tr>
      </table>
      <hr/>
      <dl>
        <dt>Opis</dt>
        <dd><?php echo h($page['content']); ?></dd>
      </dl>
      <?php //end of the attribute division ?>

    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
