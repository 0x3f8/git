<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

?> 
  <form class="form-inline">
    <div class="form-group">
      <label for="id" class="h3">Query UUID</label>
      <input type="text" class="form-control input-lg" style="width: 40rem" id="id" name="id" placeholder="XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX">
      <button type="submit" class="btn btn-primary">View</button>
    </div>
  </form>
  <br/>
<?php

  if(isset($_GET['id'])) {
    $result = mysqli_query($db, "SELECT * FROM `reports` WHERE `id`='" . mysqli_real_escape_string($db, $_GET['id']) . "' LIMIT 0, 1");
    if(!$result) {
      reply(500, "MySQL Error: " . mysqli_error($db));
      die();
    }

    $row = mysqli_fetch_assoc($result);
    if(!$row) {
      reply(404, "Report not found!");
      die();
    }
?>
  <!--
  <ul>
    <li>ID: <?= htmlentities($row['id']); ?></li>
    <li>Name: <?= htmlentities($row['name']); ?></li>
    <li>Description: <?= htmlentities($row['description']); ?></li>
  </ul>
  -->
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Details</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-2 col-sm-2 text-muted text-right">ID</div>
        <div class="col-xs-8 col-sm-9"><?= htmlentities($row['id']); ?></div>
      </div>
      <div class="row">
        <div class="col-xs-2 col-sm-2 text-muted text-right">Name</div>
        <div class="col-xs-8 col-sm-9"><?= htmlentities($row['name']); ?></div>
      </div>
      <div class="row">
        <div class="col-xs-2 col-sm-2 text-muted text-right">Details</div>
        <div class="col-xs-8 col-sm-9"><?= htmlentities($row['description']); ?></div>
      </div>
    </div>
  </div>

  <?php
    format_sql(query($db, $row['query']));
  }
require_once('footer.php'); 
?>

