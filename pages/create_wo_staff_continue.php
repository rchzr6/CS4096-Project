<?php
//contiune with the process and then jump to two.
session_start();

include '../includes/connection.php';//File to get the connection to the databases for queries

	$status = $_SESSION['status'];
	//echo $status;
	$officenum = $_SESSION['officenum'];
	$phone = $_SESSION['phonenum'];
	$email = $_SESSION['email'];
	$subname = $_SESSION['subname'];

	$type = $_GET['worktype'];
	if(!empty($_GET['othertype']))	//checks if othertype is set, if yes, replaces the type with other type
		$type = $_GET['othertype'];
	$scope = $_GET['scope'];
	if(!empty($_GET['otherscope']))	//checks if otherscope is set, if yes, replaces the scope with otherscope
		$scope = $_GET['otherscope'];
	$aname=" ";
	
	if($status == 'Staff' || $status = 'staff'){
		echo '<html>
				<head>
					<link rel="stylesheet" href="../css/style.css">
					<script language="javascript" src="../calendar/calendar.js"></script>
				</head>
		<body>';
		include '../includes/faculty_menu.php';
		echo 'Assign Work Order to Self?<br>';
		echo '<form name="yes" method="POST" action="#"><input type="submit" name="Yes" value="Yes"/><form>';
		echo '<form name="no" method="POST" action="#"><input type="submit" name="No" value="No"/></form>';
	}
	if($status == 'faculty' || isset($_POST['No'])){
		include '../includes/queries/create_wo_queries.php';//CALLS THE NEXT SET OF QUERIES TO CONTINUE CREATION OF WORK ORD
			header( 'Location: ../pages/create_wo_two.php?modify='.$modify.'&status='.$status.'&wonum='.$newnum.'&' );
	}
	if(isset($_POST['Yes'])){
		$aname = $_SESSION['subname'];
		include '../includes/queries/create_wo_queries.php';
						$_SESSION['go'] = TRUE;

			header( 'Location: ../pages/create_wo_two.php?modify='.$modify.'&status='.$status.'&wonum='.$newnum.'&jump=true' );

	}
		include '../includes/footer.php';
		echo '</body></html>';
	
	?>