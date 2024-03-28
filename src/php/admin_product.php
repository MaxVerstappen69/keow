<?php
require_once "../../config/db.php";
include '../include/navbar_admin.php';
// Check if user is logged in
$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

// Fetch products associated with the logged-in user
$sql = "SELECT product_id, category_name, employee_id, product_name, detail, price, quantity, image
FROM product
INNER JOIN category ON product.category_id=category.category_id;";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
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
    <div class="container">
        <h2 class="mt-3 text-center">รายการสินค้า</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="admin_add_product.php">
    <button type="button" class="btn btn-primary shadow-sm">เพิ่มสินค้า</button>
</a>
    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 150px;">Product ID</th>
                    <th style="width: 150px;">Category Name</th>
                    <th style="width: 150px;">Employee ID</th>
                    <th>Product Name</th>
                    <th>Detail</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th style="width: 150px;">Actions</th>
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
                            <a href='admin_product_edit.php?id=" . $row["product_id"] . "' class='btn btn-primary btn-sm'>แก้ไข</a>
                           <a href='admin_product_delete_process.php?delete_id=" . $row["product_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณจะลบพนักงานคนนี้จริงหรือ?\")'>ลบ</a>" ?>
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