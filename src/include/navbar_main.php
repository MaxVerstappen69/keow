<?php
// session_start();
include "../../config/db.php";
$id = isset ($_SESSION['login_user']) ? $_SESSION['login_user'] : null;
$sql = "SELECT * FROM customer WHERE email = '$id';";
$result = $conn->query($sql);

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

            <!-- <div class="text-center">
                <form class="form-inline">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search..." aria-label="Search"
                            style="width: 30vw; border-radius: 30px;">
                        <button type="submit" class="btn"><i class="bi bi-search" style="font-size: 1rem;"></i></button>
                    </div>
                </form>
            </div> -->

            <div>
                <a href="#" class="btn border-0" style="color: #000000;">
                    <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                </a>
                <?php
                if (isset ($_SESSION['login_user'])) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="btn-group">
                                <img src="data:image/png;base64,<?php echo base64_encode($row['thumbnail']); ?>"
                                    class="img-fluid rounded-circle" style="width: 40px; height: 40px;" alt="Thumbnail">
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split border-0" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="order.php">Order</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <?php
                        }
                        // echo '<a class="btn btn-sm fw-bold" href="logout.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Logout</a>';
                    }
                } else {
                    echo '<a class="btn btn-sm fw-bold" href="login.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">Sign In</a>';
                }
                ?>
            </div>
        </div>
    </nav>

</body>

</html>