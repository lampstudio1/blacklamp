<?php
header('Content-Type: application/json; charset=UTF-8');
$username = $_GET["username"];
$googleid = "";
$lamppoint = 0;
$pubg_solo_tier = "";
$pubg_duo_tier = "";
$pubg_squad_tier = "";
$lol_solo_tier = "";
$lol_team_tier = "";
$ow_dealer_tier = "";
$ow_tanker_tier = "";
$ow_healer_tier = "";

$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    echo json_encode(array('status' => 500));
} else {
    $var = mysqli_query($con,"SELECT *FROM user_tb WHERE username='$username'");
    while($row = mysqli_fetch_array($var)) {
        $googleid = $row['googleid'];
        $lamppoint = $row['lamppoint'];
    }

    $var = mysqli_query($con,"SELECT *FROM ow_tb WHERE googleid='$googleid'");
    while($row = mysqli_fetch_array($var)) {
        $ow_dealer_tier = $row['ow_dealer_tier'];
        $ow_tanker_tier = $row['ow_tanker_tier'];
        $ow_healer_tier = $row['ow_healer_tier'];
    }

    $var = mysqli_query($con,"SELECT *FROM pubg_tb WHERE googleid='$googleid'");
    while($row = mysqli_fetch_array($var)) {
        $pubg_solo_tier = $row['pubg_solo_tier'];
        $pubg_duo_tier = $row['pubg_duo_tier'];
        $pubg_squad_tier = $row['pubg_squad_tier'];
    }

    $var = mysqli_query($con,"SELECT *FROM lol_tb WHERE googleid='$googleid'");
    while($row = mysqli_fetch_array($var)) {
        $lol_solo_tier = $row['lol_solo_tier'];
        $lol_team_tier = $row['lol_team_tier'];
    }
    echo json_encode(array('status' => 200, 'username' => $username, 'lamppoint' => $lamppoint, 'lol_solo_tier' => $lol_solo_tier, 'lol_team_tier' => $lol_team_tier, 'pubg_solo_tier' => $pubg_solo_tier, 'pubg_duo_tier' => $pubg_duo_tier, 'pubg_squad_tier' => $pubg_squad_tier, 'ow_dealer_tier' => $ow_dealer_tier, 'ow_tanker_tier' => $ow_tanker_tier, 'ow_healer_tier' => $ow_healer_tier));
    mysqli_close($con);
}

?>