<?php
session_start();
require_once "../../config/db.php";

$id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    require_once "../../config/db.php"; // Include database connection
    $sql = "SELECT customer.email, orders.order_id, cart.cart_no, product.image, product.product_name, cart.quantity, orders.total_amount, orders.status_delivery, orders.created_date 
    FROM orders
    INNER JOIN cart ON orders.cart_id = cart.cart_id
    INNER JOIN customer ON cart.customer_id = customer.customer_id
    JOIN product ON cart.product_id = product.product_id
    WHERE customer.email = '$id'";

    $result = $conn->query($sql);
    $order_ids = []; // เก็บ order_id ทั้งหมดที่ได้จาก query
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_ids[] = $row["order_id"]; // เก็บ order_id เข้าไปในอาเรย์
        }
    }

    // Define variables from file upload
    $transaction = file_get_contents($_FILES["fileToUpload"]["tmp_name"]); // Get contents of the uploaded file
    $created_date = date("Y-m-d H:i:s"); // Current date and time
    $update_date = date("Y-m-d H:i:s"); // Current date and time

    // Prepare SQL statement to insert data into the 'bill' table
    $sql = "INSERT INTO bill (order_id, transaction, created_date, update_date) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);

    // Loop through each order_id and execute the SQL statement for each one
    foreach ($order_ids as $order_id) {
        $stmt->bind_param("isss", $order_id, $transaction, $created_date, $update_date);
        // Execute the statement
        if ($stmt->execute()) {
            // echo "File uploaded successfully.";
            header("Location: user_order.php");
        } else {
            echo "Error uploading file for order ID $order_id: " . $conn->error;
        }
    }

    // Close statement
    $stmt->close();

    // Close database connection
    $conn->close();
}
?>