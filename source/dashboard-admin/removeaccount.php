<?php
$rnme = $_POST['rnme'];
$googleid = "";
$vcode = md5($_POST['vcode']);
$md5vcode ="";
$cccon = new mysqli("localhost","root","ieelte1214","admin_db");
$nq = "SELECT * from verification_code";
$nresult = mysqli_query($cccon,$nq);
while($nrow = mysqli_fetch_array($nresult)) {
    $md5vcode = $nrow['md5_vcode'];
}
if($vcode != $md5vcode) {
    echo "<script>alert('인증코드 미일치.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
} else {
    $con = new mysqli("localhost","root","ieelte1214","user_db");
    $result = mysqli_query($con,"SELECT * FROM user_tb WHERE username='$rnme'");
    while($row = mysqli_fetch_array($result)) {
        $googleid = $row['googleid'];
    }
    //user삭제
    mysqli_query($con,"DELETE FROM user_tb WHERE googleid='$googleid'");
    mysqli_query($con,"DELETE FROM ow_tb WHERE googleid='$googleid'");
    mysqli_query($con,"DELETE FROM pubg_tb WHERE googleid='$googleid'");
    mysqli_query($con,"DELETE FROM lol_tb WHERE googleid='$googleid'");
    mysqli_close($con);
    
    echo "<script>alert('삭제 완료.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/dashboard.php';</script>";
    
}


?>