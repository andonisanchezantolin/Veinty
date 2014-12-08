<?php
session_start ();
function controlUser() {
	if (strcmp($_SESSION ['type'], 'student' )!=0)
		die ( "<p id='error'>Admin users do not have the privileges to perform this action.</p>" );
	return true;
}

function controlAdmin() {
	if (strcmp($_SESSION ['type'], 'admin')!=0)
		die (  "<p id='error'>Student users do not have the privileges to perform this action.</p>" );
	return true;
}

function controlLoged(){
	if (!isset ( $_SESSION ['type'] ))
		die ( "<p id='error'>You must log in to perform this action.</p>" );
	return true;
}

function controlGuests() {
	if (isset ( $_SESSION ['type'] ))
		die( "<p id='error'>You are already logged.</p>");
	return true;
}
?>