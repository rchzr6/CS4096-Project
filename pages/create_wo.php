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
	include '../includes/stu_menu.php'; //ADDS THE BASIC MENU TO THE PAGE
	include '../includes/connection.php';//ESTABLISHES THE CONNECTION TO THE DATABASE
	echo '<h1>Create Workorder: Phase 1</h1>';//LISTS HEADER THROUGH THE PHP
	//setting default variables, ESSENTIALLY INITIALIZING THEM TO NULL
	$phone = "";
	$email = "";
	$officenum = "";
	$subname = "";
	$unencyid = "";
	if(isset($_POST['Continue'])){//CHECKS WHICH VERSION OF THE FORM WAS SUBMITTED
	//CAPTCH CHECK BEGINxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx THIS IS DIRECTLY GIVEN BY THE CAPTCHA DOWNLOADED DO NOT EDIT
		include_once '../securimage/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			echo "The security code entered was incorrect.<br /><br />";
			echo "Please try again.";
			unset($_POST['Continue']);
		}
		else{
			$subid = SHA1($_POST['idnum']);//encrypts the ID of the user if the captcha is correct
			$unencyid =$_POST['idnum'];
			$subname = $_POST['subname'];
			$status = $_POST['status'];
			include '../includes/queries/create_wo_load_data_query.php';//CALLS THE QUERY TO LOAD THE DATA FOR THE WORK ORDER
		}
		//CAPTCHA CHECK ENDxxxxxxxxxxxxxxxxxxxxxxxxxxx
	}
	if(isset($_POST['Continuetwo'])){//CHECKS WHICH VERSION OF THE FORM WAS SUBMITTED

			//SETS THE VARIABLES TO THE PROPER POST
			$status = $_POST['status'];
			$subid = SHA1($_POST['idnum']);
			$unencyid =$_POST['idnum'];//SETS ID VAR TO DISPLAY IN CASE USER FORGETS EMAIL
			$subname = $_POST['subname'];
			$officenum = $_POST['officenum'];
			$phone = $_POST['phonenum'];
			$email = $_POST['email'];
			$type = $_POST['worktype'];
			if(!empty($_POST['othertype']))	//checks if othertype is set, if yes, replaces the type with other type
				$type = $_POST['othertype'];
			$scope = $_POST['scope'];
			if(!empty($_POST['otherscope']))	//checks if otherscope is set, if yes, replaces the scope with otherscope
				$scope = $_POST['otherscope'];
			if(!empty($email))
				include '../includes/queries/create_wo_queries.php';//CALLS THE NEXT SET OF QUERIES TO CONTINUE CREATION OF WORK ORDER
			else{
				echo '<b>Email is required to continue</b>';//PRINTS ERROR 
				$_POST['Continue'] = 'Continue';//SETS VARIABLE SO USER DOES NOT NEED TO START OVER ON THE PAGE WITH CAPTCHA
			}
			
		}

	
//BELOW HTML CREATES THE BASIC FORM TO DISPLAY NOTHING FANCY
?>
<div id="create_wo_form" style=" width:40%; float:left; border-style: solid; border-width: small;">
<form id="create_wo" action="#" style="float:left;" method="POST">
	Submitter Status:
	<select form="create_wo" name="status" required>
	<?php
		if(!empty($status))
			echo '<option value="'.$status.'" selected="selected">'.$status.'</option>';
	?>
		<option value="Undergraduate Student">Undergraduate Student</option>
		<option value="Graduate Student">Graduate Student</option>
		
	</select>
	<br>
	Submitter Email (MUST BE MST EMAIL): <input type="text" name="idnum" value="<?php echo $unencyid; ?>"></input><br>
	Submitter Name: <input type="text" name="subname" value="<?php echo $subname; ?>" ></input><br>
	<?php
	if(isset($_POST['Continue'])){
	//form to get the basic info of the user
		echo 'Submitter Office Number: <input type="text" name="officenum" value='.$officenum.' ></input><br>';
		echo 'Submitter Phone Number: <input type="text" name="phonenum" value='.$phone.' ></input><br>';
		echo 'Submitter Preferred E-Mail Address: <input type="text" name="email" value='.$email.' ><br>';
	
		echo 'Work Type:';
		echo '<select form="create_wo" name="worktype" >';
			echo '<option value="Mechanical">Mechanical</option>';
			echo '<option value="Electrical/Electronic">Electrical/Electronic</option>';
			echo '<option value="Moving/Labor">Moving/Labor</option>';
			echo '<option value="Rapid Prototype">Rapid Prototype</option>';
			echo '<option value="other" onselect="loadotype()">Other</option>';
		echo '</select><br>';
		echo '<script> function loadotype(){ document.write("Other Type: <input type="text" name="othertype" value="NULL"/>"); </script>';//script to load the 'other' field
		echo '<br>';
		echo 'Work Scope:';
		echo '<select form="create_wo" name="scope" >';
			echo '<option value="Research Project/Lab">Research Project/Lab</option>';
			echo '<option value="Instructional LAB">Instructional LAB</option>';
			echo '<option value="Facilities">Facilities</option>';
			echo '<option value="Student Design Team">Student Design Team</option>';
			echo '<option value="ME261">ME-261</option>';
			echo '<option value="other" onselect="loadoscope()">Other</option>';
		echo '</select><br>';
		echo '<script> function loadoscope(){ document.write("Other Scope: <input type="text" name="otherscope" value="NULL"/>"); </script>';//script to load the 'other' field
		echo '<br>';
	}
	?>
	<?php
	if(!isset($_POST['Continue'])){
		echo '<input type="submit" name="Continue" value="Continue"/>';
		include '../includes/captcha.php';//includes the captch on the first page only
	}
	else
		echo '<input type="submit" name="Continuetwo" value="Continue"/>';//PRINTS THE SUBMIT BUTTON TO CONTINUE A SECOND TIME,
	?>
</form>
</div>
<?php include '../includes/footer.php'; ?><!----INCLUDES THE FOOTER--->
</body>
</html>
