<?php session_start(); include 'condb.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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

    <?php include 'menu.php' ?> <br><br>

    <div class="container">
        <form id="form1" method="POST" action="insert_class.php">
            <div class="row">
                <div class="col-md-12">

                <div class="alert alert-success h4 text-center " role="alert">
                    รายละเอียดการสมัคร
                </div>

                    <table class = "table table-hover">
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อสถาบัน</th>
                            <th>ราคา</th>
                            <th>ลบ</th>
                            
                        </tr>

                        <?php
                        $Total = 0;
                        $sumPrice = 0;
                        $m = 1;

                        for($i=0; $i <= (int)$_SESSION["intLine"]; $i++){    
                            if(($_SESSION["strProductID"][$i]) != ""){
                                $sql1 = "SELECT * FROM school WHERE sc_id = '" . $_SESSION["strProductID"][$i] . "'";
                                $result1 = mysqli_query($conn,$sql1);
                                $row_sc = mysqli_fetch_array($result1);  
                                
                                $_SESSION["price"] = $row_sc['price'];

                                $Total = $_SESSION["strQty"][$i];
                                $sum = $Total * $row_sc['price'];
                                $sumPrice = $sumPrice + $row_sc['price'];
                                $_SESSION["sum_price"] = $sumPrice;
                               
                        ?>

                        <tr>
                            <td> <?=$m?> </td>
                            <td>
                                <img src="img/<?=$row_sc['image']?>" width="150" height="100" class="border">
                                <?=$row_sc['sc_name']?>
                            </td>
                            <td> <?=$row_sc['price']?> </td>
                            <td> <a href="sc_delete.php?Line=<?=$i?>"> <img src="img/delete" width="25"> </a> </td>
                            
                        </tr>
                        <?php  
                        $m = $m+1;
                        }
                        }
                        ?>

                        <tr>
                            <td class="text-end" colspan="2"> รวมเป็นเงิน </td>
                            <td class="text-center"> <?=$sumPrice?> </td>
                            <td> บาท </td>
                        </tr>

                    </table>

                    <div style="text-align:right">
                        <a class="btn btn-outline-success" type="button" href="sh_school.php"> เลือกวิชาเพิ่ม </a>
                        <button class="btn btn-success" type="submit" href="insert_class.php?id=<?=$row['sc_id']?>"> ยืนยันการลงทะเบียน </button>

                        
                    </div>
                </div>
            </div>
            <div class="text-red">
                ***ตรวจสอบให้แน่ใจก่อนกดยืนยันการลงทะเบียนถ้ากดยืนยันรายชื่อจะอยู่ในระบบทันที***
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                <div class="alert alert-info h4 text-center"  role="alert">
                ข้อมูลสำหรับสมัครลงทะเบียน
                </div>
                ชื่อ-นามสกุล:
                <input type="text" name="cus_name" class="form-control " required placeholder="ชื่อ-นามสกุล"> <br>
                เบอร์โทรติดต่อ:
                <input type="tel" name="cus_tel" class="form-control " required pattern="[0-9]{10}" minlength="10" maxlength="10" inputmode="numeric" placeholder="เบอร์โทรติดต่อ"> <br>
                มีความรู้พื้นฐานในวิชาที่เลือกมาหรือไม่:
                <input type="text" name="cus_know" class="form-control " required placeholder="มี/ไม่มี"> <br>
                เลือกวันเวลาที่ต้องการเรียน:
                <select  type="text" id="day" name="day-time" class="form-control "><br>
                    <option value="จันทร์-ศุกร์ 9:00-16:00">จันทร์-ศุกร์ 9:00-16:00</option>
                    <option value="เสาร์-อาทิตย์ 18:00-22:00">เสาร์-อาทิตย์18:00-22:00</option>
                </select>
                <br><br><br>
                </div>
            </div>
        </form>    
    </div>
                    
</body>
</html>