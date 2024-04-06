<?php
session_start();
require_once "../../config/db.php";

// เมื่อมีการส่งข้อมูลมาจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // คิวรี่ฐานข้อมูลเพื่อตรวจสอบข้อมูลผู้ใช้ในตาราง customer
    $query_customer = "SELECT * FROM customer WHERE email='$email' or username ='$email' AND password='$password'";
    $result_customer = mysqli_query($conn, $query_customer);

    // คิวรี่ฐานข้อมูลเพื่อตรวจสอบข้อมูลผู้ใช้ในตาราง employee
    $query_employee = "SELECT * FROM employee WHERE em_email='$email' or em_username ='$email' AND em_password='$password'";
    $result_employee = mysqli_query($conn, $query_employee);

    // ถ้าพบข้อมูลผู้ใช้ในตาราง customer
    if (mysqli_num_rows($result_customer) == 1) {
        $row = mysqli_fetch_array($result_customer);
        $_SESSION['login_user'] = $email; // เก็บค่าอีเมล์ผู้ใช้ใน session
        $_SESSION['user_role'] = $row['user_role'];
        header("location: index.php");
    }
    // ถ้าพบข้อมูลผู้ใช้ในตาราง employee
    elseif (mysqli_num_rows($result_employee) == 1) {
        $row = mysqli_fetch_array($result_employee);
        $_SESSION['login_user'] = $email; // เก็บค่าอีเมล์ผู้ใช้ใน session
        $_SESSION['user_role'] = $row['user_role'];
        header("location: index.php"); // ปล. เปลี่ยนไปยังหน้า dashboard ของ employee
    } else {
        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
        header('location: login.php');
        exit();
    }

    // ตรวจสอบว่ากล่อง "จดจำฉัน" ถูกเลือกหรือไม่
    if (isset($_POST['remember_me'])) {
        // ทำสิ่งที่คุณต้องการเมื่อกล่อง "จดจำฉัน" ถูกเลือก
        // เช่น บันทึกข้อมูลลงในคุกกี้
    }
}


?>