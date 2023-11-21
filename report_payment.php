<?php
include 'condb.php';
session_start();
$order_id="";
$cusname="";
$total=0;
$orderStatus="";

if(isset($_POST['btn1'])){
    $key_word=$_POST['keyword'];
    if($key_word != ""){
        $sql="SELECT * FROM tb_order WHERE orderID='$key_word'";
        unset($_SESSION['error']);
    }else{
        echo "<script>window.location='report_payment.php';</script>";
        unset($_SESSION['error']);
    }
    $hand=mysqli_query($conn,$sql);
    $num1=mysqli_num_rows($hand);
        if($num1 == 0){
            echo "<script>window.location='report_payment.php';</script>";
            $_SESSION['error']="ไม่พบข้อมูลเลขที่ใบลงทะเบียน";
        }else{
        $row=mysqli_fetch_array($hand);
        $order_id=$row['orderID'];
        $cusname=$row['cus_name'];
        $total=$row['total_price'];
        $orderStatus=$row['order_status'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งหลักฐานการโอน</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS เพื่อให้รองรับการใช้งานหน้าจอมือถือ -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container  col-sm-5">
    <div class="alert alert-success mt-4 h4 text-center" role="alert">
        แจ้งหลักฐานการโอน
    </div>
        <div class="row">
            <div class="col">
                <div class="border mt-5 p-2 my-2 " style="background-color: #f0f0f5;">
                <form method="POST" action="report_payment.php">
                    <label for="">เลขที่ใบลงทะเบียน</label>
                    <input type="text" name="keyword">
                    <button type="submit" name="btn1" class="btn btn-outline-danger">
                        ค้นหา
                    </button>
                    <?php
                    if(isset($_SESSION['error'])){
                        echo"<div class='text-danger'> ";
                        echo $_SESSION['error'];
                        echo "</div>";
                    }
                    ?>
                </form>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col">
                <form method="POST" action="insert_report_payment.php" enctype="multipart/form-data">
                    <label class="mt-4">เลขที่ใบลงทะเบียน</label>
                    <input type="text" name="order_id" required class="form-control" value=<?=$order_id?>>
                    <?php
                    if($orderStatus == '1'){
                        echo "<span id='status' style='color: red;'>ยังไม่ชำระเงิน</span>";
                    }elseif($orderStatus == '2') {
                        echo "<span id='status' style='color: green;'>ชำระเงินแล้ว</span>";
                    }
                    ?>
                    <br>
                    <label class="mt-4">ชื่อผู้ลงทะเบียน</label>
                    <textarea class="form-control" name="cusName" required rows="1"><?=$cusname?></textarea>
                    <label class="mt-4">จำนวนเงิน</label>
                    <input type="number" class="form-control" name="total_price" required value=<?=$total?>>
                    <label class="mt-4">วันที่โอน</label>
                    <input type="date" class="form-control" name="pay_date" required>
                    <label class="mt-4">เวลาที่โอน</label>
                    <input type="time" class="form-control" name="pay_time" required>
                    <label class="mt-4">หลักฐานการโอนเงิน</label>
                    <input type="file" class="form-control" name="file1" required><br>
                    <?php if($orderStatus == '2'){ ?>
                        <button type="submit" name="btn2" class="btn btn-primary " disabled>
                        ยืนยัน
                    </button> <?php }else{  ?>
                        <button type="submit" name="btn2" class="btn btn-primary">
                        ยืนยัน
                    </button>
                        <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>