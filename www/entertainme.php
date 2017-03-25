<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div>
<?php
  require_once 'steamApi.php';
  $api = new SteamApi();
  echo $api->AppDetails('a');
  ?>
</div>
<div>
</div>
</body>
</html>
