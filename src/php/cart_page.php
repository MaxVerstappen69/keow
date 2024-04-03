<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';

// สร้างอาร์เรย์เพื่อเก็บข้อมูลของสินค้าที่เลือก
$selected_products = array();
$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

$sql_update = "UPDATE cart_item
               INNER JOIN product ON cart_item.product_id = product.product_id
               INNER JOIN customer ON cart_item.customer_id = customer.customer_id
               SET cart_item.quantity = product.quantity
               WHERE cart_item.quantity > product.quantity
                 AND customer.email = '$id';";

$result_update = $conn->query($sql_update);

if ($result_update === TRUE) {
    // echo "จำนวนสินค้าในตะกร้าถูกปรับแล้ว";
} else {
    echo "เกิดข้อผิดพลาดในการปรับปรุงจำนวนสินค้าในตะกร้า: " . $conn->error;
}
// คำสั่ง SQL ที่เข้าถึงข้อมูลสินค้าในตะกร้าและจับคู่กับข้อมูลของผู้ใช้ที่ล็อกอินอยู่
$sql = "SELECT cart_item.cart_item_id, product.product_id, product.product_name, product.price, product.image, product.quantity, cart_item.quantity as cart_quantity
FROM cart_item
INNER JOIN product ON cart_item.product_id = product.product_id
INNER JOIN customer ON cart_item.customer_id = customer.customer_id
WHERE customer.email = '$id';";


$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .product-image {
            width: 130px;
            height: 130px;
            object-fit: cover;
            
        }

        .form-check-input-custom {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['success5'])) {
        echo '<script src="../js/success_delete_cart.js"></script>';
        unset($_SESSION['success5']);
    }
    ?>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Shopping Cart</h2>
        <form id="orderForm" method="post" action="order.php" enctype="multipart/form-data">
            <div class="container d-flex justify-content-center">
            <div class="row w-75">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row['product_id'];

                        if (array_key_exists($product_id, $selected_products)) {
                            $selected_products[$product_id]['cart_quantity'] += $row['cart_quantity'];
                        } else {
                            $selected_products[$product_id] = array(
                                'product_id' => $product_id,
                                'product_name' => $row['product_name'],
                                'price' => $row['price'],
                                'image' => $row['image'],
                                'quantity' => $row['quantity'],
                                'cart_quantity' => $row['cart_quantity']
                            );
                        }
                    }
                }

                foreach ($selected_products as $product) {
                    ?>
                    <div class="col-md-12">
                        <div class="product-card d-flex align-items-center">
                            <img src="data:image/png;base64,<?php echo base64_encode($product['image']); ?>"
                                class="product-image me-3">
                            <div class="flex-grow-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input form-check-input-custom"
                                        name="selected_products[]" id="product_<?php echo $product['product_id']; ?>"
                                        value="<?php echo $product['product_id']; ?>" checked>
                                    <label class="form-check-label" for="product_<?php echo $product['product_id']; ?>">
                                        <?php echo $product['product_name']; ?>
                                    </label>
                                </div>
                                <div class="input-group mt-2 w-25">
                                    <span class="input-group-text">จำนวน</span>
                                    <input type="number" class="form-control"
                                        name="cart_quantity[<?php echo $product['product_id']; ?>]"
                                        value="<?php echo $product['cart_quantity'] ?>" readonly>
                                </div>
                                <div class="input-group mt-2 w-25">
                                    <span class="input-group-text">ราคา</span>
                                    <input type="text" class="form-control" name="category_id"
                                        value="<?php echo $product['price'] ?>" readonly>
                                </div>
                                <div class="mt-2">
                                    <a href='cart_delete_process.php?delete_id=<?php echo $row["cart_item_id"]; ?>'
                                        class='btn btn-danger btn-sm'
                                        onclick='return confirm("คุณจะลบสินค้านี้จริงหรือ?")'>ลบ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            

            <div class="mt-4 d-flex justify-content-end">
                <button type="button" id="orderButton" class="btn btn-primary">สั่งสินค้า</button>
            </div>
        </form>
    </div>
</div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('orderButton').addEventListener('click', function () {
            var selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');
            if (selectedProducts.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    text: 'โปรดเลือกสินค้าอย่างน้อย 1 รายการ',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                var form = document.getElementById('orderForm');
                selectedProducts.forEach(function (product) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_products[]';
                    input.value = product.value;
                    form.appendChild(input);
                });
                form.submit();
            }
        });
    </script>

</body>

</html>