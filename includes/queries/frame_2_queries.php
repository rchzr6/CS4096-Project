<?php
//QUERIES FOR FRAME TWO TO GET INFO AND STORE IN VARIABLES
	$q = "SELECT COUNT('wo_status') AS size FROM `transaction` WHERE `wo_num` = $wonum";
	$sizeres = mysqli_query($con,$q);
	$row = $sizeres->fetch_assoc();
	$size = $row['size'];
	$wonum = $_GET['wonum'];
	$q = "SELECT `wo_status`,`transaction_by`,`Date/Time`, `comments`, `hours_logged_now` FROM `transaction` WHERE `wo_num` = '$wonum' ORDER BY `Date/Time` ASC";
	//echo $q;
	$res = mysqli_query($con,$q);
	
	?>