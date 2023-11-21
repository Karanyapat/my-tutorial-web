<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginback.css">

</head>
<body class="imgback">
    <div class="container col-sm-4">
        
<br><br><br>
            <div class="alert alert-danger h3 text-center mb-4 mt-4" role="alert">
                เข้าสู่ระบบ
            </div>
            <br>
            
                <form method="POST" action="login_check.php">
                    <b>บัญชี</b> <input type="text" name="username" class="form-control" required placeholder="username..."> <br><br>
                    <b>รหัสผ่าน</b> <input type="password" name="password" class="form-control" required placeholder="password..."> <br><br>
                    <?php 
                        if(isset($_SESSION["Error"])){
                            echo $_SESSION["Error"]; 
                        }                
                    ?><br><br>
                    

                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <input type="submit" name="submit" value="เข้าสู่ระบบ" class="btn btn-primary">
                        </div>

                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-outline-primary" href="register.php"> สมัครบัญชี </a>
                        </div>
                    </div>
                </form>

    </div>
</body>
</html>