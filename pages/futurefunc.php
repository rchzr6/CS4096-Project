<?php
//PAGE FUNCTIONALITY TO COME IN SECOND PHASE OF PROJECT
	session_start();

//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
        //then abort the script
	exit();
}
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php include '../includes/menu.php'; ?>
	<h1>This Function To Be Added In The Future</h1>
	<?php include '../includes/footer.php'; ?>
</body>
</html>