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
                margin: 2em 0 3em 0;
            }
        </style>
    </head>
    <body style="background-color : #e4e4e4;">
        <div class="container">
            <div class="title" >
                    Blacklamp Admin Dashboard
            </div>
            <div class="admincheck">
                <form action="./dashboard.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Admin ID</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="aid" name="aid">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Admin PW</span>
                        </div>
                        <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="apw" name="apw">
                    </div>
                    <button type="submit" class="btn btn-outline-success pull-right">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>



