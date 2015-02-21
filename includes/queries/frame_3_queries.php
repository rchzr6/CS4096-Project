<?php
//queries for frame 3
$q = "SELECT MAX(transaction_num) AS max FROM `transaction` WHERE `wo_num` = '$wonum'";
//echo $q;
$res = mysqli_query($con,$q);
$resa = mysqli_fetch_row($res);
$num = $resa[0];
$q ="SELECT `wo_status`, `hours_logged` FROM `transaction` WHERE `transaction_num` = '$num' ";//gets relevant data from transaction table, orders its then stores in php variables
//echo $q;

	$f3result = mysqli_query($con,$q);
	$f3ar = mysqli_fetch_row($f3result);
	$selected = $f3ar[0];
	$hours = $f3ar[1];
	$wonum = $_GET['wonum'];
	?>