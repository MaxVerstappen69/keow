<?php
require_once "../../config/db.php"; // Include database configuration file
include '../include/navbar_main.php';

$product = null;

// Check if product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Retrieve product details from the database based on product ID
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // Fetch product details
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
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col fw-bold py-3 fs-3 text-center">
            รายละเอียดสินค้า
            </div>
            <hr class="hr" />
        </div>

        <div class="row">
            <?php if ($product) : ?>
                <div class="col-4">
                    <img src="data:image/png;base64,<?php echo base64_encode($product['image']); ?>"
                        style="height: 70%;" alt="Thumbnail">
                </div>
                <div class="col-8">
                    <form method="post" action="#">
                        
                                <h1><?php echo $product['product_name']; ?></h1>
                                <p>฿<?php echo $product['price']; ?></p>
                                <p>รายละเอียดสินค้า : <?php echo $product['detail']; ?></p>

                                <div class="input-group">
                                    <p class='pe-4 opacity-50'>จำนวน</p>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="decreaseQuantity()">-</button>
                                    <span class="input-group-text" id="currentQuantity">1</span>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="increaseQuantity()">+</button>
                                    <p class='ps-4 opacity-50'>มีสินค้าทั้งหมด
                                        <span id="quantity"><?php echo $product['quantity']; ?> ชิ้น</span>
                                    </p>
                                </div>

                                <a href="#" class="btn fw-bold mt-2 shadow-sm"
                                    style='background-color: #EF959D'>Add to Cart</a>
                        
                    </form>
                </div>
            <?php else : ?>
                <div class="col">
                    <p>Product not found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>