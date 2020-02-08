<?php
$vcode = md5($_POST['vcode']);
$queryValue = $_POST['query'];
$dbname = $_POST['dbname'];
$cccon = new mysqli("localhost","root","ieelte1214","admin_db");
$md5vcode ="";
$nq = "SELECT * from verification_code";
$nresult = mysqli_query($cccon,$nq);
while($nrow = mysqli_fetch_array($nresult)) {
    $md5vcode = $nrow['md5_vcode'];
}
if($vcode != $md5vcode) {
    echo "<script>alert('인증코드 미일치.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
} else {
    $con = new mysqli("localhost","root","ieelte1214",$dbname);
    if(!$con) {
        echo "<script>alert('DB연결 실패. DB확인을 위해 서버 관리자에게 문의해주세요.')</script>";
        echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/dashboard.php';</script>";
    } else {
        $result = mysqli_query($con,$queryValue);
        if(!$result) {
            echo "<script>alert('쿼리 실행 실패. DB확인을 위해 서버 관리자에게 문의해주세요.')</script>";
            echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/dashboard.php';</script>";
        } else {
            echo "<script>alert('쿼리 실행 완료.')</script>";
            echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/dashboard.php';</script>";
        }

    }
}

mysqli_close($con);
?>