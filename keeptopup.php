<?php
	session_start();
	include 'connectdb.php';
    $money = $_POST['money'];
    $username =  $_POST['username'];

    $oldmoneySQL = "select topup from member where email = '$username'";
    $objQuery = mysqli_query($con,$oldmoneySQL);
	$objResult = mysqli_fetch_array($objQuery);
    $totalMoney = $objResult["topup"] + $money;

    $strSQL = "UPDATE member SET topup = $totalMoney WHERE email = '$username'";
  
	$objQuery1 = mysqli_query($con,$strSQL);
	if($objQuery1)
	{
			echo 1;
	}
	else
	{
			echo 2;
	}
	mysqli_close($con);
?>
   