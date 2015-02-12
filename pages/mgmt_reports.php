<?php
//THIS PAGE IS TO HELP EASILY ADD USERS TO THE MEMBER DATABASE TABLE WHILE ALSO ADDING THEM TO THE FACULTY/STAFF DB AND IF FACULTY TO THE GROUP DB
	session_start();//starts a session IMPORTANT TO PROTECT PAGES
	
//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
        //then abort the script
	exit();
}
include '../includes/connection.php';

if(isset($_POST['Submit'])){
$report = $_POST['select_action'];

if($report == "ism"){
			echo '<script>window.open("../includes/review_assign_frames/assign_wo.php?status=ASSIGNED&wonum='.$wonum.'&name='.$aname.'&group='.$type.'")</script>';

}
if($report == "smd"){
			echo '<script>window.open("../includes/review_assign_frames/assign_wo.php?status=ASSIGNED&wonum='.$wonum.'&name='.$aname.'&group='.$type.'")</script>';

}
if($report == "wos"){
			echo '<script>window.open("../includes/review_assign_frames/assign_wo.php?status=ASSIGNED&wonum='.$wonum.'&name='.$aname.'&group='.$type.'")</script>';

}

}

?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!--Refrences the CSS style sheet held in the base CSS folder--->
</head>
<body>
	<?php include '../includes/menu.php'; //Includes the normal main menu ?>
	<h1>Management Reports</h1>
	<form action="#" method="POST" name="reportform">
		<select form="reportform" name="select_action">
			<option value="ism">Idividual Staff Member</option>
			<option value="smd">Staff Member by Day</option>
			<option value="wos">Work Order Status</option>
		</select><br>
		<input type="submit" value="Submit"  name="Submit"/>
	</form>
	
	<?php include '../includes/footer.php'; ?><!---ADDS THE BASIC FOOTER TO THE PAGE--->
</body>
</html>