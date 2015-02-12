<?php
Session_start();
//QUERIES TO GET THE TRANSACTION NUMBER AND TO INSERT INTO TRANSACTION FROM THE REVIEW AND ASSIGN PAGE
				include '../connection.php';
				$q = "SELECT `transaction_num` FROM `transaction` ORDER BY `transaction_num` DESC";
				$res = mysqli_query($con,$q);
				$size = mysqli_fetch_row($res)[0];
				$size++;
				$comment = $_POST['comment'];
				$wo_num = $_GET["wonum"];
				$aname = $_SESSION['username'];
				$status = $_GET["status"];
				$q = "SELECT `name` FROM `staff` WHERE `id_num` IN (SELECT `id` FROM `member` WHERE `username` = '$aname')";
				$res = mysqli_query($con,$q);
				$aname = mysqli_fetch_row($res)[0];
				$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments) VALUES($size,'$wo_num','$status','$aname','$comment')";
				mysqli_query($con,$q);
				if($status == 'TERMINATED'){
					$comment = "Work order was terminated by ".$aname.".";
					$q = "INSERT INTO transaction(transaction_num,wo_num,wo_status,transaction_by,comments) VALUES($size,'$wo_num','CLOSED','$aname','$comment')";
					mysqli_query($con,$q);
					
				}
?>