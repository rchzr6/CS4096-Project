
<?php
//THIS IS FRAME 5. USED TO DISPLAY THE AVAILABLE WORK ORDERS FOR USER TO SELECT FROM, QUERIES ARE RUN ON A DIFFERENT PAGE, THIS PAGE ONLY USES THE RESULTS
		echo '<div id="framefive" style="border-style: solid; border-width: small; height: 400px;overflow: scroll;">';
				if(!empty($_POST['tree'])){
				if($_POST['organize'] == 'tree'){
					$tree = TRUE;
					$q = "SELECT `wo_num`,`wo_submit_date`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders`";//gets all work orders
						$wo_to_display = mysqli_query($con,$q);

				}
				}
			
				if(isset($_POST['Filter']) && !empty($wo_to_display) && $tree == FALSE){
					$size = mysqli_num_rows($wo_to_display);
					//echo '<br><br><br>Note: Red color = over due, Green = On/Ahead of Schedule. Work orders are listed in order of due date.<br>';
					echo '<table style="width:100%;">';
					echo '<tr><th>WO#</th><th>Status</th><th>Short Description</th><th>Due Date</th><th>Start Date</th></tr>';
					while($size > 0){
						$row = mysqli_fetch_row($wo_to_display);
						// $idate = strtotime($row[1]);
						// $date = date('Y-m-d',$idate);
						echo '<tr><td style=" width:15px;"><center><a  href="?wonum='.$row[0].'">'.$row[0].'</a></center></td><td style=" width:55px;"><center>'.$row[1].'</center></td><td style=" width:650px;">&nbsp;&nbsp;'.$row[2].'</td>';
						if($row[3] < Date('Y-m-d'))
							echo '<td style="color: red; align: center;"><center>'.$row[3].'</center></td>';
						else if($row[3] == Date('Y-m-d'))
							echo '<td style="color: yellow; align: center;"><center>'.$row[3].'</center></td>';
						else
							echo '<td style="color: green; align: center;"><center>'.$row[3].'</center></td>';
						if($row[4] >= Date('Y-m-d'))
							echo '<td style="color: green; align: center;"><center>'.$row[4].'</center></td>';
						else
							echo '<td><center>'.$row[4].'</center></td>';
						echo '</tr>';
							$wonum = $row[0];
						--$size;
					}
					echo '</table>';
					echo 'Work orders listed in order of due date, red = overdue, green = ahead/on time.';
					
				}
				else if(isset($_POST['Filter']) && !empty($wo_to_display) && $tree == TRUE)
					include '../includes/print_tree.php';
				else
					echo 'No Work Orders To Display<br>';
		echo '</div>';
?>