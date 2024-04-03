<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if ID is provided
if (!isset($_GET['delete_id'])) {
    // Redirect to employee list page if ID is not provided
    header("Location: cart_page.php");
    exit();
}

// Include database connection
require_once "../../config/db.php";

// Get the ID of the employee to be deleted
$cart_item_id = $_GET['delete_id'];

// Prepare and execute SQL statement to delete the employee
$sql = "DELETE FROM cart_item WHERE cart_item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_item_id);
$stmt->execute();
$stmt->close();

// Close database connection
$conn->close();

// Redirect back to employee list page after deletion
$_SESSION['success5'] = 'ลบข้อมูลสำเร็จ';
header('location: cart_page.php');
exit();
?>
