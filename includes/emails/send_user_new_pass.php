<?php
include '../includes/connection.php';

//Subject
$subject =  'DO NOT REPLY: Password Reset';
$docRoot= "https://" . $_SERVER['HTTP_HOST'];

//message
$message = '<html><p>Here is your new password, please change it as soon as possible:</p> <b>';
$message .= $newpass;

//Additional Headers
$headers = "From: mae-workorder.mst.edu"."\r\n"."reply-To: mae-workorder.mst.edu";
//  will add mitch as CC
//$headers .= "CC: cotrellm@mst.edu\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to, $subject, $message, $headers);
?>
