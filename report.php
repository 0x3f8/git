<?php
  if($_SERVER['REQUEST_METHOD'] != 'POST')
    die("Only HTTP POST requests are allowed!");

  if($_SERVER['CONTENT_TYPE'] != 'application/json')
    die("Only application/json POSTs are accepted!");

  $body = file_get_contents("php://input");
  $params = json_decode($body);

  var_dump($params);
?>
