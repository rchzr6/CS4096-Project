<?php #login.php 
           #####[make sure you put this code before any html output]#####
//THIS PAGE HANDLES THE LOGIN OF USERS USING THE MEMBERS TABLE
//connect to server
include '../includes/connection.php';


//check if the login form has been submitted
if(isset($_POST['go'])){
	#####form submitted, check data...#####
	####CHECKING FOR FACULTY/STAFF USER HERE####
        //step 1a: sanitise and store data into vars (storing encrypted password)
	$usr = mysqli_real_escape_string($con, htmlentities($_POST['u_name']));
	$u_pass =$_POST['u_pass'];
	$psw = SHA1($u_pass) ; //using SHA1() to encrypt passwords  
        //step2: create query to check if username and password match
	$q = "SELECT * FROM `member` WHERE username='$usr' AND password='$psw'  ";
	
	//step3: run the query and store result
	$res = mysqli_query($con, $q) or trigger_error("Query Failed! SQL: $q - Error: ".mysqli_error($con), E_USER_ERROR);
	
	//make sure we have a positive result
	if(mysqli_num_rows($res) == 1){
		#########  LOGGING IN  ##########
		//starting a session  
                session_start();
		
                //creating a log SESSION VARIABLE that will persist through pages   
		$_SESSION['log'] = 'in';
		$get_ID = "SELECT `id` FROM `member` WHERE username='$usr'";
		$res = mysqli_query($con,$get_ID);
		$resa = mysqli_fetch_row($res);
		$_SESSION['UID'] = $resa[0];
		$_SESSION['username'] = $usr;
		//redirecting to restricted page
		header('location:../index.php?log=in');
	} 
	else{
	$error = "Wrong details or not registered, try again.";
	}
	}//end isset go
?> 

<!DOCTYPE html>
<html lang="en">
	 <head>
	 <title></title>
	 <meta charset="utf-8">
	 <link rel="icon" href="images/favicon.ico">
	 <link rel="shortcut icon" href="images/favicon.ico" />
	 <link rel="stylesheet" href="../css/style.css">
	 </head>
	 <body>
<!--==============================header=================================-->
 


<!--=======content================================-->

<div class="content page1"><div class="ic"></div>
 <div class="container_12">
	<br>
	
<form id="login" method="post" action="#" style="float:center;">

    <b><label for="u_name">Username:</label></b>
    <p><input type="text" name="u_name" value=""></p>
    
    <b><label for="u_pass">Password:</label></b>
    <p><input type="password" name="u_pass" value=""></p>
    
    <p><button type="submit" name="go">Login</button></p>
</form>	

<br>
<a href="password_reset.php">Forgot Password</a></br>
<!-- A paragraph to display eventual errors -->
<p><strong><?php if(isset($error)){echo $error;}  ?></strong></p>
</div>
</div>

<!--==============================footer=================================-->

	
  <?php include '../includes/footer.php'; ?>

</body>
</html>
