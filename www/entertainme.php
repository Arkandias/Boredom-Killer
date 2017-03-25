<?php
class SteamApi {
    $url = 'http://...';
    public function AppDetails($gameID) {
      return $gameID;
    }
}
$api = SteamApi();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
    <?php $api.AppDetails('Test'); ?>
  </div>
</body>
</html>

