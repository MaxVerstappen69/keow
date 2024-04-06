

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    
    
<?php include '../include/navbar_admin.php'; ?>

         
          <?php
          if (isset ($_SESSION['success6'])) {
            echo '<script src="../js/success_edit_bank.js"></script>';
            unset($_SESSION['success6']);
          }
          ?>

<?php
          if (isset ($_SESSION['success3'])) {
            echo '<script src="../js/success_delete_bank.js"></script>';
            unset($_SESSION['success3']);
          }
          ?>

          

          
          
<div class="container mt-5">
    <h2 class="mb-4 text-center">เพิ่มข้อมูลธุรกรรม</h2>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="add_bank.php">
    <button type="button" class="btn btn-primary shadow-sm">เพิ่มข้อมูล</button>
</a>
    </div>
    <div class="table-responsive">
        <hr>
        <?php
        require_once "../../config/db.php";
        

        // Check if the user is logged in
        $id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

        // Fetching employee data from the database
        $sql = "SELECT * FROM bank";
        $result = $conn->query($sql);

        // Check if there are any employees
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อธนาคาร</th>
                            <th>ชื่อผู้ใช้บัญชี</th>
                            <th>รูปธนาคาร</th>
                            <th>QrCode</th>
                            <th>เมนู</th>
                        </tr>
                    </thead>
                    <tbody>";
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["bank_id"] . "</td>
                        <td>" . $row["bank_name"] . "</td>
                        <td>" . $row["bank_detail"] . "</td>
                        <td><img src='data:image/png;base64," . base64_encode($row['image']) . "' alt='Thumbnail' style='width: 100px;'></td>
                        <td><img src='data:image/png;base64," . base64_encode($row['qrcode_perma']) . "' alt='Thumbnail' style='width: 100px;'></td>

                        <td>
                            <a href='admin_bank_edit.php?id=" . $row["bank_id"] . "' class='btn btn-primary btn-sm'>แก้ไข</a>
                            <a href='delete_bank_process.php?delete_id=" . $row["bank_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณจะลบจริงหรือ?\")'>ลบ</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
            } else {
                echo "<p class='text-muted'>No employees found.</p>";
            }
            $conn->close();
            ?>
    </div>
</div>

<!-- Bootstrap JS (optional if you need it) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
