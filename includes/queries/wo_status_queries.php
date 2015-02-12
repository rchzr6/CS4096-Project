<?php		
		
		$wonum = $_GET['wonum'];//gets the work order number from the previous page
		$id = $_GET['id'];//gets the work order number from the previous page
		$user = $_GET['stuname'];//gets the work order number from the previous page
		$id=SHA1($id);
		$notfound=0;
		
		$q = "SELECT * FROM `student` WHERE id = '$id'";
		$res = mysqli_query($con,$q);
		$row = $res->fetch_assoc();;
		$name=$row['Name'];
		
		if (!isset ($name)){
			$q = "SELECT * FROM `staff` WHERE id_num = '$id'";
			$res = mysqli_query($con,$q);
			$row = $res->fetch_assoc();
			$name=$row['name'];
				if (!isset ($name)){
					$q = "SELECT * FROM `faculty` WHERE id_num = '$id'";
					$res = mysqli_query($con,$q);
					$row = $res->fetch_assoc();
					$name=$row['name'];
					if (!isset ($name)){
						echo "no user found with that ID number.<br>"; 
						$notfound=1;
					}
				}
				
			}
			
			if ($name == $user){			
			
				if($notfound == "0"){
					$phone=$row['phone'];
					$email=$row['email'];
					if ($wonum=="*"){
						$q = "SELECT * FROM `work_orders` WHERE submitter_name = '$name'";
						echo "<br><br><p align=\"left\"><p><br>Work orders found for submitter ".$name." are:<br><br>";
						$res = mysqli_query($con,$q);
						Print "<table>";
						While ($row = $res->fetch_assoc()){
											
							Print "<tr>"; 
 							Print "<th>WO:</th> <td>".$row['wo_num'] . "</td> "; 
 							Print "<th>Date:</th> <td>".$row['wo_submit_date'] . "</td> "; 
 							Print "<th>Description:</th> <td>".$row['wo_short_description'] . "</td></tr> "; 
 						
 						} 
 						Print "</table></p>"; 
					
							
						
					}
					else {
						$q = "SELECT * FROM `work_orders` WHERE wo_num = '$wonum'";
						$res = mysqli_query($con,$q);
						$row = $res->fetch_assoc();
						$sd = $row['wo_short_description'];
						$sdate = $row['start_date'];
						$ddate = $row['due_date'];
						include '../includes/frameone.php';
						include '../includes/frametwo.php';
						include '../includes/framethree.php';
						}
				}
				else
						echo "Nothing found for" .$name."<br>";
			}
			else{
				echo "<p> ";
				echo "<br><br><p align=\"left\">The name and ID entered to not match.";
				$name = "";
				$id = "";
			}
			?>