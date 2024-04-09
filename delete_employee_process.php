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
    header("Location: admin_employee.php");
    exit();
}

// Include database connection
require_once "db.php";

// Get the ID of the employee to be deleted
$employee_id = $_GET['delete_id'];

// Prepare and execute SQL statement to delete the employee
$sql = "DELETE FROM employee WHERE employee_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$stmt->close();

// Close database connection
$conn->close();

// Redirect back to employee list page after deletion
$_SESSION['success2'] = 'ลบข้อมูลสำเร็จ';
header('location: admin_employee.php');
exit();
?>