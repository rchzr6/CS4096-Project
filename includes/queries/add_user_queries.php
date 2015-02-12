<?php
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$group = $_POST['worktype'];
	$role = $_POST['role'];
	$user = $_POST['user'];
	$id = SHA1($_POST['id']);//encrypts ID number 
	$pass = SHA1($_POST['password']);//encrypts password
	$type = $_POST['type'];
	$room = $_POST['room'];
	$phone = $_POST['phone'];
	$email = $_POST['id'];
	$name = $lname.', '.$fname;
	$q = "SELECT * FROM `member`";
	$res = mysqli_query($con,$q);
	$mid = mysqli_num_rows($res);
	$mid = $mid + 1;
	$q = "INSERT INTO `member`(id,username,password,mem_id) VALUES ('$id','$user','$pass','$mid')";//inserts info into member table for login
	//echo $q;
	mysqli_query($con,$q);
	//echo $q;
	$q = "INSERT INTO ".$type."(id_num,name,room,phone,email) VALUES ('$id','$name','$room','$phone','$email')";//inserts info into either staff or faculty table for info use.
	mysqli_query($con,$q);
	if($type == 'staff'){
		$q = "SELECT `entry` FROM `group` ORDER BY `entry` DESC";
		$res = mysqli_query($con,$q);
		$resa = $row = $res->fetch_row();
		$value = $resa[0];
		$value++;
		$q = "INSERT INTO `group`(`user_name`, `group_name`, `role`,`entry`) VALUES ('$name','$group','$role','$value')";
		mysqli_query($con,$q);
	}
	//echo $q;
	?>