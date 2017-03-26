<?php
require_once 'php/steamApi.php';
$api = new SteamApi();

class Player {
    public $name;
    public $id;
    public $game_list;

    function __construct($id, $name = false) {
      $this->id = $id;
      if ($name) {
        $this->name = $name;
      }
    }

    public function getOwnedGames() {
      global $api;
      return $this->game_list = array_map(
          function($x) {
              return $x['appid'];
          },
          $api->GetOwnedGames($this->id));
    }
  }

$player1 = new Player('76561197997640408');
$player2 = new Player('76561197994769476');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
    <h3>Available games:<h3>
    <ul>
      <?php
        $player1->getOwnedGames();
        $player2->getOwnedGames();
        $commonGames = array_intersect(
            $player1->game_list,
            $player2->game_list);
        $detailed = array_map(
            function($gameID) {
                global $api;
                return $api->AppDetails($gameID);
            },
            $commonGames
        );
        foreach ($detailed as $game) {
            echo "<li>{$game['name']}</li>";
        }
      ?>
    </ul>
  </div>
</body>
</html>
