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

// Check if add to cart button is clicked
if (isset($_POST['add_to_cart'])) {
    // Get quantity from the form
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['login_user'])) {
        $customer_email = $_SESSION['login_user']; // Assuming $_SESSION['login_user'] contains customer's email
        // Retrieve customer ID based on email
        $customer_sql = "SELECT customer_id FROM customer WHERE email = '$customer_email'";
        $customer_result = $conn->query($customer_sql);
        if ($customer_result->num_rows > 0) {
            $customer_row = $customer_result->fetch_assoc();
            $customer_id = $customer_row['customer_id'];

            // Check if the product is already in the cart
            $existing_item_sql = "SELECT * FROM cart_item WHERE product_id = '$product_id' AND customer_id = '$customer_id'";
            $existing_item_result = $conn->query($existing_item_sql);

            if ($existing_item_result->num_rows > 0) {
                // Product already exists in the cart, update quantity
                $existing_item_row = $existing_item_result->fetch_assoc();
                $existing_quantity = $existing_item_row['quantity'];
                $existing_stock_quantity = $product['quantity']; // Quantity in stock
                $new_quantity = $existing_quantity + $quantity;

                // Check if the new quantity exceeds the stock quantity
                if ($new_quantity > $existing_stock_quantity) {
                    // If exceeds, set the quantity to the maximum available stock quantity
                    $new_quantity = $existing_stock_quantity;
                }

                // Update the existing cart item with the new quantity
                $update_sql = "UPDATE cart_item SET quantity = '$new_quantity', update_date = NOW() WHERE product_id = '$product_id' AND customer_id = '$customer_id'";
                if ($conn->query($update_sql) === TRUE) {
                    // Quantity updated successfully
                } else {
                    echo "Error updating quantity: " . $conn->error;
                }
            } else {
                // Product doesn't exist in the cart, add new item
                $sql_insert = "INSERT INTO cart_item (product_id, quantity, customer_id, created_date, update_date) VALUES ('$product_id', '$quantity', '$customer_id', NOW(), NOW())";
                if ($conn->query($sql_insert) === TRUE) {
                    // echo "Product added to cart successfully.";
                } else {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                }
            }
        } else {
            echo '<script src="../js/error_admin_addcart.js"></script>';
        }
    } else {
        echo '<script src="../js/error_addcartnotcustomer.js"></script>';
    }
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
    <!-- <script src="../js/buttonQuantity.js"></script> -->
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
            <?php if ($product): ?>
                <div class="col-4">
                    <img src="data:image/png;base64,<?php echo base64_encode($product['image']); ?>" style="height: 70%;"
                        alt="Thumbnail">
                </div>
                <div class="col-8">
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

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
                            <input type="number" class="rounded text-center " name="quantity" id="quantity" value="1" min="1"
                                max="<?php echo $product['quantity']; ?>">
                            <p class='ps-4 opacity-50'>มีสินค้าทั้งหมด
                                <span id="quantity">
                                    <?php echo $product['quantity']; ?> ชิ้น
                                </span>
                            </p>
                        </div>

                        <button class="btn fw-bold mt-2 shadow-sm" type="submit" name="add_to_cart"
                            style='background-color: #EF959D'>Add to Cart</button>

                    </form>
                </div>
            <?php else: ?>
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
