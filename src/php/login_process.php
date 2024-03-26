<?php
session_start();
require_once "../../config/db.php";

// เมื่อมีการส่งข้อมูลมาจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // คิวรี่ฐานข้อมูลเพื่อตรวจสอบข้อมูลผู้ใช้
    $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);


    // ถ้าพบข้อมูลผู้ใช้ในฐานข้อมูล
    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result);

        $_SESSION['login_user'] = $email; // เก็บค่าอีเมล์ผู้ใช้ใน session
        $_SESSION['user_role'] = $row['user_role'];

        if ($_SESSION['user_role'] === 'user' && 'admin') {
            header("location: index.php");
        }
    } else {
        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
        header('location: login.php');
        exit();
    }

    // ตรวจสอบว่ากล่อง "จดจำฉัน" ถูกเลือกหรือไม่
    if (isset ($_POST['remember_me'])) {
        // ทำสิ่งที่คุณต้องการเมื่อกล่อง "จดจำฉัน" ถูกเลือก
        // เช่น บันทึกข้อมูลลงในคุกกี้
    }
}

?>