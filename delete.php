<?php
	session_start();

	$Line = $_POST["Line"];
	$_SESSION["strProductID"][$Line] = "";
	$_SESSION["strQty"][$Line] = "";

	echo 1;
?>