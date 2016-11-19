<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

  if(!isset($_GET['id'])) {
?>
    <form>
      <p>ID (should be a 36-digit UUID): <input type='text' name='id'></p>
      <p><input type='submit' value='View!' /></p>
    </form>
<?php
  }
  else
  {
    $result = mysqli_query($db, "SELECT * FROM `reports` WHERE `id`='" . mysqli_real_escape_string($db, $_GET['id']) . "' LIMIT 0, 1");
    if(!$result) {
      reply(500, "MySQL Error: " . mysqli_error($db));
      die();
    }

    $row = mysqli_fetch_assoc($result);
?>
  <ul>
    <li>ID: <?= htmlentities($row['id']); ?></li>
    <li>Name: <?= htmlentities($row['name']); ?></li>
    <li>Description: <?= htmlentities($row['description']); ?></li>
  </ul>

  <p>Output:</p>
  <hr />
  <pre><?= htmlentities(file_get_contents($row['outfile'])); ?></pre>
  <hr />
<?php
  }
?>
<?php require_once('footer.php'); ?>

