<?php
//FRAME ONE OF REVIEW AND ASSIGN SECTION OF THE SITE -- GETS BASIC INFO AND PRINTS IT. ALSO GETS SOME INFO FOR USE IN FROM TWO TO AVOID EXTRA QUERIES
	include '../includes/connection.php';
	echo '<div id="rev_assign_frame_one" style="border-style: solid; border-width: small;heght: 300px; overflow:scroll;">';
			echo '<center><h1>Summary</h1></center>';
	if(!empty($_GET['wonum'])){
		$wonum = $_GET['wonum'];
		include '../includes/queries/rev_assign_frame_one_queries.php';
		//PRINTS INFO AND CREATES THE DIV CONTAINER
		echo '<table>';
		echo '<tr><td>Work Order Number:</td><td><b>'.$wonum.'<b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Submitter Name:</td><td><b>'.$name.'</b></td></tr>';
		echo '<tr><td>Submit Date:</td><td><b>'.$sub_date.'</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Phone:</td><td><b>'.$phone.'</b></td></tr>';
		echo '<tr><td>Office:</td><td><b>'.$office.'</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Email:</td><td><b>'.$email.'</b></td></tr>';
		echo '<tr><td>Work Order Type:</td><td><b>'.$type.'</td></tr>';
		echo '<tr><td>Work Order Scope:</td><td><b>'.$scope.'</td></tr>';
		echo '<tr><td>Work Order Files:</td><td><b><a href="../files/'.$file.'">'.$file.'</a></td></tr>';
		echo '<tr><td>Due Date:</td><td><i>'.$ddate.'</i></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Start Date:</td><td><i>'.$sdate.'</i></td></tr>';
		echo '</table>';
	}
	else
		echo '<b>No Work Order Selected</b><br><br><br><br><br><br><br><br><br><br><br><br>';
	echo '</div>';
?>