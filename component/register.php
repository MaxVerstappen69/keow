<?php
  require_once "../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopppppp</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"crossorigin="anonymous"/>
    <link rel="stylesheet" href="/style/style.css">
  
  
    </head>
  <body>
    <header class="p-3 text-bg-dark">
        <div class="container">
            
            <div class="text-end">
                <img class="logo" src="./image/_8bf53b61-d83a-44b5-bf8a-3d1712173abb-removebg-preview.png" alt="">
              <button type="button" class="btn btn-outline-light me-2"><a href="login.html">ลงชื่อเข้าใช้</a></button>
              <button type="button" class="btn btn-warning"><a href="register.html">สมัครบัญชี</a></button>
            </div>
          </div>
        </div>
      </header>

      <main class="form-signin w-100 m-auto">
        <form>
          
          <h1 class="h3 mb-4 fw-normal">โปรดลงชื่อเข้าใช้</h1>
      
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">อีเมล์</label>
          </div>

          <div class="form-floating">
            <input type="user" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">ชื่อบัญชีผู้ใช้</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">รหัสผ่าน</label>
          </div>

         <div class="form-floating">
            <input type="confirmpassword" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">ยินยันรหัสผ่าน</label>
          </div>

          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">ลงทะเบียน</button>
          <p class="mt-5 mb-3 text-body-secondary">ยังไม่มีบัญชี?<a href="login.html">สมัครบัญชี</a></p>
        </form>
      </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
