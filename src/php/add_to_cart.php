<?php
session_start(); // Start the session to access session variables
require_once "../../config/db.php";

// Check if any product data is sent
if (isset($_POST['selected_products'])) {
    // Connect to the database

    // Create an array to store selected product IDs
    $selectedProducts = $_POST['selected_products'];

    // Check if there are any products in the list
    if (count($selectedProducts) > 0) {
        // Assuming 'cart_no' is always 1 for simplicity
        $cart_no = 1;

        // Loop through each selected product and insert it into the cart table
        foreach ($selectedProducts as $cart_item_id) {
            // Insert the product into the cart table
            $insert_sql = "INSERT INTO cart (cart_item_id, cart_no) VALUES ('$cart_item_id', '$cart_no')";
            if (!$conn->query($insert_sql)) {
                echo "Error inserting product into cart: " . $conn->error;
                exit();
            }
        }

        // Redirect the user to a page indicating that the products are added to the cart
        header("Location: index.php");
        exit(); // Ensure that no other output is sent
    } else {
        echo "No products selected.";
    }

} else {
    echo "No data received.";
}

// Close the database connection
$conn->close();
?>