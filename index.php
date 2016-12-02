<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

  if(isset($_GET['msg'])) {
    print '<div class="alert alert-success">' . htmlentities($_GET['msg']) . '</div>';
  }
?>

<div class="container">
  <div class="row">
    <div class="h2 col-xs-12 text-center col-centered">What would you like to do today?</div>
  </div>
  <div class="row col-xs-6 col-xs-offset-3">
    <div class="list-group text-center">
      <a href="/query.php" class="btn btn-primary btn-lg active btn-block" role="button">Query Data</a>
      <a href="/view.php" class="btn btn-primary btn-lg active btn-block" role="button">View a Previous Query</a>
    </div>
  </div>
</div>

<?php require_once('footer.php'); ?>
