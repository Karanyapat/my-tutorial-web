<?php 
    session_start();
    include 'condb.php';

    //เพื่อให้ไม่สามารถเข้ามาหน้า index ได้ หากยังไม่ได้login
    // if (!isset($_SESSION["username"])){
    //     $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
    //     header("location: login.php");
    // }
    $cusName=$_POST['cus_name'];
    $cusTel=$_POST['cus_tel'];
    $cusKnow=$_POST['cus_know'];
    $cusdayTime=$_POST['day-time'];

    $sql= "insert into tb_order(cus_name,cus_tel,cus_know,`day-time`,total_price,order_status)
    values('$cusName','$cusTel','$cusKnow','$cusdayTime',' " . $_SESSION["sum_price"] . "','1')";
    mysqli_query($conn,$sql);

    $orderID = mysqli_insert_id($conn);
    $_SESSION["order_id"] = $orderID;

    for($i=0; $i <= (int)$_SESSION["intLine"]; $i++){ 
        if(($_SESSION["strProductID"][$i]) != ""){
            //ดึงข้อมูลคอร์ส
            $sql1="select * from school where sc_id ='" . $_SESSION["strProductID"][$i] . "' ";
            $result1=mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_array($result1);
            $price = $row1['price'];
            $total = $_SESSION["strQty"][$i] * $price;
            
            $sql2="insert into order_detail(order_id,mem_id,orderPrice,Total)
            values('$orderID','" . ($_SESSION["strProductID"][$i]) . "','$price','$total')";
            mysqli_query($conn,$sql2);
            //echo "<script> alert('บันทึกข้อมูลการสมัครเรียบร้อยแล้ว') </script>";
            echo "<script> window.location='payment_order.php'; </script>";
        }
    }
    mysqli_close($conn);
    //unset($_SESSION["intLine"]);
    unset($_SESSION["intLine"]);
    unset($_SESSION["strProductID"]);
    unset($_SESSION["strQty"]);
    unset($_SESSION["sum_price"]);
    
?>