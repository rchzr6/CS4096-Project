<?php
	session_start();
//THIS PAGE IS THE MANAGEMENT "HUB", GIVES MANAGEMENT OPTIONS ON WHAT THEY CAN DO 
//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
       // then abort the script
	exit();
}
$notallowed=1;
include '../includes/connection.php';//File to get the connection to the databases for queries
$user = $_SESSION['username'];//gets session variable username
$q = "SELECT `id` FROM `member` WHERE `username` = '$user'";//gets user's id from the member table where their login info is stored
	$resid = mysqli_query($con,$q);
	
	$row = $resid->fetch_assoc();
    $id = $row['id'];
    
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	$myname="";
	$numb = $res->num_rows;
	if($numb >0){
		$row = $res->fetch_assoc();
		$myname = $row['name'];
	}
	//echo $myname;
	$q = "SELECT * FROM  `group` WHERE `user_name` = '$myname' AND `role` = 'Manager'";//checks if user is in the groups table and gets that info
	$res = mysqli_query($con,$q);
	
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php include '../includes/menu.php'; 
	$num = $res->num_rows;
	//echo $num;
	if($num > 0){
	
	echo '<h1>Password Reset</h1>';
		echo '<form id="actions" method="post" action="#">';
		echo '<select form="actions" name="select_action">';
			echo '<option value="student">Student</option>';
			echo '<option value="faculty">Faculty</option>';
			echo '<option value="staff">Staff</option>';
		echo '</select><br><br>';
		
		echo '<b>First Name</b>:<br> <input type="text" name="fname"></input><br><br>';
		echo '<b>Last Name</b>:<br> <input type="text" name="lname"></input><br><br>';
		echo '<b>Email</b>:<br> <input type="text" name="email"></input><br><br>';
		echo '<b>ID</b>:<br> <input type="text" name="idnum"></input><br><br><br>';
		
		echo '<input type="submit" value="Submit"  name="Submit"/>';
	echo '</form>';
	
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!empty($_POST['select_action'])){
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$id = SHA1($_POST['idnum']);
		$email = $_POST['email'];
		
		$action = $_POST['select_action'];
		if($action == 'faculty' || $action == 'staff'){
			$name = $lname.', '.$fname;
			$q = "SELECT * FROM `".$action."` WHERE `name` = '$name' AND `email` = $email AND `id_num` = '$id'";
			$res = mysqli_query($con,$q);
			if(mysqli_num_rows($res) == 1){
				$newpass = generateRandomString();
				$hnewpass = SHA1($newpass);
				$q = "UPDATE `member` WHERE `id` = '$id' SET `password` = '$hnewpass'";
				mysqli_query($con,$q);
				$to = $email;
				include('../includes/emails/send_new_pass.php');
			}
		}
		if($action == 'student'){
			$name = $fname.' '.$lname;
			$q = "SELECT * FROM `".$action."` WHERE `name` = '$name' AND `email` = '$email' AND `id` = '$id'";
			//echo $q;
			$res = mysqli_query($con,$q);
			if(mysqli_num_rows($res) == 1){
				$newpass = generateRandomString();
				$hnewpass = SHA1($newpass);
				$q = "UPDATE `stu_member` SET `password` = '$hnewpass' WHERE `id` = '$id'";
				//echo $q;
				mysqli_query($con,$q);
				$to = $email;
				include('../includes/emails/send_user_new_pass.php');
			}
		}
}
	}
	else {
	
	Echo '<h1>User not allowed to this area!</h1><br>';
	}
	
	
	 include '../includes/footer.php'; 
	
	?>
</body>
</html>