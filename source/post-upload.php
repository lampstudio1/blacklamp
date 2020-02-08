<!DOCTYPE HTML>
<html>
    <head>
        <link href="./css/reset.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="./css/style.css" rel="stylesheet">
        <link href="./css/style3.css" rel="stylesheet">
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/icon.ico">
        <link rel="icon" href="./img/icon.ico">
        <title>BlackLamp BETA</title>
        <style>
        </style>
    </head>
    <?php
    session_start();
    if(!isset($_SESSION['gid']) and (!isset($_SESSION['rs']) or $_SESSION['rs']==1 )) {
        echo "<script>alert('로그인 한 회원만 사용할 수 있습니다. 로그인 해 주세요.')</script>";
        echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/sign';</script>";
    }
    ?>
    <body style="background-color:#e4e4e4;">
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
            <div class="postupform" style="background-color : white; border-radius: 4px; box-shadow: 3px 3px 3px 3px gray; padding: 2em 2em 2em 2em; margin-top : 0.8em;">
                <p style="font-size :1.3em; padding: 0 0 1em 0;">
                    파티 포스트 생성
                </p>
                <form action="https://blacklamp.lampstudio.xyz/createppost" method="POST">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">파티 타이틀</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="title">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">게임 종류</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="gamek">
                            <option value="0">LOL</option>
                            <option value="1">Overwatch</option>
                            <option value="2">PUBG</option>
                        </select>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">https://discord.gg/</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" placeholder="디스코드 주소" aria-describedby="inputGroup-sizing-default" name="daddr">
                    </div>
                    
                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">생성</button>
                    
                </form>
            </div>
            
            
        </div>
    </body>
</html>
