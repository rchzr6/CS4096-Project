<?php
include '../includes/connection.php';
if(isset($_POST['Submit'])){//checks to see if form has been submitted, if yes, stores the info in php variables for use
	include '../includes/queries/add_stu_queries.php';//includes the file that stores the info and then uses the info the run the queries
}
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!--Refrences the CSS style sheet held in the base CSS folder--->
</head>
<body>
	<?php include '../includes/menu.php'; //Includes the normal main menu ?>
	<h1>Student Create Account</h1>
	<form id="add_users" action="#" method="post"><!----adds the form to get the user info to store----->
		<b>MST Email</b>: <input type="text" name="id"></input></br>
		<b>Password</b>: <input type="text" name="password"></input><br>
		<input type="submit" value="Submit" name="Submit"/>
	</form>
	
	<?php include '../includes/footer.php'; ?><!---ADDS THE BASIC FOOTER TO THE PAGE--->
</body>
</html>