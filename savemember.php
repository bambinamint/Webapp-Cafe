<?php
    include 'connectdb.php';
//รับข้อมูลส่งมาจาก html form จากไฟล์ form.html
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

//บันทึกลงฐานข้อมูล

    $sql = "insert into member(name,phone,email,password) 
    values ('$name','$phone','$email','$password')";
    //สั่งประมวลผลคำสั่ง sql
    if(mysqli_query($con,$sql)){
        header('location:login.php');
    }
    else{
        header('location:signup.php');
    }
?>
<!-- $sql = "INSERT INTO member VALUES ('$name','$phone','$email','$password')";
    echo $sql; -->