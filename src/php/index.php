<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';
if (isset($_SESSION['login_user'])) {
    // echo "ผู้ใช้เข้าสู่ระบบแล้ว";
} else {
    // echo "ไม่มีการเข้าสู่ระบบ";
}
$sql = 'SELECT * FROM product';
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../../public/image/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide w3-animate-bottom" data-bs-ride="carousel" style="">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner ">
            <div class="carousel-item active">
                <img src="../../public/image/computer1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../public/image/computer2.png" class="d-block w-100 h-50" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../public/image/computer3.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container w3-animate-bottom shadow"
        style="margin-top: 50px; width: 100%; border: 1px solid black; padding: 10px; box-shadow: 0px 0px 3px; border-radius: 30px;">
        <div class="pic" style="text-align: center; display: flex; justify-content: center;">
            <a href="monitor.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-display" style="font-size: 50px;"></i>
                <p>Monitor</p>
            </a>
            <a href="cpu.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-cpu" style="font-size: 50px;"></i>
                <p>CPU</p>
            </a>
            <a href="motherboard.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-motherboard" style="font-size: 50px;"></i>
                <p>Motherboard</p>
            </a>
            <a href="gpu.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-gpu-card" style="font-size: 50px;"></i>
                <p>GPU</p>
            </a>
            <a href="memory.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-memory" style="font-size: 50px;"></i>
                <p>Memory</p>
            </a>
            <a href="powersupply.php" class="icon text-decoration-none text-dark" style="margin-right: 80px; margin-top:auto;">
                <img src="../../public/image/powersupply.png" alt="" style="width: 50px; height: 50px;">
                <p>Power Supply</p>
            </a>
            <a href="hdd.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-device-hdd" style="font-size: 50px;"></i>
                <p>HDD</p>
            </a>
            <a href="fan.php" class="icon text-decoration-none text-dark" style="margin-right: 80px;">
                <i class="bi bi-fan" style="font-size: 50px;"></i>
                <p>Fan</p>
            </a>
            <a href="Accessories.php" class="icon text-decoration-none text-dark">
                <i class="bi bi-keyboard" style="font-size: 50px;"></i>
                <p>Accessories</p>
            </a>
        </div>
    </div>

    <div class="container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="my-5 p-2 px-5 rounded-pill shadow rounded" style='background-color: #EF959D'>
            <h1>สินค้าเข้าใหม่</h1>
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