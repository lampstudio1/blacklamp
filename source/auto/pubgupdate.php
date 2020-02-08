<?php 
$pubg_seasonid = 'division.bro.official.pc-2018-06';
$pubg_get_accountid = 'https://api.pubg.com/shards/steam/players?filter[playerNames]=';

$api_key = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJmZmUyYzljMC1lZmUzLTAxMzctNzY1Ny0wNTFmMTM0M2QyZGIiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTc0NDg4NjI0LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJsYWNrbGFtcCJ9.KRdhagPxFa8WZ62KDPR2PCD5RDEBuTYKDpIaQM62VkA';
$headers = [
    "Authorization: Bearer ".$api_key,
    "Accept: application/vnd.api+json"
];
$con = new mysqli('localhost','root','ieelte1214','user_db');
if(!$con) {
    exit;
}
$query = "SELECT * FROM pubg_tb";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_array($result)) {
    $gamedata = array();
    $pname = $row['pubg_username'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $pubg_get_accountid.$pname);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
    $return = curl_exec($ch);
    $json = json_decode($return, true);
    curl_close($ch);
    $accountid = $json['data'][0]['id'];
    $pubg_get_stats = 'https://api.pubg.com/shards/steam/players/'.$accountid.'/seasons/division.bro.official.pc-2018-06';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $pubg_get_stats);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
    $return = curl_exec($ch);
    $json = json_decode($return, true);
    curl_close($ch);
    if($json['data']['attributes']['gameModeStats']['solo']) {
        $temp = explode('.',(string)$json['data']['attributes']['gameModeStats']['solo']['rankPoints']);
        $gamedata[0] = $temp[0];
    } else {
        $gamedata[0] = null;
    }
    if($json['data']['attributes']['gameModeStats']['duo']) {
        $temp = explode('.',(string)$json['data']['attributes']['gameModeStats']['duo']['rankPoints']);
        $gamedata[1] = $temp[0];
    }
    else{
        $gamedata[1] = null;
    }
    if($json['data']['attributes']['gameModeStats']['squad']) {
        $temp = explode('.',(string)$json['data']['attributes']['gameModeStats']['squad']['rankPoints']);
        $gamedata[2] = $temp[0];
    } else {
        $gamedata[2] = null;
    }
    $query = "UPDATE pubg_tb SET pubg_solo_tier = '".$gamedata[0]."', pubg_duo_tier = '".$gamedata[1]."', pubg_squad_tier = '".$gamedata[2]."' WHERE pubg_username = '".$pname."'";
    if(mysqli_query($con,$query)) {
        continue;
    }
    else {
        continue;
    }

    
mysqli_close($con);
}

?>