<?php
include_once '../config/config.php';

require_once '../lib/nusoap.php';
require_once '../lib/class.wsdlcache.php';

// create soap_server object
$ns = 'http://veinty.esy.es/webservice';
//$ns = 'http://localhost/SarVeinty(hosting)/webservice';
$serviceName = 'Verify your password!';
$functionName = 'checker';

$server = new soap_server ();

// show wsdl -> ../webservice/verifysecurepasswordservice.php?wsdl
$server->configureWSDL ( $serviceName, $ns );

// regiter password checker function
$server->register ( $functionName, array (
		'password' => 'xsd:string',
		'ticket' => 'xsd:string' ), array (
		'response' => 'xsd:string' ), $ns );

// password checker funtion implementation
function checker($password, $ticket) {
	connectDb ();
	$passwordsFilePath = 'passwords.txt';
	if ($password == '' or $ticket == '') {
		return 'INCORRECT DATA';
	} else if (! accessCheck ( $ticket )) {
		return 'UNAUTHORIZED USER';
	} else {
		// Increment access
		updateAccess ( $ticket );
		
		// Check Password
		$passwordsFile = file_get_contents ( $passwordsFilePath );
		$lines = explode ( "\n", $passwordsFile );
		$secure = 'SECURE PASSWORD';
		foreach ( $lines as $line ) {
			if (strstr($line, $password )) {
				$secure = 'INSECURE PASSWORD';
				break;
			}
		}
		return $secure;
	}
	mysql_close ();
}
function accessCheck($ticket) {
	$sql = mysql_query ( "Select * FROM tickets WHERE ticket='$ticket'" ) or die ( 'Error: ' . mysql_error () );
	if (mysql_num_rows ( $sql ) == 0)
		return false;
	else
		return true;
}
function updateAccess($ticket) {
	$ip = $_SERVER ['REMOTE_ADDR'];
	$searchAccessIP = mysql_query ( "SELECT * FROM access WHERE ip='$ip' AND ticket='$ticket'" ) or die ( 'Error: ' . mysql_error () );
	if (mysql_num_rows ( $searchAccessIP ) == 0) {
		$searchTicket = mysql_query ( "INSERT INTO access (ip, numaccess, ticket) VALUES ('$ip', '1', '$ticket')" ) or die ( 'Error: ' . mysql_error () );
	} else {
		$updateAccess = mysql_query ( "UPDATE access SET numaccess = numaccess + 1 WHERE ip='$ip'" ) or die ( 'Error: ' . mysql_error () );
	}
}
// call to nusoap service method
$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service ( $HTTP_RAW_POST_DATA );

?>