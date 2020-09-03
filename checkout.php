<?php
session_start();
include 'connectdb.php';
$username =  $_POST['username'];

$oldmoneySQL = "select topup from member where email = '$username'";
$objQuery = mysqli_query($con,$oldmoneySQL);
//mysqli_fetch_array การคืนค่าข้อมูลของ result ในแถวที่ชี้อยู่ ซึ่งจะเก็บไว้ที่ array และเลื่อนไปตัวชี้ที่ชี้ไปยังตำแหน่งถัดไป โดยจะคืนค่า false กรณีที่เกิดความผิดพลาด
$objResult = mysqli_fetch_array($objQuery);
$totalMoney = $objResult["topup"];
$SumTotal = $_SESSION["SumTotal"];

    if($SumTotal < $totalMoney) {
      $totalMoney=$totalMoney-$SumTotal;
      $strSQL = "UPDATE member SET topup = $totalMoney WHERE email = '$username'";
      $objQuery1 = mysqli_query($con,$strSQL);
      $orderSql = "INSERT INTO orders (email,status,total) VALUES ('$username','Padding',$SumTotal)";
      mysqli_query($con,$orderSql); 
      $strOrderID = mysqli_insert_id($con);
      for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
      {
        if($_SESSION["strProductID"][$i] != "")
        {
            $detailSql = "INSERT INTO orders_detail (id_order,id_product,amount) VALUES (".$strOrderID.",".$_SESSION["strProductID"][$i].",".$_SESSION["strQty"][$i].") ";
            mysqli_query($con,$detailSql) ;
        }
      }
      $_SESSION["intLine"] = null;
      $_SESSION["strProductID"] = "";
	    $_SESSION["strQty"] = "";
      echo 1 ;
    }else{
      echo 2;
    }

 mysqli_close($con);

?>