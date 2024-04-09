<?php include 'include/navbar_admin.php';
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // หากไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้าแสดงข้อความการเข้าถึงไม่ได้
    exit;
}
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php"); // หากไม่ได้เข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปยังหน้าล็อกอิน
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Employee List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here if needed */
        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<script src="js/erorr_admin_edit.js"></script>';
        unset($_SESSION['error']);
    }
    ?>
    <?php
    if (isset($_SESSION['success'])) {
        echo '<script src="js/sucess_admin_edit.js"></script>';
        unset($_SESSION['success']);
    }
    ?>
    <?php
    if (isset($_SESSION['currentPassword'])) {
        echo '<script src="js/currentpass_admin_edit.js"></script>';
        unset($_SESSION['currentPassword']);
    }
    ?>
    <?php
    if (isset($_SESSION['success1'])) {
        echo '<script src="js/suscess_add_employee.js"></script>';
        unset($_SESSION['success1']);
    }
    ?>
    <?php
    if (isset($_SESSION['success2'])) {
        echo '<script src="js/success_delete_employee.js"></script>';
        unset($_SESSION['success2']);
    }
    ?>




    <div class="container mt-5">
        <h2 class="mb-4 text-center">รายชื่อพนักงาน</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="add_employee.php">
                <button type="button" class="btn btn-primary shadow-sm">เพิ่มข้อมูล</button>
            </a>
        </div>
        <div class="table-responsive">
            <hr>
            <?php
            require_once "db.php";


            // Check if the user is logged in
            $id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : null;

            // Fetching employee data from the database
            $sql = "SELECT * FROM employee";
            $result = $conn->query($sql);

            // Check if there are any employees
            if ($result->num_rows > 0) {
                echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>รหัสพนักงาน</th>
                            <th>ตำแหน่ง</th>
                            <th>ชื่อจริง  </th>
                            <th>นามสกุล</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>อีเมล์</th>
                            <th>เมนู</th>
                        </tr>
                    </thead>
                    <tbody>";

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["employee_id"] . "</td>
                        <td>" . $row["user_role"] . "</td>
                        <td>" . $row["em_firstname"] . "</td>
                        <td>" . $row["em_lastname"] . "</td>
                        <td>" . $row["em_username"] . "</td>
                        <td>" . $row["em_email"] . "</td>

                        <td>
    <a href='admin_profile_edit.php?id=" . $row["employee_id"] . "' class='btn btn-primary btn-sm'>แก้ไข</a>
    <a href='delete_employee_process.php?delete_id=" . $row["employee_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณจะลบพนักงานคนนี้จริงหรือ?\")'>ลบ</a>
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