<?php
header('Content-Type: application/json; charset=UTF-8');
        
        
$googleid = $_GET["googleid"];
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con){
    echo json_encode(array('status' => 500));
}
$login="SELECT *from user_tb WHERE googleid='$googleid'";
$result=$con->query($login);
if($result->num_rows >= 1) {
    echo json_encode(array('status' => 200, 'id' => $googleid));
} else {
    echo json_encode(array('status' => 100, 'id' => $googleid));
}
$con->close();
?>