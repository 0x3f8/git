<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  # Don't allow anybody to access this page (yet!)
  restrict_page_to_users($db, []);

  require_once('header.php');

  if(!isset($_GET['id'])) {
?>
    <p>WARNING: This is experimental!</p>
    <form>
      <p>ID: <input type='text' name='id'></p>
      <p>Name: <input type='text' name='name'></p>
      <p>Description: <input type='text' name='description'></p>
      <p><input type='submit' value='Edit!' /></p>
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

    # Update the row with the new values
    $set = [];
    foreach($row as $name => $value) {
      print "Checking for " . htmlentities($name) . "...<br>";
      if(isset($_GET[$name])) {
        print 'Yup!<br>';
        $set[] = "`$name`='" . mysqli_real_escape_string($db, $_GET[$name]) . "'";
      }
    }

    $query = "UPDATE `reports` " .
      "SET " . join($set, ', ') . ' ' .
      "WHERE `id`='" . mysqli_real_escape_string($db, $_REQUEST['id']) . "'";
    print htmlentities($query);

    $result = mysqli_query($db, $query);
    if(!$result) {
      reply(500, "SQL error: " . mysqli_error($db));
      die();
    }

    print "Update complete!";
  }
?>
<?php require_once('footer.php'); ?>

