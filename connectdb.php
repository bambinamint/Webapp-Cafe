<?php
//เชื่อมต่อกับฐานข้อมูล
//step 1 : connect to database server
$con = mysqli_connect('localhost','root','');
mysqli_set_charset($con, "utf8");
if(!$con){
    echo 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้';
}
else{
    //setp 2 : connect to database ให้เลือกชื่อ database ที่สร้างไว้
    $db = mysqli_select_db($con,'thatsanandb');
    if(!$db){
        echo 'ไม่พบฐานข้อมูลที่ระบุ';
    }
    //else{
        //ทำการ redirect ไปยังไฟล์ savemember.php
        //header('location:savemember.php');
    //}
}
?>