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

    if(!$result) {
      reply(400, "Database error! " . mysqli_error($db));
      die();
    }


    $results = [];

    while($row = mysqli_fetch_assoc($result)) {
      $results[] = $row;
    }

    return $results;
  }

  function get_username() {
    if(!isset($_COOKIE['AUTH'])) {
      return;
    }

    $auth = json_decode(decrypt(pack("H*",$_COOKIE['AUTH'])), true);

    return $auth['username'];
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

  function check_access($db, $username, $users) {
    # Allow administrator to access any page
    if($username == 'administrator') {
      return;
    }

    if(!in_array($username, $users)) {
      reply(403, 'Access denied!');
      exit(1);
    }
  }

  function format_sql($rows) {
    if(sizeof($rows) === 0) {
      ?>
      <div class="alert alert-danger" role="alert">
        <strong>No Resuts</strong> Your query did not return any results
      </div>
      <?php
      return;
    }
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Output</h3>
        <p class="text-muted">You may have to scroll to the right to see the full details</p>
      </div>
      <div class="panel-body" style="overflow-x: scroll;">
        <table class="table table-striped">
          <thead>
            <tr>
              <?php
                // headers
                $headers = array_keys($rows[0]);
                foreach($headers as $header) {
                  ?><th><?= htmlentities($header); ?></th><?php
                }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($rows as $row) {
                ?><tr><?php
                foreach($headers as $header) {
                  //$out .= str_pad($row[$header], 15) . ' ';
                  ?><td><?= htmlentities($row[$header]); ?></td><?php
                }
                ?></tr><?php
              }
            ?>            
          </tbody>
        </table>
      </div>
    </div>
    <?php
  }
?>
