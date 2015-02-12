<?php
if($status == 'Undergraduate Student' || $status == 'Graduate Student'){
	$q = "SELECT `room_number`,`phone`,`email` FROM `student` WHERE `id` = '$subid' AND `Name` = '$subname'";
	$res= mysqli_query($con,$q);
	$rowc = mysqli_num_rows($res);
	if($rowc >= 1){
		$row = $row = $res->fetch_assoc();;
		$officenum = $row['room_number'];
		$phone = $row['phone'];
		$email = $row['email'];
	}
	else{
		if($status == 'Undergraduate Student')
			$q = "INSERT INTO student(id,Name,status) VALUES ('$subid','$subname','ugrad')";
		else
			$q = "INSERT INTO student(id,Name,status) VALUES ('$subid','$subname','grad')";
		mysqli_query($con,$q);
	}
}
if($status == 'Staff'){
	$q = "SELECT `room`,`phone`,`email` FROM `staff` WHERE `id_num` = '$subid' AND `Name` = '$subname'";
	$res= mysqli_query($con,$q);
	$rowc = mysqli_num_rows($res);
	if($rowc == 1){
		$row = $row = $res->fetch_assoc();;
		$officenum = $row['room'];
		$phone = $row['phone'];
		$email = $row['email'];
	}
}
if($status == 'Faculty'){
	$q = "SELECT `room`,`phone`,`email` FROM `faculty` WHERE `id_num` = '$subid' AND `Name` = '$subname'";
	$res= mysqli_query($con,$q);
	$rowc = mysqli_num_rows($res);
	if($rowc == 1){
		$row = $row = $res->fetch_assoc();;
		$officenum = $row['room'];
		$phone = $row['phone'];
		$email = $row['email'];
	}
}
?>
