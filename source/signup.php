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
        <link href="./css/reset.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="./css/style.css" rel="stylesheet">
        <link href="./css/style4.css" rel="stylesheet">
        <meta charset='utf-8'>
	<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="246699693811-drb51542flv37ae1q8tttpt6e1v2oc72.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/icon.ico">
        <link rel="icon" href="./img/icon.ico">
        <title>BlackLamp BETA</title>
        <style>
        </style>
    </head>
    <body style="background-color:#e4e4e4;">
        <?php 
        session_start();
        if(!isset($_SESSION['gid']) or (!isset($_SESSION['rs']) or $_SESSION['rs'] == 0)) {
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
                    <a href="https://blacklamp.lampstudio.xyz"><img src="./img/blacklamp.png" width="103px"class="logo" alt="blacklamp-logo">
                    </a>
                </span>
            </div>
            <div class="signupform" style="background-color : white; border-radius: 4px; box-shadow: 3px 3px 3px 3px gray; padding: 2em 2em 2em 2em; margin-top : 0.8em;">
                <p style="font-size :1.3em; padding: 0 0 1em 0;">
                    추가 정보 입력
                </p>
                <form action="https://blacklamp.lampstudio.xyz/createaccount" method="POST">
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">닉네임</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="username" name="username">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">오버워치닉네임</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="ow_username" name="ow_username" placeholder="nickname#12345">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">롤닉네임</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="lol_username" name="lol_username">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">배그닉네임</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="pubg_username" name="pubg_username">
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">회원가입</button>
                    
                    
                </form>
            </div>
            
            
            
            
            
            
            
            
            
            
        </div>
    </body>
</html>
