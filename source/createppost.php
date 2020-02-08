<?php
session_start();
if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs'] ==0 )) {
    echo "<script>alert('로그인 한 후에 사용해 주세요.')<script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/sign';</script>";
}
$gid = $_SESSION['gid'];
$unme = $_SESSION['username'];
$ptitle = $_POST['title'];
$gamekind = $_POST['gamek'];
$address = "https://discord.gg/".$_POST['daddr'];
$usertier = "";
if(!$ptitle){
    echo "<script>alert('Null');</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    exit;
}
$con = new mysqli("localhost","root",'ieelte1214',"user_db");
if(!$con) {
    echo "<script>alert('데이터베이스 연결 실패. 관리자에게 문의하세요.')</script>";
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    exit;
}
switch ($gamekind) {
    case "0":
        $query = "SELECT * from lol_tb WHERE googleid='$gid'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)) {
            $usertier = $row['lol_solo_tier'];
            
        }
        break;
    case "1":
        $query = "SELECT * from ow_tb WHERE googleid='$gid'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)) {
            $usertier = $row['ow_dealer_tier'];
        }
        break;
    case "2":
        $query = "SELECT * from pubg_tb WHERE googleid='$gid'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)) {
            $usertier = $row['pubg_solo_tier'];
        }
        break;
}
if(empty($usertier)) {
    $usertier = "정보 없음";
}
if($usertier = ""){
    $usertier = "정보 없음";
}
$query = "INSERT INTO partypost_tb (googleid,username,gametype,title,discord_address,user_tier) VALUES ('$gid','$unme','$gamekind','$ptitle','$address','$usertier')";
$result = mysqli_query($con,$query);
if($result) {
    echo "<script>alert('파티 포스트 업로드 완료!')</script>";
    mysqli_close($con);
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
} else {
    echo "<script>alert('쿼리 작업 실패. 관리자에게 문의하세요.')</script>";
    mysqli_close($con);
    echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
    exit;
}

?>
