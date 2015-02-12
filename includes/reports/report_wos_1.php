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
?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
	 <script language="javascript" src="../../calendar/calendar.js"></script>

</head>
<body>
	<?php include '../../includes/menu.php'; ?>
	<!----FORM TO ENTER COMMENTS----->
	<h1>Date Range:</h1>
	<form id="getdate" action="report_wos_2.php" method="post">
		<b>Start Date:</b> </br>
<?php
	  require('../../calendar/classes/tc_calendar.php');
	  $year = date("Y");
	  $eyear = $year + 3;
	  $tyear = date(2014);
	  $timestamp = strtotime('+3 years');
	  $eallow = date('Y-m-d', $timestamp);
      $myCalendar = new tc_calendar("date1", true);
	  $myCalendar->setIcon("../../calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date("d"),date("m"), date("Y"));
	  $myCalendar->setPath("../../calendar/");
	  $myCalendar->setYearInterval($tyear, $eyear);
	  $myCalendar->dateAllow(date(2014-01-01));
	  $myCalendar->writeScript();
	  ?>
	  <br><br><br><br><b>End Date:</b> </br>
<?php
	  $year = date("Y");
	  $eyear = $year + 3;
	  $tyear = date(2014);
	  $timestamp = strtotime('+3 years');
	  $eallow = date('Y-m-d', $timestamp);
      $myCalendar = new tc_calendar("date2", true);
	  $myCalendar->setIcon("../../calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date("d"),date("m"), date("Y"));
	  $myCalendar->setPath("../../calendar/");
	  $myCalendar->setYearInterval($tyear, $eyear);
	  $myCalendar->dateAllow(date(2014-01-01));
	  $myCalendar->writeScript();
	  ?>
	  <br><br><br><br>
		<input type="submit" value="Submit" name="Submit" />
	</form>	
	<?php include '../../includes/footer.php'; ?>
</body>
</html>