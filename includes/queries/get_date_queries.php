<?php
//QUERIES TO GET THE TRANSACTION NUMBER AND TO INSERT INTO TRANSACTION FROM THE REVIEW AND ASSIGN PAGE
				include '../connection.php';
				$wo_num = $_GET["wonum"];
				$q = "SELECT `wo_status` FROM `work_orders` WHERE `wo_num` = '$wo_num'";
				$res = mysqli_query($con,$q);
				$status = mysqli_field_seek($res,0);
				$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";	
				$res = mysqli_query($con,$q);
				$size = mysqli_field_seek($res,0);
				$size++;
				$q = "SELECT MAX(hours_logged) FROM `transaction` WHERE `wo_num` = '$wo_num'";
				$res = mysqli_query($con,$q);
				$hours = mysqli_field_seek($res,0);
				//echo $q;
				//echo $hours;
				$aname = $_SESSION['username'];
				$comment = 'Start date set to '.$sdate.'.';
				$q = "SELECT `name` FROM `staff` WHERE `id_num` IN (SELECT `id` FROM `member` WHERE `username` = '$aname')";
				$res = mysqli_query($con,$q);
				$aname = mysqli_fetch_row($res)[0];
				$q = "INSERT INTO transaction(transaction_num,hours_logged,wo_num,wo_status,transaction_by,comments) VALUES($size,$hours,'$wo_num','$status','$aname','$comment')";
				mysqli_query($con,$q);
				$q = "UPDATE `work_orders` SET `start_date` = '$sdate' WHERE `wo_num` = '$wo_num'";
				mysqli_query($con,$q);
				if($status == 'TERMINATED'){
					$comment = "Work order was terminated by ".$aname.".";
					$q = "INSERT INTO transaction(transaction_num,hours_logged,wo_num,wo_status,transaction_by,comments) VALUES($size,$hours,'$wo_num','CLOSED','$aname','$comment')";
					mysqli_query($con,$q);
					
				}
?>