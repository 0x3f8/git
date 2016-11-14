<?php
  define('JSON', true);

  if($_SERVER['CONTENT_TYPE'] != 'application/json')
    die("Only application/json POSTs are accepted!");
  if($_SERVER['REQUEST_METHOD'] != 'POST') {
    reply(400, "Only HTTP POST requests are allowed!");
    exit(1);
  }

  $params = json_decode(file_get_contents("php://input"), true);

  function reply($code, $msg) {
    print json_encode([
      'result' => $code,
      'msg' => $msg,
    ]);
  }

  function restrict_page_to_users($db, $params, $users) {
    check_access($db, $params['username'], $params['password'], $users);
  }
?>
