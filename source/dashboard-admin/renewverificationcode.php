<?php
$oldvcode = $_POST['vcode1'];
$oldvcodet = $_POST['vcode2'];
$newvcode = $_POST['vcode3'];
$newvcodet = $_POST['vcode4'];
$sqlvcode_md5 = ""; 

if(($oldvcode == $oldvcodet) and ($newvcode == $newvcodet)) {
    $con = new mysqli("localhost","root","ieelte1214","admin_db");
    $query = "SELECT * from verification_code";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result)) {
        $sqlvcode_md5 = $row['md5_vcode'];
    }
    if (md5($oldvcode) == $sqlvcode_md5) {
        $query = "TRUNCATE verification_code";
        $result = mysqli_query($con,$query);
        $md5vcode = md5($newvcode);
        $query = "INSERT INTO verification_code (normal_vcode,md5_vcode) VALUES ('$newvcode','$md5vcode')";
        $result = mysqli_query($con,$query);
        if($result) {
            echo "<script>alert('정상적으로 수정 완료.')</script>";
            echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
        } else {
            echo "<script>alert('DB오류.')</script>";
            echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
        }
        
        
    } else {
        echo "<script>alert('인증코드 불일치.')</script>";
        echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
    }
    mysqli_close($con);
} else {
    echo "<script>alert('인증코드 불일치.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
}
?>