<?php
require_once 'php/steamApi.php';
$api = new SteamApi();

function generateGameDiv($gameData) {
  return "<div class='game-container'><a href='http://store.steampowered.com/app/{$gameData['steam_appid']}'><div><img src='{$gameData['header_image']}'/><h1>{$gameData['name']}</h1></div></a></div>";
}

class Player {
    // public $name;
    public $id;
    public $game_list;

    function __construct($id = false, $name = false) {
      global $api;
      $this->id = $id;
      if ($name) {
        if (($result = $api->GetIdFromUrl($name))) {
          $this->id = $result;
        };
      }
      // Retrieving user's display name
      // $this->name = $api->GetPlayerSummaries($this->id)['personaname'];
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

$player1 = new Player($id = false, $name = 'arkandiasmaniac');
$player2 = new Player('76561197994769476', 'obayemi');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div>
    <h3>You should play to:<h3>
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
        $multi = array_filter(
            $detailed,
            function ($game) {
                foreach ($game['categories'] as $category) {
                    if (
                        $category['id'] == 1 // Multi-player
                        || $category['id'] == 9 // Co-op
                        || $category['id'] == 36 // Online Multi-Player
                        || $category['id'] == 38 // Online Co-op
                    ) {
                        return True;
                    }
                }
                return False;
            }
        );
      echo generateGameDiv($multi[array_rand($multi)]);
        //foreach ($multi as $game) {
            //echo "<li>{$game['name']}</li>\n";
        //}
    ?>
  </div>
</body>
</html>
