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
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php include '../includes/menu.php'; ?>
	<h3>Review/Assign WorkOrders:</h3>
	<div id="revassign" style="width:100%; height:700px;">
	<div id="revassignleft" style="width:40%; float:left; height: 700px;">
		<?php include '../includes/review_assign_frames/frame_one.php'; ?>
		<?php include '../includes/review_assign_frames/frame_two.php'; ?>
	</div>
	<div id="revassignright" style="width:59.9%;float:right; height: 700px;">
		<?php include '../includes/review_assign_frames/frame_three.php'; ?>
		<?php include '../includes/review_assign_frames/frame_four.php'; ?>
		<?php include '../includes/review_assign_frames/frame_five.php'; ?>

	</div>
	</div>

	<?php include '../includes/footer.php'; ?>
</body>
</html>