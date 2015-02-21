<?php
//FRAME TWO OF REVIEW AND ASSIGN SECTION OF THE SITE -- PRINTS REST OF INFO AND TRANSACTION LISTS
	include '../includes/connection.php';
	
	
		echo '<div id="rev_assign_frame_two" style="border-style: solid; border-width: small;height: 350px; overflow: scroll;">';
		if(!empty($_GET['wonum'])){//MAKES SURE THE WORK ORDER NUMBER IS SET, IF IT IS PRINTS THE STATUS PANE
		echo '<table>';
		echo '<tr><td>Short Description: </td><td style="width:20%;"><i>'.$s_desc.'</i></td><td></td><td></td><td></td></tr>';
		echo '<tr><td>Full Description:</td><td><i> '.$l_desc.'</i></td><td></td><td></td><td></td></tr>';
		echo '<tr><td>Assigned Name: </td><td><b>'.$a_name.'</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Assigned Group: </td><td><b>'.$a_group.'</b></td></tr>';
		echo '<tr><td>Work Order Status: </td><td><b>'.$status.'</b></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Work Order Complete Date: </td><td><b>'.$complete_date.'</b></td></tr>';
		echo '<tr><td>Parent Work Order: </td><td><b>'.$parent.'</b></td><td></td><td></td><td></td></tr>';
		echo '</table>';
		echo '<br><hr>';
		//BELOW IS CODE TO PRINT TRANSACTIONS AS SEEN IN frametwo.php IN MAIN INCLUDES FOLDER
		include '../includes/queries/frame_2_queries.php';//INCLUDES THE QUERIES FOR THIS FRAME.
		if ($size > 0) {
			while($size > 0){
				$row = mysqli_fetch_row($res);
				echo "<b>Comments</b>: ".$row[3]."<br>";
				echo "<b>Status</b>: ".$row[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Posted by</b>: ".$row[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><b>Time Stamp</b>: ".$row[2]; 
				echo "<br><b>Hours Logged</b>: ".$row[4]."<br>";
			
			echo "<hr>";
				--$size;
			}
		}
		}
		else
			echo '<b>No Work Order Selected</b><br><br><br><br><br><br><br><br><br><br><br><br>';
		//END TRANSACTION PRINTING CODE
		echo '</div>';
		
?>
			