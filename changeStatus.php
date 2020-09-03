<?php
    include("connectdb.php"); 
    $id = $_POST["orderId"];
    $status = $_POST["Status"];
    $strSQL = "UPDATE orders SET status = '$status',notify = 0 WHERE id_order = '$id'";
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