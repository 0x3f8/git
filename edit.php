<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  # Don't allow anybody to access this page (yet!)
  restrict_page_to_users($db, []);

  require_once('header.php');

  if(!isset($_GET['id'])) {
?>
    <div class="alert alert-warning"><strong>Warning!</strong> This is experimental.</div>
    <form class="form-horizontal">
      <div class="form-group">
        <label for="id" class="col-sm-2 control-label">ID</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="id" id="id" placeholder="XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX">
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="name" id="name" placeholder="New Name">
        </div>
      </div>
      <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="description" id="description" placeholder="New Description">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
          <button type="submit" class="btn btn-default">Edit</button>
        </div>
      </div>
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

