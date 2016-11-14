<?php
  function reply($code, $msg) {
    if(JSON) {
      print json_encode([
        'result' => $code,
        'msg' => $msg,
      ]);
    }
  }
?>

