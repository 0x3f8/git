<?php
  require_once('db.php');
  require_once('functions.php');

  if($_SERVER['REQUEST_METHOD'] != 'POST')
    die("Only HTTP POST requests are allowed!");

  require_once('this_is_json.php');

  var_dump($params);

  # TODO: mysqli_query()

  reply(200, "Success!");
?>
