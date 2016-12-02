<?php
  require_once('crypto.php');
  require_once('db.php');

  function mp3_web_path($db) {
    $result = query($db, "SELECT `id` FROM `audio` WHERE `username` = '" . mysqli_real_escape_string($db, get_username()) . "'");

    if (!$result) {
      return null;
    }

    return 'getaudio.php?id=' . $result[0]['id'];
  }
