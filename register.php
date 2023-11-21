<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginback.css">
</head>
<body class ="imgback">
    <div class="container  col-sm-4">

        <br> <br>
        <div class="alert alert-success h3 text-center mb-4 mt-4" role="alert">
            สมัครสมาชิก
        </div>
        <br>
        <form method="POST" action="insert_register.php">
            <b>ชื่อ </b><input type="text" name="firstname" class="form-control" required><br>
            <b>นามสกุล</b> <input type="text" name="lastname" class="form-control" required><br>
            <b>เบอร์โทร</b> <input type="number" name="phone" class="form-control" required ><br>
            <b>ชื่อบัญชี </b><input type="text" name="username" maxlength="20" class="form-control" required><br>
            <b>รหัสผ่าน </b><input type="password" name="password" maxlength="20" class="form-control" required> <br>

            

            
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <input type="submit" name="submit" value="บันทึก" class="btn btn-warning">
                    <!--   <input type="reset" name="cancel" value="ยกเลิก" class="btn btn-danger">   -->
                </div>

                <div class="col d-flex justify-content-end">
                    <a class="btn btn-outline-warning" href="login.php"> กลับไปหน้า Login </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>