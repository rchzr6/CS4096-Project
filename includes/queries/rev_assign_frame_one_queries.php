<?php
//BASIC QUERY ---GETS INFO FROM WORK ORDER TABLE AND SAVES AS VARIABLES
		$q = "SELECT `due_date`,`start_date`,`submitter_name`,`wo_submit_date`,`submitter_room_num`,`submitter_phone`,`submitter_email`,`wo_type`,`wo_scope`,`wo_file_list`,`wo_short_description`,`wo_long_description`,`assigned_name`,`assigned_group`,`wo_status`,`wo_complete_date`,`parent_wo_num` FROM `work_orders` WHERE `wo_num` = '$wonum'";
		$res = mysqli_query($con,$q);
		$row = $row = $res->fetch_assoc();;
		$name = $row['submitter_name'];
		$sub_date = $row['wo_submit_date'];
		$office = $row['submitter_room_num'];
		$phone = $row['submitter_phone'];
		$email = $row['submitter_email'];
		$type = $row['wo_type'];
		$scope = $row['wo_scope'];
		$file = $row['wo_file_list'];
		$s_desc = $row['wo_short_description'];
		$l_desc = $row['wo_long_description'];
		$a_name = $row['assigned_name'];
		$a_group = $row['assigned_group'];
		$aname = $a_name;
		$agroup = $a_group;
		$status = $row['wo_status'];
		$complete_date = $row['wo_complete_date'];
		$parent = $row['parent_wo_num'];
		$ddate = $row['due_date'];
		$sdate = $row['start_date'];

		
?>