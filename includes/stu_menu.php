<?php 
//PHP FILE TO PRINT THE MENU OF THE SITE
$docRoot= "https://" . $_SERVER['HTTP_HOST'];//gets the root of the site
?>
<div id="menu">
	<ul id="navlist">
		<li><p><a href="<?php echo $docRoot; ?>/mae_shop/index.php">Home</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/mae_shop/pages/create_wo.php">Create Work Order</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/mae_shop/pages/wo_status.php">Work Order Status</a></p></li>
		<li><p><a href="<?php echo $docRoot; ?>/mae_shop/pages/stu_change_password.php">Change Password</a></p></li>
	</ul>
</div>
<br><br><br>
<hr>