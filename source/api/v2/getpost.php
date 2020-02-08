<?php
require '/home/ieelte/log/log.php';
header('Content-Type: application/json; charset=UTF-8');
$api_key = md5($_GET["api_key"]);
$request_name = "null";
$clientid = $_GET['clientid'];
if(empty($api_key) or empty($clientid)) {
    header("HTTP/1.1 400 Bad Request");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"GETPost Request",$request_name,$api_key,"400 Bad Request");
    exit;
    
}

$api_con = new mysqli("localhost","root","ieelte1214","api_db");
$query = "SELECT * FROM api_key_tb WHERE api_key_md5='".$api_key."'";
$result = mysqli_query($api_con,$query);
if(mysqli_num_rows($result) != 1){
    header("HTTP/1.1 401 Unauthorized");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"GETPost Request",$request_name,$api_key,"401 Unauthorized");
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
    insertApiLog($clientid,"GETPost Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);
    exit;
}
$return_arr = array();
$count = 0;
$query = "SELECT * FROM partypost_tb";
$result = mysqli_query($con,$query);
if(!$result) {
    header("HTTP/1.1 500 Internal Server Error");
    header("Request-Name: ".$request_name);
    insertApiLog($clientid,"GETPost Request",$request_name,$api_key,"500 Internal Server Error");
    mysqli_close($con);

    exit;
}
while($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $arr['googleid'] = $row['googleid'];
    $arr['username'] = $row['username'];
    $arr['gametype'] = $row['gametype'];
    $arr['title'] = $row['title'];
    $arr['discord_address'] = $row['discord_address'];
    $arr['user_tier'] = $row['user_tier'];
    array_push($return_arr,$arr);
}
header("HTTP/1.1 200 OK");
header("Request-Name: ".$request_name);
insertApiLog($clientid,"GETPost Request",$request_name,$api_key,"200 OK");
echo json_encode(array('count'=>$count, 'post' => $return_arr));
mysqli_close($con);
?>
