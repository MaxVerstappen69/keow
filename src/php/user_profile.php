<?php
include '../include/navbar_main.php';
$k = $_SESSION['login_user'];
$sql = "SELECT * FROM customer where email='$k'";
$result = $conn->query($sql);
$sqladmid = "SELECT * FROM employee WHERE em_email = '$k';";
$resultadmin = $conn->query($sqladmid);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>
  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
        ข้อมูลผู้ใช้
      </div>
      <hr class="hr" />
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="btn-group">
          <img src="data:image/png;base64,<?php echo base64_encode($row['thumbnail']); ?>" class="img-fluid rounded-circle"
            style="width: 100px; height: 100px;" alt="Thumbnail">
        </div>
        <div class="container d-flex justify-content-between text-center pt-5">
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>" readonly>
            <label for="firstname">ชื่อจริง</label>
          </div>
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>" readonly>
            <label for="lastname">นามสกุล</label>
          </div>
        </div>
        <div class="container text-center pt-5">
          <div class="card form-floating w-100 d-inline-block">
            <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" readonly>
            <label for="address">ที่อยู่</label>
          </div>
        </div>
        <div class="container text-center pt-5">
          <div class="card form-floating w-100 d-inline-block">
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" readonly>
            <label for="email">อีเมล์ (ไม่สามารถแก้ได้)</label>
          </div>
        </div>
        <div class="container d-flex justify-content-between text-center pt-5">
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" readonly>
            <label for="phone">เบอร์โทรศัพท์</label>
          </div>
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" readonly>
            <label for="username">ชื่อผู้ใช้งาน</label>
          </div>

        </div>
        <?php
      }
    }
    if (mysqli_num_rows($resultadmin) > 0) {
      while ($rowAdmin = mysqli_fetch_assoc($resultadmin)) {
        ?>
        <div class="btn-group">
          <img src="data:image/png;base64,<?php echo base64_encode($rowAdmin['em_thumbnail']); ?>"
            class="img-fluid rounded-circle" style="width: 100px; height: 100px;" alt="Thumbnail">
        </div>
        <div class="container d-flex justify-content-between text-center pt-5">
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="firstname" value="<?php echo $rowAdmin['em_firstname']; ?>"
              readonly>
            <label for="firstname">ชื่อจริง</label>
          </div>
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="lastname" value="<?php echo $rowAdmin['em_lastname']; ?>"
              readonly>
            <label for="lastname">นามสกุล</label>
          </div>
        </div>
        <div class="container text-center pt-5">
          <div class="card form-floating w-100 d-inline-block">
            <input type="email" class="form-control" name="email" value="<?php echo $rowAdmin['em_email']; ?>" readonly>
            <label for="email">อีเมล์ (ไม่สามารถแก้ได้)</label>
          </div>
        </div>
        <div class="container d-flex justify-content-between text-center pt-5">
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="phone" value="<?php echo $rowAdmin['em_phone']; ?>" readonly>
            <label for="phone">เบอร์โทรศัพท์</label>
          </div>
          <div class="card form-floating d-inline-block" style="width: 45%">
            <input type="text" class="form-control" name="username" value="<?php echo $rowAdmin['em_username']; ?>"
              readonly>
            <label for="username">ชื่อผู้ใช้งาน</label>
          </div>

        </div>
        <?php
      }
    } else
      // echo "0 results";
    ?>

    <div class="container pt-5">
      <a href="user_profile_edit.php"><button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="signup"
          style="background-color: #EF959D; margin-bottom: 30px;">แก้ไขข้อมูลผู้ใช้</button></a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>