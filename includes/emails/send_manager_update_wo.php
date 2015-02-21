<?php

if(!empty($wo_num))
	$wonum = $wo_num;
//includes the db connection

include 'connection.php';

//query db and get type and desc then store data
$q = "SELECT `wo_short_description`,`wo_type` FROM `work_orders` WHERE `wo_num` = '$wonum'";
$res = mysqli_query($con,$q);
$row = mysqli_fetch_array($res);
$group = $row['wo_type'];
$wosdesc = $row['wo_short_description'];
//query db and get the manager(s) of the proper group
$q = "SELECT `user_name` FROM `group` WHERE `role` = 'Manager' AND `group_name` = '$group'";
$res = mysqli_query($con,$q);
$to = ''; //Initialize to
$q = "SELECT COUNT('user_name') AS 'SIZE' FROM `group` WHERE `role` = 'Manager' AND `group_name` = '$group'";
$sizeres = mysqli_query($con,$q);
$sizear = mysqli_fetch_array($sizeres);
$size = $sizear['SIZE'];
//get all the managers and store them in the to line
for ($i = 0; $i < $size; $i++){
		$tempusr = mysqli_fetch_row($res)[0];
		$q = "SELECT `email` FROM `faculty` WHERE `name` = '$tempusr' ";
		$tempres = mysqli_query($con,$q);
		$tempar = mysqli_fetch_array($tempres);
		$to .= $tempar['email'];
		$to .= ',';
	}
	$q = "SELECT MAX(transaction_num) FROM `transaction` WHERE `wo_num` = $wonum";
	$sizeres = mysqli_query($con,$q);
	$size = mysqli_field_seek($sizeres,0);
	$q = "SELECT `wo_status`,`transaction_by`,`Date/Time`, `comments`, `hours_logged` FROM `transaction` WHERE `transaction_num` = '$size'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_row($res);
	
//Subject
$subject =  'DO NOT REPLY: MANAGER: MAEM workorder number ';
$subject .= $wonum;
$subject .= ' status changed';

//message
$message = '<html><p> <b> Work order number: <b>';
$message .= $wonum;
$message .= " has been updated.</b><br><br><b>Short Description</b><br><i>";
$message .= $wosdesc;
$message .= "</i><br><br>";
$message .= "<b>Latest Transaction</b>:<br><hr>";
$message .= "<i>Comments</i>: ".$row[3]."<br>";
$message .= "<i>Status</i>: ".$row[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Posted By</i>: ".$row[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><i>Time Stamp</i>: ".$row[2]."<br>";
$message .= "<i>Total Hours Logged</i>: ".$row[4]."<br>";

//Additional Headers
$headers = "From: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrell@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);

?>
