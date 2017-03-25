<?php

function CallAPI($method, $url, $data = false)
{
  $curl = curl_init();

  switch ($method)
  {
    case "POST":
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
    case "PUT":
      curl_setopt($curl, CURLOPT_PUT, 1);
      break;
    default:
      if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
  }

  // Optional Authentication:
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $result = curl_exec($curl);

  curl_close($curl);

  return $result;
}

class SteamApi {
  public function AppDetails($gameID) {
    return json_decode(file_get_contents("http://store.steampowered.com/api/appdetails?appids={$gameID}"), true);
  }

  public function GetOwnedGames($userID) {
    return json_decode(file_get_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=E44E540CAB2E08BB0B4A471117B8DA24&steamid={$userID}&format=json"), true)['response']['games'];
  }
}
