<?php
require_once "../../config/db.php"; // Include database configuration file
include '../include/navbar_main.php';
// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Retrieve product details from the database based on product ID
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // Fetch product details
        // Display product details as needed
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <script src="../js/buttonQuantity.js"></script>
</head>

<body>

    <!-- Display product details here -->
    <!-- Display product details here -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-4"><img src="data:image/png;base64,<?php echo base64_encode($product['image']); ?>"
                    style="height: 70%;" alt="Thumbnail"></div>
            <div class="col-8">
                <h1>
                    <?php echo $product['product_name']; ?>
                </h1>
                <p>฿
                    <?php echo $product['price']; ?>
                </p>
                <p>รายละเอียดสินค้า :
                    <?php echo $product['detail']; ?>
                </p>

                <div class="input-group">
                    <p class='pe-4 opacity-50'>จำนวน</p>

                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                    <span class="input-group-text" id="currentQuantity">1</span>
                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                    <p class='ps-4 opacity-50'>มีสินค้าทั้งหมด <span id="quantity">
                            <?php echo $product['quantity']; ?> ชิ้น
                        </span></p>
                </div>
                <a href="#" class="btn fw-bold mt-2 shadow-sm" style='background-color: #EF959D'>Add to Cart</a>
            </div>
        </div>
    </div>




    </div>
    <!-- Other product details can be displayed similarly -->
</body>

</html>