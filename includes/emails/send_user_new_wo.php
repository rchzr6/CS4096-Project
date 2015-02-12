<?php
include '../includes/connection.php';

if(!empty($wo_num))
	$wonum = $wo_num;
	
//query db and get the manager(s) of the proper group
$q = "SELECT `submitter_advisor`,`submitter_email`,`wo_short_description`,`submitter_name`, `submitter_status` FROM `work_orders` WHERE `wo_num` = '$wonum'";
$res = mysqli_query($con,$q);
//get info for to, their name and status
$row = mysqli_fetch_array($res);
$adv = $row['submitter_advisor'];
$subemail = $row['submitter_email'];
$name = $row['submitter_name'];
$status = $row['submitter_status'];
$wosdesc = $row['wo_short_description'];
$id="";

$to = $subemail;
//queries to get necessary info
if($status == 'ugrad' ||  $status == 'grad'){
	$q = "SELECT `id` FROM `student` WHERE `name` = '$name' AND `email` = '$to'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_array($res);
	$id = $row['id'];
}
if($status == 'staff'){
	$q = "SELECT `id_num` FROM `staff` WHERE `name` = '$name' AND `email` = '$to'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_array($res);
	$id = $row['id_num'];
}
if($status == 'faculty'){
	$q = "SELECT `id_num` FROM `faculty` WHERE `name` = '$name' AND `email` = '$to'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_array($res);
	$id = $row['id_num'];
}

//Subject
$subject =  'DO NOT REPLY: SUBMITTER: New MAEM workorder submitted ';
$subject .= $wonum;
$docRoot= "https://" . $_SERVER['HTTP_HOST'];

//message
$message = '<html><p>A new work order has been entered into the MAEM shop work order system.The assigned work order number is: <b>';
$message .= $wonum;
$message .= "</b><br><br><b>Short Description</b><br><i>";
$message .= $wosdesc;
$message .= "</i><br><br>";
$message .= '<a href="'.$docRoot.'/mae_shop/pages/wo_status.php?wonum='.$wonum.'&amp;id='.$id.'&amp;email=true"<br>Track Your Work Order Here</br></a></html>';

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrellm@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);

include 'send_advisor_new_wo.php';
?>
