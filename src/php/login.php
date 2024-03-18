<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>เข้าสู่ระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>

    <?php include '../include/navbar.php';?>

<main class="form-signin w-100 m-auto">
    <form method="post" action="login_process.php"> <!-- ระบุ action ให้ชี้ไปยังไฟล์ login_process.php -->
        <h1 class="h3 mb-3 fw-normal">โปรดลงชื่อเข้าใช้</h1>
        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">อีเมล์ผู้ใช้</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">รหัสผ่าน</label>
        </div>
        <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault" name="remember_me">
    <label class="form-check-label" for="flexCheckDefault">จดจำฉันไว้</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">ลงชื่อเข้าใช้</button>
        <p class="mt-5 mb-3 text-body-secondary">ยังไม่มีบัญชี?<a href="register.php">สมัครบัญชี</a></p>
    </form>
</main>
</body>
</html>
