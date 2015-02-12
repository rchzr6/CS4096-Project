<?php
//includes the db connection
include '../includes/connection.php';

if(!empty($wo_num))
	$wonum = $wo_num;

//query db and get type and desc then store data
$q = "SELECT `wo_short_description`,`wo_type` FROM `work_orders` WHERE `wo_num` = '$wonum'";
$res = mysqli_query($con,$q);
$row = mysqli_fetch_array($res);
$group = $row['wo_type'];
$wosdesc = $row['wo_short_description'];
//query db and get the manager(s) of the proper group
$q = "SELECT `user_name` FROM `group` WHERE `role` = 'Manager' AND `group_name` = '$group'";
//echo $q.'<br>';
$res = mysqli_query($con,$q);
$to = ''; //Initialize to
$size = mysqli_num_rows($res);
//get all the managers and store them in the to line
for ($i = 0; $i < $size; $i++){
		$tu = mysqli_fetch_row($res);
		$tof = $tu[0];
		$q = "SELECT `email` FROM `staff` WHERE `name` = '$tof'";
		//echo $q.'<br>';
		$ress = mysqli_query($con,$q);
		$to .= mysqli_fetch_row($ress)[0];
		if($size > 0 && $i < ($size-1))
			$to .= ',';
	}
	
//Subject
$subject =  'DO NOT REPLY: MANAGER: New MAEM workorder submitted ';
$subject .= $wonum;

//message
$message = '<html><p>A new work order has been entered into the MAEM shop work order system for the group <b>'.$group.'</b>. The assigned work order number is: <b>';
$message .= $wonum;
$message .= "</b><br><br><b>Short Description</b><br><i>";
$message .= $wosdesc;
$message .= "</i><br><br>";

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrell@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);

?>
