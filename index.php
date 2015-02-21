<?php
	session_start();
	//HOME PAGE, SIMPLE PAGE JUST FOR  NAVIGATION.
	
	if(isset($_GET['log'])){
					$log = $_GET['log'];
					
					include 'includes/menu.php'; 
					
				}
	
	
	
	
?>
<head>
	 <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<html>
		
		<h1>Home page</h1>
		<p>Welcome to the Missouri S&T MAE Shop Work Order System.<br></p>
		<?php
		if(!isset($_GET['log'])){
			
					$root = "http://" . $_SERVER['HTTP_HOST'];		
					echo 'Please log in with one of the selections below<P><P>';
				
					echo '<form action="'.$root.'/cs4096/pages/login.php">';
					echo '<input type="submit" name="stafflogin" value="Faculty / Staff Login">';
					echo '</form>';
					echo '<form action="'.$root.'/cs4096/pages/stu_login.php">';
					echo '<input type="submit" name="student" value="Student Access">';
					echo '</form>';
					
					
					
					
					
				}
		
		?>
		
		
		<?php include 'includes/footer.php'; 
		
		?>
	</html>
</body>
