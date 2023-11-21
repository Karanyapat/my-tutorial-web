<?php
include 'condb.php';
 $orderID=$_POST['order_id'];
 $totalPrice=$_POST['total_price'];
 $payDate=$_POST['pay_date'];
 $payTime=$_POST['pay_time'];

 //อัพโหลดภาพ
 if (is_uploaded_file($_FILES['file1']['tmp_name'])) { 
        $new_image_name = 'sch_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "./payment/".$new_image_name;
        move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
        } else {
        $new_image_name = "";
        }
    $sql = "INSERT INTO payment(orderID,paymoney,pay_date,pay_time,pay_image) 
            VALUE ('$orderID','$totalPrice','$payDate','$payTime','$new_image_name')";

    $hand=mysqli_query($conn,$sql);
    if($hand){
        echo "<script>alert('บันทึกข้อมูลแล้วเราจะพาคุณกลับไปหน้าหลัก');window.location='sh_school.php';</script>";
    }else{
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ');window.location='index.php';</script>";
    }
mysqli_close($conn);

?>