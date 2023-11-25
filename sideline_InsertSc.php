<?php
//connect DB
session_start();
require_once "connectdb.php";
if (isset($_POST['submit'])) {
    //สร้างตัวแปรเพื่อรับค่าจากฟอร์ม
    $id = $_POST['lady_id'];
    $name = $_POST['lady_name'];
    $address = $_POST['lady_address'];
    // $address = $_POST['lady_photo'];
    $phone = $_POST['lady_phone'];
    // $fileName = $_POST['photo_file'];
    $line = $_POST['lady_line'];
    $group_id = $_POST['group_id'];

    $check_stdID = $conn->prepare("SELECT lady_id FROM ladies WHERE lady_id = ?");
    $check_stdID->bindParam(1, $id);
    $check_stdID->execute();

    // ตรวจสอบการกรอกข้อมูลที่ส่งมาจากแบบฟอร์ม
    if (empty($id)) {
        $_SESSION['error'] = 'กรุณากรอกไอดี';
        header("location: sideline_Insert.php");
    } else if (empty($name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: sideline_Insert.php");
    } else if (empty($address)) {
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header("location: sideline_Insert.php");
    } else if (empty($phone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
        header("location: sideline_Insert.php");
    } else if (empty($line)) {
        $_SESSION['error'] = 'กรุณากรอกไอดีไลน์';
        header("location: sideline_Insert.php");
    } else if ($check_stdID->rowCount() > 0) {
        $_SESSION['error'] = "มีรหัสนักศึกษานี้อยู่แล้ว";
        header("location: sideline_Insert.php");
    } else {
        try {
            //-------------------------------------------------------------------------------------------------//

            if (isset($_FILES['photo_file']) && !empty($_FILES['photo_file']['name'])) {
                // เซ็ตต้าแหน่งที่จะบันทึกไฟล์รูป
                $targetDir = "upload/"; // แก้ไขต้าแหน่งเก็บรูปได้ตามที่คุณต้องการ
                $fileName = basename($_FILES['photo_file']['name']);
                $size = $_FILES['photo_file']['size'];
                $targetFilePath = $targetDir . $fileName ;

                // ตรวจสอบว่าไฟล์เป็นรูปภาพหรือไม่
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf','JPG','PNG');
                if (in_array($fileType, $allowTypes)) {
                    if (!file_exists($targetFilePath)) { // check file not exist in your upload folder path
                        if ($size < 5000000) { // check file size 5MB
                            if (move_uploaded_file($_FILES['photo_file']['tmp_name'],$targetFilePath)) {

                                // เพิ่มข้อมูลนักศึกษาลงในฐานข้อมูล
                                if(!isset($_SESSION['error'])){

                                    $sql = "INSERT INTO ladies (lady_id, lady_name, lady_address, lady_photo, lady_phone, lady_line, group_id) VALUES (?,?,?,?,?,?,?)";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(1,$id);
                                    $stmt->bindParam(2,$name);
                                    $stmt->bindParam(3,$address);
                                    $stmt->bindParam(4,$fileName); // เก็บต้าแหน่งของไฟล์รูป
                                    $stmt->bindParam(5,$phone);
                                    $stmt->bindParam(6,$line);
                                    $stmt->bindParam(7,$group_id);
                                    // $stmt->execute();
                                    $result=$stmt->execute();
                                    // Sweet Alert เพื่อแจ้งผลลัพธ์การเพิ่มข้อมูล
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                                    if($result){
                                    echo '<script>
                                        setTimeout(function() {
                                            Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "เพิ่มข้อมูลส้าเร็จ",
                                            showConfirmButton: false,
                                            timer: 1500
                                            }).then(function() {
                                            window.location = "sideline_show.php"; //หน้าที่ต้องการให้กระโดดไป
                                        });
                                    }, 1000);
                                    </script>';
                                    }else{
                                    echo '<script>
                                        setTimeout(function() {
                                            Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "เกิดข้อผิดพลาด",
                                            showConfirmButton: false,
                                            timer: 1500
                                            }).then(function() {
                                            window.location = "sideline_Insert.php"; //หน้าที่ต้องการให้กระโดดไป
                                            });
                                        }, 1000);
                                    </script>';
                                    }

                                }else{
                                    $_SESSION['error']="มีบางอย่างผิดพลาด";
                                    header("Location: sideline_Insert.php");
                                }
                            } else {
                                $_SESSION['error'] = "มีข้อผิดพลาดในการอัปโหลดไฟล์รูป";
                                header("location: sideline_Insert.php");
                            }
                        }else{
                            $_SESSION['error'] = "ขนาดไฟล์ใหญ่เกิน 5MB"; // error message file size larger than 5mb
                            header("location: sideline_Insert.php");
                        }
                    }else{
                        $_SESSION['error'] = "มีไฟล์นี้อยู่แล้ว..กรุณาเปลี่ยนชื่อไฟล์"; // error message file not exists yourupload folder path
                        header("location: sideline_Insert.php");
                    }
                } else {
                    $_SESSION['error'] = "เฉพาะไฟล์รูปภาพเท่านั้นที่อนุญาตให้อัปโหลด (jpg, jpeg, png, gif)";
                    header("location: sideline_Insert.php");
                }
            } else {
                $_SESSION['error'] = "กรุณาเลือกไฟล์รูป";
                header("location: sideline_Insert.php ");
            }
         
            //-------------------------------------------------------------------------------------------------//
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>