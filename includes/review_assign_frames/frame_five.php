<?php
//FRAME FIVE -- LISTS WORK ORDERS ACTIONS
	include '../includes/connection.php';
	
?>
<div id="rev_assign_frame_five" style="border-style: solid; border-width: small; height: 100px;">
	<form id="actions" method="post" action="#">
		<b>Action</b> 
		<select form="actions" name="select_action">
			<option value="print">Print</option>
			<option value="assign">Assign</option>
			<option value="close">Close</option>
			<option value="terminate">Terminate</option>
			<option value="placeonhold">Place On Hold</option>
			<option value="setstartdate">Set Start Date</option>
			<option value="edit">Edit Work Order Info</option>
		</select><br>
		<input type="submit" value="Submit"  name="Submit"/>
	</form>
	
</div>
<?php

	if(!empty($_POST['select_action'])){
		$action = $_POST['select_action'];
		if($action == 'print') 
			echo '<script>window.print()</script>';
			
		if($action == 'assign'){
			$date = date("Y-m-d H:i:s");
			echo '<script>window.open("../includes/review_assign_frames/assign_wo.php?status=ASSIGNED&wonum='.$wonum.'&name='.$aname.'&group='.$type.'")</script>';
		}
		if($action == 'close'){
			$date = date("Y-m-d H:i:s");
			$q = "UPDATE `work_orders` SET `wo_status`= 'Closed',`wo_complete_date` = '$date' WHERE `wo_num` = '$wonum'";
			mysqli_query($con,$q);
			$comment = 'Closed by '.$myname;
			$q = "INSERT INTO transaction(wo_num,wo_status,transaction_by,comments) VALUES('$wonum','Closed','$myname','$comment')";
			mysqli_query($con,$q);
			include '../includes/emails/send_user_closed_wo.php';
		}
		if($action == 'terminate'){
			$date = date("Y-m-d H:i:s");
			$q = "UPDATE `work_orders` SET `wo_status`= 'Closed',`wo_complete_date` = '$date' WHERE `wo_num` = '$wonum'";
			mysqli_query($con,$q);
			echo '<script>window.open("../includes/review_assign_frames/get_comment.php?status=TERMINATED&wonum='.$wonum.'&name='.$aname.'")</script>';
			include '../includes/emails/send_user_terminate_wo.php';
		}
		if($action == 'placeonhold'){
			$date = date("Y-m-d H:i:s");
			$q = "UPDATE `work_orders` SET `wo_status`= 'Hold' WHERE `wo_num` = '$wonum'";
			mysqli_query($con,$q);
			echo '<script>window.open("../includes/review_assign_frames/get_comment.php?status=Hold&wonum='.$wonum.'&name='.$aname.'")</script>';
		}
		if($action == 'setstartdate'){
			$date = date("Y-m-d H:i:s");
			//$q = "UPDATE `work_orders` SET `wo_status`= 'Hold' WHERE `wo_num` = '$wonum'";
			//mysqli_query($con,$q);
			echo '<script>window.open("../includes/review_assign_frames/get_date.php?status='.$status.'&wonum='.$wonum.'&name='.$aname.'")</script>';
		}
		if($action == 'edit'){
			echo '<script>window.open("../pages/change_info.php?status='.$status.'&wonum='.$wonum.'")</script>';
		}
	
	}
	
?>