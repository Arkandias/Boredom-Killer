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
    echo $api->AppDetails('a');
    ?>
  </div>
</body>
</html>
