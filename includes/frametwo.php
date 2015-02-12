<?php
//THIS IS FRAME 2, USED TO DISPLAY ALL AVAILABLE TRANSACTIONS
	echo '<div id="frametwo" style="border-style: solid; border-width: small; height:500px; overflow: scroll;">';

	echo '<h2>Transaction Comments:</h2><br>';
	if(!empty($wonum)){//selects comments from the transaction table and prints them.
	include 'queries/frame_2_queries.php';
	//echo $size;
	if ($size > 0) {
		while($size > 0){
			$row = $res->fetch_assoc();
			echo "<b>Comments</b>: ".$row['comments']."<br>";
			//echo "<b>Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Submitter</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Time Stamp</b><br>";
			echo "<b>Status</b>: ".$row['wo_status']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Posted By</b>: ".$row['transaction_by']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><b>Time Stamp</b>: ".$row['Date/Time']."<br>";
			echo "<b>Total Hours Logged</b>: ".$row['hours_logged']."<br>";
			echo "<hr>";
			--$size;
		}
	}
	}
	echo '</div>';
?>
