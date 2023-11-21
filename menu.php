<?php 
  
    //เพื่อให้ไม่สามารถเข้ามาหน้า index ได้ หากยังไม่ได้login
    if (!isset($_SESSION["username"])){
        $_SESSION['Error'] = 'กรุณาเข้าสู่ระบบก่อน !!!';
        header("location: login.php");
    }
?>


    <!-- ไฟล์นี้แสดงผลบนเว็บไม่ได้ เพราะไม่มีแท็กhtml เลยทำหน้าที่เป็นแค่แม่แบบ โดยจะใช้ใน index.php -->

    <!-- background-color โค้ดสีสามารถเปลี่ยนได้ -->
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #E6E6FA;">
  <div class="container">
    <a class="navbar-brand" href="#">Tutorial Universe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="sh_school.php">สถานที่</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="history.php">ดูประวัติการลงทะเบียน</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">ลงชื่อออก</a>
        </li>
      
      </ul>

      <form class="d-flex" method="POST" action="sh_school.php">
        <input class="form-control me-2 col-sm-12" type="search" name="keyword" placeholder="ex. ชื่ออจ. ชื่อวิชา ราคาไม่เกิน ..." aria-label="Search">
        <button class="btn btn-outline-danger" type="submit">ค้นหา</button>
      </form>

    </div>
  </div>
</nav>