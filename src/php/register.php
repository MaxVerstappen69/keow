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
            <div class="row text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                    <input type="username" name="username" class="form-control rounded-pill" id="floatingInput"
                        placeholder="username">
                    <label for="floatingInput">ชื่อจริง</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                    <input type="username" name="username" class="form-control rounded-pill" id="floatingInput"
                        placeholder="username">
                    <label style="" for="floatingPInput">นามสกุล</label>
                </div>
            </div>
            <div class="container text-center pt-5">
                <div class="column form-floating w-100 d-inline-block">
                    <input type="address" name="address" class="form-control rounded-pill" id="floatingInput"
                        placeholder="address">
                    <label for="floatingInput">ที่อยู่</label>
                </div>
                </div>
                <div class="row text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                    <input type="phone" name="phone" class="form-control rounded-pill" id="floatingInput"
                        placeholder="phone">
                    <label for="floatingInput">เบอร์โทร</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                    <input type="email" name="email" class="form-control rounded-pill" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">อีเมล์</label>
                </div>
            </div>
            <div class="row text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                    <input type="password" name="password" class="form-control rounded-pill" id="floatingpassword"
                        placeholder="password">
                    <label for="floatingpassword">รหัสผ่าน</label>
                </div>
                <div class="column form-floating w-50 d-inline-block">
                    <input type="password" name="password" class="form-control rounded-pill" id="floatingpassword"
                        placeholder="password">
                    <label for="floatingpassword">ยืนยันรหัสผ่าน</label>
                </div>
            </div>
            <div class="container text-center pt-5">
                <div class="column form-floating w-50 d-inline-block">
                    <input type="username" name="username" class="form-control rounded-pill" id="floatingInput"
                        placeholder="username">
                    <label for="floatingInput">ชื่อผู้ใช้งาน</label>
                </div>
                </div>


            <div class="container text-center w-50">
                <div class="form-check text-start my-3 ">
                    

                </div>
            </div>
            <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit"
                style="background-color: #EF959D">ลงทะเบียน</button>
            <p class="mt-5 mb-5 text-body-secondary">มีบัญชีแล้ว?<a href="register.php">ลงชื่อเข้าใช้</a></p>
        </div>
  </form>
</body>
</html>