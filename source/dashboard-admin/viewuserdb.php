<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/reset.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="shortcut icon" href="../img/icon.ico">
        <link rel="icon" href="../img/icon.ico">
        <title>BlackLamp Admin Dashboard</title>
    </head>
    <body>
        <div class="container1">
            <?php
$vcode = md5($_POST['vcode']);
$count = 0;
$md5vcode ="";
$cccon = new mysqli("localhost","root","ieelte1214","admin_db");
$nq = "SELECT * from verification_code";
$nresult = mysqli_query($cccon,$nq);
while($nrow = mysqli_fetch_array($nresult)) {
    $md5vcode = $nrow['md5_vcode'];
}
echo "<script>alert(".$md5vcode.")</script>";
if($vcode != $md5vcode) {
    echo "<script>alert('인증코드 미일치.')</script>";
    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz/dashboard-admin/';</script>";
} else {
    $con = new mysqli("localhost","root","ieelte1214","user_db");
    $query = "SELECT * from user_tb";
    $result = mysqli_query($con,$query);
    echo "<table class='table'><thead class='thead-dark'><tr><th scope='col'>#</th><th scope='col'>GoogleID</th><th scope='col'>eMail</th><th scope='col'>Username</th><th scope='col'>LampPoint</th><th scope='col'>OW_username</th><th scope='col'>OW_Tank_tier</th><th scope='col'>OW_Deal_tier</th><th scope='col'>OW_Heal_tier</th><th scope='col'>LOL_Username</th><th scope='col'>LOL_Solo_Tier</th><th scope='col'>LOL_Team_tier</th><th scope='col'>PUBG_Username</th><th scope='col'>PUBG_SOLO_tier</th><th scope='col'>PUBG_DUO_tier</th><th scope='col'>PUBG_SQUAD_tier</th></tr></thead><tbody>";
    while($row = mysqli_fetch_array($result)) {
        $gid = $row['googleid'];
        $count = $count + 1;
        echo "<tr>";
        echo "<th scope='row'>".$count."</th>";
        echo "<th scope='row'>".$gid."</th>";
        echo "<th scope='row'>".$row['email']."</th>";
        echo "<th scope='row'>".$row['username']."</th>";
        echo "<th scope='row'>".$row['lamppoint']."</th>";
        $nquery = "SELECT * from ow_tb WHERE googleid='$gid'";
        $nresult = mysqli_query($con,$nquery);
        while($nrow = mysqli_fetch_array($nresult)) {
            echo "<th scope='row'>".$nrow['ow_username']."</th>";
            echo "<th scope='row'>".$nrow['ow_tanker_tier']."</th>";
            echo "<th scope='row'>".$nrow['ow_dealer_tier']."</th>";
            echo "<th scope='row'>".$nrow['ow_healer_tier']."</th>";
        }
        $nquery = "SELECT * from lol_tb WHERE googleid='$gid'";
        $nresult = mysqli_query($con,$nquery);
        while($nrow = mysqli_fetch_array($nresult)) {
            echo "<th scope='row'>".$nrow['lol_username']."</th>";
            echo "<th scope='row'>".$nrow['lol_solo_tier']."</th>";
            echo "<th scope='row'>".$nrow['lol_team_tier']."</th>";
        }
        $nquery = "SELECT * from pubg_tb WHERE googleid='$gid'";
        $nresult = mysqli_query($con,$nquery);
        while($nrow = mysqli_fetch_array($nresult)) {
            echo "<th scope='row'>".$nrow['pubg_username']."</th>";
            echo "<th scope='row'>".$nrow['pubg_solo_tier']."</th>";
            echo "<th scope='row'>".$nrow['pubg_duo_tier']."</th>";
            echo "<th scope='row'>".$nrow['pubg_squad_tier']."</th>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
    mysqli_close($con);
}
?>
        </div>
    </body>
</html>


