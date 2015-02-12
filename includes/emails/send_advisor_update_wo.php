<?php

if(!empty($wo_num))
	$wonum = $wo_num;
//includes the db connection

include 'connection.php';

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
	
//Subject
$subject =  'DO NOT REPLY: ADVISOR: MAEM workorder number ';
$subject .= $wonum;
$subject .= ' status changed';

$q = "SELECT * FROM `transaction` WHERE `wo_num` = '$wonum' ORDER BY `Date/Time` DESC";
$res = mysqli_query($con,$q);
$row = mysqli_fetch_row($res);
//message
$message = '<html><p> <b> Work order number: <b>';
$message .= $wonum;
$message .= " has been upated.</b><br><br><b>Short Description</b><br><i>";
$message .= $wosdesc;
$message .= "</i><br><br>";
$message .= "<b>Latest Transaction</b>:<br><hr>";
$message .= "<i>Comments</i>: ".$row[4]."<br>";
$message .= "<i>Status</i>: ".$row[2]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Posted By</i>: ".$row[3]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><i>Time Stamp</i>: ".$row[6]."<br>";
$message .= "<i>Total Hours Logged</i>: ".$row[7]."<br>";

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrell@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);

?>
