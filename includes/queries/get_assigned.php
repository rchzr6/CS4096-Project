<?php
// get the list of user names that are managers for the group being checked.
	$q = "SELECT `user_name` FROM `group` WHERE `group_name` = '$type' AND role = 'Manager'";
	$res = mysqli_query($con,$q);
	$resar = mysqli_fetch_row($res);
	$aname = $resar[0];
?>