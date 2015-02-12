<?php

// this include gets the name of full name of the user and his group affiliation.
	$logname=$_SESSION['username'];
		
	$fullname = "unresolved ";
	$mygroup = " ";
		
	$q = "SELECT `id` FROM `member` WHERE `username` = '$logname'";//gets user's id from the member table where their login info is stored
	//echo $q;
	$resa = mysqli_query($con,$q);
		$resar = $row = $resa->fetch_assoc();
	$id = $resar['id'];
	//echo $id;
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	if(mysqli_num_rows($res) >0)
		$fullname = mysqli_fetch_row($res)[0];
	$q = "SELECT `name` FROM  `faculty` WHERE `id_num` = '$id'";//checks if user is faculty, NOTE ONLY STORES INFO FROM STAFF OR FACULTY
	$res = mysqli_query($con,$q);
	if(mysqli_num_rows($res) >0)
		$fullname = mysqli_fetch_row($res)[0];
		$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$fullname'";//gets the group of the user
		$res = mysqli_query($con,$q);
		if(mysqli_num_rows($res) > 0)
			$mygroup = mysqli_fetch_row($res)[0];
	?>