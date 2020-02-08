<?php
header('Content-Type: application/json; charset=UTF-8');
$googleid = $_GET['googleid'];
$owname = $_GET['owname'];
$pubgname = $_GET['pubgname'];
$lolname = $_GET['lolname'];
$username = $_GET['username'];
$cnt = 0;

$con = new mysqli("localhost","root","ieelte1214","user_db");

$var = "INSERT INTO user_tb (googleid,username) VALUES ('$googleid','$username')";
$req = mysqli_query($con,$var);
if(!$req) {
    echo json_encode(array('status' => 500));
} else {
    $var = "INSERT INTO ow_tb (googleid,ow_username) VALUES ('$googleid','$owname')";
    $req = mysqli_query($con,$var);
    if($req) {
        $cnt += 1;
    }
    $var = "INSERT INTO lol_tb (googleid,lol_username) VALUES ('$googleid','$lolname')";
    $req = mysqli_query($con,$var);
    if($req) {
        $cnt += 1;
    }
    $var = "INSERT INTO pubg_tb (googleid,pubg_username) VALUES ('$googleid','$pubgname')";
    $req = mysqli_query($con,$var);
    if($req) {
        $cnt += 1;
    }
    if($req == 3 ){
      echo json_encode(array('status' => 200, 'googleid' => $googleid));  
    } else {
        echo json_encode(array('status' => 500));
    }
    
}
$con->close();
?>