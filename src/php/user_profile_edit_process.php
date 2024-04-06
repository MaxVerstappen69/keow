<?php
session_start();

// Include the database configuration file
require_once "../../config/db.php";

// Check if the database connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit']) || isset($_POST['submit_admin'])) {
    if (isset($_POST['submit'])) {
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
            $file_content = file_get_contents($file_tmp);

            // Update profile picture and other profile information in the database
            $update_sql = "UPDATE customer SET firstname=?, lastname=?, address=?, phone=?, username=?, thumbnail=?";
            $params = array($firstname, $lastname, $address, $phone, $username, $file_content);

            $verifyPassword = "SELECT password FROM customer WHERE email = '$email'";
            $stmt = $conn->prepare($verifyPassword);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Compare hashed password from the database with the provided password
                if (md5($confirm_password) === $hashed_password) {
                    $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                    header('location: user_profile_edit.php');
                    exit();
                }
            }

            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header('location: user_profile_edit.php');
                exit();

            } elseif (!empty($new_password) && $new_password === $confirm_password) {
                // Encrypt new password with MD5
                $encrypted_password = md5($new_password);
                $update_sql .= ", password=?";
                $params[] = $encrypted_password;
            }

            $update_sql .= " WHERE email=?";
            $params[] = $email;
        } else {
            // Update other profile information except profile picture
            $update_sql = "UPDATE customer SET firstname=?, lastname=?, address=?, phone=?, username=?";
            $params = array($firstname, $lastname, $address, $phone, $username);

            $verifyPassword = "SELECT password FROM customer WHERE email = '$email'";
            $stmt = $conn->prepare($verifyPassword);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Compare hashed password from the database with the provided password
                if (md5($confirm_password) === $hashed_password) {
                    $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                    header('location: user_profile_edit.php');
                    exit();
                }
            }

            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header('location: user_profile_edit.php');
                exit();

            } elseif (!empty($new_password) && $new_password === $confirm_password) {
                // Encrypt new password with MD5
                $encrypted_password = md5($new_password);
                $update_sql .= ", password=?";
                $params[] = $encrypted_password;
            }

            $update_sql .= " WHERE email=?";
            $params[] = $email;
        }

    } elseif (isset($_POST['submit_admin'])) {
        $firstname = $_POST['em_firstname'];
        $lastname = $_POST['em_lastname'];
        $email = $_POST['em_email'];
        $phone = $_POST['em_phone'];
        $username = $_POST['em_username'];
        // New password and confirm password
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if a file is selected for upload
        if ($_FILES['profile_picture']['name']) {
            // Get file details
            $file_name = $_FILES['profile_picture']['name'];
            $file_tmp = $_FILES['profile_picture']['tmp_name'];

            // Read file content
            $file_content = file_get_contents($file_tmp);

            // Update profile picture and other profile information in the database
            $update_sql = "UPDATE employee SET em_firstname=?, em_lastname=?, em_phone=?, em_username=?, em_thumbnail=?";
            $params = array($firstname, $lastname, $phone, $username, $file_content);

            $verifyPassword = "SELECT em_password FROM employee WHERE em_email = '$email'";
            $stmt = $conn->prepare($verifyPassword);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Compare hashed password from the database with the provided password
                if (md5($confirm_password) === $hashed_password) {
                    $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                    header('location: user_profile_edit.php');
                    exit();
                }
            }

            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header('location: user_profile_edit.php');
                exit();

            } elseif (!empty($new_password) && $new_password === $confirm_password) {
                // Encrypt new password with MD5
                $encrypted_password = md5($new_password);
                $update_sql .= ", em_password=?";
                $params[] = $encrypted_password;
            }

            $update_sql .= " WHERE em_email=?";
            $params[] = $email;
        } else {
            // Update other profile information except profile picture
            $update_sql = "UPDATE employee SET em_firstname=?, em_lastname=?, em_phone=?, em_username=?";
            $params = array($firstname, $lastname, $phone, $username);

            $verifyPassword = "SELECT em_password FROM employee WHERE em_email = '$email'";
            $stmt = $conn->prepare($verifyPassword);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                // Compare hashed password from the database with the provided password
                if (md5($confirm_password) === $hashed_password) {
                    $_SESSION["currentPassword"] = 'รหัสผ่านที่ใช้ในปัจจุบัน';
                    header('location: user_profile_edit.php');
                    exit();
                }
            }

            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header('location: user_profile_edit.php');
                exit();

            } elseif (!empty($new_password) && $new_password === $confirm_password) {
                // Encrypt new password with MD5
                $encrypted_password = md5($new_password);
                $update_sql .= ", em_password=?";
                $params[] = $encrypted_password;
            }

            $update_sql .= " WHERE em_email=?";
            $params[] = $email;
        }

    }

    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $bind_count = count($params);

        $types = str_repeat('s', $bind_count); // Assuming all parameters are strings

        $stmt->bind_param($types, ...$params);
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = 'แก้ไขข้อมูลเรียบร้อย';
            header('location: user_profile_edit.php');
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