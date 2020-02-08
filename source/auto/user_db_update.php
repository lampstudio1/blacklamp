#!/usr/bin/php -q
<?php
$con = new mysqli("localhost","root","ieelte1214","user_db");
//LoL Update
$query = "SELECT * FROM lol_tb";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)){
    $googleid = $row['googleid'];
    $username = $row['lol_username'];
    $username = str_replace(" ","",$username);
    $username = urlencode($username);
    $api_key = "RGAPI-47c561bc-530a-4cd4-9c55-47f8cd50c7e4";
    $url = "https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$username."?api_key=".$api_key;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($status_code != 200) {
        continue;
    }
    $resulta = json_decode($response,true);
    $url = "https://kr.api.riotgames.com/lol/league/v4/entries/by-summoner/".$resulta['id']."?api_key=".$api_key;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($status_code != 200) {
        continue;
    }
    $league = json_decode($response, true);
    if(empty($league)) {
        $lol_st = null;
        $lol_tt = null;
    }
    if($league[0]['queueType'] == "RANKED_SOLO_5x5") {
	$lol_st = $league[0]['tier']." ".$league[0]['rank'];
	$lol_tt = $league[1]['tier']." ".$league[1]['rank'];
    } else if($league[0]['queueType'] == "RANKED_FLEX_SR"){
	$lol_st = $league[1]['tier']." ".$league[1]['rank'];
	$lol_tt = $league[0]['tier']." ".$league[0]['rank'];
    }
    $query  = "UPDATE lol_tb SET lol_solo_tier='".$lol_st."', lol_team_tier='".$lol_tt."' WHERE googleid='".$googleid."'";
    $resulta = mysqli_query($con,$query);
    
}
mysqli_close($con);
?>
