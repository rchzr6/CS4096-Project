<?php
//queries for frame 3
$q = "SELECT MAX(transaction_num) AS max FROM `transaction` WHERE `wo_num` = '$wonum'";
$res = mysqli_query($con,$q);
$resa = $res->fetch_assoc();
$num = $resa['max'];
$q ="SELECT `wo_status`, `hours_logged` FROM `transaction` WHERE `transaction_num` = '$num' ";//gets relevant data from transaction table, orders its then stores in php variables

	$f3result = mysqli_query($con,$q);
	$f3ar = $f3result->fetch_assoc();
	$selected = $f3ar['wo_status'];
	$hours = $f3ar['hours_logged'];
	$wonum = $_GET['wonum'];
	?>