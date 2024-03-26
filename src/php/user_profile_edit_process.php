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
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    // New password and confirm password
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if a file is selected for upload
    if ($_FILES['profile_picture']['name']) {
        // Get file details
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];

        // Read file content
        $file_content = addslashes(file_get_contents($file_tmp));

        // Update profile picture in the database
        $update_sql = "UPDATE customer SET firstname=?, lastname=?, address=?, phone=?, username=?, thumbnail=? WHERE email=?";
        $params = array($firstname, $lastname, $address, $phone, $username, $file_content, $email);
    } else {
        // Update other profile information except profile picture
        $update_sql = "UPDATE customer SET firstname=?, lastname=?, address=?, phone=?, username=? WHERE email=?";
        $params = array($firstname, $lastname, $address, $phone, $username, $email);
    }

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        echo '<script>alert("New password and confirm password do not match");</script>';
        header("Location: user_profile.php");
        exit();
    }

    // Check if new password is not empty
    if (!empty($new_password)) {
        // Encrypt new password with MD5
        $encrypted_password = md5($new_password);
        // Update password in the database
        $update_sql = "UPDATE customer SET password=? WHERE email=?";
        $params = array($encrypted_password, $email);
    }

// Prepare the statement
$stmt = $conn->prepare($update_sql);

if ($stmt) {
    // Bind parameters
    $types = 'ss'; // Two bind variables, both strings
    $stmt->bind_param($types, ...$params);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ");</script>';
        header("Location: user_profile.php");
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
