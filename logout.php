<?php
  # This should be the first require
  require_once('this_is_html.php');

  setcookie('AUTH', '');
  header('Location: index.php?msg=Successfully%20logged%20out!');
?>
