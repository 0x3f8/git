<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');
  require_once('uuid.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');

  function format_sql($rows) {
    if(sizeof($rows) == 0) {
      return 'No results!';
    }

    $out = '';

    /* Print headers */
    $headers = array_keys($rows[0]);
    foreach($headers as $header) {
      $out .= str_pad($header, 15) . ' ';
    }
    $out .= "\n";
    foreach($headers as $header) {
      $divider = str_repeat('-', strlen($header));
      $out .= str_pad($divider, 15) . ' ';
    }
    $out .= "\n";

    /* Print rows */
    foreach($rows as $row) {
      foreach($headers as $header) {
        $out .= str_pad($row[$header], 15) . ' ';
      }
      $out .= "\n";
    }

    return $out;
  }
?>

  <script>
    count = 0;
    function add_launch() {
      $('#content').append($('#launch_template').html());
      return false;
    }
    function add_usage() {
      $('#content').append($('#usage_template').html());
      return false;
    }
    function reset(type) {
      $('#content').html('');
      $('#content').append('<p>Date: <input type="text" name="date" id="date" value="<?= date('Y-m-d'); ?>"/></p>');
      $('#date').datepicker({
        dateFormat:"yy-mm-dd",
      });
      $('#aftercontent').html('<input type="hidden" name="type" value="' + type + '" />');
      $('#aftercontent').append('<p><button type="button" onClick="add_' + type + '();">(add field)</button></p>');
      $('#aftercontent').append('<p><input type="submit" value="Query!" /> <label><input type="checkbox" name="save"> Save results?</input></p>');
    }
  </script>
<div id='launch_template' style='display: None'>
  <div style='display: block'>
    <select name='field[]'>
      <option name='udid' selected>udid</option>
      <option name='appVersion'>appVersion</option>
      <option name='device'>device</option>
      <option name='locale'>locale</option>
      <option name='lversion'>lversion</option>
      <option name='manuf'>manuf</option>
      <option name='model'>model</option>
      <option name='product'>product</option>
      <option name='screenDensityH'>screenDensityH</option>
      <option name='screenDensityW'>screenDensityW</option>
      <option name='sdkint'>sdkint</option>
    </select>
    <select name='modifier[]'>
      <option value='eq' selected>==</option>
      <option value='lt'>&lt;</option>
      <option value='gt'>&gt;</option>
      <option value='le'>&le;</option>
      <option value='ge'>&ge;</option>
      <option value='ne'>&ne;</option>
    </select>
    <input type='text' name='value[]'/>
  </div>
</div>
<div id='usage_template' style='display: None'>
  <div style='display: block'>
    <select name='field[]'>
      <option name='udid' selected>udid</option>
      <option name='activity'>activity</option>
    </select>
    <select name='modifier[]'>
      <option value='eq' selected>==</option>
      <option value='lt'>&lt;</option>
      <option value='gt'>&gt;</option>
      <option value='le'>&le;</option>
      <option value='ge'>&ge;</option>
      <option value='ne'>&ne;</option>
    </select>
    <input type='text' name='value[]'/>
  </div>
</div>
<p>Welcome to the query engine!</p>

<p>Which would you like to query?</p>
<p><label><input type='radio' name='type' onChange='reset("launch");'> Launch reports</label></p>
<p><label><input type='radio' name='type' onChange='reset("usage");'> Usage reports</label></p>
<hr />
<form method='POST'>
  <p><div id='content'></div></p>
  <p><div id='aftercontent'></div></p>
  <hr />
</form>

<?php

  if(isset($_REQUEST['date'])) {
    $fields = $modifiers = $values = [];
    if(isset($_REQUEST['field']))    { $fields    = $_REQUEST['field']; }
    if(isset($_REQUEST['modifier'])) { $modifiers = $_REQUEST['modifier']; }
    if(isset($_REQUEST['value']))    { $values    = $_REQUEST['value']; }
    $date = $_REQUEST['date'];

    if(sizeof($fields) !== sizeof($modifiers) || sizeof($modifiers) !== sizeof($values)) {
      reply(500, "Something went wrong! :(");
      die();
    }

    if(!$date) {
      reply(400, "date is a mandatory field!");
    }

    $where = [];
    for($i = 0; $i < sizeof($fields); $i++) {
      $field = $fields[$i];
      if(!ctype_alpha($field)) {
        reply(400, "Field name can only contain letters!");
        die();
      }

      $modifier = $modifiers[$i];
      if($modifier === 'eq') {
        $modifier = '=';
      } elseif($modifier === 'lt') {
        $modifier = '<';
      } elseif($modifier === 'gt') {
        $modifier = '>';
      } elseif($modifier === 'le') {
        $modifier = '<=';
      } elseif($modifier === 'ge') {
        $modifier = '>=';
      } elseif($modifier === 'ne') {
        $modifier = '!=';
      } else {
        reply(400, "Bad modifier!");
        die();
      }

      $value = mysqli_real_escape_string($db, $values[$i]);

      $where[] = "`$field` $modifier '$value'";
    }
    $where[] = "`date`='" . mysqli_real_escape_string($db, $date) . "' ";

    $type = $_REQUEST['type'];
    if($type !== 'launch' && $type !== 'usage') {
      reply(400, "Type has to be either 'launch' or 'usage'!");
    }

    $query = "SELECT * ";
    $query .= "FROM `app_" . $type . "_reports` ";
    $query .= "WHERE " . join(' AND ', $where) . " ";
    $query .= "LIMIT 0, 100";

    print $query;
    $out = format_sql(query($db, $query));
    print "<pre>" . htmlentities($out) . "</pre>";

    if(isset($_REQUEST['save'])) {
      $id = gen_uuid();
      $name = "report-$id";
      $description = "Report generated @ " . date('Y-m-d H:i:s');
      $result = mysqli_query($db, "INSERT INTO `reports`
        (`id`, `name`, `description`, `query`)
      VALUES
        ('$id', '$name', '$description', '" . mysqli_real_escape_string($db, $query) . "')
        ");

      if(!$result) {
        reply(500, "Error saving report: " . mysqli_error($db));
        die();
      }

      print "<p><strong>Saved your report as <a href='view.php?id=$id'>$name</a></strong></p>";
      print "<p>Please bookmark that link if you want to keep it!</p>";
    }
  }
  require_once('footer.php');
?>
