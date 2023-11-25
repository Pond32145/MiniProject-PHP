<?php
    $severname ="localhost";
    $username ="root";
    $password ="";
    $dbname ="sideline_db";

    try{
        $conn = new PDO("mysql:host=$severname;dbname=$dbname",$username,$password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
    }catch(PDOException $e){
        echo "เชื่อมต่อข้อมูลผิดพลาด". $e -> getMessage();
    }
?>