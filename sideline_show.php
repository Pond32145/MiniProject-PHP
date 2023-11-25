<?php

session_start();
require_once "connectdb.php";
require_once "./component/nav02.php";

// if (!isset($_SESSION['admin_login'])) {
//     $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
//     header('location: signin.php');
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Student Data Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,200;0,400;1,400&display=swap');

        * {
            font-family: 'Prompt', sans-serif;
        }
        body{
            margin-bottom: 100px;
        }
        .m {
            margin-top: 75px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="m"></div>
    <div class="container">
        <div class="text-center bg-primary rounded text-light mt-2">
            <h1>Show information of Sideline</h1>
        </div>

        <!-- <hr> -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="sideline_Insert.php" class="btn btn-success">เพิ่มข้อมูล</a>
            <a href="admin_home.php" class="btn btn-warning">กลับหน้าหลัก</a>

        </div>
        <table id="stdTable" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Sideline ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>line</th>
                    <th>Team</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                //ทดลองเทส github
                // $stmt = $conn->query("SELECT * FROM ladies");
                // $sql = "SELECT * FROM ladies";
                // $sql = "SELECT ladies.*, groups.*, agency.* FROM ladies
                // INNER JOIN groups ON ladies.group_id = groups.group_id
                // INNER JOIN agency ON groups.agen_id = agency.agen_id;
                // "
                // ;
                //INNER JOIN ใช้แล้วไม่แสดงข้อมูล
                //เลยใช้ LEFT JOIN แทน
                $sql = "SELECT * FROM ladies
                LEFT JOIN groups ON ladies.group_id = groups.group_id
                LEFT JOIN agency ON groups.agen_id = agency.agen_id";


                $stmt = $conn->prepare($sql);

                $stmt->execute();
                $lady = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($lady as $user) {
                ?>
                    <tr>

                        <td>
                            <div class="text-center">
                                <img src="upload/<?php echo  $user['lady_photo']; ?>" style="width: 20px; " onclick="showImage(src)" class="rounded">
                            </div>
                        </td>
                        <td><?php echo $user['lady_id']; ?></td>
                        <td><?php echo $user['lady_name']; ?></td>
                        <td><?php echo $user['lady_address']; ?></td>
                        <td><?php echo $user['lady_phone']; ?></td>
                        <td><?php echo $user['lady_line']; ?></td>
                        <td><?php echo $user['group_name']; ?></td>

                        <td>
                            <form action="sideline_update.php" method="post" style="display: inline;">
                                <input type="hidden" name="order" value="<?php echo $user['lady_id']; ?>">
                                <input type="submit" name="edit" value="แก้ไข" class="btn btn-warning btn-sm">
                            </form>
                            <form action="sideline_delete.php" method="post" style="display: inline;">
                                <button type="button" class="button_D btn btn-danger btn-sm" data-student-id=<?php echo $user['lady_id']; ?> ">ลบ</button>
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
                                                    form.action = 'sideline_delete.php';
                                                    const input = document.createElement('input');
                                                    input.type = 'hidden';
                                                    input.name = 'lady_id';
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