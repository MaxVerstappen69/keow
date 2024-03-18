<?php
session_start();
require_once "../../config/db.php";

// When data is submitted via a form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST['username_email']; // Assuming this field contains either username or email
    $password = md5($_POST['password']);

    // Query the database to check user data
    $query = "SELECT * FROM customer WHERE (username='$username_email' OR email='$username_email') AND password='$password'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    // If user data is found in the database
    if($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login_user'] = $row['email']; // Store user's email in session
        header("location: dashboard.php"); // Redirect to dashboard.php
    } else {
        echo "Username or email or password is incorrect";
    }

    // Check if the "remember me" checkbox is selected
    if(isset($_POST['remember_me'])) {
        // Perform actions when "remember me" is selected
        // For example, save data in a cookie
    }
}
?>
