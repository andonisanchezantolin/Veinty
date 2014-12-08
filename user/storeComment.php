<?php
include_once 'control.php';
controlLoged ();
require_once ('../config/config.php');

include_once 'verifystudent.php';

if (isset ( $_POST ['addressee'] ))
	$addressee = $_POST ['addressee'];

if (isset ( $_POST ['comment'] )) {
	$comment = $_POST ['comment'];
}
if (verifyEmail ( $addressee )) {
	connectDb ();
	
	$sender = $_SESSION ['email'];
	
	$date = date ( 'Y-m-d H:i:s' );
	
	$insertCommentSql = mysql_query ( "INSERT INTO wall (addressee, sender, date, message)
			VALUES ('" . $addressee . "','" . $sender . "','" . $date . "','" . $comment . "')" );
	
	if (! $insertCommentSql) {
		die ( "<p id='error'>Error:  " . mysql_error () . "</p>" );
	}
	mysql_close ();
	echo "<p id='message'>Your comment has been sent to $addressee, redirecting...</p>";
}
?>