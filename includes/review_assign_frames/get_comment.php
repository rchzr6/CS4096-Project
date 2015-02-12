<?php
			//THIS FILE IS TO GET THE COMMENT IN A NEW WINDOW
			
			If(isset($_POST['Submit'])){
				include '../../includes/queries/get_comment_queries.php';//INCLUDES THE QUERIES TO PROCESS THE COMMENTS
				include '../../includes/emails/send_user_update_wo.php';
				echo '<script>window.close()</script>';//CLOSES THE OPEN WINDOW
				//echo $q;
			}
			
?>

<html>
<head>
	 <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<?php include '../../includes/menu.php'; ?><!---INCLUDES THE MENU--->
	<!----FORM TO ENTER COMMENTS----->
	<h1>Enter Comments:</h1>
	<form id="getcomments" action="#" method="post">
		<textarea maxlength="250" name="comment" form="getcomments">Comments...</textarea>
		<input type="submit" value="Submit" name="Submit" />
	</form>
	
	<?php include '../../includes/footer.php'; ?><!---INCLUDES THE FOOTER-->
</body>
</html>