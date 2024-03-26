<?php
require_once "../../config/db.php";
if (isset ($_SESSION['login_user'])) {
    // echo "ผู้ใช้เข้าสู่ระบบแล้ว";
} else {
    // echo "ไม่มีการเข้าสู่ระบบ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <?php include '../include/navbar_main.php'; ?>

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

    <div class="container w3-animate-bottom"
        style="margin-top: 50px; width: 100%; border: 1px solid black; padding: 10px; box-shadow: 0px 0px 3px; border-radius: 30px;">
        <div class="pic" style="text-align: center; display: flex; justify-content: center;">
            <a href="monitor.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-display" style="font-size: 50px;"></i>
                <p>Monitor</p>
            </a>
            <a href="cpu.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-cpu" style="font-size: 50px;"></i>
                <p>CPU</p>
            </a>
            <a href="motherboard.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-motherboard" style="font-size: 50px;"></i>
                <p>Motherboard</p>
            </a>
            <a href="gpu.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-gpu-card" style="font-size: 50px;"></i>
                <p>GPU</p>
            </a>
            <a href="memory.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-memory" style="font-size: 50px;"></i>
                <p>Memory</p>
            </a>
            <a href="memory.php" class="icon" style="margin-right: 80px; margin-top:auto;">
                <img src="../../public/image/powersupply.png" alt="" style="width: 50px; height: 50px;">
                <p>Power Supply</p>
            </a>
            <a href="hdd.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-device-hdd" style="font-size: 50px;"></i>
                <p>HDD</p>
            </a>
            <a href="fan.php" class="icon" style="margin-right: 80px;">
                <i class="bi bi-fan" style="font-size: 50px;"></i>
                <p>Fan</p>
            </a>
            <a href="keyboard.php" class="icon">
                <i class="bi bi-keyboard" style="font-size: 50px;"></i>
                <p>Accessories</p>
            </a>
        </div>
    </div>

    <div class="container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="name-pro">
            <h3>สินค้าเข้าใหม่</h3>
        </div>
    </div>

    <div class="flex-container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
    </div>

    <div class="container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="name-pro">
            <h3>อุปกรณ์เสริม</h3>
        </div>
    </div>

    <div class="flex-container w3-animate-bottom" style=" justify-content: center; align-items: center; display: flex;">
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
        <div class="container-product">
            <a class="view-order" href="order.php" target="_blank">
            <img src="../../public/image/rtx4070.png" width="170" height="170" alt="">
            <h3>RTX 4070</h3>
            <p>ราคา ฿12,000</p>
            <a href="#" class="btn active">เพิ่มลงตะกร้า</a>
        </a>
        </div>
    </div>


</body>
<footer>
    
</footer>

</html>