<?php
session_start();
	
		include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			echo "The security code entered was incorrect.<br /><br />";
			echo "Please try again.";
			exit;
		}
?>