<?php
	$id = $_SESSION['UID'];
	$q = "SELECT `name` FROM `faculty` WHERE `id_num` = '$id'";
	$res = mysqli_query($con,$q);
	$resa = $row = $res->fetch_assoc();;
	$namear = $resa[0];
	$q = "SELECT COUNT(group_name) FROM `group` WHERE `user_name` = '$namear'";
	$res = mysqli_query($con,$q);
	$row = mysqli_fetch_row($res);
	$count = $row[0];
	if($count > 1){
		//put group select here
		$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$namear'";
		$res = mysqli_query($con,$q);
		echo '<select form="filter" name="groupfilter">';
		while($count > 0){
			$row = mysqli_fetch_row($res);
			echo '<option value="'.$row[0].'">'.$row[0].'</option>';
			$count--;
		}
		echo '</select><br>';
	}
	
	
	

?>