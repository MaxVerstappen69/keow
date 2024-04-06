<?php
if (!isset ($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar navbar-light shadow" style="background-color: #B8D8BA;">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a class="navbar-brand" href="index.php">
                    <img src="../../public/image/logo.png" width="90" height="70" class="d-inline-block align-top"
                        alt="">
                </a>
            </div>
            <div>
                <?php
                // Check if the user is logged in
                if (isset ($_SESSION['login_user'])) {
                    // If logged in, show logout button
                    echo '<a class="btn btn-sm fw-bold" href="user_order.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Order</a>';
                    echo '<a class="btn btn-sm fw-bold" href="user_profile.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">profile</a>';
                    echo '<a class="btn btn-sm fw-bold" href="logout.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Logout</a>';
                } else {}    
                ?>
            </div>
        </div>
    </nav>

</body>

</html>