<?php
session_start();
if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs'] == 1 )) {
    echo "<script>alert('잘못된 접근입니다.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
}
$ow = $_POST['ow_username'];
$lol = $_POST['lol_username'];
$pubg = $_POST['pubg_username'];
$gid = $_SESSION['gid'];
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    echo "<script>alert('서버가 불안정합니다.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
}
function lolUpdate() {
    global $lol, $gid, $con;
    $query = "UPDATE lol_tb SET lol_username='".$lol."' WHERE googleid='".$gid."'";
    $var = mysqli_query($con,$query);
    if(!$var) {
        echo "<script>alert('정보 수정에 실패하였습니다.');</script>";
        echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    }
}
function owUpdate() {
    global $ow, $gid, $con;
    $query = "UPDATE ow_tb SET ow_username='".$ow."' WHERE googleid='".$gid."'";
    $var = mysqli_query($con,$query);
    if(!$var) {
        echo "<script>alert('정보 수정에 실패하였습니다.');</script>";
        echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    }
}
function pubgUpdate() {
    global $pubg, $gid, $con;
    $query = "UPDATE pubg_tb SET pubg_username='".$pubg."' WHERE googleid='".$gid."'";
    $var = mysqli_query($con,$query);
    if(!$var) {
        echo "<script>alert('정보 수정에 실패하였습니다.');</script>";
        echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>"; 
    }

}
if(empty($ow)){
    $status['ow'] = 0;
} else {
    $status['ow'] = 1;
}

if(empty($lol)){
    $status['lol'] = 0;
} else {
    $status['lol'] = 1;
}

if(empty($pubg)){
    $status['pubg'] = 0;
} else {
    $status['pubg'] = 1;
}

if($status['ow'] == 1) {
    owUpdate();
}

if($status['lol'] == 1) {
    lolUpdate();
}

if($status['pubg'] == 1) {
    pubgUpdate();
}



mysqli_close($con);

echo "<script>alert('정보 수정 성공!');</script>";
echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>"; 

?>