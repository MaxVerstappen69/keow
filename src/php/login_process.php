<?php
session_start();
require_once "../../config/db.php";

// เมื่อมีการส่งข้อมูลมาจากฟอร์ม
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // คิวรี่ฐานข้อมูลเพื่อตรวจสอบข้อมูลผู้ใช้
    $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    // ถ้าพบข้อมูลผู้ใช้ในฐานข้อมูล
    if($count == 1) {
        $_SESSION['login_user'] = $email; // เก็บค่าอีเมล์ผู้ใช้ใน session
        header("location: index.php");
    } else {
        echo "อีเมล์หรือรหัสผ่านไม่ถูกต้อง";
    }

    // ตรวจสอบว่ากล่อง "จดจำฉัน" ถูกเลือกหรือไม่
    if(isset($_POST['remember_me'])) {
        // ทำสิ่งที่คุณต้องการเมื่อกล่อง "จดจำฉัน" ถูกเลือก
        // เช่น บันทึกข้อมูลลงในคุกกี้
    }
}
?>