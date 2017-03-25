<?php
class SteamApi {
  public function AppDetails($gameID) {
    return json_decode(file_get_contents("http://store.steampowered.com/api/appdetails?appids={$gameID}"), true);
  }

  public function GetOwnedGames($userID) {
    return json_decode(file_get_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamid={$userID}&format=json"), true)['response']['games'];
  }
}
