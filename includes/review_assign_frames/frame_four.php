<?php
//FRAME FOUR -- LISTS WORK ORDERS FROM FILTERS
	include '../includes/connection.php';
	
?>
		<div id="rev_assign_frame_four" style="border-style: solid; border-width: small; height:480px; overflow:scroll;">

		<?php 
		$tree = FALSE;
			if(isset($_POST['organize'])){
					if($_POST['organize'] == 'tree'){
						$tree = TRUE;
					}
			} 
		if($tree == TRUE)
					include '../includes/print_tree.php';
		if($tree == FALSE){
			echo '<table id="list_wo" style="border: 1px solid black;">';
			echo '<tr style="border: 1px solid black;">';
			echo '<th style="border: 1px solid black; width: 3%;">Work Order #</th>';
			echo '<th style="border: 1px solid black; width: 7%;">Submit Date</th>';
			echo '<th style="border: 1px solid black;width: 10%;">Submitter Name</th>';
			echo '<th style="border: 1px solid black;width: 10%;">Assigned Name</th>';
			echo '<th style="border: 1px solid black;">Short Description</th>';
			echo '<th style="border: 1px solid black;width: 7%;">Due Date</th>';
			echo '<th style="border: 1px solid black;width: 7%;">Start Date</th>';
		echo '</tr>';
				include '../includes/queries/rev_assign_frame_four_queries.php';

		echo '</table>';
	}
		?>
</div>