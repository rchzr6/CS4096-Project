<?php 
//PHP FILE TO PRINT THE MENU OF THE SITE
$docRoot= "http://" . $_SERVER['HTTP_HOST'];//gets the root of the site
?>
<div id="menu">
	<ul id="navlist">
		<li><p><a href="<?php echo $docRoot; ?>/cs4096/index.php">Home</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/cs4096/pages/create_wo_staff.php">Create Work Order</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/cs4096/pages/shop_management.php">Management</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/cs4096/pages/shop_tech.php">Review/Update WO</a></p></li>
		<!----<li><p><a href="<?php echo $docRoot; ?>/cs4096/pages/wo_status.php">Work Order Status</a></p></li>---->
		<li><p><a href="<?php echo $docRoot; ?>/cs4096/pages/change_password.php">Change your user password</a></p></li>
	</ul>
</div>
<br><br><br>
<hr>
