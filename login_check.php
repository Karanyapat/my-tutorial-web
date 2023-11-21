<?php
include 'condb.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM member WHERE user_name = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_array($result);

    if ($row) {
        $_SESSION["username"] = $row['user_name'];
        $_SESSION["pw"] = $row['password'];
        $_SESSION["firstname"] = $row['fname'];
        $_SESSION["lastname"] = $row['lname'];
        $_SESSION["status"] = $row['status'];
        $_SESSION["map"] = $row['map'];

        $status = $row['status'];

        if ($status == '0') {
            header("location: index.php");
        } else if ($status == '1') {
            header("location: show_school.php");
        }
    } else {
        $_SESSION["Error"] = "<p> ชื่อผู้ใช้หรือรหัสผ่านของคุณไม่ถูกต้อง!!! </p>";
        header("location: login.php");
    }
} else {
    echo "MySQLi query error: " . mysqli_error($conn);
}
?>
