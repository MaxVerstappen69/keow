<?php
session_start();

// Include the database configuration file
require_once "db.php";

// Check if the database connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve user information from the form
    $employee_id = $_POST['employee_id'];
    $category_id = $_POST['category_id'];
    $product_name = $_POST['product_name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];

    // Check if a file is selected for upload
    if ($_FILES['image']['name']) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        // Read file content
        $file_content = file_get_contents($file_tmp);

        // Update profile picture and other profile information in the database
        $update_sql = "UPDATE product SET employee_id=?, category_id=?, product_name=?, detail=?, price=?, quantity=?, image=? WHERE product_id=?";
        $params = array($employee_id, $category_id, $product_name, $detail, $price, $quantity, $file_content, $product_id);
    } elseif (!empty($_FILES["image"]["name"])) {
        // Update other profile information based on a condition
        $update_sql = "UPDATE product SET employee_id=?, category_id=?, product_name=?, detail=?, price=?, quantity=? WHERE product_id=?";
        $params = array($employee_id, $category_id, $product_name, $detail, $price, $quantity, $product_id);
    } else {
        // Update other profile information except profile picture
        $update_sql = "UPDATE product SET employee_id=?, category_id=?, product_name=?, detail=?, price=?, quantity=? WHERE product_id=?";
        $params = array($employee_id, $category_id, $product_name, $detail, $price, $quantity, $product_id);
    }

    // Prepare the statement
    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $bind_count = count($params);
        $types = str_repeat('s', $bind_count); // Assuming all parameters are strings

        $stmt->bind_param($types, ...$params);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success4'] = 'แก้ไขข้อมูลเรียบร้อย';
            header('location: admin_product.php');
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>