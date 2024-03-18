<?php
  session_start();
  require_once "../../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
<body>
  <form action="../php/register_process.php" method="post">
    <?php if(isset($_SESSION['error'])){ ?>
      <div class="alert alert-danger" role="alert">
        <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>
    <?php if(isset($_SESSION['success'])){ ?>
      <div class="alert-alert-success" role="alert">
        <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        ?>
      </div>
    <?php } ?>
    <?php if(isset($_SESSION['warning'])){ ?>
      <div class="alert-alert-warning" role="alert">
        <?php
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
        ?>
      </div>
    <?php } ?>
    <div class="form-group">
      <label for="firstname">firstname</label>
      <input type="text" class="form-control" name="firstname" aria-describedby="firstname" placeholder="Enter Firstname">
    </div>
    <div class="form-group">
      <label for="lastname">lastname</label>
      <input type="text" class="form-control" name="lastname" aria-describedby="lastname" placeholder="Enter Lastname">
    </div>
    <div class="form-group">
      <label for="address">address</label>
      <input type="text" class="form-control" name="address" aria-describedby="address" placeholder="Enter Address">
    </div>
    <div class="form-group">
      <label for="phone">phone number</label>
      <input type="text" class="form-control" name="phone" aria-describedby="phone" placeholder="Enter Phone number">
    </div>
    <div class="form-group">
      <label for="email">email</label>
      <input type="text" class="form-control" name="email" aria-describedby="email" placeholder="Enter Email">
    </div>
    <div class="form-group">
      <label for="username">username</label>
      <input type="text" class="form-control" name="username" aria-describedby="username" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="confirm password">Password</label>
      <input type="password" class="form-control" name="con_password" placeholder="Confirm Password">
    </div>
    <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
  </form>
</body>
</html>