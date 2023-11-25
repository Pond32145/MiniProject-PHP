<?php

require_once "connectdb.php";
    if (isset($_POST['lady_id'])) {
        $del = $_POST['lady_id'];

        // กระบวนการลบไฟล์ในโฟลเดอร์ Upload
        $select_stmt = $conn->prepare('SELECT * FROM ladies WHERE lady_id = :lady_id');
        $select_stmt->bindParam(':lady_id', $del);
        $select_stmt->execute();

        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // กระบวนการลบข้อมูลในแถวของตารางนั้น
        unlink("upload/".$row['lady_photo']); // unlink function permanently remove your file
        $sql = "DELETE FROM ladies where lady_id= :lady_id";
        $delete_stmt = $conn->prepare($sql);
        $delete_stmt->bindParam(':lady_id', $del);
        $delete_stmt->execute();
        echo "Delete Successfully";
        header("Location: sideline_show.php");
    }
?>