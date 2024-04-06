<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';
// Check if user is logged in
$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

// Fetch products associated with the logged-in user
$sql = " SELECT orders.order_id, cart.cart_no, product.image, product.product_name, cart.quantity, orders.total_amount, orders.status_delivery, orders.created_date 
FROM `orders`
INNER JOIN cart ON orders.cart_id = cart.cart_id
JOIN product ON cart.product_id = product.product_id

ORDER BY orders.order_id = '$id';";




$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Order List</title>
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
    <h2 class="mb-4 text-center">รายการสั่งซื้อ</h2>
        
        <table class="table table-striped">
        <hr>
            <thead>
                <tr>
                    <th style="width: 150px;">รหัสการสั่งซื้อ</th>
                    <th >รูปสินค้า</th>
                    <th style="width: 150px;">ชื่อสินค้า</th>
                    <th>จำนวนสินค้า</th>
                    <th>ราคารวม</th>
                    <th>สถานะ</th>
                    <th style="width: 150px;">เวลาสั่งซื้อ</th>
                    <th style="width: 150px;">สลิปการจ่ายเงิน</th>
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
                                <?php echo $row['cart_no'] ?>
                            </td>
                            <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="Thumbnail">
                            </td>
                            <td>
                                <?php echo $row['product_name'] ?>
                            </td>
                            <td>
                                <?php echo $row['quantity'] ?>
                            </td>
                            <td>
                                <?php echo $row['total_amount'] ?>
                            </td>
                            <td>
                                <?php echo $row['status_delivery'] ?>
                            </td>
                            <td>
                                <?php echo $row['created_date'] ?>
                            </td>
                            <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="Thumbnail">
                            </td>
                           
                            <td><?php echo"  
                            <a href='admin_edit_product.php?id=" . $row["order_id"] . "' class='btn btn-primary btn-sm'>ชำระเงิน</a>
                           <a href='admin_product_delete_process.php?delete_id=" . $row["order_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณจะลบสินค้านี้จริงหรือ?\")'>ยกเลิก</a>" ?>
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