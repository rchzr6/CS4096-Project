<?PHP

// a listing of all work orders that have been open and how many hours per work order
// filter by date range
// subcategorized by group
// sections
// all new open
// anything that has been new within that range
// all previous ones that have been opened and closed
// anything that has not been new or closed
// all ones that were closed within that date range
// all work orders that have been closed within the date range

//New ones submitted in this range
	$q = "SELECT `wo_num` FROM `work_orders` WHERE `wo_submit_date` >= '$sdate' AND `wo_submit_date` <= '$edate'";
	$t = "SELECT SUM(hours_logged_now),`wo_num` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate' AND `hours_logged` > 0";

//everything else

//Need to get all transactions from the range, then sum the hours_logged_now within that range for each work order
//closed in range
$q = "SELECT `wo_num` FROM `work_orders` WHERE `wo_submit_date` < '$sdate' OR `wo_submit_date` > '$edate'";
$t = "SELECT SUM(hours_logged_now),`wo_num` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate' AND `hours_logged` > 0";

//not closed or new in range
$q = "SELECT `wo_num` FROM 'work_orders` WHERE `wo_submit_date` < '$sdate' OR `wo_submit_date` > '$edate' AND `wo_status` != 'CLOSED'";
$t = "SELECT SUM(hours_logged_now),`wo_num` FROM`transaction` WHERE `wo_num` = '$num' AND `Date/Time` >= '$sdate' AND `Date/Time` <= '$edate' AND `hours_logged` > 0";

$otherres = mysqli_query($q,$conm);

?>