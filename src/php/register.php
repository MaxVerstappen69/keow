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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
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