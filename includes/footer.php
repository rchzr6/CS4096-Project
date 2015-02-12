<!--------THIS FILE CONTAINS THE FOOTER CODE----->
<footer>
	<div style="clear:both;">
<hr>
	<div style="float:left;">

	 <p>Site designed by Mitch Cottrell and Andrew Siebert , &copy; <a href="http://mae.mst.edu">University of Missouri Science and Technology Mechanical and Aerospace Engineering Departments</a></p>

	</div>
	<div style="float:right">
	<?php
	//BELOW IS THE CODE FOR THE LOGOUT BUTTON
	if(isset($_SESSION['username'])){
		//GETS THE ROOT OF THE SERVER TO MAKE SURE THIS LINK WORKS EVERYWHERE
		$root = "https://" . $_SERVER['HTTP_HOST'];
		echo '<form action="'.$root.'/mae_shop/includes/logout.php">';
			echo '<input type="submit" name="Logout" value="Logout">';
		echo '</form>';
	}
	?>
	</div>
	</div>
</footer>