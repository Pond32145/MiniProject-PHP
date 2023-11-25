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
    <title>Update Students</title>
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
    <div class="new_container mt-3 border border-secondary rounded p-4" style="width: 600px;">
        <h1>Update Sideline Data</h1>

        <?php
        // ดึงข้อมูลเดิมจากฐานข้อมูล
        $id = $_POST['order']; // หรือใช้ POST ตามการส่งข้อมูล
        // $sql = "SELECT * FROM students WHERE student_id = :student_id";
        $sql = "SELECT ladies.*, groups.group_name FROM ladies
        INNER JOIN groups ON ladies.group_id = groups.group_id WHERE lady_id= :lady_id; ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':lady_id', $id);
        $stmt->execute();
        $lady = $stmt->fetch(PDO::FETCH_ASSOC);

        extract($lady); // ไม่ต้องสร้างตัวแปรมารองรับ เรียกใช้ผ่านชื่อฟิลด์ได้เลย

        $imageURL = 'upload/' . $lady_photo;
        ?>



        <form action="sideline_updateSc.php" method="post" enctype="multipart/form-data" class="row g-3">
            <h5 class="mt-2">Update data SIDELINE</h5>
            <hr style="width:35%">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                    <label for="studentID" class="form-label">Sideline ID:</label>
                    <input type="text" class="form-control" name="lady_id" value="<?php echo $lady_id; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="fname" class="form-label">Name:</label>
                    <input type="text" name="lady_name" class="form-control" value="<?php echo $lady_name; ?>">
                </div>
                <div class="col-md-6">
                    <label for="lname" class="form-label">Address:</label>
                    <input type="text" name="lady_address" class="form-control" value="<?php echo $lady_address; ?>">
                </div>
                <div class="col-md-6">
                    <label for="phone_no" class="form-label">Phone Number:</label>
                    <input type="text" name="lady_phone" class="form-control" value="<?php echo $lady_phone; ?>">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Line:</label>
                    <input type="text" name="lady_line" class="form-control" value="<?php echo $lady_line; ?>">
                </div>
                <div class="col-md-6">
                    <label for="class" class="form-label">Group:</label>
                    <select id="group_id" name="group_id" class="form-select" value="<?php echo $group_id; ?>">

                        <?php
                        // เรียกข้อมูลห้องเรียนจากฐานข้อมูล
                        $sql = "SELECT * FROM groups";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // <!--  วนลูปเพื่อแสดงตัวเลือกส้าหรับห้องเรียน -->

                        foreach ($groups as $group) {
                            $groupId = $group['group_id'];
                            $groupName = $group['group_name'];
                            // <!-- // เช็คว่าห้องเรียนที่เลือกตรงกับข้อมูลนักเรียน -->
                            $selected = ($lady['group_id'] == $groupId) ? 'selected' : '';
                            echo "<option value='$groupId' $selected>$groupName</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="col-md-12">

                    <img src="<?php echo $imageURL ?>" width="100" class="mb-2">
                    <input type="file" name="txt_file" class="form-control" value="<?php echo $lady_photo; ?>">
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
        <hr>
        <!-- <p class="text-end">
            <a href="showStudent.php">กลับหน้าหลัก</a>
        </p> -->
    </div>

</body>

</html>