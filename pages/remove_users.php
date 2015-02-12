<?php
	session_start();
//THIS PAGE IS THE MANAGEMENT "HUB", GIVES MANAGEMENT OPTIONS ON WHAT THEY CAN DO 
//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
       // then abort the script
	exit();
}
$notallowed=1;
include '../includes/connection.php';//File to get the connection to the databases for queries
$user = $_SESSION['username'];//gets session variable username
$q = "SELECT `id` FROM `member` WHERE `username` = '$user'";//gets user's id from the member table where their login info is stored
	$resid = mysqli_query($con,$q);
	
	$row = $resid->fetch_assoc();
    $id = $row['id'];
    
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	$myname="";
	$numb = $res->num_rows;
	if($numb >0){
		$row = $res->fetch_assoc();
		$myname = $row['name'];
	}
	//echo $myname;
	$q = "SELECT * FROM  `group` WHERE `user_name` = '$myname' AND `role` = 'Manager'";//checks if user is in the groups table and gets that info
	$res = mysqli_query($con,$q);
	$num = $res->num_rows;
	//echo $num;
	if($num == 0){
		header("location:../index.php?log=in#");
        
       // then abort the script
		exit();
	}

if(!empty($_POST['Submit2'])){
	include '../includes/queries/remove_user_queries.php';
}
include '../includes/connection.php';

?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!--Refrences the CSS style sheet held in the base CSS folder--->
</head>
<body>
	<?php include '../includes/menu.php'; //Includes the normal main menu ?>
	<?php 
	if(!isset($_POST['Submit'])){
	echo '<h1>Management Remove Users</h1>';
	echo '<form action="#" method="POST" id="utype">';
		echo '<select form="utype" name="selecttype">';
			echo '<option value="staff">Staff</option>';
			echo '<option value="fac">Faculty</option>';
		echo '</select><br>';
		echo '<input type="submit" value="Submit"  name="Submit"/>';
	echo '</form>';
	}
	else{
		$type = $_POST['selecttype'];
		if($type == 'staff'){
			$q = "SELECT `name` FROM `staff`";
			$res = mysqli_query($con,$q);
			$count = mysqli_num_rows($res);
			echo '<form action="#" method="POST" id="who">';
				echo '<select form="who" name="select_who">';
				while($count > 0){
					$name = mysqli_fetch_row($res);
					$count--;
					echo '<option value="'.$name[0].'">'.$name[0].'</option>';
				}
				echo '</select><br>';
				echo '<input type="hidden" value="staff" name="type"/>';
				echo '<input type="submit" value="Submit"  name="Submit2"/>';
			echo '</form>';
		}
		else if($type == 'fac'){
			$q = "SELECT `name` FROM `faculty`";
			$res = mysqli_query($con,$q);
			$count = mysqli_num_rows($res);
			echo '<form action="#" method="POST" id="who">';
				echo '<select form="who" name="select_who">';
				while($count > 0){
					$name = mysqli_fetch_row($res);
					$count--;
					echo '<option value="'.$name[0].'">'.$name[0].'</option>';
				}
				echo '</select><br>';
				echo '<input type="hidden" value="faculty" name="type"/>';
				echo '<input type="submit" value="Submit"  name="Submit2"/>';
			echo '</form>';
		
		
		}
	}
	?>
	<?php include '../includes/footer.php'; ?><!---ADDS THE BASIC FOOTER TO THE PAGE--->
</body>
</html>