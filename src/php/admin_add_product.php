<?php
require_once "../../config/db.php";
include '../include/navbar_admin.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

  <div class="container text-center border rounded-4 shadow w-50 my-5">
    <div class="row">
      <div class="col fw-bold py-3 fs-3">
        เพิ่มสินค้า
      </div>
      <hr class="hr" />
    </div>

    <?php
        ?>
        <form method="post" action="admin_add_product_process.php" enctype="multipart/form-data">
        <?php
          if (isset ($_SESSION['error'])) {
            echo '<script src="../js/erorr_admin_add_product.js"></script>';
            unset($_SESSION['error']);
          }
          ?>
          <?php
          if (isset ($_SESSION['error1'])) {
            echo '<script src="../js/erorr1_admin_add_product.js"></script>';
            unset($_SESSION['error1']);
          }
          ?>
          <?php
          if (isset ($_SESSION['success1'])) {
            echo '<script src="../js/success_admin_add_product.js"></script>';
            unset($_SESSION['success1']);
          }
          ?>
          <div class="container text-center pt-5">
            <div class="card form-floating w-50 d-inline-block">
              <input type="text" class="form-control" name="employee_id">
              <label for="employee_id">รหัสพนักงาน</label>
            </div>
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
            <div class="card form-floating d-inline-block" style="width: 45%">
    <select class="form-select" name="category_id">
        <option value="1">Monitor</option>
        <option value="2">CPU</option>
        <option value="3">Mainboard</option>
        <option value="4">Graphic card</option>
        <option value="5">RAM</option>
        <option value="6">Power Supply</option>
        <option value="7">HDD&SSD</option>
        <option value="8">Cooling Fan</option>
        <option value="9">Accessories</option>
    </select>
    <label for="category_id">ประเภทสินค้า</label>
</div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="product_name">
              <label for="product_name">ชื่อสินค้า</label>
            </div>
          </div>
          <div class="container text-center pt-5">
            <div class="card form-floating w-100 d-inline-block">
              <input type="text" class="form-control" name="detail">
              <label for="detail">รายละเอียดสินค้า</label>
            </div>
          </div>
          <div class="container d-flex justify-content-between text-center pt-5">
          <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="price">
              <label for="price">ราคาสินค้า</label>
            </div>
            <div class="card form-floating d-inline-block" style="width: 45%">
              <input type="text" class="form-control" name="quantity">
              <label for="quantity">จำนวนสินค้า</label>
            </div>
            </div>
          <div class="container text-center pt-5">
            <label for="image" class="form-label">เลือกรูปภาพสินค้า</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="container pt-5">
            <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="submit"
              style="background-color: #EF959D; margin-bottom:30px;">ยืนยัน</button>
          </div>
        </form>
        <?php
    ?>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>