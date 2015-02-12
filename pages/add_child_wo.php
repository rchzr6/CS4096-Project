<?php
	include '../includes/connection.php';
	if(isset($_POST['submit'])){
		$pnum = $_GET['wonum'];
		
		//gets new work order number
		$q = "SELECT MAX(wo_num) FROM `work_orders`";
		$res = mysqli_query($con,$q);
		$newnum = mysqli_fetch_row($res)[0];
		$newnum++;
		
		//gets base work order info
		$q = "SELECT * FROM `work_orders` WHERE `wo_num` = '$pnum'";
		$res = mysqli_query($con,$q);
		$resa = $row = $res->fetch_assoc();
		$aname = $resa['assigned_name'];
		$advisor = "";
		$count = $resa['children'];
		$count++;
		$psdate = $resa['start_date'];
		
		//Gets staff members info
		$q = "SELECT * FROM `staff` WHERE `name` = '$aname'";
		//echo $q.'<br>';
		$res = mysqli_query($con,$q);
		$resa = $row = $res->fetch_assoc();
		$phone = $resa['phone'];
		$email = $resa['email'];
		$officenum = $resa['room'];
		
		//gets submitted info
		$type = $_POST['worktype'];
		$scope = $_POST['scope'];
		$longd = $_POST['fulldesc'];
		$shortd = $_POST['shortdesc'];
		$subname = $aname;
		$statust = 'staff';
		$q = "SELECT * FROM `work_orders` WHERE `wo_num` = '$pnum'";
		$res = mysqli_query($con,$q);
		$duedate = $_POST['date1'];
		
		//Exe queries
		$q = "INSERT INTO work_orders(wo_num,wo_status,submitter_status,submitter_name,submitter_room_num,submitter_phone,submitter_email,wo_scope,wo_type,assigned_name,assigned_group) VALUES ('$newnum','New','$statust','$subname','$officenum','$phone','$email','$scope','$type','$aname','$type');";
		mysqli_query($con,$q);
		$q = "UPDATE `work_orders` SET `wo_short_description` = '$shortd', `wo_long_description` = '$longd', `due_date` = '$duedate', `submitter_advisor` = '$advisor', `parent_wo_num` = '$pnum' WHERE `wo_num` = $newnum";
		mysqli_query($con,$q);
		if(isset($_POST['sdate'])){
			$q = "UPDATE `work_orders` SET `start_date` = '$psdate'";
			mysqli_query($con,$q);
		}
		$q = "UPDATE `work_orders` SET `children` = '1' WHERE `wo_num` = '$pnum'";
		mysqli_query($con,$q);
		$today = date('Y-m-d');
		if(isset($_POST['pdate']))
			$q = "UPDATE `work_orders` SET `start_date` = '$psdate' WHERE `wo_num` = '$newnum'";
		else
			$q = "UPDATE `work_orders` SET `start_date` = '$psdate' WHERE `wo_num` = '$today'";
		mysqli_query($con,$q);
		if(isset($_POST['sdate']))
			header( 'Location: ../pages/shop_tech.php?wonum='.$newnum.'' );

		//include '../includes/handle_file.php';
		//include '../includes/handlefiles.php';
}
		?>

<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!----includes the CSS Style sheet.---->
	 	 <script language="javascript" src="../calendar/calendar.js"></script>

</head>

<body>
	<?php include '../includes/menu.php'; ?><!----Includes the basic menu file--->
	<form id="create_wo" action="#" method="POST">
	<!----Get work order to create child of---->
	Parent Work Order Number: <?php $wonum = $_GET['wonum']; echo ' '.$wonum.'<br><br>'; ?>
	<!----Get child scope, type, and descriptions---->
	<?Php 
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
		echo '<br>';
	?>
	<br>
<b>Due Date:</b> </br>
<?php
	  require('../calendar/classes/tc_calendar.php');
	  $year = date("Y");
	  $eyear = $year + 3;
	  $timestamp = strtotime('+3 years');
	  $eallow = date('Y-m-d', $timestamp);
      $myCalendar = new tc_calendar("date1", true);
	  $myCalendar->setIcon("../calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date("d"),date("m"), date("Y"));
	  $myCalendar->setPath("../calendar/");
	  $myCalendar->setYearInterval($year, $eyear);
	  $myCalendar->dateAllow(date("Y-m-d"), $eallow);
	  $myCalendar->writeScript();
	  ?>
<br><br>
<b>Short Description:</b><br> <textarea maxlength="250" name="shortdesc" form="create_wo" style="float:left;" cols="70" rows="4">Short Description</textarea><br><br><br><br><br>
<b>Full Description of Work:</b><br> <textarea name="fulldesc" form="create_wo" style="float:left; " rows="20" cols="70">Full Description</textarea><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!----	<b>Upload File: </b>
	<p><b><i>NOTE: Our system will only handle file names with no spaces. Please replace all spaces with underscores.<br>In addition, please upload all your files in one zip file.</i></b></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="3500000">
        <input name="file" type="file" id="file" size="50">
<br><br> ---->
<b>Assigned To Me:</b> <input type="checkbox" value="sdate" name="sdate"/><br><br>
<b>Start Date Same As Parent:</b> <input type="checkbox" value="pdate" name="pdate"/><br><br>


	<!---Submit work order--->
<input type="submit" value="Submit" name="submit" />
</form>


	<?php include '../includes/footer.php';?><!----Includes the basic footer file---->
</body>
</html>