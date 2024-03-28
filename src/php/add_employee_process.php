<?php
session_start();
require_once "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าข้อมูลที่ส่งมาจาก form ครบถ้วนหรือไม่
    if (empty($_POST['em_firstname']) || empty($_POST['em_lastname']) || empty($_POST['em_email']) || empty($_POST['em_username']) || empty($_POST['em_password']) || empty($_POST['em_confirm_password'])) {
        $_SESSION['error'] = 'กรุณากรอกข้อมูล.';
        header('location: add_employee.php');
        exit();
    }

    // ตรวจสอบว่ารหัสผ่านและรหัสผ่านยืนยันตรงกันหรือไม่
    if ($_POST['em_password'] !== $_POST['em_confirm_password']) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header('location: add_employee.php');
        exit();
    }

    // สร้างตัวแปรเพื่อเก็บค่าที่รับมาจาก form
    $em_firstname = $_POST['em_firstname'];
    $em_lastname = $_POST['em_lastname'];
    $em_email = $_POST['em_email'];
    $em_username = md5($_POST['em_username']);
    $em_password = md5($_POST['em_password']); // ควรเข้ารหัสรหัสผ่านก่อนบันทึกลงฐานข้อมูล
    $user_role = 'admin';

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO employee (em_firstname, em_lastname, em_email, em_username, em_password, user_role)
            VALUES ('$em_firstname', '$em_lastname', '$em_email', '$em_username', '$em_password','$user_role')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success1'] = 'เพิ่มข้อมูลเรียบร้อย.';
        header('location: admin_employee.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
