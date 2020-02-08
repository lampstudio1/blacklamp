<?php
session_start();
if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs'] == 1)) {
    echo "<script>alert('잘못된 접근입니다.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    exit;
}
if($_POST['gid'] != $_SESSION['email']) {
    echo "<script>alert('email이 일치하지 않습니다.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}

$con = new mysqli("localhost","root","ieelte1214","user_db");
if(!$con){
    echo "<script>alert('서버 오류. 다시 시도하여 주세요.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}
$gid = $_SESSION['gid'];
$query = "DELETE FROM lol_tb WHERE googleid='".$gid."'"; //lol
if(mysqli_query($con,$query)) {

} else {
    echo "<script>alert('1RE 오류. contact.lampstudio@gmail.com 으로 구글 이메일과 함께 문의해주세요.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}

$query = "DELETE FROM ow_tb WHERE googleid='".$gid."'"; //ow
if(mysqli_query($con,$query)) {

} else {
    echo "<script>alert('2RE 오류. contact.lampstudio@gmail.com 으로 구글 이메일과 함께 문의해주세요.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}

$query = "DELETE FROM pubg_tb WHERE googleid='".$gid."'"; //pubg
if(mysqli_query($con,$query)) {

} else {
    echo "<script>alert('3RE 오류. contact.lampstudio@gmail.com 으로 구글 이메일과 함께 문의해주세요.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}

$query = "DELETE FROM user_tb WHERE googleid='".$gid."'"; //user
if(mysqli_query($con,$query)) {

} else {
    echo "<script>alert('5RE 오류. contact.lampstudio@gmail.com 으로 구글 이메일과 함께 문의해주세요.');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/my';</script>";
    exit;
}

echo "<script>alert('정상적으로 계정삭제가 되었습니다.');</script>";
echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
$_SESSION['gid'] = null;
$_SESSION['username'] = null;
$_SESSION['rs'] = null;
$_SESSION['email'] = null;
mysqli_close($con);

?>
