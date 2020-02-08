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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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

    </head>
    <body style="background-color:#e4e4e4;">
        <?php
	require '/home/ieelte/log/slog.php';
        session_start();
        include('config.php');
        $redirect_url = 'https://blacklamp.lampstudio.xyz/sign';
        
      if(isset($_REQUEST['logout'])) { unset($_SESSION['id_token_token']); }
      if(isset($_GET['code'])) {
          $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
          $_SESSION['id_token_token'] =$token;
          header('Location: '.filter_var($redirect_url, FILTER_SANITIZE_URL));
          return;
      }
        if(!empty($_SESSION['id_token_token']) && isset($_SESSION['id_token_token']['id_token'])) {
            $google_client->setAccessToken($_SESSION['id_token_token']);
        } else {
            $authURL = $google_client->createAuthUrl();
        }
        
        if($google_client->getAccessToken()) {
            $token_data = $google_client->verifyIdToken();
            $ret = $token_data['sub'];
            $email = $token_data['email'];
            $unme = "";
            $con = new mysqli("localhost","root","ieelte1214","user_db");
            $query = "SELECT * FROM user_tb WHERE googleid='".$ret."'";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result)) {
                $unme = $row['username'];
            }
            $cnt = mysqli_num_rows($result);
            if($cnt == 0) {
                $_SESSION['gid'] = $ret;
                $_SESSION['rs'] = 1;
                $_SESSION['email'] = $email;
		insertWebSignLog($_SESSION['gid'],"R");
                echo "<script>document.location.href='https://blacklamp.lampstudio.xyz/signup';</script>";
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['gid'] = $ret;
                $_SESSION['username'] = $unme;
                $_SESSION['rs'] = 0;
		insertWebSignLog($_SESSION['gid'],"L");
                echo "<script>document.location.href='https://blacklamp.lampstudio.xyz';</script>";
            }
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
            <div class="page-login">
                <div style ="padding : 1em 1em 1em 1em;">
                    <div class="page-login-text">
                       BlackLamp 서비스는 Google 로그인으로 사용할 수 있습니다.<br>현재 서비스 개발 중 입니다.
                    </div>
                    <?php 
                    echo "<a class='btn btn-outline-primary btn-lg btn-block' href='".$authURL."' role='button'>구글 로그인</a>";
                    ?>
		            
                    
                </div>
                
            </div>
           
        </div>
    </body>
</html>
