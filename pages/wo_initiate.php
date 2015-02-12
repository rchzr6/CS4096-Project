<?php
session_start();

//THIS PAGE DOES THE FINAL STEPS OF PUTTING A WORK ORDER INTO THE SYSTEM
	$wonum = $_GET['wonum'];
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!----Includes the basic style sheet----->
</head>
<body>
<?php 
include '../includes/connection.php';//includes the connection file to establist connection to the database for queries
$status = $_GET['status'];
if($status != 'Staff' && $status != 'Faculty')
include '../includes/stu_menu.php'; 
else
include '../includes/menu.php';
?>
<?php
//executes the queries and sends the proper emails
$wo_num = $_GET['wonum'];
include '../includes/queries/initiate_queries.php';//calls the queries to do the basic initialization
include '../includes/emails/send_user_new_wo.php';//sends email to the user
include '../includes/emails/send_manager_new_wo.php';//sends email to the group manager of the group the work order applies to

if(isset($_GET['jump'])){
	$jump = $_GET['jump'];
	if($jump==TRUE || $jump==true)
		header( 'Location: ../pages/shop_tech.php?wonum='.$wonum.'');
}

?>
<p>Work Order Creation Successful!</p><br><!--Prints message and link to home--->
<a href="../index.php">Click Here To Return Home</a>

<?php include '../includes/footer.php'; ?><!----Includes the footer----->
</body>
</html>