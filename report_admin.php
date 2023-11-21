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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Report Paymant</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
                    <div id="layoutSidenav_contnt">
                        <main>
                            <div class="container-fluid px-4 mt-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               แสดงรายชื่อที่ลงทะเบียน (ยังไม่ได้ชำระเงิน)
                               
                            </div>
                            <div>
                                <br>
                                <a href="report_admin_yes.php"><button type="button" class="btn btn-outline-success">ชำระเงินแล้ว</button></a>
                                <a href="report_admin.php"><button type="button" class="btn btn-outline-success">ยังไม่ชำระเงิน</button></a>
                                <a href="report_admin_no.php"><button type="button" class="btn btn-outline-success">ยกเลิกใบสั่งซื้อ</button></a>
                                <a href="show_school.php"><button type="button" class="btn btn-success">กลับไปหน้าหลัก</button></a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>เลขที่ใบสมัคร</th>
                                            <th>ชื่อนามสกุล(นักเรียน)</th>
                                            <th>เบอร์โทรติดต่อ</th>
                                            <th>ความรู้พื้นฐาน</th>
                                            <th>วันเวลาที่จะเรียน</th>
                                            <th>ราคารวม</th>
                                            <th>วันที่ทำการลงทะเบียน</th>
                                            <th>สถานะการชำระเงิน</th>
                                            <th>รายละเอียด</th>
                                            <th>ปรับสถานะการสั่งซื้อ</th>
                                            <th>ยกเลิกการสั่งซื้อ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>orderID</th>
                                            <th>cus_name</th>
                                            <th>cus_tel</th>
                                            <th>cus_know</th>
                                            <th>day-time</th>
                                        </tr>
                                    </tfoot>
                                <?php
                                $sql ="select * from tb_order where order_status='1' order by reg_date DESC" ;
                                $result=mysqli_query($conn,$sql);
                                
                                ?>
                                    <tbody>
                                    <?php while($row=mysqli_fetch_array($result)){ 
                                        $status = $row['order_status'];
                                        ?>
                                        <tr>
                                            <td><?=$row['orderID']?></td>
                                            <td><?=$row['cus_name']?></td>
                                            <td><?=$row['cus_tel']?></td>
                                            <td><?=$row['cus_know']?></td>
                                            <td><?=$row['day-time']?></td>
                                            <td><?=$row['total_price']?></td>
                                            <td><?=$row['reg_date']?></td>
                                            <td>
                                                <?php
                                                if($status == 1){
                                                    echo "<b style='color:green'>ยังไม่ชำระเงิน</b>";
                                                }else if($status == 2){
                                                    echo "<b style='color:blue'>ชำระเงินแล้ว</b>";
                                                }else if($status == 0){
                                                    echo "<b style='color:red'>ยกเลิกการสั่งซื้อ</b>";
                                                }
                                                ?>
                                        </td>

                                        <td><a href="report_order_detail.php?id=<?=$row['orderID']?>" class="btn btn-warning" >รายละเอียด</a></td>

                                        <td><a href="pay_order.php?id=<?=$row['orderID']?>" class="btn btn-success" 
                                        onclick="del1(this.href); return false;">ปรับสถานะ</a></td>

                                        <td><a href="cancel_order.php?id=<?=$row['orderID']?>" class="btn btn-danger" 
                                        onclick="del(this.href); return false;">ยกเลิก</a></td>
                                        </tr>
                                    <?php } 
                                    //mysqli_close($conn);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

<script>
    function del(mypage){
        var agree=confirm('คุณต้องการยกเลิกการชำระเงินหรือไม่');
        if(agree){
            window.location=mypage;
        }
    }
    function del1(mypage1){
        var agree=confirm('คุณต้องการปรับสถานะการชำระเงินหรือไม่');
        if(agree){
            window.location=mypage;
        }
    }
</script>