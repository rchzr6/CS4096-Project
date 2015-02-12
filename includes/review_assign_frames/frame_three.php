<?php
//FRAME THREE OF REVIEW AND ASSIGN LIST -- GETS FILTER INFO AND SUBMITS IT FOR FRAME FOUR
	include '../includes/connection.php';
	$id = $_SESSION['UID'];//GETS THE ID FROM SESSION VAR
	$q = "SELECT `name` FROM `faculty` WHERE `id_num` = '$id'";
	$res = mysqli_query($con,$q);
	$resa =mysqli_fetch_array($res);
	$user = $resa[0];

	$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$user'";
	$res = mysqli_query($con,$q);
		if(mysqli_num_rows($res) == 1 || mysqli_num_rows($res) == 0)
		$check = true;
	else
		$check = false;
	
?>

<div id="rev_assign_frame_three" style="border-style: solid; border-width: small;height:100px;">
	<form id="view_and_filter" method="post" action="#">
		<b>View By</b> 
		<select form="view_and_filter" name="view">
			<option value= "ME" >Assigned To Me</option>
			
				<!--  This part builds the list of what groups to filter on for the dropdown -->
				<!--      If it cant find any groups it just puts "Assigned to Group" in place of the -->
				<!--      real groups   -->
				<?php
				if($check == true) 
					echo '<option value="group">Assigned To Group</option>'; 
				else{
					$size = mysqli_num_rows($res);
					while($size > 0){
						$row = mysqli_fetch_row($res);
						echo '<option value="'.$row[0].'">Assigned to '.$row[0].' group</option>';
						--$size;
					}
				}
			?>
			<option value="ALL">All</option>
		</select>
		<br>
		<b>Filter By</b>
		<select form="view_and_filter" name="filter">
			<option value="New">New</option>
			<option value="ALL">All</option>
			<option value="Closed">Closed</option>
			<option value="Done">Done</option>
			<option value="In Progress">In Progress</option>
			<option value="Hold">Hold</option>
			<option value="Waiting On Parts">Waiting On Parts</option>
			<option value="Waiting On Cost">Waiting On Cost</option>
			<option value="Assigned">Assigned</option>
		</select><br>
		<b>Organize By</b>
		<?php
		echo '<select form="view_and_filter" name="organize">';
		echo '<option value="number">Work Order Number</option>';
		echo '<option value="sdate">Start Date</option>';
		echo '<option value="ddate">Due Date</option>';
		echo '<option value="tree">Tree - PRINTS ALL WORK ORDERS</option>';
		echo '</select><br>'; ?>
		<input type="submit" value="Go"  name="Go"/>
	</form>
</div>