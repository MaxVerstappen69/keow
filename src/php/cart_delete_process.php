<?php
// เชื่อมต่อกับฐานข้อมูล
require_once "../../config/db.php";

// ตรวจสอบว่ามีค่า delete_id ที่ถูกส่งมาหรือไม่
if (isset($_GET['delete_id'])) {
    // รับค่าไอดีของไอเท็มที่ต้องการลบ
    $delete_id = $_GET['delete_id'];

    // สร้างคำสั่ง SQL เพื่อลบไอเท็มออกจากตะกร้า
    $sql = "DELETE FROM cart_item WHERE cart_item_id = $delete_id";

    // ทำการลบข้อมูล
    if ($conn->query($sql) === TRUE) {
        // ถ้าสำเร็จให้ Redirect กลับไปยังหน้าตะกร้า
        header("Location: cart_page.php");
        exit(); // ออกจากสคริปต์
    } else {
        // ถ้าเกิดข้อผิดพลาดในการลบ
        echo "เกิดข้อผิดพลาดในการลบ: " . $conn->error;
    }
} else {
    // ถ้าไม่มี delete_id ที่ถูกส่งมา
    echo "ไม่พบไอดีที่ต้องการลบ";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>