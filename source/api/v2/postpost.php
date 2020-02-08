<?php
require '/home/ieelte/log/log.php';
header('Content-Type: application/json; charset=UTF-8');
$api_key = md5($_GET['api_key']);
$request_name = "null";
$data['googleid'] = $_GET['googleid'];
$data['username'] = $_GET['username'];
$data['title'] = $_GET['title'];
$data['type'] = $_GET['type'];
$data['link'] = $_GET['link'];
$data['tier'] = "";
$clientid = $_GET['clientid'];

$api_con = new mysqli("localhost","root","ieelte1214","api_db");
$query = "SELECT * FROM api_key_tb WHERE api_key_md5='".$api_key."'";
$result = mysqli_query($api_con,$query);
if(mysqli_num_rows($result) != 1){
    header("HTTP/1.1 401 Unauthorized");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"401 Unauthorized");
    mysqli_close($api_con);
    exit;
}
while($row = mysqli_fetch_array($result)) {
    $request_name = $row['name'];
}

if(empty($data['googleid']) or empty($clientid) or  empty($data['username']) or empty($data['title']) or empty($data['link']) ) {
    header("HTTP/1.1 400 Bad Request");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"400 Bad Request");
    mysqli_close($api_con);
    exit;
}
mysqli_close($api_con);
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
switch($data['type']){
    case "0":
        $query = "SELECT * FROM lol_tb WHERE googleid='".$data['googleid']."'";
        $result = mysqli_query($con,$query);
        if(!$result){
            header("HTTP/1.1 500 Internal Server Error");
            header("Request-Name: ".$request_name);
	    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"500 Internal Server Error");
            mysqli_close($con);
            exit;
        } 
        while($row = mysqli_fetch_array($result)) {
            $data['tier'] = $row['lol_solo_tier'];
        }
        break;
    case "1":
        $query = "SELECT * FROM ow_tb WHERE googleid='".$data['googleid']."'";
        $result = mysqli_query($con,$query);
        if(!$result){
            header("HTTP/1.1 500 Internal Server Error");
            header("Request-Name: ".$request_name);
	    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"500 Internal Server Error");
            mysqli_close($con);
            exit;
        } 
        while($row = mysqli_fetch_array($result)) {
            $data['tier'] = $row['ow_dealer_tier'];
        }
        break;
    case "2":
        $query = "SELECT * FROM pubg_tb WHERE googleid='".$data['googleid']."'";
        $result = mysqli_query($con,$query);
        if(!$result){
            header("HTTP/1.1 500 Internal Server Error");
            header("Request-Name: ".$request_name);
	    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"500 Internal Server Error");
            mysqli_close($con);
            exit;
        } 
        while($row = mysqli_fetch_array($result)) {
            $data['tier'] = $row['pubg_solo_tier'];
        }
        break;
}
$query = "INSERT INTO partypost_tb (googleid,username,gametype,title,discord_address,user_tier) VALUES ('".$data['googleid']."','".$data['username']."','".$data['type']."','".$data['title']."','".$data['link']."','".$data['tier']."')";
$result = mysqli_query($con,$query);
if($result){
    header("HTTP/1.1 200 OK");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"200 OK");
    mysqli_close($con);
    exit;
} else {
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"PostPost Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}

?>
