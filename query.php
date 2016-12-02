<?php
  # This should be the first require
  require_once('this_is_html.php');
  require_once('db.php');
  require_once('uuid.php');

  restrict_page_to_users($db, ['guest']);

  require_once('header.php');
  ?>

  <script>
    count = 0;
    function add_query_filter(type) {
      // clone the query
      var new_query_piece = $('#query_piece').clone().attr('id','').removeClass('hidden')
      // set the type in the hidden field
      $('form input[name=type]').attr('value', type);

      // get the right fields for the type
      if (type === 'launch') fields = ['udid','appVersion','device','locale','lversion','manuf','model','product','screenDensityH','screenDensityW','sdkint'];
      if (type === 'usage') fields = ['udid','activity'];

      // add the fields
      fields.forEach(function(f){
        new_query_piece.find('select[name^=field]').append('<option value="' + f + '">' + f + '</option>');
      });

      // add the new element
      new_query_piece.appendTo('form #query_pieces');

      // fire up the tooltips
      $("[data-toggle='tooltip']").tooltip();

      // do notthing in the callser
      return false
    }

    function select_query_type(type) {
      $('#content').html($('#content_template').html());
      $('#content').find('[name=type]').attr('value', type)
      $('#content #date').datepicker({ dateFormat: 'yy-mm-dd' });
      $('form').removeClass('hidden')

      // highligh the selected query type
      $('.query-type').find('.active').removeClass('active');
      $('.query-type-' + type).addClass('active');

      // fire up the tooltips
      $("[data-toggle='tooltip']").tooltip();

      // load the first selector
      add_query_filter(type)
    }

    function removeFilterRow(elem) {
      $(elem).parents('.query-piece').remove();
    }
  </script>


  <div class="container">
    <div class="row">
      <div class="h2">Welcome to the query engine!</div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="pull-right h4">Which would you like to query?</div>
      </div>

      <ul class="query-type nav nav-pills col-xs-6">
        <li class="query-type-launch"><a href="#" onClick="select_query_type('launch');">Launch</a></li>
        <li class="query-type-usage"><a href="#" onClick="select_query_type('usage');">Usage</a></li>
      </ul>

    </div>

    <form method="POST" class="form-horizontal well hidden">
      <div id="content"></div>
    </form>

    <div id="content_template" class="hidden">

      <div class="form-group">
        <label for="date" class="control-label col-xs-2 col-md-4">Date</label>
        <div class="col-xs-6 col-sm-3">
          <input type="text" class="form-control" name="date" id="date" value="<?= date('Y-m-d'); ?>"/>
        </div>
      </div>

      <div class="form-group">
        <input type="hidden" name="type" value="" />
        <div class="float-right col-xs-2 col-md-4">
          <div class="glyphicon glyphicon-plus-sign pull-right text-success" style="font-size: large;" data-toggle="tooltip" data-placement="left" title="Add Filter Field" onClick="add_query_filter($(this).closest('form').find('[name=type]').val());"></div>
          <!-- <button type="button" class="btn btn-primary pull-right" onClick="add_query_filter($(this).closest('form').find('[name=type]').val());">Add Field</button> -->
        </div>
        <div id="query_pieces" class="col-xs-10 col-md-8"></div>
      </div>

      <div class="form-check form-group">
        <label class="control-label col-xs-2 col-md-4">Save Query?</label>
        <div class="col-xs-6 col-sm-3">
          <input type="checkbox" name="save" id="save" class="form-check-input" />
        </div>
      </div>

      <div class="form-check form-group">
        <button type="submit" class="btn btn-primary col-xs-offset-5 col-md-offset-5">Run Query</button>
      </div>
    </div>

    <div id="query_piece" class="hidden query-piece">
      <select name="field[]" class="form-control" style="width: auto; display: inline-block;"></select>
      <select name="modifier[]" class="form-control" style="width: auto; display: inline-block;">
        <option value="eq" selected>=</option>
        <option value="lt">&lt;</option>
        <option value="gt">&gt;</option>
        <option value="le">&le;</option>
        <option value="ge">&ge;</option>
        <option value="ne">&ne;</option>
      </select>
      <input type="text" name="value[]" class="form-control" style="width: auto; display: inline-block;"/>
      <div class="glyphicon glyphicon-remove-sign text-danger" style="font-size: large;" data-toggle="tooltip" data-placement="right" title="Remove This Filter Field" onClick="removeFilterRow(this)"></div>
    </div>
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

      ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Report Saved!</h3>
        </div>
        <div class="panel-body">
          <p>Saved your report as <a href='view.php?id=<?= $id ?>'><?= $name; ?></a></p>
          <p>Please bookmark that link if you want to keep it!</p>
        </div>
      </div>
      <?php

      //print "<p><strong>Saved your report as <a href='view.php?id=$id'>$name</a></strong></p>";
      //print "<p>Please bookmark that link if you want to keep it!</p>";
    }

    //print "<div class='well'><strong>Query:</strong> $query</div>";
    
    format_sql(query($db, $query));
  }

  require_once('footer.php');
?>
