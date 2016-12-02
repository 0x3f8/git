<?php
  # This require should always be first
  require_once('this_is_json.php');
  require_once('db.php');

  function parse_date($date) {
    return date('Y-m-d H:i:s', strtotime($date));
  }

  restrict_page_to_users($db, $params, ['guest']);

  if($_GET['type'] == 'launch') {
    $udid = mysqli_real_escape_string($db, $params['udid']);

    // Use local time and date
    //$date = mysqli_real_escape_string($db, parse_date($params['date']));
    //$time = mysqli_real_escape_string($db, $params['time']);

    $appVersion = intval($params['appVersion']);
    $device = mysqli_real_escape_string($db, $params['device']);
    $locale = mysqli_real_escape_string($db, $params['locale']);
    $lversion = mysqli_real_escape_string($db, $params['lversion']);
    $manuf = mysqli_real_escape_string($db, $params['manuf']);
    $model = mysqli_real_escape_string($db, $params['model']);
    $product = mysqli_real_escape_string($db, $params['product']);
    $screenDensityH = intval($params['screenDensityH']);
    $screenDensityW = intval($params['screenDensityW']);
    $sdkint = intval($params['sdkint']);

    $result = mysqli_query($db, "INSERT INTO `app_launch_reports`
      (`udid`, `date`, `time`, `appVersion`, `device`, `locale`, `lversion`, `manuf`, `model`, `product`, `screenDensityH`, `screenDensityW`, `sdkint`)
        VALUES
      ('$udid', now(), now(), '$appVersion', '$device', '$locale', '$lversion', '$manuf', '$model', '$product', '$screenDensityH', '$screenDensityW', '$sdkint')
    ");
  } elseif($_GET['type'] == 'usage') {
    $udid = mysqli_real_escape_string($db, $params['udid']);
    $activity = mysqli_real_escape_string($db, $params['activity']);

    // Use local clock
    //$date = mysqli_real_escape_string($db, parse_date( $params['date']));
    //$time = mysqli_real_escape_string($db, $params['time']);

    $result = mysqli_query($db, "INSERT INTO `app_usage_reports`
      (`udid`, `date`, `time`, `activity`)
        VALUES
      ('$udid', now(), now(), '$activity')
    ");
  } else {
    reply(500, "<em>type</em> parameter must be either launch or usage");
    exit(1);
  }

  if(!$result) {
    reply(500, "Couldn't save the record: " . mysqli_error($db));
    exit(1);
  }

  reply(200, "Success!");
?>
