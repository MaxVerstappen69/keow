<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';
if (isset($_SESSION['login_user'])) {
    // echo "ผู้ใช้เข้าสู่ระบบแล้ว";
} else {
    // echo "ไม่มีการเข้าสู่ระบบ";
}
$sql = 'SELECT * FROM `product` WHERE category_id=3';
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../../public/image/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motherboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
</head>

<body>

    <div class="container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="my-5 p-2 px-5 rounded-pill shadow rounded" style='background-color: #EF959D'>
            <h1>Motherboard</h1>
        </div>
    </div>

    <div class="container w3-animate-bottom">
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col">
                        <div class="card h-100 text-center shadow rounded" style="background-color: #B8D8BA;" >
                            <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" class="card-img-top"
                                style="height: 200px; object-fit: contain;" alt="Thumbnail">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $row['product_name']; ?>
                                </h5>
                                <p class="card-text fw-bold text-danger">฿
                                    <?php echo $row['price']; ?>
                                </p>
                                <a href="productDetail.php?id=<?php echo $row['product_id']; ?>" class="btn fw-bold" target="_blank"
                                    style='background-color: #EF959D'>View Details</a>

                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo 'no data';
            }
            ?>
        </div>
    </div>







</body>
<footer>

</footer>

</html>