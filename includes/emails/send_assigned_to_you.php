<?php

//includes the db connection
include '../connection.php';
$wonum = 2;
if(!empty($wo_num))
	$wonum = $wo_num;
	
$q = "SELECT `assigned_name` FROM `work_orders` WHERE `wo_num` = '$wonum'";
//echo $q.'<br>';
$res = mysqli_query($con,$q);
$name = mysqli_fetch_row($res)[0];
$q = "SELECT `email` FROM `staff` WHERE `name` = '$name'";
//echo $q.'<br>';
$res = mysqli_query($con,$q);
$row = mysqli_fetch_row($res);
$to = $row[0];
//echo $to;

//Subject
$subject =  'DO NOT REPLY: ASSIGNED: MAEM workorder '.$wonum.' has been assigned to you';
$docRoot= "https://" . $_SERVER['HTTP_HOST'];

//message
$message = '<html><p>The work order <b>';
$message .= $wonum;
$message .= "</b> has been assigned to you.";
$message .= '<a href="'.$docRoot.'/mae_shop/pages/shop_tech.php?wonum='.$wonum.'"><br>Work Order Link</br></a></html>';
//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrellm@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);
echo '<br>';
if(mail($to, $subject, $message, $headers))
	echo 'SENT!';
else	
	echo 'ERROR!';

?>
