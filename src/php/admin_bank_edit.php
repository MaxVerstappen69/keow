<?php
require_once "../../config/db.php";
include '../include/navbar_admin.php';

if (isset($_GET['id'])) {
  $bank_id = $_GET['id'];

  // ดึงข้อมูลของ employee จากฐานข้อมูลโดยใช้ employee_id
  $sql = "SELECT * FROM bank WHERE bank_id='$bank_id'";
  $result = $conn->query($sql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
        แก้ไขข้อมูลธนาคาร
      </div>
      <hr class="hr" />
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form method="post" action="admin_bank_edit_process.php" enctype="multipart/form-data">

          <input type="hidden" name="bank_id" value="<?php echo $row['bank_id']; ?>">

          <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" class="img-fluid rounded"
            style="width: 150px; height: 150px;" alt="Thumbnail">
          <div class="container text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="bank_id" value="<?php echo $row['bank_id']; ?>" readonly>
              <label for="text">รหัส</label>
            </div>
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="bank_name" value="<?php echo $row['bank_name']; ?>">
              <label for="text">ชื่อธนาคาร</label>
            </div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="bank_detail" value="<?php echo $row['bank_detail']; ?>">
              <label for="text">ชื่อผู้ใช้บัญชี</label>
            </div>
          </div>

          <div class="container text-center pt-5">
            <label for="image" class="form-label">เลือกรูปภาพ QrCode</label>
            <input type="file" class="form-control" id="qrcode_perma" name="qrcode_perma">
          </div>
          <div class="container pt-5">
            <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="submit" value="Submit"
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