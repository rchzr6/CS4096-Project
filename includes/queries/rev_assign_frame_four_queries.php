<script type="text/javascript">

          function(data) {      
	      $("#rev_assign_frame_one").html(datar);
            return false;
          }
        
    </script>
<?php
			//NOTE
			//Filter is the wo status
			//View is the assignment
			$tree = FALSE;
			if(isset($_POST['organize'])){
					if($_POST['organize'] == 'tree'){
						$tree = TRUE;
					}
			}
			//set up the basic variables
			$usr = $_SESSION['username'];
			$q = "SELECT `id` FROM `member` WHERE `username` = '$usr'";
			$res = mysqli_query($con,$q);
			$id = mysqli_fetch_row($res)[0];
			$q = "SELECT `name` FROM `staff` WHERE `id_num` = '$id'";
			$res = mysqli_query($con,$q);
			$aname = mysqli_fetch_row($res)[0];
			//echo $q.'<br>'.$aname;
			$q = "SELECT `group_name` FROM `group` WHERE `user_name` = '$aname'";
			//echo $q;
			$res = mysqli_query($con,$q);
			$sizeg = mysqli_num_rows($res);
			if($sizeg > 0)
				$group = mysqli_fetch_row($res)[0];
			
			if(empty($_POST['view']) && empty($_POST['filter']) && $tree == FALSE){
				$q = "SELECT `wo_num`,`wo_submit_date`,`submitter_name`,`assigned_name`,`wo_short_description`, `due_date`,`start_date` FROM `work_orders` WHERE `assigned_name` = '$aname' AND `wo_status` = 'New' ORDER BY `due_date` ASC";
				$res = mysqli_query($con,$q);
				$size = mysqli_num_rows($res);
				if($size > 0){
					while($size > 0){
						$row = mysqli_fetch_row($res);
						$fdate= $row[1];
							$pdate = new DateTime($fdate);
							$pdate->modify('+1 day');
							$date = $pdate->format('Y-m-d');
						echo '<tr style="border: 1px solid black;">';
						echo '<td style="border: 1px solid black;"><a href="?wonum='.$row[0].'">'.$row[0].'</a></td>';
						echo '<td style="border: 1px solid black;">'.$date.'</td>';
						echo '<td style="border: 1px solid black;">'.$row[2].'</td>';
						echo '<td style="border: 1px solid black;">'.$row[3].'</td>';
						echo '<td style="border: 1px solid black;">'.$row[4].'</td>';
						if($row[5] < Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: red;">'.$row[5].'</td>';
						else if($row[5] == Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: yellow;">'.$row[5].'</td>';
						else
							echo '<td style="border: 1px solid black; color: green;">'.$row[5].'</td>';
						if($row[6] >= Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: green;">'.$row[6].'</td>';
						else
							echo '<td style="border: 1px solid black;">'.$row[6].'</td>';
						echo '</tr>';
						--$size;
					}
				}
			}
			else{
				if($_POST['view'] != 'ME' && $_POST['view'] != 'group' && !empty($_POST['view']))
					$group = $_POST['view'];
				//sets the initial query up. below will add the conditional aspects
				$q = "SELECT `wo_num`,`wo_submit_date`,`submitter_name`,`assigned_name`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders`  ";
				//get filter and view values
				$view = $_POST['view'];
				$filter = $_POST['filter'];
				
				
				if($view != 'ALL' && $filter != 'ALL'){
					if($view == 'ME')
						$q .= " WHERE `wo_status` = '$filter' AND `assigned_name` = '$aname'";
					if($view == 'group' && $sizeg > 0)
						$q .= " WHERE `wo_status` = '$filter' AND `assigned_group` = '$group'";
					if($view == 'group' && $sizeg == 0)
						echo '<b>You do not belong to a group. Showing all work orders.</b><br>';
					if($view  != 'ME' && $view != 'group' && !empty($_POST['view']))
						$q .= " WHERE `wo_status` = '$filter' AND `assigned_group` = '$view'";
				}
				else if($filter != 'ALL' && $view == 'ALL') {
						$q .= "WHERE `wo_status` = '$filter'";
				}
				else if($filter == 'Closed'){
					$q .= "WHERE (`wo_status = 'Closed' OR `wo_status` = 'Terminated`) ";
					if($view != 'ALL'){
						if($view == 'ME')
							$q .= "AND `assigned_name` = '$aname'";
						if($view == 'group' && $sizeg > 0)
							$q .= "AND `assigned_group` = '$group'";
						if($view == 'group' && $sizeg == 0)
							echo '<b>You do not belong to a group. Showing all work orders.</b><br>';
						if($view  != 'ME' && $view != 'group' && !empty($_POST['view']))
							$q .= "AND `assigned_group` = '$view'";
					}
				}
				
				else if($filter == 'ALL'){
					if($view == 'ME')
						$q .= " WHERE `assigned_name` = '$aname'";
					if(($view == 'group' && $sizeg > 0) || ($view != 'ME' && $view != 'ALL' && $view != 'all' && $sizeg >0))
						$q .= " WHERE `assigned_group` = '$group'";
					if($view == 'group' && $sizeg == 0)
						echo '<b>You do not belong to a group. Showing all work orders.</b><br>';
					//if($view  != 'ME' && $view != 'group' && !empty($_POST['view']))
						//$q .= " WHERE `assigned_group` = '$view'";
					//if($view == 'ALL')
						//DO NOTHING
				}
				if(isset($_POST['organize'])){
					$org = $_POST['organize'];
					$tree = FALSE;
					if($org == 'sdate')
						$q .= " ORDER BY `start_date` ASC";
					else if($org == 'ddate')
						$q .= " ORDER BY `due_date` ASC";
					else if($org == 'tree'){
						$tree = TRUE;
						$q = "SELECT `wo_num`,`wo_submit_date`,`wo_short_description`, `due_date`, `start_date` FROM `work_orders`";//gets all work orders
					}
				}
				
				$res = mysqli_query($con,$q);
				//echo $q;
				// echo $filter;
				// echo $view;
				$size = mysqli_num_rows($res);
				//echo $q;
				
				if($size > 0 && $tree != TRUE){
					while($size > 0){
						$row = mysqli_fetch_row($res);
						$fdate= $row[1];
						$pdate = new DateTime($fdate);
						$pdate->modify('+1 day');
						$date = $pdate->format('Y-m-d');
						echo '<tr style="border: 1px solid black;">';
						echo '<td style="border: 1px solid black;"><a href="?wonum='.$row[0].'">'.$row[0].'</a></td>';
						echo '<td style="border: 1px solid black;">'.$date.'</td>';
						echo '<td style="border: 1px solid black;">'.$row[2].'</td>';
						echo '<td style="border: 1px solid black;">'.$row[3].'</td>';
						echo '<td style="border: 1px solid black;">'.$row[4].'</td>';
						
						if($row[5] < Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: red;">'.$row[5].'</td>';
						else if($row[5] == Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: yellow;">'.$row[5].'</td>';
						else
							echo '<td style="border: 1px solid black; color: green;">'.$row[5].'</td>';
							
						if($row[6] >= Date('Y-m-d'))
							echo '<td style="border: 1px solid black; color: green;">'.$row[6].'</td>';
						else
							echo '<td style="border: 1px solid black;">'.$row[6].'</td>';
							
						echo '</tr>';
						--$size;
					}
				}
		}

?>