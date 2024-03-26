<?php
session_start();

// Include the database configuration file
require_once "../../config/db.php";

// Check if the database connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // รับค่าที่แก้ไขจากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

    // Check if a file is selected for upload
    if ($_FILES['profile_picture']['name']) {
        // Get file details
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];

        // Read file content
        $file_content = addslashes(file_get_contents($file_tmp));

        // Update profile picture in the database
        $update_sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', address='$address', phone='$phone', username='$username', thumbnail='$file_content' WHERE email='$email'";
    } else {
        // Update other profile information except profile picture
        $update_sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', address='$address', phone='$phone', username='$username' WHERE email='$email'";
    }

    if (mysqli_query($conn, $update_sql)) {
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ")</script>';
        header("Location: user_profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    header("Location: user_profile.php");
    exit();
}
?>
