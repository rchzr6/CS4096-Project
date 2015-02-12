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
if($adv == 'Cottrell, Mitch')
	$to = "cottrell@mst.edu";
else if( $adv = 'Schmid, Ken')
	$to = "schmid@mst.edu";
else{
	$q = "SELECT `email` FROM `faculty` WHERE `name` = '$adv'";
	$res = mysqli_query($con,$res);
	$to = mysqli_fetch_row($res)[0];
}
$to .= ', '.$subemail;
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
	$id = $row['id'];
}
if($status == 'faculty'){
	$q = "SELECT `id_num` FROM `faculty` WHERE `name` = '$name' AND `email` = '$to'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_array($res);
	$id = $row['id'];
}

//Subject
$subject =  'DO NOT REPLY: MAEM Work Order Terminated';
$subject .= $wonum;
$docRoot= "https://" . $_SERVER['HTTP_HOST'];

//message
$message = '<html><p>Your work order (number: '.$wonum.') has been terminated by '.$aname;
$message .= "</i><br><br>";
$message .= '<a href="'.$docRoot.'/mae_shop/pages/wo_status.php?wonum='.$wonum.'&amp;id='.$id.'&amp;email=true"<br>Track Your Work Order Here</br></a></html>';

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrellm@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);
?>
