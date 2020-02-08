<?php
header('Content-Type: application/json; charset=UTF-8');
$googleid = $_GET['googleid'];
$owname = $_GET['owname'];
$pubgname = $_GET['pubgname'];
$lolname = $_GET['lolname'];
$cnt = 0;

$con = new mysqli("localhost","root","ieelte1214","user_db");

$var = "UPDATE ow_tb SET ow_username='$owname' WHERE googleid='$googleid'";
$result = mysqli_query($con,$var);
if($result) {
    $cnt += 1;
}

$var = "UPDATE lol_tb SET lol_username='$lolname' WHERE googleid='$googleid'";
$result = mysqli_query($con,$var);
if($result) {
    $cnt += 1;
}

$var = "UPDATE pubg_tb SET pubg_username='$pubgname' WHERE googleid='$googleid'";
$result = mysqli_query($con,$var);
if($result) {
    $cnt += 1;
}

if($cnt == 3) {
    echo json_encode(array('status' => 200))
} else {
    echo json_encode(array('status' => 500))
}
$con->close();

?>