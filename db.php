<?php
  require_once('functions.php');

  $dbHost = 'localhost';
  $dbUsername = 'sprusage';
  $dbPassword = '';
  $dbName = 'sprusage';

  $db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

  if(!$db) {
    reply(500, "Couldn't connect to the database!");
    exit(1);
  }

  function query($db, $query) {
    $result = mysqli_query($db, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
?>
