<?php
	//setting the proper value for status, had to set to different for looks on previous page
	if($status == 'Undergraduate Student' ){
		$statust = 'ugrad';
		$modify = TRUE;
	}
	if($status == 'Graduate Student'){
		$statust = 'grad';
		$modify = TRUE;
	}
	if($status == 'Staff')
		$statust = 'staff';
	if($status == 'Faculty')
		$statust = 'faculty';
	
	//Query below, fetch result, get row, increment highest wo num to get new wo num
	//include 'get_assigned.php';
	$q = "SELECT MAX(wo_num) FROM `work_orders`";
	$createres = mysqli_query($con,$q);
	$createar = mysqli_fetch_row($createres);
	$oldnum = $createar[0];
	$newnum = $oldnum + 1;
	$wo_num = $newnum;
	//query below, insert new wo into db
	if(isset($aname) && !empty($aname)){
		$q = "INSERT INTO work_orders(wo_num,wo_status,submitter_status,submitter_name,submitter_room_num,submitter_phone,submitter_email,wo_scope,wo_type,assigned_name,assigned_group) VALUES ('$newnum','New','$statust','$subname','$officenum','$phone','$email','$scope','$type','$aname','$type');";
		mysqli_query($con,$q);
		$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$row = mysqli_fetch_row($res);
		$size = $row[0];
		$size++;
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged) VALUES ($size,$newnum,'New','$name','Work Order Submitted','0')";
		mysqli_query($con,$q);
		$size++;
		$comment = "Work Order Assigned To ".$aname.".";
		$bid = $_SESSION['UID'];
		$q = "SELECT `name` FROM `staff` WHERE `id_num` = '$bid'";
		$res = mysqli_query($con,$q);
		$resa = mysqli_fetch_row($res);
		$bname = $resa[0];
		$q = "INSERT INTO transaction(transaction_num,hours_logged,wo_num,wo_status,transaction_by,comments) VALUES($size,'0','$wo_num','Assigned','$bname','$comment')";
		//echo $q;
		sleep(1);
		mysqli_query($con,$q);
	}
	else{
		$q = "INSERT INTO work_orders(wo_num,wo_status,submitter_status,submitter_name,submitter_room_num,submitter_phone,submitter_email,wo_scope,wo_type,assigned_name,assigned_group) VALUES ('$newnum','New','$statust','$subname','$officenum','$phone','$email','$scope','$type','NEW','$type');";
		mysqli_query($con,$q);
		$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$row = mysqli_fetch_row($res);
		$size = $row[0];
		$size++;
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged) VALUES ($size,$newnum,'New','$name','Work Order Submitted','0')";
		mysqli_query($con,$q);
	}
	//echo $q;
	if($statust == 'ugrad' || $statust == 'grad'){
			$q = "UPDATE `student` SET  `Name` = '$subname', `status` = '$statust', `room_number` = '$officenum', `phone` = '$phone', `email` = '$email' WHERE `id` = '$subid'";
			//echo $q;
			mysqli_query($con,$q);
	if($type != "prototype")
		 include '../includes/redirectone.php';
	else
		include '../includes/redirecttwo.php';
	}
?>