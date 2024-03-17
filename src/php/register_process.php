<?php

    session_start();
    require_once "../../config/db.php";

    if(isset($_POST['signup'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $con_password = $_POST['con_password'];
        $user_role = 'user';

        if(empty($firstname)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header('location: register.php');
        }else if(empty($lastname)){
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header('location: register.php');
        }else if(empty($address)){
            $_SESSION['error'] = 'กรุณากรอกที่อยู่';
            header('location: register.php');
        }else if(empty($phone)){
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
            header('location: register.php');
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header('location: register.php');
        }else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5 ){
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวรหัส 5 ถึง 20 ตัวอักษร';
            header('location: register.php');
        }else if(empty($con_password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header('location: register.php');
        }else if($password != $con_password){
            $_SESSION['error'] = 'รหัสผ่านตรงกัน';
            header('location: register.php');
        }else{
            try {

                $check_email = $conn -> prepare('SELECT email FROM customer WHERE email = :email');
                $check_email -> bindParam(':email', $email);
                $check_email -> execute();
                $row = $check_email -> fetch(PDO::FETCH_ASSOC);

                if($row['email'] == $email){
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='login.php' ";
                    header('location: register.php');
                }else if(!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn -> prepare('INSERT INTO customer (firstname, lastname, address, phone, email, password, user_role) 
                    VALUES (:firstname, :lastname, :address, :phone, :email, :password, :user_role)');
                    $stmt -> bindParam(':firstname', $firstname);
                    $stmt -> bindParam(':lastname', $lastname);
                    $stmt -> bindParam(':address', $address);
                    $stmt -> bindParam(':phone', $phone);
                    $stmt -> bindParam(':email', $email);
                    $stmt -> bindParam(':password', $password);
                    $stmt -> bindParam(':user_role', $user_role);
                    $stmt -> execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header('location: register.php');
                }else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header('location: register.php');
                }
            
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
