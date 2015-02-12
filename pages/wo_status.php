<?php
Session_start();
//THIS PAGE IS TO RETRIEVE THE STATUS OF THE WORK ORDER FOR GENERAL USERS
	include '../includes/connection.php';//includes the basic connection file to establish connection to the database
	$status = 0;
//Check if ID has been set and is not empty
	if(!empty($_POST['id']) || !empty($_GET['id'])){
		//if ID has been set then the wo_number has been set as well, sets value to local variable here
		$wonum = $_GET['wonum'];
		//Checks to see if the email post is set and not empty, meaning someone got a link here and the id is already encrypted
		//if(!empty($_GET['email'])){
			$id = $_GET['id'];//sets ID to local variable
		//}
		//else{
		if (strlen($id)<11){
			$id = SHA1($id);//This is for the form being filled out instead of a link redirect, encrypts the ID
			Echo "encoded now";
		}
	}
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!---adds the CSS stylesheet to the page--->
</head>
<body>
	<?php 
	if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
			include '../includes/stu_menu.php';  //includes the student menu if the user is no logged in.
		}else{
			include '../includes/menu.php'; //if the user is logged in, which indicates the user is a staff/faculty member, then we include the staff side menu
		}
		?>
	<u><h1>Public Work Order Query</h1></u>
	<!----Form to get information about the user and work order---->
	<div id="work_order_query" style=" width='500px'; float:left;">
		Enter your Student Number and your name IDENTICALLY as you entered it when you created the work order. <br>
		Enter the work order number you wish to view or the * to get a list of your work orders.<br><br>
		<form id="query_wo" action="#" method="get" style="float:left;">
			Enter Work Order Number:<input type="text" name="wonum"><br>
			Enter Your Email:<input type="text" name="id"></br>
			Enter Your Name:<input type="text" name="stuname"></br>
		<input type="submit" name="Retrieve" value="Retrieve" ></br></br>
	</form><br><br></p><br><br></p>
	</div><br><br><br><br><br><br><br><br><br></p>
	<?php
		if(isset($id)){
		//includes the queries that get the proper info from the database if the id is set
			include '../includes/queries/wo_status_queries.php';
		}
	?>
	<?php include '../includes/footer.php'; ?><!----Includes the basic footer file---->
</body>
</html>