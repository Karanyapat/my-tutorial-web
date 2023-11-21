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
    <title>Add School</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <div class="container">
        <div class="row">
                <!-- sm คือความกว้างขอช่องกรอกข้อมูล สามารถเปลี่ยนเลขได้ -->
            <div class="col-sm-12">
                <!-- ส่วนหัว -->
                <!-- h4คือเพิ่มขนาดตัวอักษร , text-centerคือให้อักษรอยู่ตรงกลาง , mb mt คือเพิ่มช่องว่าง บน-ล่าง -->
                <div class="alert alert-primary h3 text-center mb-4 mt-4"  role="alert">
                    เพิ่มข้อมูลสถานศึกษา
                </div>
                
<form name="form1" method="post" action="insert_school.php" enctype="multipart/form-data">

    <!-- เพิ่มชื่อสถานศึกษา -->
    <label>ชื่อสถานศึกษา: </label>
    <input type="text" name="scname" class="form-control" placeholder="ชื่อสถานศึกษา..." require> <br>
    
    <!-- เลือกจังหวัดของสถานศึกษาที่เพิ่ม -->
    <label>จังหวัด: </label>
    <select class="form-select" name="pvID">
        <?php 
            $sql = "SELECT * FROM province ORDER BY pv_name";
            $hand = mysqli_query($conn,$sql);
            

            while($row = mysqli_fetch_array($hand)){
        ?> <!-- ใช้ while วนลูปค่าใน pv_name และแสดงผลว่ามีกี่ตัวเลือก-->
        <option value="<?=$row['pv_id']?>"><?=$row['pv_name']?></option>    
        <?php
            }
            mysqli_close($conn)        
        ?>          
    </select>
    <br>     
    <label>สถานที่ตั้ง:  </label>
    <input type="url" name="map" class="form-control" placeholder="แนบลิ้ง Google Map..." require> <br>

    <label>ชื่ออาจารย์:  </label>
    <input type="text" name="tcname" class="form-control" placeholder="ชื่ออาจารย์..." require> <br>

    <label>ชื่อวิชา:  </label>
    <input type="text" name="sjname" class="form-control" placeholder="ชื่อวิชา..." require> <br>

    <label>ความเชี่ยวชาญ:  </label>
    <input type="text" name="expertise" class="form-control" placeholder="ความเชี่ยวชาญ..." require> <br>

    <label>ประสบการณ์:  </label>
    <input type="text" name="experience" class="form-control" placeholder="ประสบการณ์..." require> <br>

    <label>ราคา:  </label>
    <input type="number" name="price" class="form-control" placeholder="... บาท" require> <br>

    <label>รูปภาพประกอบ:  </label>
    <input type="file" name="file1"  require> <br><br>

    <!-- เป็น summit ถ้า input เป็น file-->
    <button type="submit" class="btn btn-primary">Submit</button>

    
    <a class="btn btn-danger" href="show_school.php" role="button">Cancel</a>

    

    

</form>
            </div>
        </div>
    </div>

</body>
</html>