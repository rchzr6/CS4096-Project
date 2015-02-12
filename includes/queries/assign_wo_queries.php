<?php
//QUERIES TO PRINT OUT THE OPTIONS FOR ASSIGNING A WORKORDER INSIDE THE USER'S GROUP
			include '../connection.php';
			$group = $_GET["group"];
	
			$q = "SELECT `user_name` FROM `group` WHERE `group_name` = '$group'";
			$res = mysqli_query($con,$q);
			$count = mysqli_num_rows($res);
			
?>