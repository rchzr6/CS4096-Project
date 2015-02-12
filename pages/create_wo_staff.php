<?php
//THIS IS THE FIRST PAGE IN THE WORK ORDER CREATION PROCESS
	session_start();
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!---ADDS THE CSS STYLE SHEET TO THE PAGE--->
</head>
<body>
<?php 
	include '../includes/menu.php'; //ADDS THE BASIC MENU TO THE PAGE
	include '../includes/connection.php';//ESTABLISHES THE CONNECTION TO THE DATABASE
	echo '<h1>Create Staff Workorder</h1>';//LISTS HEADER THROUGH THE PHP
	//setting default variables, ESSENTIALLY INITIALIZING THEM TO NULL
	$phone = "";
	$email = "";
	$officenum = "";
	$subname = "";
	$unencyid = "";
	
	$user = $_SESSION['username'];//gets session variable username
	$q = "SELECT `id` FROM `member` WHERE `username` = '$user'";//gets user's id from the member table where their login info is stored
	$resid = mysqli_query($con,$q);
	$rid = $resid->fetch_row();
	$id = $rid[0];
	
	$q = "SELECT `name`,`room`,`phone`,`email` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	$size =mysqli_num_rows($res);
	
	if ($size >0){
		$resa = mysqli_fetch_array($res);
		$subname = $resa[0];
		$status = "Staff";
		$officenum = $resa[1];
		$phone = $resa[2];
		$email = $resa[3];
		
		
	}
	$q = "SELECT `name`,`room`,`phone`,`email` FROM  `faculty` WHERE `id_num` = '$id'";//checks if user is faculty, NOTE ONLY STORES INFO FROM STAFF OR FACULTY
	$resb = mysqli_query($con,$q);
	$size =mysqli_num_rows($resb);

	
	if ($size >0){
		$resa = mysqli_fetch_array($resb);
		$subname = $resa[0];
		$status = "Faculty";
		$officenum = $resa[1];
		$phone = $resa[2];
		$email = $resa[3];
		
	}
	
	

	
//BELOW HTML CREATES THE BASIC FORM TO DISPLAY NOTHING FANCY
?>
<div id="create_wo_form" style=" width:40%; float:left; border-style: solid; border-width: small;">
<form id="create_wo_staff" action="create_wo_staff_continue.php" style="float:left;" method="GET">
	
	
	<?php
	//if(isset($_POST['Continue'])){
	//form to get the basic info of the user
		echo 'Submitter Name: '.$subname.'<br>';
		echo 'Submitter Status: '.$status.'<br>';
		echo 'Submitter Office Number: '.$officenum.'<br>';
		echo 'Submitter Phone Number:  '.$phone.'<br>';
		echo 'Submitter E-Mail Address:  '.$email.'<br>';
		
		
		$_SESSION['status']=$status;
		$_SESSION['officenum']=$officenum;
		$_SESSION['phonenum']=$phone;
		$_SESSION['email']=$email;
		$_SESSION['subname']=$subname;
	
	
	
		echo 'Work Type:';
		echo '<select form="create_wo_staff" name="worktype" >';
			echo '<option value="Mechanical">Mechanical</option>';
			echo '<option value="Electrical/Electronic">Electrical/Electronic</option>';
			echo '<option value="Moving/Labor">Moving/Labor</option>';
			echo '<option value="Rapid Prototype">Rapid Prototype</option>';
			echo '<option value="other" onselect="loadotype()">Other</option>';
		echo '</select><br>';
		echo '<script> function loadotype(){ document.write("Other Type: <input type="text" name="othertype" value="NULL"/>"); </script>';//script to load the 'other' field
		echo '<br>';
		echo 'Work Scope:';
		echo '<select form="create_wo_staff" name="scope" >';
			echo '<option value="Research Project/Lab">Research Project/Lab</option>';
			echo '<option value="Instructional LAB">Instructional LAB</option>';
			echo '<option value="Facilities">Facilities</option>';
			echo '<option value="Student Design Team">Student Design Team</option>';
			echo '<option value="ME261">ME-261</option>';
			echo '<option value="other" onselect="loadoscope()">Other</option>';
		echo '</select><br>';
		echo '<script> function loadoscope(){ document.write("Other Scope: <input type="text" name="otherscope" value="NULL"/>"); </script>';//script to load the 'other' field
		echo '<br>';
	//}
		
		echo '<input type="submit" name="create_wo_staff" value="Continue"/>';//PRINTS THE SUBMIT BUTTON TO CONTINUE A SECOND TIME,
	?>
</form>
</div>
<?php include '../includes/footer.php'; ?><!----INCLUDES THE FOOTER--->
</body>
</html>
