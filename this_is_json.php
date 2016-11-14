<?php
  define('JSON', true);

  if($_SERVER['CONTENT_TYPE'] != 'application/json')
    die("Only application/json POSTs are accepted!");
  if($_SERVER['REQUEST_METHOD'] != 'POST') {
    reply(400, "Only HTTP POST requests are allowed!");
    exit(1);
  }

  $params = json_decode(file_get_contents("php://input"), true);
?>
