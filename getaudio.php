<?php
  require_once('crypto.php');
  require_once('db.php');

  $allow_access = false;
  $username = get_username();

  // EXPERIMENTAL! Only allow guest to download.
  if ($username === 'guest') {

    $result = query($db, "SELECT * FROM `audio` WHERE `id` = '" . mysqli_real_escape_string($db, $_GET['id']) . "' and `username` = '" . mysqli_real_escape_string($db, $username) . "'");

    if ($result) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . $result[0]['filename']); 
      header('Content-Transfer-Encoding: binary');
      header('Connection: Keep-Alive');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . strlen($result[0]['mp3']));

      ob_clean();
      flush();
      print $result[0]['mp3'];

      return;
    }

  }

  require_once('header.php');

  ?>
  <div class="alert alert-warning"><strong>Not Accessible!</strong> File does not exist or you do not have access to the file.</div>
  <?php

  require_once('footer.php');


