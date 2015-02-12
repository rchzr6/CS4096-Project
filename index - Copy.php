<?php
	session_start();
	//HOME PAGE, SIMPLE PAGE JUST FOR  NAVIGATION.
?>
<head>
	 <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<html>
		<?php include 'includes/menu.php'; ?>
		<h1>Home page</h1>
		<p>Welcome to the MS&T MAE Shop Work Order System.<br>Please use the above menu to navigate and use the system.</p>
		<?php
				if(isset($_GET['log'])){
					$log = $_GET['log'];
					echo 'Successfully Logged In, you may now continue';
				}
		?>
		<?php include 'includes/footer.php'; ?>
	</html>
</body>