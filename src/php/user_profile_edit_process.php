<?php
session_start();

// Include the database configuration file
require_once "../../config/db.php";

// Check if the database connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // รับค่าที่แก้ไขจากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $update_sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', address='$address', phone='$phone', username='$username'  WHERE email='$email'";
    if (mysqli_query($conn, $update_sql)) {
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ")</script>';
        header("Location: user_profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    header("Location: user_profile.php");
    exit();
}
?>
