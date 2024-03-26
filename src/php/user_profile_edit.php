<?php
require_once "../../config/db.php";
include '../include/navbar_main.php';

$k = $_SESSION['login_user'];
$sql = "SELECT * FROM customer WHERE email='$k'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
       แก้ไขข้อมูลผู้ใช้
      </div>
      <hr class="hr" />
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form method="post" action="user_profile_edit_process.php" enctype="multipart/form-data"> <!-- Add enctype attribute for file upload -->
          <div class="btn-group">
            <img src="data:image/png;base64,<?php echo base64_encode($row['thumbnail']); ?>" class="img-fluid rounded-circle"
              style="width: 100px; height: 100px;" alt="Thumbnail">
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>">
            </div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>">
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>">
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" readonly>
            </div>
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
            </div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
            </div>
          </div>
          <div class="container text-center pt-5">
            <label for="profile_picture" class="form-label">เลือกรูปภาพโปรไฟล์ใหม่</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
          </div>
          <div class="container pt-5">
            <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="submit"
              style="background-color: #EF959D; margin-bottom:30px;">ยืนยัน</button>
          </div>
        </form>
        <?php
      }
    } else {
      echo "0 results";
    }
    ?>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>
