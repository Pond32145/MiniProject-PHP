<?php

require_once "connectdb.php";
    if (isset($_POST['user_id'])) {
        $del = $_POST['user_id'];

        // กระบวนการลบไฟล์ในโฟลเดอร์ Upload
        $select_stmt = $conn->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $select_stmt->bindParam(':user_id', $del);
        $select_stmt->execute();

        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // กระบวนการลบข้อมูลในแถวของตารางนั้น
        // unlink("upload/".$row['student_photo']); // unlink function permanently remove your file
        $sql = "DELETE FROM users where user_id= :user_id";
        $delete_stmt = $conn->prepare($sql);
        $delete_stmt->bindParam(':user_id', $del);
        $delete_stmt->execute();
        echo "Delete Successfully";
        header("Location: user_show.php");
    }
?>