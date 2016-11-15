<?php
  # This require should always be first
  require_once('this_is_json.php');
  require_once('db.php');

  function parse_date($date) {
    return date('Y-m-d H:i:s', strtotime($date));
  }

  restrict_page_to_users($db, $params, ['guest']);

  if($_GET['type'] == 'launch') {
    $udid = mysqli_real_escape_string($db, "0123456789abcdef");
    $date = mysqli_real_escape_string($db, parse_date("20161114130421-0500"));

    $appVersion = intval($params['appVersion']);
    $device = mysqli_real_escape_string($db, "vbox86p");
    $locale = mysqli_real_escape_string($db, "USA");
    $lversion = mysqli_real_escape_string($db, "3.10.0-genymotion-g1d178ae-dirty");
    $manuf = mysqli_real_escape_string($db, "Genymotion");
    $model = mysqli_real_escape_string($db, "Samsung Galaxy S4 - 4.4.4 - API 19 - 1080x1920");
    $product = mysqli_real_escape_string($db, "vbox86p");
    $screenDensityH = intval($params['screenDensityH']);
    $screenDensityW = intval($params['screenDensityW']);
    $sdkint = intval($params['sdkint']);

    $result = mysqli_query($db, "INSERT INTO `app_launch_reports`
      (`udid`, `date`, `appVersion`, `device`, `locale`, `lversion`, `manuf`, `model`, `product`, `screenDensityH`, `screenDensityW`, `sdkint`)
        VALUES
      ('$udid', '$date', '$appVersion', '$device', '$locale', '$lversion', '$manuf', '$model', '$product', '$screenDensityH', '$screenDensityW', '$sdkint')
    ");
  } elseif($_GET['type'] == 'usage') {
    $udid = mysqli_real_escape_string($db, "0123456789abcdef");
    $date = mysqli_real_escape_string($db, parse_date("20161114131729-0500"));

    $activity = mysqli_real_escape_string($db, "AddPost");

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
