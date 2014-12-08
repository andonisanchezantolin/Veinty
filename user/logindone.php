<?php
REQUIRE 'control.php';
controlGuests ();

$email = '';
$pass = '';
if (isset ( $_POST ['email'] ))
	$email = $_POST ['email'];
if (isset ( $_POST ['pass'] ))
	$pass = $_POST ['pass'];

INCLUDE '../config/config.php';
connectDb ();

$encript_pass = sha1 ( $pass );

$searchUser = mysql_query ( "SELECT * FROM users WHERE email='" . $email . "'" );
$searchStudent = mysql_query ( "SELECT * FROM students WHERE email='" . $email . "'" );

$userData = mysql_fetch_array ( $searchUser );
$studentData = mysql_fetch_array ( $searchStudent );
$userType = $userData ['type'];
$studentName = $studentData ['name'];

$userLogattempts = ( int ) $userData ['attempts'];

if ($userLogattempts < 3) {
	
	$userLogattempts ++;
	$userUpdateattempts = mysql_query ( "UPDATE users SET attempts=$userLogattempts WHERE email='".$email."'" );
	//user do not exist
	if (strcmp ( $userData ['email'], $email ) != 0){
		echo "	<input type='hidden' id='state' value=0></input>
				<p id='loginerror'>User and password are incorrect. Redirecting...</p>";
	}
	//user exist but the password is incorrect
	else if (strcmp ( $userData ['password'], $encript_pass ) != 0) {
		echo "	<input type='hidden' id='state' value=0></input>
				<p id='loginerror'>User and password are incorrect, attempts: " . $userLogattempts . ". Redirecting...</p>";
	//user and password are correct
	} else {
		
		$ip = $_SERVER ['REMOTE_ADDR'];
		$datenow = date ( 'Y-m-d H:i:s' );
		
		$saveLoginEvent = mysql_query ( "INSERT INTO login(date, email, ip) VALUES ('".$datenow."','".$email."','".$ip."')" );
		$sqlattemptsRestore = mysql_query ( "UPDATE users SET attempts=0 WHERE email='".$email."'" );
		if (! $userUpdateattempts || ! $sqlattemptsRestore || ! $saveLoginEvent)
			die ( 'Error: ' . mysql_error () );
		
		$_SESSION ['email'] = $email;
		$_SESSION ['type'] = $userType;
		
		echo "	<input type='hidden' name='state' id='state' value=1></input>
				<p id='message'>Welcome to Veinty Web $studentName, redirecting...</p>";
	}
} else
	echo "	<input type='hidden' id='state' value=0></input>
			<p id='loginerror'> You can not log in the system because you have exceeded the maximum number of attempts. Please contact the administrator, redireccting...</p>";
mysql_close ();
?>
