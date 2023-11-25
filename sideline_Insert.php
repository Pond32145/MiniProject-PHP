<?php
session_start();
require_once "connectdb.php";
require_once "./component/nav02.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,200;0,400;1,400&display=swap');

        * {
            font-family: 'Prompt', sans-serif;
        }

        .m {
            margin-top: 75px;
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
            background-color: #333;
            /* height: 100vh; */
        }
    </style>
</head>

<body>
    <div class="m"></div>
    <div class="new_container mt-5 border border-secondary rounded p-4" style="width: 600px;">
        <h1>Add Information of Sideline</h1>
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['error'])) {
        ?>
            <div class="alert alert-warning" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php
        }
        ?>

        <form action="sideline_InsertSc.php" method="post" enctype="multipart/form-data" class="row g-3">
            <h5 class="mt-2">Add data SIDELINE</h5>
            <hr style="width:35%">
            <div class="row">
                <div class="col-md-6">
                    <label for="studentID" class="form-label">Sideline ID:</label>
                    <input type="text" class="form-control" name="lady_id">
                </div>
                <div class="col-md-6">
                    <label for="fname" class="form-label">Name:</label>
                    <input type="text" name="lady_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="lname" class="form-label">Address:</label>
                    <input type="text" name="lady_address" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="phone_no" class="form-label">Phone Number:</label>
                    <input type="text" name="lady_phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Line:</label>
                    <input type="text" name="lady_line" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="class" class="form-label">Group:</label>
                    <select id="group_id" name="group_id" class="form-select">

                        <?php
                        $sql = "SELECT * FROM `groups`";
                        // $sql = "SELECT group_id, group_name FROM `group`";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($groups as $group) :
                        ?>
                            <option value="<?php echo $group['group_id'] ?>"><?php echo $group['group_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="phone_no" class="form-label">Student Photo:</label>
                    <!-- <input type="file" name="file" class="form-control" accept="image/*"> -->
                    <input type="file" name="photo_file" class="form-control streched-link" accept="image/gif, image/jpeg,image/png">
                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="button" value="Back to home" class="btn btn-danger w-100" onclick="window.location.href ='admin_home.php'">
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" name="submit" value="CONFIRM" class="btn btn-primary w-100">
                        </div>
                    </div>


                </div>
                <!-- <button type="submit" name="submit" class="btn btn-primary container">บันทึก</button> -->
            </div>
        </form>

        <p class="text-end">
            <!-- <a href="index.php">กลับหน้าหลัก</a> -->
        </p>
    </div>

</body>

</html>