<?php
//THIS IS FRAME 1. THIS PRINTS THE BASIC INFO OF THE SUBMITTER AND THE WORK 

echo '<div id="frameone" style="border-style: solid; border-width: small; width=100%;">';
if(isset($_GET['wonum']))
	$wonum = $_GET['wonum'];
if(!empty($wonum)){//prints info/headers
	echo '<b>Work Order Number:</b> <i>'.$wonum.'</i><br><b>Submitter Name:</b> <i>'.$name.'</i><br><b>Submitter Phone Number:</b> <i>'.$phone.'</i><br><b>Submitter Email:</b><i> '.$email.'</i><br><b>Short Description:</b><i> '.$sd.'</i>';
	echo '<br><b>Due Date:</b> <i>'.$ddate.'</i><br><b>Start Date:</b> <i>'.$sdate.'</i><br>';
}
else
	echo '<b>Work Order Number:</b><br><b>Submitter Name:</b><br><b>Submitter Phone Number:</b><br><b>Submitter Email:</b>';
echo '</div>';
?>