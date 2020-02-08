<!DOCTYPE HTML>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154983791-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-154983791-1');
        </script>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/reset.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="246699693811-drb51542flv37ae1q8tttpt6e1v2oc72.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="shortcut icon" href="./img/icon.ico">
        <link rel="icon" href="./img/icon.ico">
        <link href="./css/style.css" rel="stylesheet">
        <title>BlackLamp BETA</title>
        <style>
            .my {
                width : 100%;
                background-color:white;
                border-radius: 4px;
                box-shadow: 4px 4px 2px gray;
                padding-bottom : 2em;
            }
            .content-title{
                font-size:1.4em;
                font-weight:bold;
                padding : 1.2em 0 1.1em 0;
            }
            .accountRemoveWarn {
                width : 50%;
                height : 22%;
                text-align: center;
                position : absolute;
                top : 50%;
                left: 50%;
                transform: translate(-50%, -50%); 
                border-radius : 5px;
                box-shadow: 2px 2px 2px 2px gray;
                background-color : white;
            }
            .disableWarn {
                text-align: right;
            }
            
        </style>
        <script>
            document.all["accountRemoveWarn"].style.display = "none";
            function onC(){
                document.location.href="https://blacklamp.lampstudio.xyz/myedit";
            }
            function onC2(){
                document.all["accountRemoveWarn"].style.display = "";
            }
            function disableW() {
                document.all["accountRemoveWarn"].style.display = "none";
            }
        </script>
    </head>
    <body style="background-color:#e4e4e4;">
        <div class="wrap">
        <?php 
        session_start();
        if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs'] == 1)) {
            echo "<script>alert('잘못된 접근입니다.');</script>";
            echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
        }
        ?>
        <div class="container">
            <div class="page-top">
                <?php
                session_start();
                if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs'] ==0 )) {
                    echo '<a href="https://blacklamp.lampstudio.xyz/sign" class="login">로그인</a>';
                } else {
                    echo '<a href="https://blacklamp.lampstudio.xyz/my" class="login">'.$_SESSION['username'].'</a>';
                }
                ?>
            </div>
            <div class="page-title">
                <span>
                    <a href="https://blacklamp.lampstudio.xyz"><img src="./img/blacklamp.png" width="103" class="logo" alt="blacklamp-logo">
                    </a>
                </span>
            </div>
            <div class="my">
                <div class="content" style="padding: 0 1em 0 1em;">
                    <h1 class="content-title">
                        기본정보    
                    </h1>
                    
                    <?php
                    session_start();
                    echo '<div style="padding-bottom:0.5em;">';
                    echo '<span style="float:left;">유저네임</span>';
                    echo '<span style="float:right;">'.$_SESSION['username'].'</span>';
                    echo '</div><br>';
                    echo '<div style="padding-bottom:0.5em;">';
                    echo '<span style="float:left;">이메일</span>';
                    $email_f = explode('@',$_SESSION['email']);
                    $email_s = substr($email_f[0],0,1);
                    echo '<span style="float:right;">'.$email_s."*********".'<span>';
                    echo '</div><br>';
                    $con = new mysqli("localhost",'root','ieelte1214',"user_db");
                    $query = "SELECT * FROM lol_tb WHERE googleid='".$_SESSION['gid']."'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result)) {
                        $lol_username = $row['lol_username'];
                        if(empty($lol_username)) { $lol_username = "정보 없음"; }
                    }
                    $query = "SELECT * FROM ow_tb WHERE googleid='".$_SESSION['gid']."'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result)) {
                        $ow_username = $row['ow_username'];
                        if(empty($ow_username)) { $ow_username = "정보 없음"; }
                    }
                    $query = "SELECT * FROM pubg_tb WHERE googleid='".$_SESSION['gid']."'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result)) {
                        $pubg_username = $row['pubg_username'];
                        if(empty($pubg_username)) { $pubg_username = "정보 없음"; }
                    }
                    echo '<div style="padding-bottom:0.5em;">';
                    echo '<span style="float:left;">리그오브레전드 닉네임</span>';
                    echo '<span style="float:right;">'.$lol_username.'</span>';
                    echo '</div><br>';
                    echo '<div style="padding-bottom:0.5em;">';
                    echo '<span style="float:left;">오버워치 닉네임</span>';
                    echo '<span style="float:right;">'.$ow_username.'</span>';
                    echo '</div><br>';
                    echo '<div style="padding-bottom:0.5em;">';
                    echo '<span style="float:left;">배틀그라운드 닉네임</span>';
                    echo '<span style="float:right;">'.$pubg_username.'</span>';
                    echo '</div><br><br><br>';
                    echo '<button type="button" class="btn btn-outline-secondary btn-lg btn-block" onclick="onC();">정보 수정</button>';
                    ?>
                    <button type="button" class="btn btn-outline-danger btn-lg btn-block" onclick="onC2();">계정 삭제</button>
                </div>
            </div>
            
        </div>
        </div>
        <div class="accountRemoveWarn" id="accountRemoveWarn">
            <div style=" padding : 1em 2em 1em 2em;">
                <span style="float:left;">정말 삭제하시겠습니까?</span>
                <span style="float:right;"><button style="border-style:none;" type="button" class="disableWarn" onclick="disableW();">×</button></span>
            </div>
            <form action="https://blacklamp.lampstudio.xyz/accountRemove" method="POST" style="padding : 0 2em 0 2em;">
                <div class="input-group mb-3" style="padding: 1em 0 1.5em 0;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">구글 계정을 입력해 주세요.</span>
                    </div>
                    <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="gid" name="gid">
                </div>
                <button type="submit" class="btn btn-outline-danger btn-sm" >계정 삭제</button>
            </form>
        </div>
        <script>
            document.all["accountRemoveWarn"].style.display = "none";
        </script>
        
        
    </body>
</html>


