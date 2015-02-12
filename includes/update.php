<?php
	include 'connection.php';
	$fail = TRUE;
	if(isset( $_POST['wo_progress']))
		$wo_progress = $_POST['wo_progress'];
	
	$fail = FALSE;
		$comments = $_POST['comment'];
		if($comments == "Comments..")
			$fail = TRUE;
	if($fail != TRUE){
	include 'queries/update_queries.php';
	include 'redirectfour.php';
	echo $q;
	}
	else
	{
	echo 'Invalid Submission. Please <a href="javascript:history.back()">go back</a> and try again';
	}
?>