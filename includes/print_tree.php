<?php
//display as tree page
include 'connection.php';
//print children function -- need to look up how to specificially write this in php

function print_children($wonum,$depth){
	include 'connection.php';
	$q = "Select `wo_num`, `children`,`wo_type`,`wo_short_description`,`wo_status`, `start_date` FROM `work_orders` WHERE `parent_wo_num` = '$wonum'";
	$resc = mysqli_query($con,$q);
	if(mysqli_num_rows($resc))
		$sizec = mysqli_num_rows($resc);
	while($sizec != 0){
		--$sizec;
		$rowc = mysqli_fetch_row($resc);
		$tdepth = $depth;
		while($tdepth > 0){
				--$tdepth;
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		if($rowc[4] == 'New' || $rowc[4] == 'NEW')
		$color = 'green';
		else if($rowc[2] == 'HOLD' || $rowc[2] == 'Hold')
		$color = 'red';
		else
		$color = 'white';
	echo '<a href="?wonum='.$rowc[0].'">'.$rowc[0].'</a> -- <span style="background-color:'.$color.';">'.$rowc[4].'</span> -- <span style="color: orange;">'.$rowc[2].'</span> -- <span style="color: purple;">'.$rowc[3].'</span> -- <span style="color: grey;">'.$rowc[5].'</span><br>';
	
		if($rowc[1] == 1)
			print_children($rowc[0],$depth+1);
		}

}

//print parent

//check to see if parent has children aka children == 1

//Find work orders who have parent wo number as parent

// loop until we have no more work orders with children
echo '<div id="print_tree">';
echo '<center><h1>Work Order Tree</h1></center>';
echo '<h5><span style="color:blue;">WO Number</span> -- WO Status -- <span style="color: orange;">WO Type/Group</span> -- <span style="color:purple;">WO Short Description</span> -- <span style="color:grey;">WO Start Date</span></h5>';

$q = "SELECT * FROM `work_orders` WHERE `parent_wo_num` = '0'";
$res = mysqli_query($con,$q);
$size = mysqli_num_rows($res);

while($size != 0){
	--$size;
	$row = $res->fetch_row();
	$wonum = $row[0];
	$children = $row[1];
	if($row[2] == 'New' || $row[2] == 'NEW')
		$color = 'green';
	else if($row[2] == 'HOLD' || $row[2] == 'Hold')
		$color = 'red';
	else
		$color = 'white';
	echo '<a href="?wonum='.$row[0].'">'.$row[0].'</a> -- <span style="background-color:'.$color.';">'.$row[2].'</span> -- <span style="color: orange;">'.$row[10].'</span> -- <span style="color: purple;">'.$row[11].'</span> -- <span style="color: grey;">'.$row[21].'</span><br>';
	if($children == 1){
		//call print children function
		print_children($wonum,1);
	}
	echo '<br>';
}
echo '</div>';

?>