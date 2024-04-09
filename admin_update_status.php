<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "db.php";

    // Get status and order_id from POST data
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    // Retrieve order_no for the given order_id
    $order_no_sql = "SELECT order_no FROM orders WHERE order_id = ?";
    $order_no_stmt = $conn->prepare($order_no_sql);
    $order_no_stmt->bind_param("i", $order_id);
    $order_no_stmt->execute();
    $order_no_result = $order_no_stmt->get_result();

    if ($order_no_result->num_rows > 0) {
        $order_no_row = $order_no_result->fetch_assoc();
        $order_no = $order_no_row['order_no'];

        // Update status in the database for all records with the same order_no
        $update_sql = "UPDATE orders SET status_delivery = ? WHERE order_no = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $status, $order_no);

        if ($update_stmt->execute()) {
            // If successful, return the updated status
            $response = array('success' => true, 'newStatus' => $status);
            echo json_encode($response);
        } else {
            // If failed, return an error message
            $response = array('success' => false, 'error' => 'Error updating status: ' . $conn->error);
            echo json_encode($response);
        }

        // Close prepared statements
        $update_stmt->close();
    } else {
        // If order_no not found, return an error message
        $response = array('success' => false, 'error' => 'Order not found.');
        echo json_encode($response);
    }

    // Close database connection
    $order_no_stmt->close();
    $conn->close();
}
?>