<?php
header('Content-Type: application/json; charset=UTF-8');

$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    echo json_encode(array('status' => 500));
    return;
}

$return_arr = array();
$var = "SELECT *FROM partypost_tb ORDER BY idx DESC";
$result = mysqli_query($con,$var);
$count = 0;
if(!$result) {
    echo json_encode(array('status' => 500));
}
while($row = mysqli_fetch_array($result)) {
    $count++;
    $arr['googleid'] = $row['googleid'];
    $arr['username'] = $row['username'];
    $arr['gametype'] = $row['gametype'];
    $arr['title'] = $row['title'];
    $arr['discord_address'] = $row['discord_address'];
    $arr['user_tier'] = $row['user_tier'];
    array_push($return_arr,$arr);
    
}
echo json_encode(array('status' => 200, 'count' => $count, 'value' => $return_arr));

mysqli_close($con);
?>