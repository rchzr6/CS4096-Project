
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
			$sdate = $_POST['date1'];
			$edate = $_POST['date2'];
	
?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<?php include '../../includes/menu.php'; ?>
	<?php 
	include '../connection.php';
	
	//WORK ORDERS SUBMITTED DURING THIS PERIOD
	$q = "SELECT `wo_num`,`wo_type`, `wo_status`,`wo_submit_date`, `wo_short_description` FROM `work_orders` WHERE `wo_submit_date` >= '$sdate' AND `wo_submit_date` <= '$edate' ORDER BY `wo_type`";
	//echo $q;
	$wonums = mysqli_query($con,$q);
	$count = mysqli_num_rows($wonums);
	echo '<h2>Work Orders Submitted During Date Range</h2>';
	echo '<b>Date Range: '.$sdate.' - '.$edate.'</b><br><br>';
	echo '<table><tr><th>Work Order Number</th><th>&nbsp;</th><th>Hours Logged In Date Range</th><th>&nbsp;</th><th>Group</th><th>&nbsp;</th><th>Status</th><th>&nbsp;</th><th>Submit Date</th><th>&nbsp;</th><th>Short Description</th></tr>';
	while($count > 0){
		$count--;
		$nums = mysqli_fetch_row($wonums);
		$num = $nums[0];
		$type = $nums[1];
		$status = $nums[2];
		$subdate = $nums[3];
		$sdesc = $nums[4];
		$ssdate = new DateTime($subdate);
		$ssdate->modify('+1 day');
		$subdate = $ssdate->format('Y-m-d');
		$edate++;
		$t = "SELECT SUM(hours_logged_now),`wo_num` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` < '$edate' AND `hours_logged` > 0";
		//echo $t.';<br>';
		$hours = mysqli_query($con,$t);
		$hour = mysqli_fetch_row($hours);
		if(!empty($hour[0]))
			echo '<tr><td><center>'.$num.'</center></td><td>&nbsp;</td><td><center>'.$hour[0].'</center></td><td>&nbsp;</td><td><center>'.$type.'</center></td><td>&nbsp;</td><td><center>'.$status.'</center></td><td>&nbsp;</td><td><center>'.$subdate.'</center></td><td>&nbsp;</td><td>'.$sdesc.'</td></tr>';
	
	}
	echo '</table><br><br>';
	
	//WORK ORDERS NOT CLOSED OR SUBMITTED DURING PERIOD
	$q = "SELECT `wo_num`, `wo_type`,  `wo_status`,`wo_submit_date`,`wo_short_description` FROM `work_orders` WHERE (`wo_submit_date` < '$sdate' OR `wo_submit_date` > '$edate') AND (`wo_status` != 'CLOSED' OR `wo_status` != 'Closed') ORDER BY `wo_type`";
	//echo $q;
	$wonums = mysqli_query($con,$q);
	$count = mysqli_num_rows($wonums);
	echo '<h2>Work Orders Not Submitted or Closed During Date Range</h2>';
	echo '<b>Date Range: '.$sdate.' - '.$edate.'</b><br><br>';
	echo '<table><tr><th>Work Order Number</th><th>&nbsp;</th><th>Hours Logged In Date Range</th><th>&nbsp;</th><th>Group</th><th>&nbsp;</th><th>Status</th><th>&nbsp;</th><th>Submit Date</th><th>&nbsp;</th><th>Short Description</th></tr>';
	while($count > 0){
		$count--;
		$nums = mysqli_fetch_row($wonums);
		$num = $nums[0];
		$type = $nums[1];
		$status = $nums[2];
		$subdate = $nums[3];
		$sdesc = $nums[4];
		$ssdate = new DateTime($subdate);
		$ssdate->modify('+1 day');
		$edate++;
		$t = "SELECT SUM(hours_logged_now),`wo_num` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` < '$edate' AND `hours_logged` > 0";
		//echo $t;
		$hours = mysqli_query($con,$t);
		$hour = mysqli_fetch_row($hours);
		if(!empty($hour[0]))
			echo '<tr><td><center>'.$num.'</center></td><td>&nbsp;</td><td><center>'.$hour[0].'</center></td><td>&nbsp;</td><td><center>'.$type.'</center></td><td>&nbsp;</td><td><center>'.$status.'</center></td><td>&nbsp;</td><td><center>'.$subdate.'</center></td><td>&nbsp;</td><td>'.$sdesc.'</td></tr>';
	
	}
	echo '</table><br><br>';

	//WORK ORDERS CLOSED BUT NOT SUBMITTED IN THIS PERIOD
	$q = "SELECT `wo_num`, `wo_type`, `wo_status`,`wo_submit_date`,`wo_short_description` FROM `work_orders` WHERE (`wo_submit_date` < '$sdate' OR `wo_submit_date` > '$edate') AND (`wo_status` = 'CLOSED' OR `wo_status` = 'Closed') ORDER BY `wo_type`";
	$wonums = mysqli_query($con,$q);
	$count = mysqli_num_rows($wonums);
	echo '<h2>Work Orders Closed During Date Range</h2>';
	echo '<b>Date Range: '.$sdate.' - '.$edate.'</b><br><br>';
	echo '<table><tr><th>Work Order Number</th><th>&nbsp;</th><th>Hours Logged In Date Range</th><th>&nbsp;</th><th>Group</th><th>&nbsp;</th><th>Status</th><th>&nbsp;</th><th>Closed Date</th><th>&nbsp;</th><th>Short Description</th></tr>';
	while($count > 0){
		$count--;
		$nums = mysqli_fetch_row($wonums);
		$num = $nums[0];
		$type = $nums[1];
		$status = $nums[2];
		$subdate = $nums[3];
		$sdesc = $nums[4];
$edate++;
		$t = "SELECT SUM(hours_logged_now),`wo_num`, `Date/Time` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` < '$edate' AND `hours_logged` > 0";
				//echo $t;

		$hours = mysqli_query($con,$t);
		$hour = mysqli_fetch_row($hours);
		$subdate = $hour[2];
		$ssdate = new DateTime($subdate);
		$ssdate->modify('+1 day');
		$subdate = $ssdate->format('Y-m-d');
		if(!empty($hour[0]))
			echo '<tr><td><center>'.$num.'</center></td><td>&nbsp;</td><td><center>'.$hour[0].'</center></td><td>&nbsp;</td><td><center>'.$type.'</center></td><td>&nbsp;</td><td><center>'.$status.'</center></td><td>&nbsp;</td><td><center>'.$subdate.'</center></td><td>&nbsp;</td><td>'.$sdesc.'</td></tr>';
	
	}
	echo '</table>';
	?>
	<?php include '../../includes/footer.php'; ?>
</body>
</html>