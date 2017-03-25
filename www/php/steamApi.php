<?php
class SteamApi {
  public function AppDetails($gameID) {
    return json_decode(file_get_contents("http://store.steampowered.com/api/appdetails?appids={$gameID}"), true);
  }

  public function GetOwnedGames($userID) {
    return json_decode(file_get_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamid={$userID}&format=json"), true)['response']['games'];
  }

  public function GetPlayerSummaries($userID) {
    return json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamids={$userID}&format=json"), true)['response']['players'][0];
  }

  public function GetIdFromUrl($url) {
    $result = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&vanityurl={$url}"), true)['response'];
    if ($result['success'] and isset($result['steamid'])) {
      return $result['steamid'];
    }
    return 0;
  }

}
