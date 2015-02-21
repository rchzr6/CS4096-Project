<?php
//PAGE FUNCTIONALITY TO COME IN SECOND PHASE OF PROJECT
	session_start();


?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
	include '../includes/connection.php';
	$wonum = $_SESSION['num'];
	Echo '<h1>work order  number :', $wonum,'</h1>';
	echo '<br>';
	
	$q = "SELECT * FROM `work_orders` WHERE wo_num = '$wonum';";
	$res = mysqli_query($con,$q);
	$resar = $row = $res->fetch_assoc();;
	$name = $resar['submitter_name'];
	$office = $resar['submitter_room_num'];
	$phone = $resar['submitter_phone'];
	$email = $resar['submitter_email'];
	$status = $resar['submitter_status'];
	$type = $resar['wo_type'];
	$scope = $resar['wo_scope'];
	$advisor = $resar['submitter_advisor'];
	$curstat = $resar['wo_status'];
	$short = $resar['wo_short_description'];
	$long = $resar['wo_long_description'];
	$start = $resar['wo_submit_date'];
	$end = $resar['wo_complete_date'];
	$ddate = $resar['due_date'];
	$files = $resar['wo_file_list'];
	$assigned = $resar['assigned_name'];
	$group = $resar['assigned_group'];
	Echo '<b>Submitter Name: </b>',$name,'<br>';
	Echo '<b>Submitter status: </b>',$status,'<br>';
	Echo '<b>Advisors name: </b>',$advisor,'<br>';
	Echo '<b>Submitter Office: </b>',$office,'<br>';
	Echo '<b>Submitter phone: </b>',$phone,'<br>';
	Echo '<b>Submitter e-mail: </b>',$email,'<br>';
	Echo '<b>Work Order Type: </b>',$type,'<br>';
	Echo '<b>Work Order Scope: </b>',$scope,'<br><br>';
	Echo '<b>Work Order status: </b>',$curstat,'<br>';
	Echo '<b>Work Order assigned to: </b>',$assigned,'<br>';
	Echo '<b>as part of group: </b>',$group,'<br><br>';
	Echo '<b>Attached Files: </b><a href="../files/'.$files.'">',$files,'</a><br>';
	Echo '<b>Short Description: </b>',$short,'<br><br><br>';
	Echo '<b>Full Description: </b>',$long,'<br><br><br>';
	Echo '<b>Start Date: </b>',$start,'<br>';
	Echo '<b>Due Date: </b>',$ddate,'<br>';
	Echo '<b>Work Order Complete Date: </b>',$end,'<br><br><br>';

	Echo '***********  Transaction List follows  **************<br><br>';
	
	if(!empty($wonum)){//selects comments from the transaction table and prints them.
	include '../includes/queries/show_all_transactions_queries.php';
	//echo $size;
	if ($size > 0) {
		while($size > 0){
			$row = $res->fetch_assoc();
			echo "<b>Comments</b>: ".$row['comments']."<br>";
			echo "<b>Status</b>: ".$row['wo_status']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Posted By</b>: ".$row['transaction_by']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><b>Time Stamp</b>: ".$row['Date/Time']."<br>";
			echo "<b>Hours Logged</b>: ".$row['hours_logged_now']."<br>";
			echo "<hr>";
			--$size;
			$size = $size -1;
		}
	}
	}
	echo '</div>';
	
	
	 ?>
</body>
</html>