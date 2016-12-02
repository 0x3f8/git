<?php
require_once('mp3.php');
require_once('db.php');
?>
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
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="/query.php">Query</a></li>
            <li><a href="/view.php">View</a></li>
            <?php
              if (get_username() == 'guest') {
                ?>
                  <li><a href="/<?= mp3_web_path($db); ?>">MP3</a></li>
                <?php
              }
              if (get_username() == 'administrator') {
                ?>
                  <li><a href="/edit.php">Edit</a></li>
                <?php
              }
            ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="/logout.php">Logout</a></li>
          </ul>

        </div>
      </div>
    </div>
    <div class="container">
      <div class="jumbotron">
        <div class="row">
            <h1>Sprusage</h1>
            <p class="lead">Welcome to the the 'Sprusage' usage monitor!</p>
        </div>
      </div>
