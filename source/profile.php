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
        <link href="./css/style2.css" rel="stylesheet">
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./img/icon.ico">
        <link rel="icon" href="./img/icon.ico">
        <title>BlackLamp BETA</title>
        <style>
        </style>
    </head>
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
            
            <?php
            session_start();
            $username = $_GET['username'];
            $googleid = "";
            $lamppoint = 0;
            $pubg_solo_tier = "";
            $pubg_duo_tier = "";
            $pubg_squad_tier = "";
            $lol_solo_tier = "";
            $lol_team_tier = "";
            $ow_dealer_tier = "";
            $ow_tanker_tier = "";
            $ow_healer_tier = "";
            $pubg_name = "";
            $ow_name = "";
            $lol_name = "";
            
           
            $con = new mysqli("localhost","root","ieelte1214","user_db");
            if(!$con) {
                echo "<div class='alert alert-danger' role='alert'>서버 연결 오류. 새로고침 해주세요.</div>";
            } else {
                $vart ="SELECT *FROM user_tb WHERE username='$username'";
                $res = $con->query($vart);
                if($res->num_rows == 0) {
                    echo '<div class="page-user-profile">';
                    echo "<div class='alert alert-danger' id'abe' role='alert'>없는 유저입니다.</div>";
                    echo "</div>";
                } else {
                    $var = mysqli_query($con,"SELECT *FROM user_tb WHERE username='$username'");
                    while($row = mysqli_fetch_array($var)) {
                        $googleid = $row['googleid'];
                        $lamppoint = $row['lamppoint'];
                    }

                    $var = mysqli_query($con,"SELECT *FROM ow_tb WHERE googleid='$googleid'");
                    while($row = mysqli_fetch_array($var)) {
                        if(empty($row['ow_dealer_tier'])) {
                            $ow_dealer_tier = "정보 없음";
                        } else {
                            $ow_dealer_tier = $row['ow_dealer_tier'];
                        }
                        
                        if(empty($row['ow_healer_tier'])) {
                            $ow_healer_tier = "정보 없음";
                        } else {
                            $ow_healer_tier = $row['ow_healer_tier'];
                        }
                        
                        if(empty($row['ow_tanker_tier'])) {
                            $ow_tanker_tier = "정보 없음";
                        } else {
                            $ow_tanker_tier = $row['ow_tanker_tier'];
                        }
                        
                        if(empty($row['ow_username'])) {
                            $ow_name = "정보 없음";
                        } else {
                            $ow_name = $row['ow_username'];
                        }
                        
                    }

                    $var = mysqli_query($con,"SELECT *FROM pubg_tb WHERE googleid='$googleid'");
                    while($row = mysqli_fetch_array($var)) {
                        if(empty($row['pubg_solo_tier'])) {
                            $pubg_solo_tier = "정보 없음";
                        } else {
                            $pubg_solo_tier = $row['pubg_solo_tier'];
                        }
                        
                        if(empty($row['pubg_duo_tier'])) {
                            $pubg_duo_tier = "정보 없음";
                        } else {
                            $pubg_duo_tier = $row['pubg_duo_tier'];
                        }
                        
                        if(empty($row['pubg_squad_tier'])) {
                            $pubg_squad_tier = "정보 없음";
                        } else {
                            $pubg_squad_tier = $row['pubg_squad_tier'];
                        }
                        
                        if(empty($row['pubg_username'])) {
                            $pubg_name = "정보 없음";
                        } else {
                            $pubg_name = $row['pubg_username'];
                        }

                    }

                    $var = mysqli_query($con,"SELECT *FROM lol_tb WHERE googleid='$googleid'");
                    while($row = mysqli_fetch_array($var)) {
                        if(empty($row['lol_solo_tier'])) {
                            $lol_solo_tier = "정보 없음";
                        } else {
                            $lol_solo_tier = $row['lol_solo_tier'];
                        }
                        
                        if(empty($row['lol_team_tier'])) {
                            $lol_team_tier = "정보 없음";
                        } else {
                            $lol_team_tier = $row['lol_team_tier'];
                        }
                        
                        if(empty($row['lol_username'])) {
                            $lol_name = "정보 없음";
                        } else {
                            $lol_name = $row['lol_username'];
                        }

                    }
                
                    echo '<div class="page-user-profile">';
                    echo '<div class="username">'.$username.'</div>';
                    echo '<hr color="black" width="50%">';
                
                    echo '<div class="game-stats">';
                
                    echo '<h6 class="game-stats-title">유저 정보</h6>';
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">Lamppoint : '.$lamppoint.'</div>';
                    echo '</div>';
                    
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">Overwatch Name : '.$ow_name.'</div>';
                    echo '</div>';
                    
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">LOL Name : '.$lol_name.'</div>';
                    echo '</div>';
                    
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">PUBG Name : '.$pubg_name.'</div>';
                    echo '</div>';
                    
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">Overwatch TANKER : '.$ow_tanker_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">Overwatch HEALER : '.$ow_healer_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">Overwatch DEALER : '.$ow_dealer_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">LOL    SOLO RANK : '.$lol_solo_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">LOL    TEAM RANK : '.$lol_team_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">PUBG   SOLO RANK : '.$pubg_solo_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">PUBG    DUO RANK : '.$pubg_duo_tier.'</div>';
                    echo '</div>';
                
                    echo '<div class="game-stats-line">';
                    echo '<div class="stats">PUBG  SQUAD RANK : '.$pubg_squad_tier.'</div>';
                    echo '</div>';
                    echo '<br>';
                    echo '</div>';               
                    echo '</div>';
                }
        
            }
            mysqli_close($con);
            ?>
            
        </div>
    </body>
</html>
