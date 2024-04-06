<?php include '../include/navbar_admin.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="container text-center border rounded-4 shadow w-50 my-5">
        <div class="row">
            <div class="col fw-bold py-3 fs-3">
                เพิ่มข้อมูลพนักงาน
            </div>
            <hr class="hr" />
        </div>

        <form method="post" action="add_employee_process.php" enctype="multipart/form-data">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <div class="container d-flex justify-content-between text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="em_firstname" required>
                    <label for="firstname">ชื่อจริง</label>
                </div>
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="em_lastname" required>
                    <label for="lastname">นามสกุล</label>
                </div>
            </div>
            <div class="container text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="email" class="form-control" name="em_email" required>
                    <label for="email">อีเมล์</label>
                </div>
            </div>
            <div class="container d-flex justify-content-between text-center pt-5">
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="password" class="form-control" name="em_password" required>
                    <label for="password">รหัสผ่าน</label>
                </div>
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="password" class="form-control" name="em_confirm_password" required>
                    <label for="confirm_password">ยืนยันรหัสผ่าน</label>
                </div>
            </div>
            <div class="container text-center pt-5">

                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="em_phone" required>
                    <label for="username">เบอร์โทรศัพท์</label>
                </div>
                <div class="card form-floating d-inline-block" style="width: 45%">
                    <input type="text" class="form-control" name="em_username" required>
                    <label for="username">ชื่อพนักงาน</label>
                </div>


            </div>
            <div class="container pt-5">
                <button class="btn w-25 py-2 fw-bold rounded-pill" type="submit" name="submit"
                    style="background-color: #EF959D; margin-bottom:30px;">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>