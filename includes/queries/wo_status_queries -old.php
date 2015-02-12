<?php		
		echo "starting query<br>";
		$wonum = $_GET['wonum'];//gets the work order number from the previous page
		$q = "SELECT `submitter_name`,`submitter_phone`,`submitter_email`,`wo_short_description` FROM `work_orders` WHERE `wo_num` = '".$wonum."'";
		$res = mysqli_query($con,$q);//runs the query
		$resar = $row = $res->fetch_assoc();;//converts result
		$name = $resar['submitter_name'];//stores variables
		$phone = $resar['submitter_phone'];
		$email = $resar['submitter_email'];
		$sd = $resar['wo_short_description'];
		echo $wonum;
		echo $name;
			//The above sets the variables to the submitter information
			//The below section determines what is the term status of the submitter and gets the rest of their info according to that
			if($status == 'ugrad' ||  $status == 'grad'){//UPDATES THE QUERY FOR STUDENTS
				$q = "SELECT `id` AS `id_num` FROM `student` WHERE `name` = '$name'";
				}
			if($status == 'staff'){//UPDATES THE QUERY FOR STAFF
				$q = "SELECT `id_num` FROM `staff` WHERE `name` = '$name'";
				}
				if($status == 'faculty'){//UPDATES THE QUERY FOR FACULTY
					$q = "SELECT `id_num` FROM `faculty` WHERE `name` = '$name'";
				}	
				$res = mysqli_query($con,$q);
				$row = mysqli_fetch_row($res);
				$idcheck = $row[0];
				$size = mysqli_num_rows($res);
				if($size > 1){
					$check = false;
					while($size > 0 && $check == false){
						--$size;
						if($idcheck == $id){
							$check = true;
						}
						$row = mysqli_fetch_row($res);
						$idcheck = $row['id_num'];
					}
				}
			//Makes sure the ID is valid, then includes the other frames
			if($idcheck == $id){
					include '../includes/frameone.php';
					include '../includes/frametwo.php';
					include '../includes/framethree.php';
				}
				else
					echo "ID doesn't match records, please try again<br>";
			?>