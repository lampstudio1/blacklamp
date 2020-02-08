<?php
session_start();
if(!isset($_SESSION['gid']) or (!isset($_SESSION['rs']) or $_SESSION['rs'] == 0)) {
    echo "<script>alert('잘못된 접근입니다.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
}

$username = $_POST['username'];
$ow_username = $_POST['ow_username'];
$pubg_username = $_POST['pubg_username'];
$lol_username = $_POST['lol_username'];
$googleid = $_SESSION['gid'];
$email = $_SESSION['email'];
$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con) {
    echo "<script>alert('데이터베이스 접속 오류.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/signup';</script>";
    exit;
}
$query = "SELECT * FROM user_tb WHERE username='".$username."'";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);
if($count == 1) {
    echo "<script>alert('닉네임 중복.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/signup';</script>";
    exit;
}
if(!$username){
    echo "<script>alert('nullpointerexception');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/signup';</script>";
    exit;
}
$query = "INSERT INTO user_tb (googleid,username,email) VALUES ('$googleid','$username','$email')";
$req = mysqli_query($con,$query);
if(!$req) {
    echo "<script>alert('쿼리 생성 실패.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/signup';</script>";
    exit;
}
$query = "INSERT INTO lol_tb (googleid,lol_username) VALUES ('$googleid','$lol_username')";
$req = mysqli_query($con,$query);
$query = "INSERT INTO ow_tb (googleid,ow_username) VALUES ('$googleid','$ow_username')";
$req = mysqli_query($con,$query);
$query = "INSERT INTO pubg_tb (googleid,pubg_username) VALUES ('$googleid','$pubg_username')";
$req = mysqli_query($con,$query);

$_SESSION['rs'] == 0;
echo "<script>alert('정상적으로 회원가입이 완료되었습니다.');</script>";
echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
$_SESSION['username'] = $username;

mysqli_close($con);


?>
