<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "../../config/db.php";

    // Get status, order_no, and customer_id from POST data
    $status = $_POST['status'];
    $order_no = $_POST['order_no'];
    $customer_id = $_POST['customer_id'];

    // Update status in the database
    $sql = "UPDATE orders SET status_delivery = '$status' WHERE order_no = '$order_no' AND customer_id = '$customer_id'";
    if ($conn->query($sql) === TRUE) {
        // If successful, return the updated status
        $response = array('success' => true, 'newStatus' => $status);
        echo json_encode($response);
    } else {
        // If failed, return an error message
        $response = array('success' => false, 'error' => 'Error updating status: ' . $conn->error);
        echo json_encode($response);
    }

    // Close database connection
    $conn->close();
}
?>
