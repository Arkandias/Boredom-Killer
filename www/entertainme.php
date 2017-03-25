<?php
require_once 'php/steamApi.php';
$api = new SteamApi();

class Player {
    public $name;
    public $id;
    public $game_list;
  }
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
//$player1 = $_REQUEST['player1'];
//$player2 = $_REQUEST['player2'];
$player1 = new Player();
$player2 = new Player();
$player1->id = 76561197997640408;
$player2->id = 76561197994769476;

echo $api->AppDetails(404);
    ?>
  </div>
</body>
</html>
