<?php

session_start();
require_once "connectdb.php";
require_once "./component/nav02.php";
if (!isset($_SESSION["admin_login"])) {
    header("location: signin.php");
    // $_SESSION['error']= "oiejrgogop";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-dark">



    <?php

    if (isset($_SESSION['admin_login'])) {
        $user_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM users WHERE user_id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <!-- <h1 class="mt-4">Welcome, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h1> -->

    <div class="container new">


        <div class="box1">


            <a href="user_show.php">

                <div class="card">
                    <div class="card2 pt-5">
                        <div class="mt-2">
                            <i class="fa-solid fa-users fa-beat-fade fa-2xl" style="color: #bad534;"></i>
                        </div>
                        <div class="mt-3">

                            <p>SHOW INFORMATION OF USERS</p>
                        </div>


                    </div>
                </div>

            </a>





            <a href="contact.php">
                <div class="card">
                    <div class="card2 pt-5">
                        <div class="mt-2">
                            <i class="fa-brands fa-dev fa-shake fa-2xl" style="color: #1c526d;"></i>
                        </div>
                        <div class="mt-3 text-light">

                            <p>CONTACT <br> DEVELOPER</p>
                        </div>


                    </div>
                </div>


            </a>




        </div>




        <div class="box2">


            <a href="sideline_show.php">

                <div class="card">
                    <div class="card2 pt-5">
                        <div class="mt-2">
                            <i class="fa-solid fa-users fa-beat-fade fa-2xl" style="color: #ff0000;"></i>
                        </div>
                        <div class="mt-3 text-danger">

                            <p>SHOW INFORMATION OF SIDELINE</p>
                        </div>


                    </div>
                </div>

            </a>





            <a href="sideline_Insert.php">

                <div class="card">
                    <div class="card2 pt-5">
                        <div class="mt-2">
                            <i class="fa-solid fa-user-plus fa-beat-fade fa-2xl" style="color: #005eff;"></i>
                        </div>
                        <div class="mt-3 text-info">

                            <p>ADD INFORMATION OF SIDELINE</p>
                        </div>


                    </div>
                </div>

            </a>



        </div>





    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //rotate and move elements with a class of "box" ("x" is a shortcut for a translateX() transform) over the course of 1 second.
        gsap.from(".box1", {
            // rotation: 180,
            x: -1000,
            // y: 1000,
            delay: .7,
        });

        gsap.from(".box2", {
            // rotation: 180,
            x: 1000,
            // y: -1000,
            delay: .7
        });
    </script>
</body>

</html>