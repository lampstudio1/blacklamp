<?php
header('Content-Type: application/json; charset=UTF-8');
$googleid = $_GET['googleid'];
$title = $_GET['title'];
$gametype = $_GET['gametype'];
$discord_address = $_GET['daddr'];
$tier = "";
$username = "";

$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    echo json_encode(array('status' => 500));
} else {
    $var = mysqli_query($con,"SELECT *FROM user_tb WHERE googleid='$googleid'");
    while($row = mysqli_fetch_array($var)) {
        $username = $row['username'];
    }
    if($gametype == "0") {
         $var = mysqli_query($con, "SELECT *FROM lol_tb WHERE googleid='$googleid'");
         while($row = mysqli_fetch_array($var)) {
             $tier = $row['lol_solo_tier'];
         }
    }
    if($gametype == "1") {
         $var = mysqli_query($con, "SELECT *FROM ow_tb WHERE googleid='$googleid'");
         while($row = mysqli_fetch_array($var)) {
             $tier = $row['ow_dealer_tier'];
         }
    }
    if($gametype == "2") {
         $var = mysqli_query($con, "SELECT *FROM pubg_tb WHERE googleid='$googleid'");
         while($row = mysqli_fetch_array($var)) {
             $tier = $row['pubg_solo_tier'];
         }
    }
    $ins = "INSERT INTO partypost_tb (googleid,username,gametype,title,discord_address,user_tier) VALUES ('$googleid','$username','$gametype','$title','$discord_address','$tier')";
    $req = mysqli_query($con, $ins);
    if($req) {
        echo json_encode(array('status' => 200));
    } else {
        echo json_encode(array('status' => 500));
    }
    mysqli_close($con);
   
}

?>