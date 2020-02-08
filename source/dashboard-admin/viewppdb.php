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
        <div class="container">
            <?php
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
    $query = "SELECT * from partypost_tb";
    $result = mysqli_query($con,$query);
    echo "<table class='table'><thead class='thead-dark'><tr><th scope='col'>Index</th><th scope='col'>GoogleID</th><th scope='col'>Username</th><th scope='col'>Gametype</th><th scope='col'>Title</th><th scope='col'>Address</th><th scope='col'>UserTier</th></tr></thead><tbody>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<th scope='row'>".$row['idx']."</th>";
        echo "<th scope='row'>".$row['googleid']."</th>";
        echo "<th scope='row'>".$row['username']."</th>";
        echo "<th scope='row'>".$row['gametype']."</th>";
        echo "<th scope='row'>".$row['title']."</th>";
        echo "<th scope='row'>".$row['discord_address']."</th>";
        echo "<th scope='row'>".$row['user_tier']."</th>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    mysqli_close($con);
}
?>
        </div>
    </body>
</html>