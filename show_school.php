<?php 
    include 'condb.php';
    session_start();

    //เพื่อให้ไม่สามารถเข้ามาหน้า index ได้ หากยังไม่ได้login 
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
        header("location: login.php");
    }else {       // เข้าเว็บได้เฉพาะ status เป็น Admin
        if ($_SESSION["status"] == 0) {
            $_SESSION['Error'] = 'คุณไม่มีสิทธิ์เข้าสู่หน้านี้';
            header("location: login.php");
        }     
    }     
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show School</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
            <!-- ส่วนหัวเรื่อง -->
            <div class="alert alert-primary h3 text-center mb-4 mt-4"  role="alert">
                    แสดงข้อมูลสถานศึกษา
            </div>
            <!-- ปุ่ม Add+ -->
            <div class="row">
                <div class="col">
                    <a class="btn btn-success " href="fr_school.php" role="button">Add+</a>
                    <a class="btn btn-secondary " href="report_admin.php" role="button" >ดูหลักฐานการชำระ</a>
                </div>

                <div class="col d-flex justify-content-end">
                     <a class="btn btn-outline-success mb-4" href="logout.php" role="button">ลงชื่อออก</a>
                </div>
            </div>

        <table class="table table-striped">
            <tr>
                <th>ชื่อสถานศึกษา</th>
                <th>จังหวัด</th>
                <th>ชื่ออาจารย์</th>
                <th>ชื่อวิชา</th>
                <th>ความเชี่ยวชาญ</th>
                <th>ประสบการณ์</th>
                <th>ราคา</th>
                <th>รูปภาพ</th>
            </tr>

            <!-- จอยค่าระหว่าง 2 ตาราง คือตาราง province กับ school ค่าที่จอยคือ pv_id -->
            <?php
                $sql = "SELECT * FROM province,school WHERE province.pv_id = school.pv_id";
                $hand = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($hand)){
            ?>
            <tr>
                <td><?=$row['sc_name']?> </td>
                <td><?=$row['pv_name']?> </td>
                <td><?=$row['tc_name']?> </td>
                <td><?=$row['sj_name']?> </td>
                <td><?=$row['expertise']?> </td>
                <td><?=$row['experience']?> </td>
                <td><?=$row['price']?> </td>
                <!-- รูปภาพ ปรับขนาดกว้าง สูง -->
                <td><img src="img/<?=$row['image']?>" width="100px" height="100px"> </td>
            </tr>
            <?php
            }
                mysqli_close($conn)           
            ?>

        </table>




    </div>
</body>
</html>