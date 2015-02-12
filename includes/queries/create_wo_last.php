<? php
$file = $fname;
if(empty($fname))
	$file = 'NO_FILES.php';
$q = "UPDATE `work_orders` SET `wo_short_description` = '$shortd', `wo_long_description` = '$longd', `wo_file_list` = '$file' , `submitter_advisor` = '$advisor' WHERE `wo_num` = $newnum";
echo $q;
mysqli_query($con,$q);


?>