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
            // If successful, update product quantity

            $sql_update_quantity = "UPDATE product
            INNER JOIN (
                SELECT cart.product_id, SUM(cart.quantity) AS total_quantity
                FROM cart
                INNER JOIN orders ON cart.cart_id = orders.cart_id
                WHERE orders.status_delivery = 4 AND orders.order_no = ?
                GROUP BY cart.product_id
            ) AS cart_total ON product.product_id = cart_total.product_id
            SET product.quantity = product.quantity + cart_total.total_quantity";

            $stmt_update_quantity = $conn->prepare($sql_update_quantity);
            $stmt_update_quantity->bind_param("i", $order_no);
            $stmt_update_quantity->execute(); // Execute the update query

            // Close the prepared statement
            $stmt_update_quantity->close();

            // Return success response
            $response = array('success' => true, 'newStatus' => $status);
            header("Location: user_order.php");
            echo json_encode($response);
            exit();
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