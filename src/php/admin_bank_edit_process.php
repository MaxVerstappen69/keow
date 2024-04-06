<?php
session_start();

// Include the database configuration file
require_once "../../config/db.php";

// Check if the database connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve user information from the form
    $bank_name = $_POST['bank_name'];
    $bank_detail = $_POST['bank_detail'];
    $bank_id = $_POST['bank_id'];

    // Check if a file is selected for upload
    if ($_FILES['qrcode_perma']['name']) {
        // Get file details
        $file_name = $_FILES['qrcode_perma']['name'];
        $file_tmp = $_FILES['qrcode_perma']['tmp_name'];

        // Read file content
        $file_content = file_get_contents($file_tmp);

        // Update profile picture and other profile information in the database
        $update_sql = "UPDATE bank SET bank_name=?, bank_detail=?, qrcode_perma=? WHERE bank_id=?";
        $params = array($bank_name, $bank_detail, $file_content, $bank_id);
    } elseif (!empty($_FILES["qrcode_perma"]["name"])) {
        // Update other profile information based on a condition
        $update_sql = "UPDATE bank SET bank_name=?, bank_detail=? WHERE bank_id=?";
        $params = array($bank_name, $bank_detail, $bank_id);
    } else {
        // Update other profile information except profile picture
        $update_sql = "UPDATE bank SET bank_name=?, bank_detail=? WHERE bank_id=?";
        $params = array($bank_name, $bank_detail, $bank_id);
    }

    // Prepare the statement
    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $bind_count = count($params);
        $types = str_repeat('s', $bind_count); // Assuming all parameters are strings

        $stmt->bind_param($types, ...$params);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success6'] = 'แก้ไขข้อมูลเรียบร้อย';
            header('location: admin_employee_payment.php');
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