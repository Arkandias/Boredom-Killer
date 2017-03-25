<?php
class SteamApi {
  public function AppDetails($gameID) {
    return json_decode(get_file_contents("http://store.steampowered.com/api/appdetails?appids={$gameID}"));
  }

  public function GetOwnedGames($userID) {
    echo get_file_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamid={$userID}&format=json");
    return json_decode(get_file_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamid=76561197997640408&format=json"));
  }
}
