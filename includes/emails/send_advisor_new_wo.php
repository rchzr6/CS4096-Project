<?php
include '../includes/connection.php';

if(!empty($wo_num))
	$wonum = $wo_num;
	

if($adv == 'Cottrell, Mitch')
	$to = "cottrell@mst.edu";
else if( $adv = 'Schmid, Ken')
	$to = "schmid@mst.edu";
else{
	$q = "SELECT `email` FROM `faculty` WHERE `name` = '$adv'";
	$res = mysqli_query($con,$res);
	$to = mysqli_fetch_row($res)[0];
}

//Subject
$subject =  'DO NOT REPLY: ADVISOR: New MAEM workorder submitted with you as ADVISOR ';
$subject .= $wonum;
$docRoot= "https://" . $_SERVER['HTTP_HOST'];

//message
$message = '<html><p>A new work order has been entered into the MAEM shop work order system for one of your advisees: '.$name.'. The assigned work order number is: <b>';
$message .= $wonum;
$message .= "</b><br><br><b>Short Description</b><br><i>";
$message .= $wosdesc;
$message .= "</i><br><br>";
$message .= '<a href="'.$docRoot.'/mae_shop/pages/wo_status.php?wonum='.$wonum.'&amp;id='.$id.'&amp;email=true"<br>Track Your Work Order Here</br></a><br><br>';
$message .= '<b>If this student is not your advisee, or you do not approve of this workorder, contact Ken Schmid or Mitch Cottrell as soon as possible.<b></html>';

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrellm@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);
?>
