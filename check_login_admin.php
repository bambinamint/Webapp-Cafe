<?php
	session_start();
	include 'connectdb.php';
	$email = $_POST['username'];
	$password = $_POST['pass'];
	$strSQL = "SELECT * FROM member WHERE email = '$email' and password = '$password' and status = 1";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			echo 1;
	}
	else
	{
			$_SESSION["email"] = $objResult["email"];
			$_SESSION["name"] = $objResult["name"];

			echo 2;
	}
	mysqli_close($con);
?>
   