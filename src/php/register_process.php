<?php

session_start();
require_once "../../config/db.php";

if(isset($_POST['signup'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $con_password = md5($_POST['con_password']);
    $username = $_POST['username'];
    $user_role = 'user';

    if(empty($firstname)){
        $_SESSION['error'] = 'กรุณากรอกชื่อจริง';
        header('location: register.php');
        exit();
    } elseif(empty($lastname)){
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header('location: register.php');
        exit();
    } elseif(empty($address)){
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header('location: register.php');
        exit();
    } elseif(empty($phone)){
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
        header('location: register.php');
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header('location: register.php');
        exit();
    } elseif(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5 ){
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวรหัส 5 ถึง 20 ตัวอักษร';
        header('location: register.php');
        exit();
    } elseif(empty($con_password)){
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header('location: register.php');
        exit();
    } elseif($password != $con_password){
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header('location: register.php');
        exit();
    } elseif(empty($username)){
        $_SESSION['error'] = 'กรุณากรอกชื่อผู้ใช้';
        header('location: register.php');
        exit();
    }

    $check_email = $conn->prepare('SELECT email FROM customer WHERE email = ?');
    $check_email->bind_param('s', $email);
    
        $check_email->execute();
        $result_email = $check_email->get_result();
        $email_row = $result_email->fetch_assoc();

        $check_username = $conn->prepare('SELECT username FROM customer WHERE username = ?');
$check_username->bind_param('s', $username);
        $check_username->execute();
        $result_username = $check_username->get_result();
        $username_row = $result_username->fetch_assoc();

        if($email_row) {
            $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='login.php'>คลิกที่นี่</a>";
            header('location: register.php');
            exit();
        }
        if($username_row) {
            $_SESSION['warning'] = "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว <a href='login.php'>คลิกที่นี่</a>";
            header('location: register.php');
            exit();
        }

        $stmt = $conn->prepare('INSERT INTO customer (firstname, lastname, address, phone, email, password, username, user_role) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssss', $firstname, $lastname, $address, $phone, $email, $password, $username, $user_role);
        $stmt->execute();
        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
        header('location: register.php');
        exit();
    }

?>
