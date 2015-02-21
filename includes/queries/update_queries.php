<?php
//UPDATE QUERIES
session_start();
$status = $_POST['status'];
if(isset($_POST['wo_progress'])){
	$status = $_POST['wo_progress'];
	$wonum = $_POST['wo_num'];
	$q = "SELECT `submitter_name` FROM `work_orders` WHERE `wo_num` = $wonum"; //GETS THE ORIGINAL SUBMITTER
	$res = mysqli_query($con,$q);
	$name = mysqli_fetch_row($res)[0];
	if( isset($_SESSION['log'])){
		$id = $_SESSION['UID'];//GETS THE USER WHO IS LOGGED IN'S ID
		$q = "SELECT `name` FROM `staff` WHERE `id_num` = '$id'";//GETS THE NAME OF THE FACULTY WHO IS LOGGED IN
		$res = mysqli_query($con,$q);
		$resa = $row = $res->fetch_row();
		$aname = $resa[0];
	//echo $q;
}
	if(!empty($aname))//IF A USER IS LOGGED IN, SET NAME TO THAT PERSON'S NAME
		$name = $aname;
	$q = "SELECT MAX(transaction_num) FROM `transaction` ORDER BY `transaction_num` ASC";//GETS THE NUMBER OF TRANSACTIONS
	//echo $q;
	$countres = mysqli_query($con,$q);
	$transnum = mysqli_fetch_row($countres)[0];
	$transnum = $transnum + 1;//INCREMENTS TRANSACTION NUMBER, USED TO GET THE NUMBER OF THE NEW TRANSACTION
	$comments = str_replace("'",'',$comments);
	$q = "UPDATE `work_orders` SET `wo_status`= '$status' WHERE `wo_num` = '$wonum'";
	mysqli_query($con,$q);
	$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments) VALUES ($transnum,$wonum,'$status','$name','$comments')";//CREATES QUERY TO CREATE TRANSACTION
	if(isset($_POST['hours'])){//CHECKS IF THE HOURS WILL BE UPDATED AND CHANGES THE QUERY ACCORDINGLY
		$q = "SELECT `hours_logged`,`transaction_num` FROM `transaction` WHERE `wo_num` = '$wonum' ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$hoursa = $row = $res->fetch_row();
		$hours = $hoursa[0];
		$hnow = $_POST['hours'];
		$hours = $hours + $_POST['hours'];
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged,hours_logged_now) VALUES ($transnum,$wonum,'$status','$name','$comments','$hours','$hnow')";
		//echo $q;
	}
	else if($status == 'Done'){
		$cdate = date('Y-m-d H-m-s');
		$q = "UPDATE `work_orders` SET `wo_status`= 'Closed', `wo_complete_date` = '$cdate' WHERE `wo_num` = '$wonum'";
		mysqli_query($con,$q);
		//echo '<script>window.open("test.php?q=$q")</script>';
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments) VALUES ($transnum,$wonum,'$status','$name','$comments')";//CREATES QUERY TO CREATE TRANSACTION
	if(isset($_POST['hours'])){//CHECKS IF THE HOURS WILL BE UPDATED AND CHANGES THE QUERY ACCORDINGLY
		$q = "SELECT `hours_logged`,`transaction_num` FROM `transaction` WHERE `wo_num` = '$wonum' ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$hoursa = $row = $res->fetch_assoc();;
		$hours = $hoursa[0];
		$hours += $_POST['hours'];
		$hnow = $_POST['hours'];
		$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged,hours_logged_now) VALUES ($transnum,$wonum,'$status','$name','$comments','$hours','$hnow')";
	}
	include '../includes/emails/send_mgr_wo_done.php';
	}
}
	mysqli_query($con,$q);//PROCESSES THE QUERY
	include '../includes/emails/send_user_update_wo.php';
	
	?>