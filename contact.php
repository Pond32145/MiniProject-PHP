<?php
session_start();
require_once "./component/nav02.php";
if (!isset($_SESSION["admin_login"])){
  header("location: signin.php");
  $_SESSION['error']= "กรุณาล็อคอินเข้าสู่ระบบ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./css/contact.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body class="bg-dark">
    <div class="m"></div>
    <div class="row  cen">

        <div class="col-lg-4 cen">
            <div class="card1 ">
                <div class="cen pt-5 ">
                    <img src="./img/pond.jpg" alt="" class="rounded-circle w-50 bor">
                </div>

                <p class="heading text-center text-primary">
                    นายณภัทร ลอนุ
                </p>
                <p class="text-danger text-center">644230009</p>
                <div class="icon cen gap-3 mb-3">
                    <a href="https://www.facebook.com/pondnap31" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook fa-spin fa-xl " style="color: #315eaa;"></i>
                    </a>

                    <a href="https://www.instagram.com/pond_np31" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram fa-spin fa-xl" style="color: #ec4b4b;"></i>
                    </a>

                    <a href="https://github.com/Pond32145" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-github fa-spin fa-xl text-white" style="color: #000000;"></i>
                    </a>
                    <a href="https://www.tiktok.com/@pond_np31" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-tiktok fa-spin fa-xl" style="color: #ffffff;"></i>
                    </a>


                </div>
            </div>
        </div>
        <div class="col-lg-4 cen">
            <div class="card1 ">
                <div class="cen pt-5 ">
                    <img src="./img/kaow.jpg" alt="" class="rounded-circle w-50 bor">
                </div>

                <p class="heading text-center text-primary">
                    นายธนธรณ์ <br> เหนี่ยวองอาจ
                </p>
                <p class="text-danger text-center">644230013</p>
                <div class="icon cen gap-3 mb-3">
                    <a href="https://www.facebook.com/profile.php?id=100004870237229" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook fa-spin fa-xl " style="color: #315eaa;"></i>
                    </a>

                    <a href="https://www.instagram.com/kaow_tnt/" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram fa-spin fa-xl" style="color: #ec4b4b;"></i>
                    </a>

                    <!-- <a href="" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-github fa-spin fa-xl text-white" style="color: #000000;"></i>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php require_once './component/footerad.php'; ?>