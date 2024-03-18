<?php
  session_start();
  require_once "../../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
  <link rel="stylesheet" href="style.css">
  <body>
    
  <form action="../php/register_process.php" method="post">
    <?php if(isset($_SESSION['error'])){ ?>
      <div class="alert alert-danger" role="alert">
        <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>
    <?php if(isset($_SESSION['success'])){ ?>
      <div class="alert-alert-success" role="alert">
        <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        ?>
      </div>
    <?php } ?>
    <?php if(isset($_SESSION['warning'])){ ?>
      <div class="alert-alert-warning" role="alert">
        <?php
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
        ?>
      </div>
    <?php } ?>

    <?php include '../include/navbar_login.php'; ?>
    <div class="container text-center border rounded-4 shadow w-50 my-5">
            <div class="row">
                <div class="col fw-bold py-3 fs-3">
                สมัครบัญชีใช้งาน
                </div>
                <hr class="hr" />
            </div>
            <div class="row text-center pt-4">
                <div class="column form-floating w-50 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="firstname" aria-describedby="firstname" placeholder="Enter Firstname">
                    <label for="firstname">ชื่อจริง</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="lastname" aria-describedby="lastname" placeholder="Enter Lastname">
                    <label for="lastname">นามสกุล</label>
                </div>
            </div>
            <div class="container text-center pt-5">
                <div class="column form-floating w-100 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="address" aria-describedby="address" placeholder="Enter Address">
                    <label for="address">ที่อยู่</label>
                </div>
                </div>
                <div class="row text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="phone" aria-describedby="phone" placeholder="Enter Phone number">
                    <label for="phone">เบอร์โทร</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="email" aria-describedby="email" placeholder="Enter Email">
                    <label for="email">อีเมล์</label>
                </div>
            </div>
            <div class="row text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                <input type="text" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="username" aria-describedby="username" placeholder="Enter username">
                    <label for="username">ชื่อผู้ใช้งาน</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                <input type="password" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="password" placeholder="Password">
                    <label for="password">รหัสผ่าน</label>
                </div>
            </div>
            <div class="container text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                <input type="password" class="form-control rounded-pill" style="background-color: rgba(217, 217, 217, 0.44)" name="con_password" placeholder="Confirm Password">
                    <label  for="confirm password">ยืนยันรหัสผ่าน</label>
                </div>
                </div>

                <div class="container pt-4">
             <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="signup"
                style="background-color: #EF959D">ลงทะเบียน</button>
            <p class="mt-5 mb-5 text-body-secondary">มีบัญชีแล้ว?<a href="login.php">ลงชื่อเข้าใช้</a></p>       
                </div>
            </div>
  </form>
</body>
</html>