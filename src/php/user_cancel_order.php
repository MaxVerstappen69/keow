<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "../../config/db.php";

    // Get order_id from POST data
    $order_id = $_POST['order_id'];

    // Update status in the database
    $sql = "UPDATE orders SET status_delivery = 4 WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        // If successful, redirect back to user_order.php or provide any success message
        header("Location: user_order.php");
        exit();
    } else {
        // If failed, return an error message
        echo "Error updating status: " . $conn->error;
    }

    // Close prepared statement
    $stmt->close();

    // Close database connection
    $conn->close();
}
?>
