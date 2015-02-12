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
			$sddate = $sdate;
// By day within the date range
// by assigned worked
// get all workers with non-zero hours worked
// order alphabetically
// total # hours worked per day

?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<?php include '../../includes/menu.php'; ?>
	<?php include '../../includes/connection.php'; ?>
	<h1>Staff Member Daily Work Report</h1>
	
	<?php
		echo '<b>Date Range: '.$sdate.' - '.$edate.'</b><br><br>';

		$q = "SELECT `name` FROM `staff`";
		$staffm = mysqli_query($con,$q);
		$count = mysqli_num_rows($staffm);
		//echo $count;
		echo '<table><tr><th>Staff Member</th>';
		$tempd = new DateTime($sdate);
		$sdate = new DateTime($sdate);
		$edate = new DateTime($edate);
		$i = 0;
		while($tempd <= $edate){
			echo '<th>&nbsp;</th><th>'.$tempd->format('Y-m-d').'</th>';
			//$i++;
			$tempd->modify('+1 day');
		}
		echo '<th>&nbsp;</th><th>Total Hours For Period</th></tr>';
		while($count > 0){
			$count--;
			$ar = mysqli_fetch_array($staffm);
			$name = $ar[0];
			$q = "SELECT SUM(hours_logged_now) FROM `transaction` WHERE `transaction_by` = '$name' AND `Date/Time` >= '".$sdate->format('Y-m-d')."' AND `Date/Time` <= '".$edate->format('Y-m-d')."' AND `hours_logged` > 0";
			$tot = mysqli_query($con,$q);
			$res = mysqli_fetch_array($tot);
			if(!empty($res[0]))
					$lentry = $res[0];
				else
					$lentry = '0';
			if($lentry > 0){
			echo '<tr><td>'.$name.'</td>';
			$fdate = new DateTime($sddate);
			while($fdate <= $edate){
				$ndate = $fdate;
				$pdate = $fdate;
				$fdate->format('Y-m-d');
				$pdate->modify('+1 day');
				$ndate = $pdate;
				$q = "SELECT SUM(hours_logged_now) FROM `transaction` WHERE `transaction_by` = '$name' AND `Date/Time` >= '".$fdate->format('Y-m-d')."' AND `Date/Time` < '".$ndate->format('Y-m-d')."'";
				$fdate = $ndate;
				//echo $q;
				$res = mysqli_query($con,$q);
				$resa = $row = $res->fetch_assoc();;
				if(!empty($resa[0]))
					$entry = $resa[0];
				else
					$entry = '0';
				echo '<td>&nbsp;</td><td><center>'.$entry.'</center></td>';
				}
			
			echo '<td>&nbsp;</td><td><center>'.$lentry.'</center></td>';
			echo '</tr>';
			}
		}
			echo '</table>';
				
	?>

	<?php include '../../includes/footer.php'; ?>
</body>
</html>