<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div>
<?php
$player1 = $_REQUEST['player1'];
$player2 = $_REQUEST['player2'];
  require_once 'steamApi.php';
  $api = new SteamApi();
  echo $api->AppDetails('a');
  ?>
</div>
<div>
</div>
</body>
</html>
