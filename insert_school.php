<?php
    include 'condb.php';
    session_start();

    //เพื่อให้ไม่สามารถเข้ามาหน้าได้ หากยังไม่ได้login
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
        header("location: login.php");
    }
?>


<?php

use LDAP\Result;

    include'condb.php';
    $sc_name = $_POST['scname'];
    $pv_id = $_POST['pvID'];
    $tc_name = $_POST['tcname'];
    $sj_name = $_POST['sjname'];
    $tise = $_POST['expertise'];
    $ience = $_POST['experience'];
    $price = $_POST['price'];
    $map = $_POST['map'];
    
    // โค้ดสำหรับอัพโหลดภาพ
    if (is_uploaded_file($_FILES['file1']['tmp_name'])) { 
        $new_image_name = 'sch_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "./img/".$new_image_name;
        move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
        } else {
        $new_image_name = "";
        }
    
    // คำสั่งเพิ่มข้อมูลลงในตาราง school   
    $sql = "INSERT INTO school(sc_name,pv_id,tc_name,sj_name,expertise,experience,price,image,map)
            VALUE('$sc_name','$pv_id','$tc_name','$sj_name','$tise','$ience','$price','$new_image_name','$map')";

    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script> alert('บันทึกข้อมูลเรียบร้อย');    </script>";
        echo "<script> window.location='fr_school.php';    </script>";
    } else{
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ');    </script>";
    }
?>