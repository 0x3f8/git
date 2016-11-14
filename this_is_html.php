<?php
  require_once('uuid.php');

  define('JSON', false);
  define('NONCE', gen_uuid());

  header("Content-Security-Policy: script-src 'self' 'nonce-" . NONCE . "'");
  header("X-Frame-Options: SAMEORIGIN");
  header("X-Content-Type-Options: nosniff");
  header("X-XSS-Protection: \"1; mode=block\"");

  $params = $_REQUEST;

  function reply($code, $msg) {
    print json_encode([
      'result' => $code,
      'msg' => $msg,
    ]);
  }
?>
