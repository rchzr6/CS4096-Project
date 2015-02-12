<?php
	$q = "SELECT `submitter_name`,`submitter_room_num`,`submitter_phone`,`submitter_email`,`wo_type`,`wo_scope`,`submitter_advisor` FROM `work_orders` WHERE wo_num = '$newnum';";
	$res = mysqli_query($con,$q);
	$resar = $row = $res->fetch_assoc();;
	$name = $resar['submitter_name'];
	$office = $resar['submitter_room_num'];
	$phone = $resar['submitter_phone'];
	$email = $resar['submitter_email'];
	$type = $resar['wo_type'];
	$scope = $resar['wo_scope'];
	$advisor = $resar['submitter_advisor'];

?>