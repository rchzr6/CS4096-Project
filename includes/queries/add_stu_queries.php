<?php
	$user = $_POST['id'];
	$id = SHA1($_POST['id']);//encrypts ID number 
	$pass = SHA1($_POST['password']);//encrypts password
	$q = "SELECT * FROM `stu_member`";
	$res = mysqli_query($con,$q);
	$e = mysqli_num_rows($res);
	$q = "INSERT INTO `stu_member`(id,username,password,mem_id) VALUES ('$id','$user','$pass','$e')";//inserts info into member table for login
	//echo $q;
	mysqli_query($con,$q);
	echo 'Account Created, redirecting to new page now<br>If not redirected <a href="../../pages/stu_login.php">Click Here</a>';
	
	include '../includes/redirectsix.php';
	

	?>