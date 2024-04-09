<?php
session_start();
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

</head>

<style>
  .form-control {
    border: 1px solid #ced4da;
    /* Example border color */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    /* Example box-shadow */
  }
</style>

<body>

  <?php include 'include/navbar_login.php'; ?>

  <form action="register_process.php" method="post">
    <?php if (isset ($_SESSION['error'])) { ?>
      <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>
    <?php
    if (isset ($_SESSION['success'])) {
      echo '<script src="js/sweetalert_successLogin.js"></script>';
      unset($_SESSION['success']);
    }
    ?>
    <?php if (isset ($_SESSION['warning'])) { ?>
      <div class="alert-alert-warning" role="alert">
        <?php
        echo $_SESSION['warning'];
        unset($_SESSION['warning']);
        ?>
      </div>
    <?php } ?>

    <div class="container text-center border rounded-4 shadow w-50 my-5">
      <div class="row">
        <div class="col fw-bold py-3 fs-3">
          สมัครบัญชีใช้งาน
        </div>
        <hr class="hr"/>
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
      <div class="container d-flex justify-content-between text-center pt-5">
        <div class="form-floating d-inline-block" style="width: 45%">
          <input type="password" class="form-control rounded-pill" name="password" aria-describedby="username"
            placeholder="Enter username">
          <label for="password">รหัสผ่าน</label>
        </div>
        <div class="form-floating d-inline-block" style="width: 45%">
          <input type="password" class="form-control rounded-pill" name="con_password" placeholder="Password">
          <label for="con_password">ยืนยันรหัสผ่าน</label>
        </div>
      </div>

      <div class="container pt-5">
        <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="signup"
          style="background-color: #EF959D">ลงทะเบียน</button>
        <p class="mt-5 mb-5 text-body-secondary">มีบัญชีแล้ว?<a href="login.php">ลงชื่อเข้าใช้</a></p>
      </div>
    </div>
  </form>

</body>

</html>