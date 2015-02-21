<?php
//THIS IS FRAME 3. THIS FRAME IS USED TO ADD COMMENTS/HOURS TO THE TRANSACTION TABLE. ALSO CAN UPDATE THE STATUS IF THE USER IS AUTHORIZED TO DO SO
	
	echo '<div id="framethree" style="border-style: solid; border-width: small; width=100%;">';
	if(!empty($wonum)){
		
	include 'queries/frame_3_queries.php';//includes the queries to get info
	echo '<form id="f3" method="post" action="../includes/updatetwo.php">';
	echo '<div id="f3select" style="float:left; width:50%;">';
	if($status == 1){ //variable to check to see if this box should be available to change.
	echo 'Status:';
		echo '<select form="f3" name="wo_progress" required>';//prints form
			echo '<option value="'.$selected.'" selected="selected">'.$selected.'</option>';
			echo '<option value="New">New</option>';
			echo '<option value="Hold">Hold</option>';
			echo '<option value="In Progress">In Progress</option>';
			echo '<option value="Waiting On Cost">Waiting on Cost</option>';
			echo '<option value="Waiting On Parts">Waiting on Parts</option>';
			echo '<option value="Done">Done</option>';
			//echo '<option value="Closed">Closed</option>';
			echo '<option value="Assigned">Assigned</option>';
		echo '</select>';
		echo '</div>';
		echo '<div id="f3hours" style="float:right; width:50%;">';
		echo 'Total Hours Logged: '.$hours.'<br>';
		echo 'Hours To Add:<br> <input type="text" name="hours"/>';
		echo '</div>';

	}
	echo 'Comments:<br>';//prints the form for the comments
		echo '<textarea name="comment" form="f3" Comments..></textarea><br>';
		echo '<div id="f3submit" style="float:right; width:50%;">';
		echo '<input type="hidden" name="old_hours" value="'.$hours.'" />';//hidden inputs to pass hours, work order number, and the status
		echo '<input type="hidden" name="wo_num" value="'.$wonum.'" />';
		echo '<input type="hidden" name="status" value="'.$selected.'" />';
		echo '<input type="submit" value="Submit"  name="Submit"/>';
		
		echo '</div><br><br>';
	}
	echo '</form></div>';
	if(!empty($wonum)){
	echo '<form action="show full WO.php" method="post" target="_blank">';
		$_SESSION['num']=$wonum;
		echo '<input type="submit" name="Display " value="Display full work order information for Work Order # '.$wonum.'" />';
		echo '</form>';
	}
	echo '<form action="#" method="POST" name="newstartdate"><input type="submit" name="CSD" value="Change Start Date"/></form>';
?>