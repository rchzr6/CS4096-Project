<?php
//THIS PAGE ALLOWS THE SHOP TECHS TO REVIEW WORK ORDERS AND MAKE ALLOWABLE CHANGES TO THEM
	session_start();
	
//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
        //then abort the script
	exit();
}
include '../includes/connection.php';//File to get the connection to the databases for queries
$status = 1;

if(isset($_POST['wonum']))//checks if work order number is set, and stores if it is
	$wonum = $_POST['wonum'];
if(isset($_GET['wonum']))
	$wonum = $_GET['wonum'];

if(isset($_POST['me']) && isset($_POST['group'])){//checks for validity
	echo 'Please select only one assignment filter';//prints this if not valid
	exit();
}
if(isset($_POST['Filter'])){//double checks validity and calls the queries
	include '../includes/queries/shop_tech_init_queries.php';
	//echo $q;
}
if(isset($_GET['wonum'])){//getting basic info about submitter, then converts info to php variables
	include '../includes/queries/shop_tech_queries_get_info.php';//calls additional queries to get info and store said info in php variables
}
if(empty($myname))//Checks if myname is empty and initializes it if it is not
	$myname = ' ';
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!----includes the CSS Style sheet.---->
</head>

<body>
	<?php include '../includes/menu.php'; ?><!----Includes the basic menu file--->
	<u><h1>Staff Workorder Update</h1></u>
	<div id="myResults"></div>
	<!----Form to get information about the user and work order---->
	<div id="frame" style="width:100%;">
	<div id="leftframe" style="width: 37%; float:left;"><!---creates side by side containers, then adds the frames specified to their proper place----->
	<?php
	
	
				
			include '../includes/get_names_and_group.php';
	
					include '../includes/frameone.php';//All the frames below are added in, in the correct locations, frame one is to display the basic info of the work order
					include '../includes/frametwo.php';//frame 2 is to display transactions of the work order
					// if the work order selected is NOT the users, or they are not a manager, or assigned the work order, then
					// dont display frame three.
					
					if(!empty($wonum)){	
					include '../includes/queries/check_modify_rights.php';
					if ($allowed == 1){
					
					include '../includes/framethree.php';//frame 3 is to display the area to add comments and change status and add hours
				}
				else{
				echo 'User '.$fullname.' not allowed view only for work order #'.$wonum;
				}
			}
	?>
	</div>
		<div id="rightframe" style="width: 62.9%; float:right;">
	<?php
					include '../includes/framefour-B.php';//frame four is to filter the work orders to select one
					include '../includes/framefive.php';//frame five displays the work orders after the filter
	?>
		</div>
		</div>
	<?php
	if(isset($_POST['CSD'])){
		$q = "SELECT `wo_status`,`assigned_name` FROM `work_orders` WHERE `wo_num` = $wonum";
		//echo $q;
		$res = mysqli_query($con,$q);
		$row = mysqli_fetch_row($res);
		$status = $row[0];
		$aname = $row[1];
		echo '<script>window.open("../includes/review_assign_frames/get_date.php?status='.$status.'&wonum='.$wonum.'&name='.$aname.'")</script>';
	}
	?>

	<?php include '../includes/footer.php';?><!----Includes the basic footer file---->
</body>
</html>