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
    $date = mysqli_real_escape_string($db, parse_date($params['date']));

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
      (`udid`, `date`, `appVersion`, `device`, `locale`, `lversion`, `manuf`, `model`, `product`, `screenDensityH`, `screenDensityW`, `sdkint`)
        VALUES
      ('$udid', '$date', '$appVersion', '$device', '$locale', '$lversion', '$manuf', '$model', '$product', '$screenDensityH', '$screenDensityW', '$sdkint')
    ");
  } elseif($_GET['type'] == 'usage') {
    $udid = mysqli_real_escape_string($db, $params['udid']);
    $date = mysqli_real_escape_string($db, parse_date( $params['date']));
    $activity = mysqli_real_escape_string($db, $params['activity']);

    $result = mysqli_query($db, "INSERT INTO `app_usage_reports`
      (`udid`, `date`, `activity`)
        VALUES
      ('$udid', '$date', '$activity')
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
