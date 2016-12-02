<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('crypto.php');

  if(!isset($_POST['username']) || !isset($_POST['password'])) {
    print <<<"EOF"
<!doctype html>
<html>
  <head>
    <title>Sprusage Usage Reporter!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"'></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand">Sprusage</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="page-header" id="banner">
        <div class="jumbotron">
        <div class="row">
            <h1>Sprusage</h1>
        </div>
      </div>
      <div class="container col-xs-offset-2">
        <form method="POST">
          <div class="form-group row center">
            <p class="lead">Please login to use the application</p>
          </div>
          <div class="form-group row">
            <label for="username" class="col-xs-2 col-sm-1 col-form-label">Username</label>
            <div class="col-xs-6">
              <input class="form-control" type="text" placeholder="Username" id="username" name="username" autofocus="autofocus">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-xs-2 col-sm-1 col-form-label">Password</label>
            <div class="col-xs-6">
              <input class="form-control" type="password" placeholder="Password" id="password" name="password">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xs-2 col-sm-1"></div>
            <div class="offset-xs-2 col-xs-10">
              <button type="submit" class="btn btn-primary">Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
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

    header('Location: index.php?msg=Successfully%20logged%20in!');
  }
?>
