<?php
    include 'condb.php';
    session_start();

    //เพื่อให้ไม่สามารถเข้ามาหน้าได้ หากยังไม่ได้login
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = '<span style="color: red;">กรุณาเข้าสู่ระบบก่อน !!!</span>';
        header("location: login.php");
    }
?>



<?php
    include 'condb.php';

    //รับค่าตัวแปร จากไฟล์ register.php
    $name = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //เข้ารหัส password ด้วย sha512
    //$password = hash('sha512',$password);

    //เพิ่มข้อมูลลงตารางฐานข้อมูล
    $sql = "INSERT INTO member(fname,lname,phone,user_name,password,status)
            Values('$name','$lastname','$phone','$username','$password','0')";

    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
        echo "<script> window.location='login.php'; </script>";
    }else{
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
        echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ'); </script>";
    }

    mysqli_close($conn);
?>