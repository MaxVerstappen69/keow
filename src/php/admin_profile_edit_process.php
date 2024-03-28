<?php
session_start();

// Include the database configuration file
require_once "../../config/db.php";

// Check if the database connection is established
if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}

if (isset ($_POST['submit'])) {
    // Retrieve user information from the form
    $em_firstname = $_POST['em_firstname'];
    $em_lastname = $_POST['em_lastname'];
    $em_email = $_POST['em_email'];
    $em_username = $_POST['em_username'];
    // New password and confirm password
    $em_new_password = $_POST['em_new_password'];
    $em_confirm_password = $_POST['em_confirm_password'];

    // Check if a file is selected for upload
    if ($_FILES['profile_picture']['name']) {
        // Get file details
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];

        // Read file content
        $file_content = file_get_contents($file_tmp);

        // Update profile picture and other profile information in the database
        $update_sql = "UPDATE employee SET em_firstname=?, em_lastname=?, em_username=?, em_thumbnail=?";
        $params = array($em_firstname, $em_lastname, $em_username, $file_content);

        $verifyPassword = "SELECT em_password FROM employee WHERE em_email = '$em_email'";
        $stmt = $conn->prepare($verifyPassword);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Compare hashed password from the database with the provided password
            if (md5($em_confirm_password) === $hashed_password) {
                $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                header('location: admin_employee.php');
                exit();
            }
        }

        if ($em_new_password !== $em_confirm_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header('location: admin_employee.php');
            exit();

        } elseif (!empty ($em_new_password) && $em_new_password === $em_confirm_password) {
            // Encrypt new password with MD5
            $encrypted_password = md5($em_new_password);
            $update_sql .= ", em_password=?";
            $params[] = $encrypted_password;
        }

        $update_sql .= " WHERE em_email=?";
        $params[] = $em_email;
    } else {
        // Update other profile information except profile picture
        $update_sql = "UPDATE employee SET em_firstname=?, em_lastname=?, em_username=?";
        $params = array($em_firstname, $em_lastname, $em_username);

        $verifyPassword = "SELECT em_password FROM employee WHERE em_email = '$em_email'";
        $stmt = $conn->prepare($verifyPassword);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Compare hashed password from the database with the provided password
            if (md5($em_confirm_password) === $hashed_password) {
                $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                header('location: admin_employee.php');
                exit();
            }
        }

        if ($em_new_password !== $em_confirm_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header('location: admin_employee.php');
            exit();

        } elseif (!empty ($em_new_password) && $em_new_password === $em_confirm_password) {
            // Encrypt new password with MD5
            $encrypted_password = md5($em_new_password);
            $update_sql .= ", em_password=?";
            $params[] = $encrypted_password;
        }

        $update_sql .= " WHERE em_email=?";
        $params[] = $em_email;
    }

    // Prepare the statement
    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $bind_count = count($params);

        $types = str_repeat('s', $bind_count); // Assuming all parameters are strings

        $stmt->bind_param($types, ...$params);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = 'แก้ไขข้อมูลเรียบร้อย';
            header('location: admin_employee.php');
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