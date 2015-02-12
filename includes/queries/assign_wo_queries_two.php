<?php
	session_start();
	include '../../includes/connection.php';
	//QUERIES TO GET INFO AND UPDATE THE DATABASES WITH THE NEW ASSIGNED NAME AND NEW TRANSACTION
	$selected = $_POST['select_assigned'];//Gets info from forms and url from previous pages
	$wo_num = $_GET["wonum"];
	$wonum = $wo_num;
	$aname = $_GET["name"];
	$group = $_GET["group"];
	if(($selected == 'other' && empty($_POST['other'])) || $selected == 'select'){//checks for errors
		echo 'Error, Please check your submission and try again.';
	}
	else{
		$other = $_POST['other'];
		if($selected == 'other'){//checks if entered name is set and sets group variable and name variable
			$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$other'";
			$res = mysqli_query($con,$q);
			if(mysqli_num_rows($res) > 0)
				$group = mysqli_field_seek($res,0);
			else
				$group = 'Other';
			$aname = $other;
		}
		else
			$aname = $selected;
		//writes query and executes
		$q = "SELECT `email` FROM `staff` WHERE `name` = '$aname'";
		$res = mysqli_query($con,$q);
		if(mysqli_num_rows($res) > 0)
			$staff_email = mysqli_fetch_row($res)[0];
		$status = 'Assigned';
		$sdate = date('Y-m-d');
		$q = "UPDATE `work_orders` SET `assigned_name` = '$aname', `assigned_group` = '$group', `wo_status` = '$status', `start_date` = '$sdate'  WHERE `wo_num` = $wonum";
		mysqli_query($con,$q);
		$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$row = mysqli_fetch_row($res);
		$size = $row[0];
		$size++;
		$comment = "Work Order Assigned To ".$aname.".";
		$bid = $_SESSION['UID'];
		$q = "SELECT MAX(hours_logged) FROM `transaction` WHERE `wo_num` = '$wo_num'";
		$res = mysqli_query($con,$q);
		$hours = mysqli_fetch_row($res)[0];
		$q = "SELECT `name` FROM `staff` WHERE `id_num` = '$bid'";
		$res = mysqli_query($con,$q);
		$resa = mysqli_fetch_row($res);
		$bname = $resa[0];
		$q = "INSERT INTO transaction(transaction_num,hours_logged,wo_num,wo_status,transaction_by,comments) VALUES($size,$hours,'$wo_num','$status','$bname','$comment')";
		mysqli_query($con,$q);
		$wonum = $wo_num;
	}

?>