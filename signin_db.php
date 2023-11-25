<?php
session_start();
require_once "connectdb.php";
if (isset($_POST["signin"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมลล์';
        header("location: signin.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลล์ไม่ถูกต้อง';
        header("location: signin.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $check = $conn->prepare($sql);
        $check->bindParam(1,$email);
        $check->execute();
        $row = $check->fetch(PDO::FETCH_ASSOC);

        if ($check->rowCount() > 0) {
            if ($email == $row['email']) {
                if (password_verify($password ,$row['password'])) {

                    if ($row['urole'] == 'admin') {
                        $_SESSION['admin_login'] = $row['user_id'];
                        header("location: admin_home.php");
                    } else {
                        $_SESSION['user_login'] = $row['user_id'];
                        header("location: user_home.php");
                    }
                    

                    // header("location: admin.php");


                } else {
                    $_SESSION['error'] = 'รหัสไม่ถูกต้อง';      
                    header("location: signin.php");      
                }
           } else {
                $_SESSION['error'] = 'อีเมลล์ไม่ถูกต้อง!!';  
                header("location: signin.php");          
            } 
            // header("location: signin.php");
        } else {
            $_SESSION["error"] = "ไม่พบข้อมูล";
            header("location: signin.php");
        }
        
    }
} else {
    $_SESSION['error'] = 'คุณไม่ได้ล็อคอินเข้ามา';
    header("location: signin.php");
}
?>
