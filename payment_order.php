<?php 
    session_start();
    include 'condb.php';

    $sql="select * from tb_order t,school s where orderID='" . $_SESSION["order_id"] ."' ";
    $result = mysqli_query($conn,$sql);
    $rs=mysqli_fetch_array($result);
    $total_price=$rs['total_price'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS เพื่อให้รองรับการใช้งานหน้าจอมือถือ -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <style>
    @keyframes blinking {
        0% { color: red; }
        50% { color: white; }
        100% { color: red; }
    }

    .text-red {
        animation: blinking 1s infinite;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
            <div class="alert alert-primary h4 text-center mt-4" role="alert">
            รายการที่ต้องชำระ
            </div>
            เลขที่ลงทะเบียน: <?=$rs['orderID'] ;?> <br>
            ชื่อ - นามสกุล(นักเรียน): <?=$rs['cus_name'] ;?> <br>
            ชื่อสถานที่สมัคร: <?=$rs['sc_name'] ;?> <br>
            วันเวลาที่เลือกเรียน: <?=$rs['day-time'] ;?> <br>
            เบอร์โทรติดต่อ: <?=$rs['cus_tel'] ;?> <br>
            <br>
            <div class="card mb-4 mt-4">
                <div class="card-body">
            <table class="table table-hover">
            <thead>
                <tr>
                <th>รหัสเลขที่ลงทะเบียน</th>
                <th>ชื่อโรงเรียน</th>
                <th>รหัสคนสมัคร</th>
                <th>ราคา</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                  $sql1="select * from order_detail d,school s where d.mem_id=s.sc_id and d.order_id='" . $_SESSION["order_id"] ."' ";
                  $result1 = mysqli_query($conn,$sql1);
                  while($row=mysqli_fetch_array($result1)){ 
            ?>
                <tr>
                <td><?=$row['order_id']?></td>
                <td><?=$row['sc_name']?></td>
                <td><?=$row['mem_id']?></td>
                <td><?=$row['orderPrice']?></td>
                </tr>
                <?php 
            } 
            ?>
            </tbody>
            </table>
            
            <h6 class="text-end"> รวมเป็นเงิน <?=number_format($total_price,2)?> บาท</h6>
            </div>
            </div>
            <div class="text-red">
                ***กรุณาจำเลขที่ลงทะเบียนแล้วแสกน QR Code เพื่อแสกนจ่ายเงินตามราคาเงินรวมด้านบนจากนั้นกดปุ่มแจ้งหลักฐานการโอน***
            </div>
            <br>
            <div class="img-thumbnail" style="display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                <img src="QR/qrcode.jpg" style="width: 300px; height: 400px; border:1px solid black">
                <div>
                    <a href="sh_school.php" class="btn btn-outline-success mt-2">ย้อนกลับ</a>
                    <a href="report_payment.php" class="btn btn-success mt-2">แจ้งหลักฐานการโอน</a>
                </div>
            </div>



            </div>
        </div>
    </div>
</body>
</html>