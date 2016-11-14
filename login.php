<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('crypto.php');

  if(!isset($_POST['username']) || !isset($_POST['password'])) {
    print <<<"EOF"
<html>
  <p>Please log in!</p>
  <form method='POST'>
    <p>Username <input type='text' name='username' /></p>
    <p>Password <input type='text' name='password' /></p>
    <input type='submit' value='Log in!' />
  </form>
</html>
EOF;
  } else {
    require_once('db.php');

    check_user($db, $_POST['username'], $_POST['password']);

    print "Successfully logged in!";

    $auth = encrypt(json_encode([
      'username' => $_POST['username'],
      'date' => date(DateTime::ISO8601),
    ]));

    setcookie('AUTH', bin2hex($auth));
  }
?>
