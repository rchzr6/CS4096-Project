<?php
//THIS IS FRAME 4 B. THIS FRAME IS USED TO FILTER THE WORK ORDERS FOR SELECTION (including advisors)
		echo '<div id="framefour" style="border-style: solid; border-width: small; width=100%;">';
		echo '<div id="ffleft" style="width:50%; float: left;">';
		echo '<h3>View (Select One)</h3><br><br><h3>List Status</h3><h3>Organize By</h3>';//prints the headings
		echo '</div>';
		echo '<div id="ffright" style="width:50%; float: right;">';
		echo '<form id="filter" action="#" method="post"><br>';
		//below prints the checkboxes
		echo 'Assigned To Me <input type="checkbox" value="me" name="me"/><br>';
		echo 'Assigned To My Group <input type="checkbox" value="group" name="group" /><br>';
		include '/queries/check_number_groups.php';//includes the queries to check if group select is needed, if so creates the selection
		echo 'Mine <input type="checkbox" value="mine" name="mine" /><br>';
		echo 'View All <input type="checkbox" value="vall" name="vall" />';
		echo '<br><br><select form="filter" name="statusfilter">';
		echo '<option value="abc">All But Closed</option>';
		echo '<option value="ip">In Progress</option>';
		echo '<option value="closed">Closed</option></select><br><br>';
		echo '<select form="filter" name="organize">';
		echo '<option value="number">Work Order Number</option>';
		echo '<option value="sdate">Start Date</option>';
		echo '<option value="ddate">Due Date</option>';
		echo '<option value="tree">Tree - PRINTS ALL WORK ORDERS</option>';
		echo '</select><br><br>';
		echo '<input type="submit" value="Filter" name="Filter" />';
		echo '</form>';
		echo '</div>';
					echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

		echo '</div>';
	

?>