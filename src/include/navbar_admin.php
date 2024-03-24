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

            <div class="text-center">
                <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search..." aria-label="Search"
                            style="width: 30vw; border-radius: 30px;">
                        <button type="submit" class="btn"><i class="bi bi-search" style="font-size: 1rem;"></i></button>
                    </div>
                </form>
            </div>

            <div>
                <a href="../php/admin_edit.php" class="btn btn-primary active">Admin</a>
                <a href="#" class="btn" style="color: #000000;">
                    <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                </a>
                <?php
                // Check if the user is logged in
                if (isset ($_SESSION['login_user'])) {
                    // If logged in, show logout button
                    echo '<a class="btn btn-sm fw-bold" href="order.php" role="button"><i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i></a>';
                    echo '<a class="btn btn-sm fw-bold" href="user_profile.php" role="button"><i class="bi bi-person-circle" style="font-size: 1.5rem;"></i></a>';
                    echo '<a class="btn btn-sm fw-bold" href="logout.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Logout</a>';
                } else {
                    // If not logged in, show sign-in button
                    echo '<a class="btn btn-sm fw-bold" href="login.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Sign In</a>';
                }
                ?>
            </div>
        </div>
    </nav>

</body>

</html>