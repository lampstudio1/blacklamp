<?php
require '/home/ieelte/log/log.php';
header('Content-Type: application/json; charset=UTF-8');
$api_key = md5($_GET["api_key"]);
$username = $_GET["username"];
$request_name = "null";
$clientid = $_GET['clientid'];
if(empty($api_key) or empty($username) or empty($clientid)) {
    header("HTTP/1.1 400 Bad Request");
    header("Request-Name".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"400 Bad Request");
    exit;
}
$api_con = new mysqli("localhost","root","ieelte1214","api_db");
$query = "SELECT * FROM api_key_tb WHERE api_key_md5='".$api_key."'";
$result = mysqli_query($api_con,$query);
if(mysqli_num_rows($result) != 1){
    header("HTTP/1.1 401 Unauthorized");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"401 Unauthorized");
    mysqli_close($api_con);
    exit;
}
while($row = mysqli_fetch_array($result)) {
    $request_name = $row['name'];
}
mysqli_close($api_con);
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con){
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
$query = "SELECT * FROM user_tb WHERE username='".$username."'";
$result = mysqli_query($con,$query);
if(!$result){
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
if(mysqli_num_rows($result) != 1) {
    header("HTTP/1.1 404 Not Found");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"404 Not Found");
    mysqli_close($con);
    exit;
}

while($row = mysqli_fetch_array($result)){
    $user_base['googleid'] = $row['googleid'];
    $user_base['email'] = $row['email'];
    $user_base['username'] = $row['username'];
    $user_base['lamppoint'] = (float)$row['lamppoint'];
}
$query = "SELECT * FROM lol_tb WHERE googleid='".$user_base['googleid']."'";
$result = mysqli_query($con,$query);
if(!$result){
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
while($row = mysqli_fetch_array($result)){
    $lol_arr['username'] = $row['lol_username'];
    $lol_arr['solo'] = $row['lol_solo_tier'];
    $lol_arr['team'] = $row['lol_team_tier'];
    $urc = str_replace(" ","",$lol_arr['username']);
    $urc = urlencode($urc);
    $lol_apikey = "RGAPI-47c561bc-530a-4cd4-9c55-47f8cd50c7e4";
    $url = "https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$urc."?api_key=".$lol_apikey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($status_code != 200) {
        header("HTTP/1.1 500 Internal Server Error");
        header("Request-Name: ".$request_name);
	insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
        mysqli_close($con);
        exit;
    }
    $resultlol = json_decode($response, true);
    $lol_arr['profileIconId'] = $resultlol['profileIconId'];
}
$query = "SELECT * FROM ow_tb WHERE googleid='".$user_base['googleid']."'";
$result = mysqli_query($con,$query);
if(!$result){
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
while($row = mysqli_fetch_array($result)){
    $ow_arr['username'] = $row['ow_username'];
    $ow_arr['dealer'] = $row['ow_dealer_tier'];
    $ow_arr['tanker'] = $row['ow_tanker_tier'];
    $ow_arr['healer'] = $row['ow_healer_tier'];
}
$query = "SELECT * FROM pubg_tb WHERE googleid='".$user_base['googleid']."'";
$result = mysqli_query($con,$query);
if(!$result){
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"Profile Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
while($row = mysqli_fetch_array($result)){
    $pubg_arr['username'] = $row['pubg_username'];
    $pubg_arr['solo'] = $row['pubg_solo_tier'];
    $pubg_arr['duo'] = $row['pubg_duo_tier'];
    $pubg_arr['squad'] = $row['pubg_squad_tier'];
}

header("HTTP/1.1 200 OK");
header("Request-Name: ".$request_name);
insertApiLog($clientid,"Profile Request",$request_name,$api_key,"200 OK");
echo json_encode(array('user_base' => $user_base, 'lol' => $lol_arr, 'ow' => $ow_arr, 'pubg' => $pubg_arr));



mysqli_close($con);
?>
