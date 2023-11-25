<?php
session_start();
require_once './component/nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,200;0,400;1,400&display=swap');

    * {
      font-family: 'Prompt', sans-serif;
    }

    .new_container {
      width: 600px;
      padding: 20px 80px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #f5f5f5;

    }

    body {
      display: grid;
      justify-content: center;
      align-items: center;
      /* background-image: url('./img/bg_login.jpeg'); */
      /* background-size: cover; */
      background-color: #f5f5f5;
      height: 100vh;
    }


  </style>
</head>

<body class="bg-dark" >
<!-- <div class="bg"></div> -->
  <div class="new_container m-auto justify-content-center d-grid">
    <h3 class="mt-4 text-center">REGISTER</h3>
    <hr>
    <form action="register_db.php" method="post" class="row g-3">

      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-info" role="alert">
          <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
          ?>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['warning'])) { ?>
        <div class="alert alert-warning" role="alert">
          <?php
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
          ?>
        </div>
      <?php } ?>


      <div class="col-md-12">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email">
      </div>
      <div class="col-md-6">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname">
      </div>
      <div class="col-md-6">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname">
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" name="password">
      </div>
      <div class="col-md-6">
        <label for="comfirm_password" class="form-label">Comfirm Password</label>
        <input type="text" class="form-control" name="confirm_password">
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="register">Submit</button>
      </div>
    </form>
    <hr>
    <p class="text-center">เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="signin.php">เข้าสู่ระบบ</a></p>
  </div>
</body>

</html>