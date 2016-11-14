<?php
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

  function check_user($db, $username, $password) {
    if(!$username || !$password) {
      reply(401, 'Please specify a username/password!');
      exit(0);
    }

    $username = mysqli_real_escape_string($db, $username);

    $result = mysqli_query($db, "SELECT * FROM `users` WHERE `username`='$username'");
    if(!$result) {
      reply(500, "Query error: " . mysqli_error($db));
      exit(1);
    }

    $row = mysqli_fetch_assoc($result);
    if(!$row) {
      reply(401, 'No such user!');
      exit(1);
    }

    if($row['password'] !== $password) {
      reply(401, 'Bad password!');
      exit(1);
    }
  }

  function check_access($db, $username, $password, $users) {
    check_user($db, $username, $password);
    if(!in_array($username, $users)) {
      reply(403, 'Access denied!');
      exit(1);
    }
  }
?>
