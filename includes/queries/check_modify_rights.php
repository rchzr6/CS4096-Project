<?php
// check to see if the users should be allowed to modify the work order.  
//  the conditions are that they are either the submitter,
//  the advisor,  assigned the work order, or a manager of the group 

$allowed=0;

//start by checking to see if they are the submitter
	$q = "SELECT * FROM `work_orders` WHERE `wo_num` = '$wonum'";
	$res = mysqli_query($con,$q);
	$subname = 'unkonwn';
	if(mysqli_num_rows($res) > 0){
	$resar = $row = $res->fetch_assoc();
	$subname = $resar['submitter_name'];
}
	if ($subname == $fullname) {$allowed=1;Echo " submitter |";}
	
	//check next to see if they are the advisor.
	$advname = $resar['submitter_advisor'];
	if ($advname == $fullname) {$allowed=1; Echo " Advisor |";}
	
	// check to see if it is a work order they are assigned
	$assignedname = $resar['assigned_name'];
	if ($assignedname == $fullname) {$allowed=1; Echo " Assigned |";}
	
	// check next to see if they are part of the group
	$assignedgroup = $resar['assigned_group'];
	
	
	$q = "SELECT * FROM `group` WHERE `group_name` = '$assignedgroup' AND `user_name` = '$fullname' ";
	
	$res = mysqli_query($con,$q);
	if(mysqli_num_rows($res) > 0){
	$resar = $row = $res->fetch_assoc();;
	$role = $resar['role'];

	
	If ($role == "Manager"){ $allowed=1;  Echo " Manager |";}
	If ($role == "Member") {$allowed=1; Echo " Member |";}
}
	
?>