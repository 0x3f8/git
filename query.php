<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');
?>


<?php
  require_once('footer.php');
?>
