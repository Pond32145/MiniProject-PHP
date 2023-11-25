<?php

session_start();
require_once "connectdb.php";
require_once "./component/nav02.php";

// require_once 'conn_db.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show User Data Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,200;0,400;1,400&display=swap');

        * {
            font-family: 'Prompt', sans-serif;
        }

        .m {
            margin-top: 75px;
        }
    </style>

</head>

<body>
    <div class="m"></div>
    <div class="container mt-3">
        <div class="text-center btn-info rounded text-light">
            <h1>Show information of Users</h1>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="admin_home.php" class="btn btn-warning">กลับหน้าหลัก</a>

        </div>

        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="insertStudent.php" class="btn btn-primary">เพิ่มข้อมูล</a>
        </div> -->
        <!-- <hr> -->
        <table id="stdTable" class="table">
            <thead>
                <tr>
                    <th class="text-center">Email</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>

                    <!-- <th  class="text-center">Password</th> -->
                    <th class="text-center">Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $stmt = $conn->query("SELECT * FROM users");
                // $sql = "SELECT * FROM users";



                // $stmt = $conn->prepare($sql);

                // $stmt->execute();
                $student = $stmt->fetchAll();
                foreach ($student as $user) {
                ?>
                    <tr>

                        <!-- <td><?php echo $user['user_id']; ?></td> -->
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
                        <!-- <td><?php echo $user['password']; ?></td> -->
                        <td class="text-center"><?php echo $user['urole']; ?></td>


                        <td class="text-center">
                            <!-- <form action="ex13_updateForm.php" method="post" style="display: inline;">
                                <input type="hidden" name="order" value="<?php echo $user['user_id']; ?>">
                                <input type="submit" name="edit" value="แก้ไข" class="btn btn-warning btn-sm">
                            </form> -->
                            <form action="user_delete.php" method="post" style="display: inline;">
                                <button type="button" class="button_D btn btn-danger btn-sm" data-student-id=<?php echo $user['user_id']; ?> ">ลบ</button>
                            </form>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>


    <script src=" http://code.jquery.com/jquery-3.7.0.min.js"></script>
                                    <script src="http://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


                                    <script>
                                        $(document).ready(function() { // ใช้งาน datatable เมื่อเว็บโหลดเสร็จ
                                            let table = new DataTable('#stdTable'); // เลือกตารางข้อมูล และเปิดใช้งาน datatable

                                        });
                                    </script>


                                    <script>
                                        // ฟังก์ชันสำหรับแสดงกล่องยืนยัน SweetAlert2
                                        function showDeleteConfirmation(studentId) {
                                            Swal.fire({
                                                title: 'คุณแน่ใจหรือไม่?',
                                                text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'ลบ',
                                                cancelButtonText: 'ยกเลิก',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // หากผู้ใช้ยืนยัน ให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
                                                    const form = document.createElement('form');
                                                    form.method = 'POST';
                                                    form.action = 'user_delete.php';
                                                    const input = document.createElement('input');
                                                    input.type = 'hidden';
                                                    input.name = 'user_id';
                                                    input.value = studentId;
                                                    form.appendChild(input);
                                                    document.body.appendChild(form);
                                                    form.submit();
                                                }
                                            });
                                        }

                                        // แนบตัวตรวจจับเหตุการณ์คลิกกับปุ่มลบทั้งหมดที่มีคลาส deletebutton
                                        const deleteButtons = document.querySelectorAll('.button_D');
                                        deleteButtons.forEach((button) => {
                                            button.addEventListener('click', () => {
                                                const studentId = button.getAttribute('data-student-id');
                                                showDeleteConfirmation(studentId);
                                            });
                                        });

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