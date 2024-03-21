<?php
session_start();
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <?php include '../include/navbar_main.php'; ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../public/image/computer.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../public/image/computer.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../public/image/computer.png" class="d-block w-100" alt="...">
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

    <div class="container" style="margin-top: 50px; width: 70%; border: 1px solid black; padding: 30px;">
        <div class="pic" style="text-align: center;">
        <div class="icon">
            <i class="bi bi-display" style="font-size: 50px;" ></i>
        </div>
        <p>Monitor</p>
            <i class="bi bi-cpu" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-motherboard" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-gpu-card" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-memory" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-memory" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-device-hdd" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-fan" style="font-size: 50px; margin-left: 80px;"></i>
            <i class="bi bi-keyboard" style="font-size: 50px; margin-left: 80px;"></i>
        </div>
    </div>


</body>

</html>