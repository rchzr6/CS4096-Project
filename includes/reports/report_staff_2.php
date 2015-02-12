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
			
// report for each staff member
// how many wo did they complete/work on
// how many hours on each work order
// generate data for a given date range
// only transactions within the date range
// print as table

?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<?php include '../../includes/menu.php'; ?>
	<?php include '../../includes/connection.php'; ?>
	<h1>Staff Member Work Report</h1>
	
	<?php
		echo '<b>Date Range: '.$sdate.' - '.$edate.'</b><br><br>';

		$q = "SELECT `name` FROM `staff`";
		$staffm = mysqli_query($con,$q);
		$count = mysqli_num_rows($staffm);
		while($count > 0){
			$count--;
			$ar = mysqli_fetch_array($staffm);
			$name = $ar[0];
			$q = "SELECT DISTINCT(wo_num) FROM `transaction` WHERE `transaction_by` = '$name' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate'";
			$trans = mysqli_query($con,$q);
			$c2 = mysqli_num_rows($trans);
			echo '<h2>Staff Member: '.$name.'</h2><br>';
			echo '<table><tr><th>Work Order Number</th><th>&nbsp;</th><th>Hours Worked For Period</th><th>&nbsp;</th><th>Due Date</th><th>&nbsp;</th><th>Short Description</th></tr>';
			while($c2 > 0){
				$c2--;
				$ar2 = mysqli_fetch_array($trans);
				$num = $ar2[0];
				$q = "SELECT `due_date`, `wo_short_description` FROM `work_orders` WHERE `wo_num` = '$num'";
				$res4 = mysqli_query($con,$q);
				$ar4 = mysqli_fetch_array($res4);
				$q = "SELECT SUM(hours_logged_now) FROM `transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate' AND `hours_logged` > 0";
				$hoursres = mysqli_query($con,$q);
				$ar3 = mysqli_fetch_array($hoursres);
				echo '<tr><td><center>'.$num.'</center></td><td>&nbsp;</td><td><center>'.$ar3[0].'</center></td><td>&nbsp;</td><td><center>'.$ar4[0].'</center></td><td>&nbsp;</td><td>'.$ar4[1].'</td></tr>';
			
			}
			echo '</table>';
			$q = "SELECT SUM(hours_logged_now) FROM `transaction` WHERE `transaction_by` = '$name' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate' AND `hours_logged` > 0";
			$tot = mysqli_query($con,$q);
			$res = mysqli_fetch_array($tot);
			echo '<b>Total Hours For Period: '.$res[0].'</b><br>';
			}	
	
	
	?>

	<?php include '../../includes/footer.php'; ?>
</body>
</html>