<?php
  require_once "../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"crossorigin="anonymous"/>
    <link rel="stylesheet" href="/style/style.css">
  
  
    </head>
  <body>
    <header class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="#" class="nav-link px-2 text-secondary">บ้านกูนิไอสัส</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
              <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
              <li><a href="#" class="nav-link px-2 text-white">เกี่ยวกับเรา</a></li>
            </ul>
    
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
            </form>
    
            <div class="text-end">
              <button type="button" class="btn btn-outline-light me-2"><a href="login.html">ลงชื่อเข้าใช้</a></button>
              <button type="button" class="btn btn-warning"><a href="register.html">สมัครบัญชี</a></button>
            </div>
          </div>
        </div>
      </header>

      <main class="form-signin w-100 m-auto">
        <form>
          
          <h1 class="h3 mb-3 fw-normal">โปรดลงชื่อเข้าใช้</h1>
      
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">ชื่อบัญชีผู้ใช้</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">รหัสผ่าน</label>
          </div>
      
          <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              จดจำฉันไว้
            </label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">ลงชื่อเข้าใช้</button>
          <p class="mt-5 mb-3 text-body-secondary">ยังไม่มีบัญชี?<a href="register.html">สมัครบัญชี</a></p>
        </form>
      </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
