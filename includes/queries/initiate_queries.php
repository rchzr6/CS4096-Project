<?php
 $date = date("Y-m-d H:i:s");
 $q = "SELECT COUNT('transaction_num') FROM `transaction` ORDER BY `transaction_num` ASC";//GETS THE NUMBER OF TRANSACTIONS
	$countres = mysqli_query($con,$q);
	$transnum = mysqli_fetch_row($countres)[0];
	$transnum++;
	$comment = "Work Order Created";
 $q = "INSERT INTO transaction(wo_num,wo_status,transaction_by,comments,Date/Time,transaction_num,comments) VALUES('$wo_num','New','System','Wo Entered','$date','$transnum','$comment');";
 //echo $q;
 mysqli_query($con,$q);
 $q = "SELECT `submitter_name`,`submitter_room_num`,`submitter_email`,`submitter_email`,`submitter_phone` FROM `work_orders` WHERE `wo_num` = $wonum";
 $res = mysqli_query($con,$q);
 $qar = $row = $res->fetch_assoc();;
 $name = $qar['submitter_name'];
 $room = $qar['submitter_room_num'];
 $email = $qar['submitter_email'];
 $phone = $qar['submitter_phone'];
 $q = "UPDATE `student` SET `last_transaction_date` = $date WHERE `Name` = '$name' AND `room_number` = '$room' AND `phone` = '$phone' AND `email` = '$email'";
 mysqli_query($con,$q);
?>