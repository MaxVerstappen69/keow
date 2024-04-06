<?php
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            
            <div class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="../php/admin_employee.php" class="nav-link" style="color: black;">พนักงาน</a></li>
        <li class="nav-item"><a href="../php/admin_order.php" class="nav-link" style="color: black;">รายการสั่งซื้อ</a></li>
        <li class="nav-item"><a href="../php/admin_product.php" class="nav-link" style="color: black;">รายการสินค้า</a></li>
        <li class="nav-item"><a href="../php/admin_employee_payment.php" class="nav-link" style="color: black;">ธุรกรรม</a></li>
      </ul>
    </div>

            <div style='display: flex; align-items: center'>
                <a href="cart_page.php" class="btn border-0" style="color: #000000;">
                    <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                </a>
                <?php
                if (isset ($_SESSION['login_user'])) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div style="display: inline-block;">
                                <div
                                    style="display: flex; align-items: center; margin-right: 10px; background-color: #EF959D; border-radius: 30px; box-shadow: 0px 0px 3px; width: 130px; height: 30px;">
                                    <h6 style="margin: 0 auto; text-align: center;">
                                        <?php echo ($row['username']); ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="btn-group">
                                <img src="data:image/png;base64,<?php echo base64_encode($row['thumbnail']); ?>"
                                    class="img-fluid rounded-circle" style="width: 40px; height: 40px;" alt="Thumbnail">
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split border-0"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="user_profile.php">โปรไฟล์</a></li>
                                    <li><a class="dropdown-item" href="user_order.php">การสั่งซื้อ</a></li>
                                    <?php
                                    if ($_SESSION['user_role'] === 'admin') {
                                        echo '<li><a class="dropdown-item" href="admin_employee.php">ผู้ดูแล</a></li>';
                                    }
                                    ?>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo '<a class="btn btn-sm fw-bold" href="login.php" role="button" style="background-color: #EF959D; border-color: #EF959D; width: 100px; border-radius: 50px;">เข้าสู่ระบบ</a>';
                }
                ?>
            </div>
        </div>
    </nav>

</body>

</html>