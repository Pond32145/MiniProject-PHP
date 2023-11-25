<?php
session_start();
require_once './component/nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,200;0,400;1,400&display=swap');

    * {
      font-family: 'Prompt', sans-serif;
    }

    .new_container {
      width: 600px;
      padding: 20px;
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
      /* background-color: #f5f5f5; */
      height: 100vh;
    }
  </style>
</head>

<body class="bg-dark">

  <div class="new_container m-auto justify-content-center d-grid">
    <h3 class="mt-4 text-center">LOGIN</h3>
    <hr>

    <?php if (isset($_SESSION['error'])) { ?>
      <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>

    <form action="signin_db.php" method="post">
      <div class="mb-3">
        <label for="student id" class="form-label">Email</label>
        <input type="text" class="form-control" name="email">
      </div>
      <div class="mb-3">
        <label for="first name" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="signin">Submit</button>
      </div>
    </form>




    <hr>
    <p class="text-start">ยังไม่ได้เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="register.php">ลงทะเบียน</a></p>
  </div>
</body>

</html>