<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "../../config/db.php";

    // Get status and order_no from POST data
    $status = $_POST['status'];
    $order_no = $_POST['order_no'];

    // Update status in the database for all orders with the same order_no
    $sql = "UPDATE orders SET status_delivery = '$status' WHERE cart_id IN (
                SELECT cart_id FROM orders WHERE order_no = '$order_no'
            )";
    if ($conn->query($sql) === TRUE) {
        // If successful, you may echo a success message or perform other actions
        echo "Status updated successfully";
    } else {
        // If failed, you may echo an error message or perform other actions
        echo "Error updating status: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
