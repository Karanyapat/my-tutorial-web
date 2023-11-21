<?php 
    session_start();

    //เพื่อให้ไม่สามารถเข้ามาหน้า index ได้ หากยังไม่ได้login
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
        header("location: login.php");
    }
     include 'condb.php';
    $ids = $_GET['id'];
    $sql = "SELECT map FROM school WHERE sc_id='$ids'";
    $result = mysqli_query($conn, $sql);
?>


<?php include 'condb.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS เพื่อให้รองรับการใช้งานหน้าจอมือถือ -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include 'menu.php'?>

    <div class="container">
        <div class="row">
            
            <?php    //จอยตารางข้อมูล shool กับ province และดึงค่า
                $ids = $_GET['id'];
                $sql = "SELECT * FROM school, province WHERE school.pv_id = province.pv_id and school.sc_id='$ids'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result)
            ?>

            <div class="col-md-4"> <br><br>
                <img src="img/<?=$row['image']?>" width="350px" class="mt-5 p-2 my-2 border" />
            </div>

            <div class="col-md-6">
                <br><br><br><br><br>
                ชื่อสถานศึกษา: <h5 class="text-success"> <?=$row['sc_name']?> </h5> <br>
                จังหวัด: <?=$row['pv_name']?> <br>
                ผู้สอน: <?=$row['tc_name']?> <br>
                วิชา: <?=$row['sj_name']?> <br>
                ความเชี่ยวชาญ: <?=$row['expertise']?> <br>
                ประสบการณ์: <?=$row['experience']?> <br><br>
                ราคา: <b class="text-danger"> <?=$row['price']?> </b> บาท  <br><br>

                <div class="row">
                    <div class="col d-flex justify-content-start">
                        <a class="btn btn-outline-danger" href="order.php?id=<?=$row['sc_id']?>" >เพิ่มลงตระกร้า</a>
                    </div>

                    <div class="col d-flex justify-content-end">
                    <?php if (filter_var($row['map'], FILTER_VALIDATE_URL)): ?>
                            <a class="btn btn-outline-info" href="<?=$row['map']?>" > ดูแผนที่ </a>
                        <?php else: ?>
                            <span class="text-danger">ไม่มี URL ที่ถูกต้อง</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>