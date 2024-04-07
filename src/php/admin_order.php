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
$sql = "SELECT customer.email,customer.firstname,customer.lastname,customer.address,customer.phone,customer.customer_id, orders.order_id, cart.cart_no, product.image, product.product_name, cart.quantity, orders.total_amount, orders.status_delivery, orders.created_date, orders.transaction,
        CONCAT(firstname, ' ', lastname) AS fullname
        FROM orders
        INNER JOIN cart ON orders.cart_id = cart.cart_id
        INNER JOIN customer ON cart.customer_id = customer.customer_id
        JOIN product ON cart.product_id = product.product_id
        
        WHERE 1
        ORDER BY orders.order_id";

$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order</title>
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
    <div class=" mt-5">
        <h2 class="mb-4 text-center">รายการสั่งซื้อ</h2>

        <table class="table table">
            <hr>
            <thead>
                <tr>
                    
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th style="width: 110px;">จำนวนสินค้า</th>
                    <th style="width: 110px;">รหัสลูกค้า</th>
                    <th>ชื่อลูกค้า</th>
                    <th style="width: 110px;">เบอร์โทร</th>
                    <th style="width: 110px;">ที่อยู่</th>
                    <th>ราคารวม</th>
                    <th style="width: 250px;">สถานะ</th>
                    <th style="width: 100px;">เวลาสั่งซื้อ</th>
                    <th style="width: 100px;">สลิปการจ่ายเงิน</th>
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
                            <form id="uploadForm" action="upload_image_slip.php" method="post" enctype="multipart/form-data">
                                <tr style="background-color: #EF959D;">
                                    <td colspan="11" class="text-center"><strong>รายการที่ :
                                            <?php echo $row['cart_no']; ?>
                                        </strong></td>
                                </tr>
                                <tr>
                               
                                    

                                    <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>"
                                            alt="Thumbnail">
                                           
                                    </td>

                                    <td> <?php echo $row['product_name'] ?></td>
                                    <td>
                                        <?php echo $row['quantity'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['customer_id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['fullname'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['address'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['total_amount'] ?>
                                    </td>
                                    <td>
                            <select class="form-select" name="status_delivery" onchange="updateStatus(this.value, <?php echo $row['order_id']; ?>)">
                                <option value="1" <?php if($row['status_delivery'] == 1) echo 'selected'; ?>>ชำระเงินเสร็จสิ้น รอการยืนยัน</option>
                                <option value="2" <?php if($row['status_delivery'] == 2) echo 'selected'; ?>>ยืนยันสำเร็จ กำลังจัดส่ง</option>
                                <option value="3" <?php if($row['status_delivery'] == 3) echo 'selected'; ?>>จัดส่งสำเร็จ</option>
                                <option value="4" <?php if($row['status_delivery'] == 4) echo 'selected'; ?>>ขอยกเลิกรายการ</option>
                                <option value="5" <?php if($row['status_delivery'] == 5) echo 'selected'; ?>>ยกเลิกรายการสำเร็จ</option>
                                <option value="6" <?php if($row['status_delivery'] == 6) echo 'selected'; ?>>ยกเลิกรายการล้มเหลว</option>
                            </select>
                        </td>
                                    <td>
                                        <?php echo $row['created_date'] ?>
                                    </td>
                                    <td><img src="data:image/png;base64,<?php echo base64_encode($row['transaction']); ?>"
                                            alt="Thumbnail">
                                    </td>
                                </tr>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </form>

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
    <script>
        function loadScript(scriptPath) {
            var script = document.createElement('script');
            script.src = scriptPath;
            document.body.appendChild(script);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function updateStatus(status, order_id) {
        // AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 100) {
                // If successful, update the status in the UI
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    // Update the status directly in the table cell
                    var statusCell = document.getElementById("status_" + order_id);
                    statusCell.innerText = response.newStatus;
                } else {
                    // Handle error scenario
                    console.error("Error updating status:", response.error);
                }
            }
        };
        xhttp.open("POST", "admin_update_status.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("status=" + status + "&order_id=" + order_id);
    }
</script>


</body>

</html>