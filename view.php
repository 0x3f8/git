<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

  function format_sql($rows) {
    if(sizeof($rows) == 0) {
      return 'No results!';
    }

    $out = '';

    /* Print headers */
    $headers = array_keys($rows[0]);
    foreach($headers as $header) {
      $out .= str_pad($header, 15) . ' ';
    }
    $out .= "\n";
    foreach($headers as $header) {
      $divider = str_repeat('-', strlen($header));
      $out .= str_pad($divider, 15) . ' ';
    }
    $out .= "\n";

    /* Print rows */
    foreach($rows as $row) {
      foreach($headers as $header) {
        $out .= str_pad($row[$header], 15) . ' ';
      }
      $out .= "\n";
    }

    return $out;
  }

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
    if(!$row) {
      reply(404, "Report not found!");
      die();
    }
?>
  <ul>
    <li>ID: <?= htmlentities($row['id']); ?></li>
    <li>Name: <?= htmlentities($row['name']); ?></li>
    <li>Description: <?= htmlentities($row['description']); ?></li>
  </ul>

  <p>Output:</p>
  <hr />
  <pre>
  Query: <?= $row['query'] ?>


<?php
    $result = mysqli_query($db, $row['query']);
    if(!$result) {
      reply(500, "Query error: " . mysqli_error($db));
      die();
    }
    $out = format_sql(mysqli_fetch_all($result, MYSQLI_ASSOC));
    print $out;
?>
  </pre>
  <hr />
<?php
  }
?>
<?php require_once('footer.php'); ?>

