<?php 
require_once "connectdb.php";
require_once './component/navuh.php'; 
session_start();
if (!isset($_SESSION["user_login"])){
  header("location: signin.php");
  $_SESSION['error']= "กรุณาล็อคอินเข้าสู่ระบบ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/user_h.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-light">
  <div class="m"></div>

  <div class="title mt mb-2 box1"  style="background-color:#ddc4c4;">
    <div class="container pt-4 ">
      <h3>เว็บไซด์ไลน์ รับงาน รับจ้างเป็นแฟน ที่ใหญ่ที่สุดในโลกของพวกเรา (^///^)</h3>
      <p>ผู้รับจ้างเป็นแฟน รับงาน ในเว็บไซต์แห่งนี้อายุมากกว่า 18 ปี ตามกฎหมาย</p>
      
    </div>
  </div>
  <div class="new mt-lg-4">

    <div class="container">
 
      <h1 class="box2">ยินดีต้อนรับสู่ Fiwfans</h1>

      <div class="row align-items-center justify-content-center gap-2">
        <?php
        
        $sql = "SELECT * FROM ladies
                LEFT JOIN groups ON ladies.group_id = groups.group_id
                LEFT JOIN agency ON groups.agen_id = agency.agen_id";

        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $lady = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lady as $user) {
        ?>
          <div class="col-md-2 mx-2 box1">
            <div class="card" onclick="showImage(src)">
            <div class="card2">
              <div class="text-center ">
                <img src="upload/<?php echo  $user['lady_photo']; ?>" style="width: 150px; height: 190px; " onclick="showImage(src)" class="rounded pt-3">
                <p class="mt-1">
                  <?php echo $user['lady_name']; ?> <br>
                </p>
              </div>
             
              <div class="row con ms-1">
                <div class="contact col-lg-6">
                <i class="fa-brands fa-line fa-bounce" style="color: #80ff00;"></i>
                  <?php echo $user['lady_line']; ?>
                  
                </div>
                <div class="address col-lg-6 pe-4">
                <i class="fa-solid fa-location-dot" style="color: #ceb71c;"></i>
                  <?php echo $user['lady_address']; ?>
                </div>
              </div>

            </div>
            </div>
          </div>
        <?php } ?>



      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    //rotate and move elements with a class of "box" ("x" is a shortcut for a translateX() transform) over the course of 1 second.
    gsap.from(".box1", {
      // rotation: 180,
      // x: -1000,
      y: 1000,
      delay: .7,
    });

    gsap.from(".box2", {
      // rotation: 180,
      x: -1000,
      // y: -1000,
      delay: .7
    });
  </script>

  <script>
    function showImage(src) {
      Swal.fire({
        title: '',
        text: '',
        imageUrl: src,
        imageWidth: 500,
        //   imageHeight: 500,
        imageAlt: '',
      })
    }
  </script>
</body>
</html>
<?php require_once './component/footer.php'; ?>