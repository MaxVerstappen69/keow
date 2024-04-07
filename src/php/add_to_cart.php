<?php
session_start();
require_once "../../config/db.php";

// Start with cart_no equal to 1 for each new set of selected_products
$cart_no = isset($_SESSION['cart_no']) ? $_SESSION['cart_no'] : 1;
$order_no = isset($_SESSION['order_no']) ? $_SESSION['order_no'] : 1;

if (isset($_POST['selected_products'])) {
    $id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

    $customer_sql = "SELECT customer_id FROM customer WHERE email = ?";
    $customer_stmt = $conn->prepare($customer_sql);
    $customer_stmt->bind_param("s", $id);
    $customer_stmt->execute();
    $customer_result = $customer_stmt->get_result();

    if ($customer_result->num_rows > 0) {
        $customer_row = $customer_result->fetch_assoc();
        $customer = $customer_row['customer_id'];
    } else {
        // Handle the case where customer is not found
        exit("Customer not found.");
    }

    $selectedProducts = $_POST['selected_products'];

    if (count($selectedProducts) > 0) {
        foreach ($selectedProducts as $product) {
            $product_id = $product;

            // Fetch quantity from cart_item table
            $quantity_sql = "SELECT quantity FROM cart_item WHERE product_id = ? AND customer_id = ?";
            $quantity_stmt = $conn->prepare($quantity_sql);
            $quantity_stmt->bind_param("ii", $product_id, $customer);
            $quantity_stmt->execute();
            $quantity_result = $quantity_stmt->get_result();

            if ($quantity_result->num_rows > 0) {
                $quantity_row = $quantity_result->fetch_assoc();
                $quantity = $quantity_row['quantity'];
            } else {
                $quantity = 0;
            }

            $totalPrice = $_POST['totalPrice'];
            $total_amount = $totalPrice;

            // Insert into cart table
            $insert_cart_sql = "INSERT INTO cart (product_id, quantity, customer_id, cart_no) VALUES (?, ?, ?, ?)";
            $insert_cart_stmt = $conn->prepare($insert_cart_sql);
            $insert_cart_stmt->bind_param("iiii", $product_id, $quantity, $customer, $cart_no);
            $insert_cart_stmt->execute();

            // Retrieve cart_id of the inserted cart
            $cartId = $insert_cart_stmt->insert_id;

            // Retrieve file content
            $file_content = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

            // Insert into orders table
            $insert_order_sql = "INSERT INTO orders (cart_id, total_amount, status_delivery, transaction, order_no, created_date, update_date) VALUES (?, ?, 1, ?, ?, NOW(), NOW())";
            $insert_order_stmt = $conn->prepare($insert_order_sql);
            $insert_order_stmt->bind_param("iisi", $cartId, $total_amount, $file_content, $order_no);
            $insert_order_stmt->execute();

            if ($insert_order_stmt->errno) {
                echo "Error inserting product into cart: " . $insert_order_stmt->error;
                exit();
            }
        }

        // Increment cart_no for the next set of products
        $cart_no++;

        // Store the updated cart_no in the session
        $_SESSION['cart_no'] = $cart_no;

        $order_no++;
        // Store the updated cart_no in the session
        $_SESSION['order_no'] = $order_no;

        // Redirect the user to indicate that the products are added to the cart
        header("Location: user_order.php");
        exit();
    } else {
        echo "No products selected.";
    }

} else {
    echo "No data received.";
}

$conn->close();
?>
