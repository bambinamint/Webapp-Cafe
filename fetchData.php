<?php
    session_start();
    include 'connectdb.php';
    $user = $_POST["user"];
    //SELECT count(*) นับจำนวน row ว่ามีกี่ row 
    //as newName แล้วเอามาตั้งชื่อ column ใหม่โดยใช้คำสั่งนี้
    $sql = "SELECT count(*) as counts FROM orders WHERE email = '".$user."' and notify = 0";
    $countQuery = mysqli_query($con,$sql);
    $countResult = mysqli_fetch_array($countQuery);
    echo $countResult["counts"] ;
?>