<?php
include_once 'control.php';
controlLoged();
require_once '../config/config.php';

$email = $_SESSION ['email'];
if (isset($_POST['search']))
	$search = $_POST ['search'];

connectDb ();
echo " 	<h1>Other profiles</h1>
		<h2>Search Profile: 
			<input type='text' id='searchstudent' name='searchstudent' placeholder='Student LDAP or initial letters'/>
			<input type='button' class='button' value='Search' onclick='search()'/>
		</h2> 
		<div id='otherprofiles'>
			<ul id=students>";
if (isset ( $search )) {
	$studentListQuery = mysql_query ( "SELECT * FROM students WHERE email like '" . $search . "%s'" );
} else {
	$studentListQuery = mysql_query ( "SELECT * FROM students" );
}

while ( $student = mysql_fetch_assoc ( $studentListQuery ) ) {
		$studentemail = $student ['email'];
		$studentinfo = $student ['name'] . ' ' . $student ['surname'];
		if(strcmp($studentemail, $_SESSION['email'])!=0)
			echo "<li id='student' class='button' onclick=\"viewprofile('$studentemail')\">$studentinfo</li>";
}

echo "		</ul>
		</div>";

if (mysql_num_rows($studentListQuery)==0){
	echo "<p ></p>";
}

// free result memory for the next Query.
mysql_free_result ( $studentListQuery );

mysql_close ();

?>