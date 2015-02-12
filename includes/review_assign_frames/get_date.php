<?php
			//THIS FILE IS TO GET THE COMMENT IN A NEW WINDOW
			
			If(isset($_POST['Submit'])){
				$sdate = $_POST['date1'];
				include '../../includes/queries/get_date_queries.php';//INCLUDES THE QUERIES TO PROCESS THE COMMENTS
				echo '<script>window.close()</script>';//CLOSES THE OPEN WINDOW
				//echo $q;
				//echo $status;
			}
			
?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
	 <script language="javascript" src="../../calendar/calendar.js"></script>
</head>
<body>
	<?php include '../../includes/menu.php'; ?><!---INCLUDES THE MENU--->
	<!----FORM TO ENTER COMMENTS----->
	<h1>Enter Comments:</h1>
	<form id="getcomments" action="#" method="post">
		<b>Due Date:</b> </br>
		<?php
			require('../../calendar/classes/tc_calendar.php');
	  		$year = date("Y");
	  		$eyear = $year + 3;
	  		$timestamp = strtotime('+3 years');
	  		$eallow = date('Y-m-d', $timestamp);
      		$myCalendar = new tc_calendar("date1", true);
	  		$myCalendar->setIcon("../../calendar/images/iconCalendar.gif");
	  		$myCalendar->setDate(date("d"),date("m"), date("Y"));
	  		$myCalendar->setPath("../../calendar/");
	  		$myCalendar->setYearInterval($year, $eyear);
	  		$myCalendar->dateAllow(date("Y-m-d"), $eallow);
	  		$myCalendar->writeScript();
	  	?>
		<input type="submit" value="Submit" name="Submit" />
	</form>
	
	<?php include '../../includes/footer.php'; ?><!---INCLUDES THE FOOTER-->
</body>
</html>