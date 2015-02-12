<?php
			//THIS FILE IS TO GET THE COMMENT IN A NEW WINDOW
			
			If(isset($_POST['Submit'])){
				include '../../includes/queries/assign_wo_queries_two.php';
				include '../../includes/emails/send_assigned_to_you.php';
				//include '../../includes/emails/send_assigned_update_wo.php';
				
				echo '<script>window.close()</script>';
			}
			
?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<?php include '../../includes/menu.php'; ?>
	<!----FORM TO ENTER COMMENTS----->
	<h1>Assign Work Order:</h1>
	<form id="getassigned" action="#" method="post">
		<select form="getassigned" name="select_assigned">
			<?php include '../../includes/queries/assign_wo_queries.php'; //INCLUDES QUERY TO GET SELECTIONS
			
			while($count > 0){//PRINTS SELECTIONS
				--$count;
				$row = mysqli_fetch_row($res);
				echo "<option value='".$row[0]."'>".$row[0]."</option>";
			}
			
			?>
			<option value="other" >Other</option>
		</select><br>
		<input type="text" name="other" value="Other"></input><br>
		<input type="submit" value="Submit" name="Submit" />
	</form>	
	<?php include '../../includes/footer.php'; ?>
</body>
</html>