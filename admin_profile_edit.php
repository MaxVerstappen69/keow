<?php
require_once "db.php";
include 'include/navbar_admin.php';
if ($_SESSION['user_role'] !== 'admin') {
  header("Location: index.php"); // หากไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้าแสดงข้อความการเข้าถึงไม่ได้
  exit;
}

if(isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // ดึงข้อมูลของ employee จากฐานข้อมูลโดยใช้ employee_id
    $sql = "SELECT * FROM employee WHERE employee_id='$employee_id'";
    $result = $conn->query($sql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
        แก้ไขข้อมูลพนักงาน
      </div>
      <hr class="hr" />
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form method="post" action="admin_profile_edit_process.php" enctype="multipart/form-data">
         
          <div class="btn-group">
            <img src="data:image/png;base64,<?php echo base64_encode($row['em_thumbnail']); ?>"
              class="img-fluid rounded-circle" style="width: 100px; height: 100px;" alt="Thumbnail">
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="em_firstname" value="<?php echo $row['em_firstname']; ?>">
              <label for="firstname">ชื่อจริง</label>
            </div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="em_lastname" value="<?php echo $row['em_lastname']; ?>">
              <label for="lastname">นามสกุล</label>
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="email" class="form-control" name="em_email" value="<?php echo $row['em_email']; ?>" readonly>
              <label for="email">อีเมล์ (ไม่สามารถแก้ได้)</label>
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="em_username" value="<?php echo $row['em_username']; ?>">
              <label for="username">ชื่อพนักงาน</label>
            </div>
          
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="password" class="form-control" name="em_new_password" placeholder="New Password">
              <label for="new_password">รหัสผ่าน</label>
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="password" class="form-control" name="em_confirm_password" placeholder="Confirm Password">
              <label for="confirm_password">ยืนยันรหัสผ่าน</label>
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
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

