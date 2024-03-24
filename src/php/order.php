<?php
include '../include/navbar_main.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>

  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
        รายการสั่งซื้อ
      </div>
      <hr class="hr" />
    </div>
    <div class="container d-flex justify-content-between text-center pt-5">
      <div class="form-floating d-inline-block" style="width: 45%">
        <input type="text" class="form-control rounded-pill" name=" firstname" aria-describedby="firstname"
          placeholder="Enter Firstname">
        <label for="firstname">ชื่อจริง</label>
      </div>
      <div class="form-floating d-inline-block" style="width: 45%">
        <input type="text" class="form-control rounded-pill" name=" lastname" aria-describedby="lastname"
          placeholder="Enter Lastname">
        <label for="lastname">นามสกุล</label>
      </div>
    </div>
    <div class="container text-center pt-5">
      <div class=" form-floating w-100 d-inline-block">
        <input type="text" class="form-control rounded-pill" name=" address" aria-describedby="address"
          placeholder="Enter Address">
        <label for="address">ที่อยู่</label>
      </div>
    </div>
    <div class="container text-center pt-5">
      <div class=" form-floating w-100 d-inline-block">
        <input type="text" class="form-control rounded-pill" name=" email" aria-describedby="address"
          placeholder="Enter Address">
        <label for="email">อีเมล์</label>
      </div>
    </div>
    <div class="container d-flex justify-content-between text-center pt-5">
      <div class="form-floating d-inline-block" style="width: 45%">
        <input type="text" class="form-control rounded-pill" name="phone" aria-describedby="phone"
          placeholder="Enter Phone number">
        <label for="phone">เบอร์โทร</label>
      </div>
      <div class="form-floating d-inline-block" style="width: 45%">
        <input type="text" class="form-control rounded-pill" name="username" placeholder="Password">
        <label for="username">ชื่อผู้ใช้งาน</label>
      </div>
    </div>


    <div class="container pt-5">
      <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="signup"
        style="background-color: #EF959D">แก้ไข</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>