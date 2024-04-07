<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';
// Check if user is logged in
$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;
// Fetch orders associated with the logged-in user
$sql = "SELECT customer.email, orders.order_id, cart.cart_no, product.image, product.product_name, cart.quantity, orders.total_amount, orders.status_delivery, orders.created_date , orders.transaction
        FROM orders
        INNER JOIN cart ON orders.cart_id = cart.cart_id
        INNER JOIN customer ON cart.customer_id = customer.customer_id
        JOIN product ON cart.product_id = product.product_id
        WHERE customer.email = ?
        ORDER BY orders.order_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php
// Function to convert status code to text
function getStatusText($statusCode)
{
    switch ($statusCode) {
        case 1:
            return 'ชำระเงินเสร็จสิ้น รอการยืนยัน';
        case 2:
            return 'ยืนยันสำเร็จ กำลังจัดส่ง';
        case 3:
            return 'จัดส่งสำเร็จ';
        case 4:
            return 'ขอยกเลิกรายการ';
        case 5:
            return 'ยกเลิกรายการสำเร็จ';
        case 6:
            return 'ยกเลิกรายการล้มเหลว';
        default:
            return 'สถานะไม่ระบุ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Order List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
    if (isset($_SESSION['success3'])) {
        echo '<script src="../js/success_delete_product.js"></script>';
        unset($_SESSION['success3']);
    }
    ?>
    <?php
    if (isset($_SESSION['success4'])) {
        echo '<script src="../js/success_admin_edit_product.js"></script>';
        unset($_SESSION['success4']);
    }
    ?>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">รายการสั่งซื้อ</h2>

        <table class="table table">
            <hr>
            <thead>
                <tr>
                    <th>รูปสินค้า</th>
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
                    $previous_cart_no = null; // เก็บค่าเลข cart_no ก่อนหน้า
                    $total_quantity = 0; // ตัวแปรสำหรับเก็บจำนวนสินค้ารวม
                    while ($row = $result->fetch_assoc()) {
                        // ตรวจสอบว่า cart_no เปลี่ยนหรือไม่
                        if ($row['cart_no'] !== $previous_cart_no) {
                            // ถ้า cart_no เปลี่ยน แสดงข้อมูลและปุ่มแก้ไขเฉพาะครั้งเดียว
                            ?>
                            <form action="user_cancel_order.php" method="post">
                                <tr style="background-color: #EF959D;">
                                    <td colspan="9" class="text-center"><strong>รายการที่ :
                                            <?php echo $row['cart_no']; ?>
                                        </strong></td>
                                </tr>
                                <tr>

                                    <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>"
                                            alt="Thumbnail">
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
                                        <?php echo getStatusText($row['status_delivery']) ?>
                                    </td>
                                    <td>
                                        <?php echo $row['created_date'] ?>
                                    </td>
                                    <td><img src="data:image/png;base64,<?php echo base64_encode($row['transaction']); ?>"
                                            alt="Thumbnail">
                                    </td>
                                    <td>
                                        <?php if ($row['status_delivery'] == 1) { ?>
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('คุณต้องการยกเลิกรายการสั่งซื้อนี้ใช่หรือไม่?')">ยกเลิกรายการสั่งซื้อ</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </form>
                            <?php
                            // กำหนดค่าเลข cart_no เป็นค่าปัจจุบัน
                            $previous_cart_no = $row['cart_no'];
                            // รวมจำนวนสินค้าใน cart_no นั้น
                            $total_quantity += $row['quantity'];
                        } else {
                            // ถ้า cart_no เป็นค่าเดิม ให้แสดงเฉพาะรายการที่เป็นสินค้าเท่านั้น
                            ?>
                            <tr>
                                <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>"
                                        alt="Thumbnail">
                                </td>
                                <td>
                                    <?php echo $row['product_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['quantity'] ?>
                                </td>
                            </tr>
                            <?php
                            // รวมจำนวนสินค้าใน cart_no นั้น
                            $total_quantity += $row['quantity'];
                        }
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
