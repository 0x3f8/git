<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

  if(isset($_GET['msg'])) {
    print "<p style='color: red; font-weight: bold;'>" . htmlentities($_GET['msg']) . "</p>";
  }
?>

<p>Welcome to the the 'Sprusage' usage monitor!</p>

<p>What would you like to do today?</p>

<ul>
  <li><a href='query.php'>Query data</a></li>
  <li><a href='view.php'>View a previous query</a></li>
  <li><a href='logout.php'>Log out</a></li>
</ul>
<?php require_once('footer.php'); ?>
