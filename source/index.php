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
        <script>
            function GoCreatePPost() {
                document.location.href='https://blacklamp.lampstudio.xyz/post-upload';
            }
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
        <style>
            .lpointlist{
                color:gray;
                text-decoration:none;
                font-size: 0.9em;
                padding : 0.3em 1em 0 0;
                float:right;
            }
        </style>
        <link href="./css/style.css" rel="stylesheet">
        <title>BlackLamp BETA</title>
        
    </head>
    <body style="background-color:#e4e4e4;">
        <div class="ads-kakao-right">
            <ins class="kakao_ad_area" style="display:none;" 
            data-ad-unit    = "DAN-r1fnqfuzdnxi" 
            data-ad-width   = "160" 
            data-ad-height  = "600"></ins> 
            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
        </div>
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
                    <a href=""><img src="./img/blacklamp.png" width="103" class="logo" alt="blacklamp-logo">
                    </a>
                </span>
            </div>
            <form class="input-group mb-3" action="./profile" method="GET">
                    <input type="text" class="form-control" placeholder="유저 프로필 검색" aria-label="Recipient's username" aria-describedby="button-addon2" id="username" name="username">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                    </div>
            </form>
            <div class="ad">
                <ins class="kakao_ad_area" style="display:none;" 
 data-ad-unit    = "DAN-r1ivhdmobf3r" 
 data-ad-width   = "320" 
 data-ad-height  = "50"></ins> 
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </div>
            <?php
            $con = new mysqli("localhost","root","ieelte1214","user_db");
            if(!$con) {
                echo "<div class='alert alert-danger' role='alert'>서버 연결 오류. 새로고침 해주세요.</div>";
            }
            $var = "SELECT *FROM partypost_tb ORDER BY idx DESC";
            $result = mysqli_query($con,$var);
            if(!$result) {
                echo "<div class='alert alert-danger' role='alert'>서버 연결 오류. 새로고침 해주세요.</div>";
            }
            echo "<button type='button' class='btn btn-outline-primary btn-lg btn-block' onclick='GoCreatePPost();'>파티 포스트 만들기</button>";
            while($row = mysqli_fetch_array($result)) {
                
                echo '<div class="card" style="margin : 2em 0 2em 0;">';
                switch($row['gametype']) {
                    case "0":
                        echo '<h5 class="card-header" style="font-weight:700;">LOL</h5>';
                        break;
                    case "1":
                        echo '<h5 class="card-header" style="font-weight:700;">Overwatch</h5>';
                        break;
                    case "2":
                        echo '<h5 class="card-header" style="font-weight:700;">PUBG</h5>';
                        break;
                }
		$tier = $row['user_tier'];
		if(empty($tier)) {
		    $tier = "정보 없음";
		}
                echo '<div class="card-body">';
                echo '<h5 class="card-title" style="font-weight:700;">'.$row['title'].'</h5>';
                echo '<div class="card-text">'.$row['username'].' / '.$tier.'</div>';
                echo '<div class="text-right"><a href="'.$row['discord_address'].'"class="btn btn-outline-primary text-right">파티 참여</a></div>';
                echo '</div>';
                echo '</div>';
            }
            mysqli_close($con);
            ?>
            <div class="ad">
                <ins class="kakao_ad_area" style="display:none;" 
 data-ad-unit    = "DAN-s4v4aapd8jfm" 
 data-ad-width   = "320" 
 data-ad-height  = "50"></ins> 
<script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </div>
            <div class="page-footer" style="text-align:center;">
                <div class="page-footer-link">
                    <a href="#" class="alink">회사소개</a> |
                    <a href="#" class="alink">약관</a> |
                    <a href="#" class="alink">개인정보취급방침</a> |
                    <a href="https://blacklamp.lampstudio.xyz/help" class="alink">도움말</a>
                </div>
                <br>
                <div class="page-footer-info">
                    <p>
                        LampStudio   대표:  
                    </p>
                    <p>
                        사업자등록번호: 123-45-67890
                    </p>
                    <p>Copyright 2019. LampStudio all rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>










