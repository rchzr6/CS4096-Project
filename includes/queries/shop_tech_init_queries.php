<?php
	$myname = " ";
	$mygroup = " ";
	
	$user = $_SESSION['username'];//gets session variable username
	$q = "SELECT `id` FROM `member` WHERE `username` = '$user'";//gets user's id from the member table where their login info is stored
	$resid = mysqli_query($con,$q);
	$id = (mysqli_fetch_row($resid)[0]);
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	if(mysqli_num_rows($res) >0)
		$myname = mysqli_fetch_row($res)[0];
	$q = "SELECT `name` FROM  `faculty` WHERE `id_num` = '$id'";//checks if user is faculty, NOTE ONLY STORES INFO FROM STAFF OR FACULTY
	$res = mysqli_query($con,$q);
	if(mysqli_num_rows($res) >0)
		$myname = mysqli_fetch_row($res)[0];
	if(isset($_POST['groupfilter']))
		$mygroup = $_POST['groupfilter'];
	else{
		$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$myname'";//gets the group of the user
		$res = mysqli_query($con,$q);
		if(mysqli_num_rows($res) > 0)
			$mygroup = mysqli_field_seek($res,0);
		if(isset($_POST['groupfilter']))
			$mygroup = $_POST['groupfilter'];
	}
	
	$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders` where `assigned_name` = '$myname' AND `wo_status` != 'CLOSED'";
	if(isset($_POST['me']))
		$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders` WHERE `assigned_name` = '$myname'";//gets work orders assigned to user
	else if(isset($_POST['group']))
		$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date`FROM `work_orders` WHERE `assigned_group` = '$mygroup' ";//gets work orders assigned to user's group
	else if(isset($_POST['mine']))
		$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders` WHERE  `submitter_name` = '$myname' OR `submitter_advisor` = '$myname' OR `assigned_name` = '$myname'";//gets work orders that i am submitter or advisor
	
	//echo $q;
if(isset($_POST['vall']))
		$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders`";//gets all work orders

//echo $q;		
			if(isset($_POST['vall'])){
				$q .= " WHERE";
			}else{
			$q .= " AND";
			}
			$filter = $_POST['statusfilter'];
			if($filter == 'abc')
				$q .= " `wo_status` != 'CLOSED'";
			if($filter == 'ip')
				$q .= " `wo_status` = 'IN PROGRESS'";
			if($filter == 'closed')
				$q .= " `wo_status` = 'CLOSED'";
		
if(isset($_POST['organize'])){
	$org = $_POST['organize'];
	$tree = FALSE;
	if($org == 'sdate')
		$q .= " ORDER BY `start_date` ASC";
	else if($org == 'ddate')
		$q .= " ORDER BY `due_date` ASC";
	else if($org == 'tree'){
		$tree = TRUE;
		$q = "SELECT `wo_num`,`wo_status`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders`";//gets all work orders
	}
}
$wo_to_display = mysqli_query($con,$q);
	//echo $q;
	
	?>