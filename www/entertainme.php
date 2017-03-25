<?php require_once 'php/steamApi.php';
  $api = new SteamApi();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
  <?php
    echo (string)($api->GetOwnedGames('76561197997640408'));
  ?>
  </div>
</body>
</html>
