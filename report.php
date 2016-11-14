<?php
  require_once('db.php');
  require_once('functions.php');

  if($_SERVER['REQUEST_METHOD'] != 'POST')
    die("Only HTTP POST requests are allowed!");

  require_once('this_is_json.php');
  restrict_page_to_users($db, $params, ['guest', 'administrator']);

  # TODO: Name these fields correctly once we decide what we're tracking
  $field1 = mysqli_real_escape_string($db, $params['field1']);
  $field2 = mysqli_real_escape_string($db, $params['field2']);
  $field3 = mysqli_real_escape_string($db, $params['field3']);

  $result = mysqli_query($db, "INSERT INTO `reports`
    (`field1`, `field2`, `field3`)
      VALUES
    ('$field1', '$field2', '$field3')
  ");
  if(!$result) {
    send_json(500, "Couldn't save the record: " . mysqli_error($db));
    exit(1);
  }

  reply(200, "Success!");
?>
