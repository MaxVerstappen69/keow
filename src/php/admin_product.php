<?php
require_once "../../config/db.php";
include '../include/navbar_admin.php';
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // หากไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้าแสดงข้อความการเข้าถึงไม่ได้
    exit;
}
// Check if user is logged in
$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

// Fetch products associated with the logged-in user
$sql = "SELECT product_id, category_name, employee_id, product_name, detail, price, quantity, image
FROM product
INNER JOIN category ON product.category_id=category.category_id
ORDER BY product_id ASC;";


$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional custom styles */
        .table {
            margin-top: 20px;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
<?php
          if (isset ($_SESSION['success3'])) {
            echo '<script src="../js/success_delete_product.js"></script>';
            unset($_SESSION['success3']);
          }
          ?>
           <?php
          if (isset ($_SESSION['success4'])) {
            echo '<script src="../js/success_admin_edit_product.js"></script>';
            unset($_SESSION['success4']);
          }
          ?>
    <div class="container mt-5">
    <h2 class="mb-4 text-center">รายการสินค้า</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="admin_add_product.php">
    <button type="button" class="btn btn-primary shadow-sm">เพิ่มสินค้า</button>
</a>
    </div>
        <table class="table table-striped">
        <hr>
            <thead>
                <tr>
                    <th style="width: 150px;">รหัสสินค้า</th>
                    <th style="width: 150px;">ประเภทสินค้า</th>
                    <th style="width: 150px;">รหัสพนักงาน</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รูปสินค้า</th>
                    <th style="width: 150px;">เมนู</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['product_id'] ?>
                            </td>
                            <td>
                                <?php echo $row['category_name'] ?>
                            </td>
                            <td>
                                <?php echo $row['employee_id'] ?>
                            </td>
                            <td>
                                <?php echo $row['product_name'] ?>
                            </td>
                            <td>
                                <?php echo $row['detail'] ?>
                            </td>
                            <td>
                                <?php echo $row['price'] ?>
                            </td>
                            <td>
                                <?php echo $row['quantity'] ?>
                            </td>
                            <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="Thumbnail">
                            </td>
                            <td><?php echo"  
                            <a href='admin_edit_product.php?id=" . $row["product_id"] . "' class='btn btn-primary btn-sm'>แก้ไข</a>
                           <a href='admin_product_delete_process.php?delete_id=" . $row["product_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณจะลบสินค้านี้จริงหรือ?\")'>ลบ</a>" ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>