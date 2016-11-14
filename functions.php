<?php
  function reply($code, $msg) {
    if(JSON) {
      print json_encode([
        'result' => $code,
        'msg' => $msg,
      ]);
    } else {
      # TODO: Non-JSON stuff
    }
  }

  function restrict_page_to_users($db, $params, $users) {
    if(!isset($params['username']) || !isset($params['password'])) {
      reply(401, 'Please specify a username/password!');
      exit(0);
    }
    $username = mysqli_real_escape_string($db, $params['username']);
    $password = mysqli_real_escape_string($db, $params['password']);

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
    if($password !== $row['password']) {
      reply(401, 'Bad password!');
      exit(1);
    }
  }
?>
