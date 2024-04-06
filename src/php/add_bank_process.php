<?php
session_start();
require_once "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าข้อมูลที่ส่งมาจาก form ครบถ้วนหรือไม่
    if (empty($_POST['bank_name']) || empty($_POST['bank_detail'])) {
        $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบ.';
        header('location: add_bank.php');
        exit();
    }

    // สร้างตัวแปรเพื่อเก็บค่าที่รับมาจาก form
    
    $bank_name = $_POST['bank_name'];
    $bank_detail = $_POST['bank_detail'];
    

    // ตรวจสอบไฟล์รูปภาพ
    if ($_FILES['qrcode_perma']['name']) {
        // Get file details
        $file_name = $_FILES['qrcode_perma']['name'];
        $file_tmp = $_FILES['qrcode_perma']['tmp_name'];

        // Read file content
        $file_content = addslashes(file_get_contents($file_tmp)); // เก็บข้อมูลไฟล์เป็น binary

        $sql = "INSERT INTO bank (bank_name, bank_detail, qrcode_perma)
                VALUES ('$bank_name', '$bank_detail','$file_content')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success1'] = 'เพิ่มข้อมูลเรียบร้อย.';
            header('location: add_bank.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $_SESSION['error1'] = "กรุณาเลือกไฟล์รูปภาพ.";
        header('location: add_bank.php');
        exit();
    }

    $conn->close();
}
?>
