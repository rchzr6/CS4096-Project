<?php
	$wonum = $_GET['wonum'];//gets the work order number from the previous page
	$q = "SELECT `submitter_name`,`submitter_phone`,`submitter_email`,`wo_short_description`,`due_date`, `start_date` FROM `work_orders` WHERE `wo_num` = '".$wonum."'";
	$res = mysqli_query($con,$q);//runs the query
	$resar = $row = $res->fetch_assoc();;//converts result
	$name = $resar['submitter_name'];//stores variables
	$phone = $resar['submitter_phone'];
	$email = $resar['submitter_email'];
	$sd = $resar['wo_short_description'];
	$ddate = $resar['due_date'];
	$sdate = $resar['start_date'];
	
	?>