<?php
session_start();

if($_SESSION['go'] != TRUE)
	header( 'Location: ../index.php' );
else
	$_SESSION['go'] = FALSE;
//This is the second page in the work order creation process.
//It handles getting the descriptions of the work order and getting the appropriate files
include '../includes/connection.php';

$fault = FALSE;//variable to check for an error
//gets variables from previous page
$status = $_GET['status'];
$newnum = $_GET['wonum'];
$modify = $_GET['modify'];
if(ISSET($_POST['advisor']))
	$advisor = $_POST['advisor'];//checks to see if an advisor is already set
//FILE HANDLING STARTS HERE PLEASE DO NOT EDIT xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
if(isset($_POST['submit'])){

include '../includes/fileuploads.php';

		//GETS THE FILE NAME AND DESCRIPTIONS
		//$fname = $_FILES['fileToUpload']['name']; 
		$fname = $fileName;
		$shortd  = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($_POST['shortdesc']))))));
		$longd  = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($_POST['fulldesc']))))));
		$duedate = $_POST['date1'];
		//echo $duedate.'<br>';
		//include '../includes/queries/create_wo_last.php'; // FOR SOME REASON THE FILE WONT INCLUDE RIGHT SO THE CODE IS DIRECTLY BELOW
		if($uploadOk == 0)
			$file = $fname;
		else
			$file = 'NO_FILES.php';
		//UPDATES THE WORK ORDER TO REFLECT THE DESCRIPTIONS, FILE, AND ADVISOR
		$q = "UPDATE `work_orders` SET `wo_short_description` = '$shortd', `wo_long_description` = '$longd', `due_date` = '$duedate', `wo_file_list` = '$file' , `submitter_advisor` = '$advisor' WHERE `wo_num` = $newnum";
		//echo $q;
		mysqli_query($con,$q);
		//GETS LATEST TRANSACTION NUMBER AND INCREMENTS BY 1
		$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
		$res = mysqli_query($con,$q);
		$resa = mysqli_fetch_row($res);
		$tnum = $resa[0];
		$tnum++;
		//CREATES NEW TRANSACTION
		//$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments,hours_logged) VALUES ($tnum,$newnum,'New','$name','Work Order Submitted','0')";
		//mysqli_query($con,$q);
		//REDIRECTS TO A CONFIRMATION OF SUCCESSFUL CREATION
		include '../includes/redirectthree.php';

	
}
//END OF FILE HANDLING xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
	 <script language="javascript" src="../calendar/calendar.js"></script>
</head>
<body>
<?php 
if($status != 'Staff' && $status != 'Faculty')
include '../includes/stu_menu.php'; 
else
include '../includes/menu.php';

if($fault == TRUE)
	echo 'Error: There is an error in your submission. Please try again.<br>';
if(isset($_GET['newnum']))
	$newnum = $_GET['newnum'];
	
//echo $newnum;
include '../includes/queries/get_info.php';//gets the basic info of the user
//creating the containing and the form
echo '<div id="create_wo_form" style=" width:50%; float:left; border-style: solid; border-width: small;">';
echo '<form id="createwotwo" action="#" style="float:left;" method="POST" enctype="multipart/form-data">';
echo '<b>Submitter Status: </b>';
if($modify){ //checking to see if modify is allowed or not
	echo '<select form="create_wo_two" name="status" required>';
	echo '<option value="'.$status.'" selected="selected">'.$status.'</option>';
	if($status == 'Undergraduate Student') //creating status options
		echo '<option value="Graduate Student">Graduate Student</option>';
	else
		echo '<option value="Undergraduate Student">Undergraduate Student</option>';
	echo '</select><br>';
}
else
	echo $status.'<br>';
//printing variables

echo '<b>Submitter Name: </b>'.$name.'<br>';
echo '<b>Submitter Office: </b>'.$office.'<br>';
echo '<b>Submitter Phone: </b>'.$phone.'<br>';
echo '<b>Submitter Email: </b>'.$email.'<br>';
echo '<b>Work Type: </b>'.$type.'<br>';
echo '<b>Work Scope: </b>'.$scope.'<br>';
echo '<b>Submitter Advisor: </b>';
if($modify){
	include '../includes/queries/get_advisors.php'; //getting list of advisors and creating selection form
}
else
	echo $advisor;

?>
<!---Descriptions and files area--->
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
<b>Short Description:</b> <textarea maxlength="250" name="shortdesc" form="createwotwo" style="float:right;" cols="70" rows="4" required>Short Description</textarea><br><br><br><br><br>
<b>Full Description of Work:</b> <textarea name="fulldesc" form="createwotwo" style="float:right; " rows="20" cols="70" required>Full Description</textarea><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<b>Upload File: </b>
	<p><b><i>NOTE: Our system will only handle file names with no spaces. Please replace all spaces with underscores.<br>In addition, if you have multiple files, please upload all your files in one zip file.</i></b></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="3500000">
        <input type="file" name="fileToUpload" id="fileToUpload">
<br><br>
<input type="submit" value="Submit" name="submit" />
</form>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>