<?php


if(!empty($wo_num))
	$wonum = $wo_num;
	
//includes the db connection
include '../connection.php';
$q = "SELECT `submitter_email` FROM `work_orders`	WHERE `wo_num` = '$wonum'";
$res = mysqli_query($con,$q);
$to = mysqli_fetch_row($res)[0];

//Subject
$subject =  'DO NOT REPLY: ASSIGNED: MAEM workorder '.$wonum.' has been assigned';

//message
$message = '<html><p>The work order <b>';
$message .= $wo_num;
$message .= "</b> has been assigned to ";
$message .= $aname;
$message .= ".";

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);

?>
