<?php
session_start(); // เริ่มหรือดึงข้อมูลเซสชัน
require_once "connectdb.php"; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

// รับข้อมูลที่ต้องการอัปเดตจากฟอร์มหรือแหล่งข้อมูลอื่น ๆ
$Id = $_POST['id'];
$s_id = $_POST['lady_id'];
$new_fname = $_POST['lady_name'];
$new_address = $_POST['lady_address'];
$new_phone = $_POST['lady_phone'];
$new_line = $_POST['lady_line'];
$new_group = $_POST['group_id'];


$sql = "SELECT ladies.*, groups.group_name
FROM ladies
INNER JOIN groups ON ladies.group_id = groups.group_id WHERE id = :id; ";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $Id);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

extract($student); // ไม่ต้องสร้างตัวแปรมารองรับ เรียกใช้ผ่านชื่อฟิลด์ได้เลย

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $image_file = $_FILES['txt_file']['name'];
        $type = $_FILES['txt_file']['type'];
        $size = $_FILES['txt_file']['size'];
        $temp = $_FILES['txt_file']['tmp_name'];
        $path = "upload/" . $image_file;
        $directory = "upload/"; // set upload folder path for upadte time previous file remove and new file upload for next use
        if ($image_file) {
            if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                if (!file_exists($path)) { // check file not exist in your upload folder path
                    if ($size < 5000000) { // check file size 5MB
                        if ($student && is_array($student) && isset($student['lady_photo'])) {
                            unlink($directory . $student['lady_photo']); // unlink function remove previos file
                        }
                        move_uploaded_file($temp, 'upload/' . $image_file); // move upload file temperary directory to your upload folder

                        // เริ่มอัพเดทข้อมูล
                        if (!isset($_SESSION['warning'])) {
                            // สร้างค้าสั่ง SQL UPDATE
                            $sql = "UPDATE ladies SET 
                                lady_name = :n_fname, 
                                lady_address = :n_address, 
                                lady_phone = :n_phone, 
                                lady_line = :n_line, 
                                lady_photo = :file_up, 
                                group_id = :n_group 
                                WHERE
                                id = :id";
                            $stmt = $conn->prepare($sql);
                            // ผูกค่าพารามิเตอร์
                            $stmt->bindParam(':id', $Id);
                            $stmt->bindParam(':n_fname', $new_fname);
                            $stmt->bindParam(':n_address', $new_address);
                            $stmt->bindParam(':n_phone', $new_phone);
                            $stmt->bindParam(':n_line', $new_line);
                            $stmt->bindParam(':file_up', $image_file);
                            $stmt->bindParam(':n_group', $new_group);
                            $result = $stmt->execute();

                            // sweet alert
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            if ($result) {
                                echo '<script>
                                setTimeout(function() {
                                Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "แก้ไขข้อมูลสำเร็จ",
                                showConfirmButton: false,
                                timer: 1500
                                }).then(function() {
                                window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                                }, 1000);
                                </script>';
                            } else {
                                echo '<script>
                                setTimeout(function() {
                                Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "เกิดข้อผิดพลาด",
                                showConfirmButton: false,
                                timer: 1500
                                }).then(function() {
                                window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                                }, 1000);
                                </script>';
                            }
                        }
                    } else {
                        $_SESSION['warning'] = "Your file to large please upload 5MB size";
                        // เมื่อขนาดไฟล์เกินก้าหนด
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                        echo '<script>
                        setTimeout(function() {
                        Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "ขนาดไฟล์ใหญ่เกินกว่าก้าหนด",
                        text: "กรุณาเลือกไฟล์ไม่เกิน 5MB แล้วลองใหม่อีกครั้ง",
                        showConfirmButton: true,
                        timer: 100000
                        }).then(function() {
                        window.location = " sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                        </script>';
                    }
                } else {
                    $_SESSION['warning'] = "File already exists... Check upload folder";
                    // เมื่อชื่อไฟล์ซ้้ากัน
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    echo '<script>
                    setTimeout(function() {
                    Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "ชื่อไฟล์นี้มีอยู่แล้ว",
                    text: "กรุณาเปลี่ยนชื่อไฟล์แล้วลองใหม่อีกครั้ง",
                    showConfirmButton: true,
                    timer: 100000
                    }).then(function() {
                    window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                    });
                    }, 1000);
                    </script>';
                }
            } else {
                $_SESSION['warning'] = "Upload JPG, JPEG, PNG & GIF formats...";
                // เมื่อชนิดของไฟล์ภาพไม่ถูกต้อง
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                setTimeout(function() {
                Swal.fire({
                position: "center",
                icon: "warning",
                title: "ชนิดไฟล์ไม่ถูกต้อง",
                text: "กรุณาเลือกไฟล์ที่เป็นภาพ แล้วลองใหม่อีกครั้ง",
                showConfirmButton: true,
                timer: 100000
                }).then(function() {
                window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            }
        } else {
            $image_file = $lady_photo; // if you not select new image than previos image same it is it.
            // เริ่มอัพเดทข้อมูล
            if (!isset($_SESSION['warning'])) {

                // สร้างค้าสั่ง SQL UPDATE
                $sql = "UPDATE ladies SET 
                                lady_name = :n_fname, 
                                lady_address = :n_address, 
                                lady_phone = :n_phone, 
                                lady_line = :n_line, 
                                lady_photo = :file_up, 
                                group_id = :n_group 
                                WHERE
                                id = :id";
                            $stmt = $conn->prepare($sql);
                            // ผูกค่าพารามิเตอร์
                            $stmt->bindParam(':id', $Id);
                            $stmt->bindParam(':n_fname', $new_fname);
                            $stmt->bindParam(':n_address', $new_address);
                            $stmt->bindParam(':n_phone', $new_phone);
                            $stmt->bindParam(':n_line', $new_line);
                            $stmt->bindParam(':file_up', $image_file);
                            $stmt->bindParam(':n_group', $new_group);
                            $result = $stmt->execute();


                // sweet alert
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                if ($result) {
                    echo '<script>
                    setTimeout(function() {
                    Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลส้าเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                    }).then(function() {
                    window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                    });
                    }, 1000);
                    </script>';
                } else {
                    echo '<script>
                    setTimeout(function() {
                    Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    showConfirmButton: false,
                    timer: 1500
                    }).then(function() {
                    window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                    });
                    }, 1000);
                    </script>';
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}