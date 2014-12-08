<?php
include_once 'control.php';
controlAdmin();

require_once '../config/config.php';
connectDb ();

$loginListQuery = mysql_query ( "SELECT * FROM login" );

echo "	<h1>Login Status</h1>
		<table id='loginstatus'>
			<th>DATE</th>
			<th>EMAIL</th>
			<th>IP</th>";

while ( $logeduser = mysql_fetch_assoc ( $loginListQuery ) ) {
	echo "	<tr id='loginuserrow'>
				<td id='loginusercolum'><p id='loginuser'>" . $logeduser ['date'] . "</p></td>
				<td id='loginusercolum'><p id='loginuser'>" . $logeduser ['email'] . "</p></td>
				<td id='loginusercolum'><p id='loginuser'>" . $logeduser ['ip'] . "</p></td>
			</tr>";
}

echo "	</table>";

?>
