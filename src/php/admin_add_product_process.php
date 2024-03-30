<?php
session_start();
require_once "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่าข้อมูลที่ส่งมาจาก form ครบถ้วนหรือไม่
    if (empty($_POST['employee_id']) || empty($_POST['category_id']) || empty($_POST['product_name']) || empty($_POST['detail']) || empty($_POST['price']) || empty($_POST['quantity'])) {
        $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบ.';
        header('location: admin_add_product.php');
        exit();
    }

    // สร้างตัวแปรเพื่อเก็บค่าที่รับมาจาก form
    $employee_id = $_POST['employee_id'];
    $category_id = $_POST['category_id'];
    $product_name = $_POST['product_name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // ตรวจสอบไฟล์รูปภาพ
    if ($_FILES['image']['name']) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        // Read file content
        $file_content = addslashes(file_get_contents($file_tmp)); // เก็บข้อมูลไฟล์เป็น binary

        $sql = "INSERT INTO product (employee_id, category_id, product_name, detail, price, quantity, image)
                VALUES ('$employee_id', '$category_id', '$product_name', '$detail', '$price','$quantity', '$file_content')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success1'] = 'เพิ่มข้อมูลเรียบร้อย.';
            header('location: admin_add_product.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $_SESSION['error1'] = "กรุณาเลือกไฟล์รูปภาพ.";
        header('location: admin_add_product.php');
        exit();
    }

    $conn->close();
}
?>
