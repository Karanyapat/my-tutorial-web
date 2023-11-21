<?php 
    session_start();

    //เพื่อให้ไม่สามารถเข้ามาหน้า index ได้ หากยังไม่ได้login
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
        header("location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Service</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap JS เพื่อให้รองรับการใช้งานหน้าจอมือถือ -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
</head>
<body>
    <?php include 'menu.php';?>
    
    <?php
        include 'slide.php';
    ?>
    <footer style="background-color: #E6E6FA;">
        <div class ="h4 text-end me-5"><br>
            <h5>Project DATABASE 2023</h5><br><br>
        </div>
           
    </footer>
    
</body>
</html>