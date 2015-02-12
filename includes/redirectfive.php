<?php
//basic redirect 
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
		echo 'not logged in';
		header ("location: ../pages/stu_home.php");
		}
Else
		{
		$wonum = $_POST['wo_num'];
		 header( 'Location: ../pages/shop_tech.php?wonum='.$wonum.'' );	
		}
?>