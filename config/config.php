<?php
function connectDb() {
	// $mode = 0; // jose
	 $mode = 1; //hostinger
	// $mode = 2; // andoni
	Switch ($mode) {
		case 0 :
			$server = 'localhost';
			$user = 'root';
			$pass = '';
			$db = 'veintyWebf';
			break;
		case 1 :
			$server = 'mysql.hostinger.es';
			$user = 'u695624977_admin';
			$pass = 'sarveinty';
			$db = 'u695624977_veint';
			break;
		case 2 :
			$server = 'localhost';
			$user = 'root';
			$pass = 'admin';
			$db = 'veintyWebf';
			break;
		default :
			die ( "The allocation of the database failed." );
			break;
	}
	
	$connect = mysql_connect ( $server, $user, $pass ) or die ( mysql_error () );
	mysql_select_db ( $db, $connect ) or die ( mysql_error () );
}
?>