<?php
require_once 'php/steamApi.php';
$api = new SteamApi();

function generateGameDiv($gameData) {
  return "<div class='game-container'><a href='steam://rungameid/{$gameData['steam_appid']}'><div><img src='{$gameData['header_image']}'/><h1>{$gameData['name']}</h1></div></a></div>";
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

?>
<!DOCTYPE html>
<html>
<head>
  <title>Your lazy game selector</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="body-wrap">
    <?php
        if (isset($_REQUEST['player1']) and isset($_REQUEST['player2'])) {
    ?>
    <h3>You should play to:</h3>
      <?php
        $player1 = new Player($id = false, $name = $_REQUEST['player1']);
        $player2 = new Player($id = false, $name = $_REQUEST['player2']);
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
        $bestFit = $multi[array_rand($multi)];
      ?>
      <div class='game-container'>
        <a href='steam://rungameid/<?= $bestFit['steam_appid'] ?>'>
          <div>
            <img src='<?= $bestFit['header_image'] ?>'/>
            <h1><?= $bestFit['name'] ?></h1>
          </div>
        </a>
      </div>
      <?php
        //echo generateGameDiv($multi[array_rand($multi)]);
        //foreach ($multi as $game) {
        //echo "<li>{$game['name']}</li>\n";
        //}
        } else {
      ?>
    <h1>You're a lazy fuck?</h1>
    <p>You want to play multiplayer / coop games with a friend but you cant agree on which one?</p>
    <p>Enter your steam custom url and you friends':</p>
    <form>
      <input name="player1" placeholder="dupond" />
      <input name="player2" placeholder="dupont"/>
      <input type="submit" value="Submit">
    </form>
    <?php
        }
    ?>
  </div>
  <a href='' style='position: absolute; bottom: 0; right: 0;'>That guy's not my friend anymore, I want to play with someone else</a>
</body>
</html>
