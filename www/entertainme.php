<?php
require_once 'php/steamApi.php';
$api = new SteamApi();

class Player {
    public $name;
    public $id;
    public $game_list;

    function __construct() {}
    function __construct1($id) {
        $this->id = $id;
    }
    function __construct2($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }

    public getOwnedGames() {
        $this->game_list = $api->getOwnedGames($this->id);
    }
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
$player1 = new Player('76561197997640408');
$player2 = new Player('76561197994769476');

$player2

echo $api->AppDetails('404');
    ?>
  </div>
</body>
</html>
