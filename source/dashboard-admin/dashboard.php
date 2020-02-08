<!DOCTYPE HTML>
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
        <style>
            .title {
                font-size : 2.5em;
                margin: 0.5em 0 2em 0;
            }
        </style>
    </head>
    <body style="background-color : #e4e4e4;">
        <?php
        session_start();
        if(isset($_SESSION['aid'])) {
            
        } else {
            $aid = $_POST['aid'];
            $apw = md5($_POST['apw']);
            $admin_db_con = new mysqli("localhost","root","ieelte1214","admin_db");
            $query = "select * from admin_account_tb where aid='$aid'";
            $result = $admin_db_con->query($query);
            if(mysqli_num_rows($result)==1) {
                $row=mysqli_fetch_assoc($result);
                if($row['apw'] == $apw) {
                    $_SESSION['aid']=$row['aid'];
                    $_SESSION['aname']=$row['aname'];
                } else {
                    ?>
                    <script>alert('관리자 DB 없음.2')</script> <?php
                    echo "<script>document.location.href='http://blacklamp.lampstudio.xyz';</script>";
                }
            } else {
                 ?>
                <script>alert('관리자 DB 없음.1')</script> <?php
                echo "<script>document.location.href='http://blacklamp.lampstudio.xyz';</script>";
            }
        }
        
        
        ?>
        <div class="container" style="padding: 0 0.5em 0 0.5em;">
            <div>
            <span class="title" >
                    Blacklamp Admin Dashboard
            </span>
            <?php
            
            session_start();
            if(!isset($_SESSION['aname'])) {
                echo "<script>document.location.href='http://blacklamp.lampstudio.xyz';</script>";
            }
            echo "<span class='username'>".$_SESSION['aname']."님 접속 </span></div>";

            $userdb_con = new mysqli("localhost","root","ieelte1214","user_db");
            $query = "SELECT COUNT(*) FROM user_tb";
	        $user_db_count_result = mysqli_query($userdb_con,$query);
	        $upon1 = mysqli_fetch_array($user_db_count_result);
            $query = "SELECT COUNT(*) FROM partypost_tb";
            $pp_tb_count_result = mysqli_query($userdb_con,$query);
	        $upon2 = mysqli_fetch_array($pp_tb_count_result);
            $ccon = new mysqli("localhost","root","ieelte1214","admin_db");
            $query = "SELECT COUNT(*) FROM admin_account_tb";
            $result = mysqli_query($ccon,$query);
            $upon3 = mysqli_fetch_array($result);
            echo "<br><br><br><div class='basicinfo-t'><b>기본정보</b></div>";
            echo "<br><div class='basicinfo' style='width:50%;'>";
            echo "<table class='table table-dark' style='margin-left: auto; margin-right: auto;'><thead><tr><th>User Count</th><th>Partypost Count</th><th>Admin Account Count</th></thead>";
            echo "<tbody><tr><th>".$upon1[0]."</th><th>".$upon2[0]."</th><th>".$upon3[0]."</th></tr></tbody></table></div>";
            mysqli_close($ccon);
            mysqli_close($userdb_con);
            ?>
            <br><br><br>
                <div class="phpscripton-t">
                    <b>PHP 스크립트 실행 (사용불가)</b>
                </div>
                <div class="phpscripton">
                    <form class='usergamedbupdate' action="" method="POST">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">유저 게임DB 업데이트</span>
                      </div>
                      <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="vcode" name="vcode" placeholder="인증코드(서버 관리자에게 문의)">
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">요청</button>
                      </div>
                    </div>
                    </form><br>
                    
                    <form class='partypostclear' action="" method="POST">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">파티포스트 전체삭제</span>
                      </div>
                      <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="vcode" name="vcode" placeholder="인증코드(서버 관리자에게 문의)">
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">요청</button>
                      </div>
                    </div>
                    </form><br>
                    
                </div><br><br><br>
                <div class="create-adminaccount-t"><b>관리자 계정 생성</b>
                <div class="create-adminaccount">
                    <form action="./createadmin.php" method="post">
                        <div class="input-group input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Admin ID</span>
                          </div>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="aidc" name="aidc">
                        </div>
                        
                        <div class="input-group input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Admin PW</span>
                          </div>
                            <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="apwc" name="apwc">
                        </div>
                        
                        <div class="input-group input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Admin Name</span>
                          </div>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="anmc" name="anmc">
                        </div>
                        
                        <div class="input-group input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">인증코드</span>
                          </div>
                            <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="vcode" name="vcode" placeholder="서버 관리자에게 문의">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">생성</button>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
              </div> <br><br><br>
                <div class="removeaccount-t"><b>일반 사용자 계정 삭제</b></div>
                <div class="removeaccount">
                    <form action="./removeaccount.php" method="post">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                          </div>
                              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="rnme" name="rnme">
                        </div>
                        
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="인증코드(서버 관리자에게 문의)" aria-label="username" aria-describedby="button-addon2" id="vcode" name="vcode">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">삭제</button>
                        </div>
                        </div>
                    </form>
                    
                </div>
                <br><br><br>
                <div class="viewuserdb-t"><b>USER DB 조회</b></div>
                <div class="viewuserdb">
                    <form action="./viewuserdb.php" method="post">
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="인증코드(서버 관리자에게 문의)" aria-label="Recipient's username" aria-describedby="button-addon2" id="vcode" name="vcode">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">조회</button>
                          </div>
                        </div>
                    </form>
                </div><br><br><br>
                
                <div class="viewppdb-t"><b>PARTYPOST DB 조회</b></div>
                <div class="viewppdb">
                    <form action="./viewppdb.php" method="post">
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="인증코드(서버 관리자에게 문의)" aria-label="Recipient's username" aria-describedby="button-addon2" id="vcode" name="vcode">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">조회</button>
                          </div>
                        </div>
                    </form>
                </div><br><br><br>
                
                <div class="queryl -t">
                    <b>SQL(Beta)</b>
                </div>
                <div class="queryl">
                    <form action="./query.php" method="post">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">DB Name</span>
                          </div>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="dbname" name="dbname">
                        </div>
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Query 문</span>
                          </div>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="query" name="query">
                        </div>
                        
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="인증코드(서버 관리자에게 문의)" aria-label="Recipient's username" aria-describedby="button-addon2" id="vcode" name="vcode">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">제출</button>
                          </div>
                        </div>
                    </form>
                </div><br><br><br>
                
                <div class="updateverificationcode -t">
                    <b>인증코드 수정</b>
                </div>
                <div class="updateverificationcode">
                    <form action="./renewverificationcode.php" method="post">
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">현재 인증코드</span>
                          </div>
                          <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="vcode1" name="vcode1">
                        </div>
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">현재 인증코드 재확인</span>
                          </div>
                          <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="vcode2" name="vcode2">
                        </div>
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">바꿀 인증코드</span>
                          </div>
                          <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="vcode3" name="vcode3">
                        </div>
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">바꿀 인증코드 재확인</span>
                          </div>
                          <input type="password" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" id="vcode4" name="vcode4">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">제출</button>
                          </div>
                        </div>
                    </form>
                </div><br><br><br>
        </div>
    </body>
</html>
