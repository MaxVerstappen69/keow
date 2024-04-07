<?php
require_once "../../config/db.php";
include '../include/navbar_admin.php';
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // หากไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้าแสดงข้อความการเข้าถึงไม่ได้
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ดึงข้อมูลของสินค้าจากฐานข้อมูลโดยใช้ product_id
    $sql = "SELECT * FROM product WHERE product_id='$product_id'";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="container text-center border rounded-4 shadow w-50 my-5">
        <div class="row">
            <div class="col fw-bold py-3 fs-3">
                แก้ไขข้อมูลสินค้า
            </div>
            <hr class="hr" />
        </div>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
        <form method="post" action="admin_edit_product_process.php" enctype="multipart/form-data">

            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

            <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>"
                class="img-fluid rounded" style="width: 150px; height: 150px;" alt="Thumbnail">
            <div class="container text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="employee_id"
                        value="<?php echo $row['employee_id']; ?>">
                    <label for="text">รหัสพนักงาน</label>
                </div>
            </div>
            <div class="container d-flex justify-content-between text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <select class="form-select" name="category_id">
                        <option value="1" <?php if ($row['category_id'] == 1) echo 'selected'; ?>>Monitor</option>
                        <option value="2" <?php if ($row['category_id'] == 2) echo 'selected'; ?>>CPU</option>
                        <option value="3" <?php if ($row['category_id'] == 3) echo 'selected'; ?>>Mainboard</option>
                        <option value="4" <?php if ($row['category_id'] == 4) echo 'selected'; ?>>Graphic card</option>
                        <option value="5" <?php if ($row['category_id'] == 5) echo 'selected'; ?>>RAM</option>
                        <option value="6" <?php if ($row['category_id'] == 6) echo 'selected'; ?>>Power Supply</option>
                        <option value="7" <?php if ($row['category_id'] == 7) echo 'selected'; ?>>HDD&SSD</option>
                        <option value="8" <?php if ($row['category_id'] == 8) echo 'selected'; ?>>Cooling Fan</option>
                        <option value="9" <?php if ($row['category_id'] == 9) echo 'selected'; ?>>Accessories</option>
                    </select>
                    <label for="text">ประเภทสินค้า</label>
                </div>
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="product_name"
                        value="<?php echo $row['product_name']; ?>">
                    <label for="text">ชื่อสินค้า</label>
                </div>
            </div>

            <div class="container text-center pt-5">
                <div class="card form-floating w-100 d-inline-block">
                    <input type="text" class="form-control" name="detail"
                        value="<?php echo $row['detail']; ?>">
                    <label for="text">รายละเอียดสินค้า</label>
                </div>
            </div>

            <div class="container d-flex justify-content-between text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="price"
                        value="<?php echo $row['price']; ?>">
                    <label for="text">ราคาสินค้า</label>
                </div>
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="quantity"
                        value="<?php echo $row['quantity']; ?>">
                    <label for="text">จำนวนสินค้า</label>
                </div>
            </div>

            <div class="container text-center pt-5">
                <label for="image" class="form-label">เลือกรูปภาพสินค้าใหม่</label>
                <input type="file" class="form-control" id="image" name="image">
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
