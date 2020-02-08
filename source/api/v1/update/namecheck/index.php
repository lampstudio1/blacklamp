<?php
header('Content-Type: application/json; charset=UTF-8');
        
        
$username = $_GET["username"];
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con){
    echo json_encode(array('status' => 500));
}
$login="SELECT *from user_tb WHERE username='$username'";
$result=$con->query($login);
if($result->num_rows >= 1) {
    echo json_encode(array('status' => 600));
} else {
    echo json_encode(array('status' => 200));
}
$con->close();
?>