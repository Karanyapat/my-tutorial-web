<?php 
include 'condb.php';
session_start();
$ids = $_GET['id'];
$sql1 = "SELECT * FROM tb_order t JOIN payment m ON t.orderID = m.orderID WHERE t.orderID = '$ids'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);
$image_bill = $row1['pay_image'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail order</title>
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
                        หลักฐานการโอนเงิน
                    </div>
                    <div>
                        <br>
                        <a href="report_admin.php"><button type="button" class="btn btn-outline-success">ย้อนกลับ</button></a>
                    </div>
                    <div class="card-body">
                        <h5>เลขที่ใบสมัคร : <?= $ids ?></h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>รหัสคนสมัคร</th>
                                    <th>รหัสใบสมัคร</th>
                                    <th>ชื่อนามสกุล(นักเรียน)</th>
                                    <th>ชื่อสถานที่</th>
                                    <th>ชื่อผู้รับผิดชอบ</th>
                                    <th>ความรู้พื้นฐาน</th>
                                    <th>วันเวลาที่จะเรียน</th>
                                    <th>ราคา</th>
                                    <th>ราคารวม</th>
                                    <th>วันที่ทำการลงทะเบียน</th>
                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM tb_order t
                                    JOIN order_detail d ON t.orderID = d.order_id
                                    JOIN school s ON d.mem_id = s.sc_id
                                    WHERE d.order_id = '$ids'
                                    ORDER BY d.mem_id";
                            $result = mysqli_query($conn, $sql);
                            $sum_total = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $sum_total += $row['total_price'];
                            ?>
                                <tr>
                                    <td><?= $row['mem_id'] ?></td>
                                    <td><?= $row['orderID'] ?></td>
                                    <td><?= $row['cus_name'] ?></td>
                                    <td><?= $row['sc_name'] ?></td>
                                    <td><?= $row['tc_name'] ?></td>
                                    <td><?= $row['cus_know'] ?></td>
                                    <td><?= $row['day-time'] ?></td>
                                    <td><?= $row['orderPrice'] ?></td>
                                    <td><?= $row['Total'] ?></td>
                                    <td><?= $row['reg_date'] ?></td>
                                </tr>
                            <?php }
                            mysqli_close($conn);
                            ?>
                        </table>
                        <b>ราคารวมสุทธิ <?= number_format($sum_total, 2) ?> บาท</b>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <?php if ($image_bill) : ?>
                    <div class="text-center">
                        <h5>หลักฐานการโอนเงิน</h5> <br>
                        <img src="./payment/<?= $row1['pay_image'] ?>" width="300px">
                    </div>
                <?php else : ?>
                    <h5>ยังไม่ได้ชำระเงิน</h5>
                <?php endif; ?>
            </div>
        </main>
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