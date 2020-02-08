<?php
$con = new mysqli("localhost","root","ieelte1214","admin_db");
$aidc = $_POST['aidc'];
$apwc = md5($_POST['apwc']);
$anmc = $_POST['anmc'];
$vcode = md5($_POST['vcode']);
$md5vcode ="";
$nq = "SELECT * from verification_code";
$nresult = mysqli_query($con,$nq);
while($nrow = mysqli_fetch_array($nresult)) {
    $md5vcode = $nrow['md5_vcode'];
}
if($vcode != $md5vcode) {
    echo "<script>alert('인증코드 미일치.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
} else {
    $query = "INSERT INTO admin_account_tb (aid,apw,aname) VALUES ('$aidc','$apwc','$anmc')";
    $result = mysqli_query($con,$query);
    if($result) {
        echo "<script>alert('관리자계정 생성완료.')</script>";
        echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
    }
}

mysqli_close($con);
?>