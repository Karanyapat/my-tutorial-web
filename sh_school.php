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
    <title>Show School</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS เพื่อให้รองรับการใช้งานหน้าจอมือถือ -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'menu.php';?>
    <!-- mt-4 คทอเพิ่มช่องว่างระหว่างแถบเมนู -->
    <div class="container mt-4">
        <div class="row">
            <?php 
                include 'condb.php';

                //ตำสั่งแบ่งหน้าเพจ
                // แนวละ4อัน ถ้าตั้ง 8 ก็จะมี2แถว , ตั้ง4 มี1แถว
                $perpage  =8;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $start = ($page-1) * $perpage;

                //ช่องค้นหาข้อมูล
                $key_word = @$_POST['keyword'];
                    if($key_word !=""){
                        $sql = "SELECT * FROM school WHERE tc_name like '%$key_word%' or sj_name like '%$key_word%' or price <= '$key_word' ORDER BY sc_id limit {$start},{$perpage}";
                    }else{
                        $sql = "SELECT * FROM school ORDER BY sc_id limit {$start},{$perpage}";
                    }


                //ดึงข้อมูลจากตาราง school
                $hand = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($hand)){
                    $price = $row['price'];
            ?>
               <!-- md-4 คือมี 3 คอลัมฟ์ เพราะ 43=12 , md-3 คือมี 4 คอลัมฟ์ เพราะ 34=12-->
            <div class="col-md-3 text-center">
                <img src="img/<?=$row['image']?>" width="250px" height="150px" class="mt-5 p-2 my-2 border"> <br>
                <!-- text-primary เปลี่ยนสี  -->
                ชื่อสถานศึกษา: <h5 class="text-primary"> <?=$row['sc_name']?> </h5> 
                รายวิชา: <?=$row['sj_name']?> <br>
                สอนโดย: <?=$row['tc_name']?> <br>
                <!-- text-danger เปลี่ยนสี  , number_format ปรับทศนิยม2ตำแหน่ง-->
                ราคา: <b class="text-danger"> <?=number_format($price,2)?> </b> บาท 
                <br><br>
                <!-- ปุ่มเพิ่มลงตระกร้า-->
                <a href="detail.php?id=<?=$row['sc_id']?>" class="btn btn-outline-warning"> รายละเอียด </a>

            </div>
            <?php
                }
                //mysqli_close($conn)
            ?>


        </div>
        <?php
        $sql1 = "SELECT * FROM school";
        $query1 = mysqli_query($conn,$sql1);
        $total_record = mysqli_num_rows($query1);
        $total_page = ceil($total_record / $perpage)
        ?>
        <br><br><br><br><br><br><br>
        <!-- ปุ่มเปลี่ยนหน้า -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="sh_school.php?page=1">Previous</a></li>
                <?php  for($i=1;$i<=$total_page;$i++) {?>
                <li class="page-item"><a class="page-link" href="sh_school.php?page=<?=$i?>"><?=$i?></a></li>
                <?php } ?>
                <li class="page-item"><a class="page-link" href="sh_school.php?page=<?=$total_page?>">Next</a></li>
            </ul>
        </nav>
           
        <?php mysqli_close($conn); ?>
                           


    </div>
</body>
</html>


