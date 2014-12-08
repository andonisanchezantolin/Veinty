<?php
include_once 'control.php';
controlGuests ();

$name = '';
$surname = '';
$email = '';
$repeatEmail = '';
$password = '';
$repeatPassword = '';
$phone = '';
$address = '';
$birthdate = '';

if (isset ( $_POST ['name'] ))
	$name = $_POST ['name'];
if (isset ( $_POST ['surname'] ))
	$surname = $_POST ['surname'];
if (isset ( $_POST ['email'] ))
	$email = $_POST ['email'];
if (isset ( $_POST ['repeatEmail'] ))
	$repeatEmail = $_POST ['repeatEmail'];
if (isset ( $_POST ['password'] ))
	$password = $_POST ['password'];
if (isset ( $_POST ['repeatPassword'] ))
	$repeatPassword = $_POST ['repeatPassword'];
if (isset ( $_POST ['phone'] ))
	$phone = $_POST ['phone'];
if (isset ( $_POST ['address'] ))
	$address = $_POST ['address'];
if (isset ( $_POST ['birthdate'] ))
	$birthdate = $_POST ['birthdate'];
	
INCLUDE 'verifystudent.php';

if (verifyStudent ( $name, $surname, $email, $repeatEmail, $password, $repeatPassword, $phone, $address, $birthdate )) {
	INCLUDE "../config/config.php";
	
	connectDb ();
	$encript_pass = sha1 ( $password );
	
	$insertStudent = "INSERT INTO students(email, name, surname, address , phone, birthdate, picture) VALUES                    
	 ('$email','$name','$surname','$address','$phone','$birthdate','nopicture.jpg')";
	$insertUser = "INSERT INTO users(email, password, type, attempts) VALUES
	 ('$email', '$encript_pass', 'student', 0)";
	
	if (! mysql_query ( $insertStudent ) || ! mysql_query ( $insertUser ))
		die ( "<p id='errorsql'> Error: " . mysql_error () . "</p>" );
	
	mysql_close ();
	
	echo "<p id='message'>Welcome $name your register has been completed succesfuly. You can log in now.</p>";
}

?>
