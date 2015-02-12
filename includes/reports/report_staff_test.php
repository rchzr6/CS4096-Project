<?php
$d = strtotime("10/31/14");
$sdate = date('Y-m-d',$d);
$d = strtotime("12/31/14");
$edate = date('Y-m-d',$d);
$sdate = new DateTime($sdate);
$edate = new DateTime($edate);
echo '<table><tr><th>Staff Member</th>';
		$tempd = $sdate;
		$i = 0;
		while($tempd <= $edate){
			echo '<th>&nbsp;</th><th>'.$tempd->format('Y-m-d').'</th>';
			//$i++;
			//$tempd = strtotime($tempd." +".$i." days");
			//$tempd++;
			//$tempd = new DateTime($tempd);
			$tempd->add(new DateInterval('P1D'));
		}
		echo '</tr></table>';
?>