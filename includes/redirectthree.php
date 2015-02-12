<?php
//basic redirect and variable storage
		$newnum = $_GET['wonum'];
		if(isset($_GET['jump']))
			$jump = TRUE;
		else
			$jump = FALSE;
		 header( 'Location: ../pages/wo_initiate.php?wonum='.$newnum.'&jump='.$jump.'&status='.$status.'');
?>
