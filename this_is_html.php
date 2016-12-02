<?php
  require_once('crypto.php');
  require_once('uuid.php');

  define('JSON', false);

  header("X-Frame-Options: SAMEORIGIN");
  header("X-Content-Type-Options: nosniff");
  header("X-XSS-Protection: 1; mode=block");

  $params = $_REQUEST;

  function reply($code, $msg) {
    print '<p style="color: red; font-weight: bold;">' . json_encode([
      'result' => $code,
      'msg' => $msg,
    ]) . '</p>';
  }

  function restrict_page_to_users($db, $users) {
    $username = get_username();

    if(!$username) {
      header('Location: login.php');
      exit(0);
    }

    check_access($db, $username, $users);
  }
?>
