<?php
include_once 'control.php';
controlLoged();

require_once '../config/config.php';
connectDb();

$sender= $_SESSION ['email'];
$addressee = $_POST ['email'];

$queryStudent = (mysql_query ( "SELECT * FROM students WHERE email='$addressee'" ));
$studentInfo = mysql_fetch_array ( $queryStudent );
if (! $queryStudent)
	die ("<p id=errorsql> Error: " . mysql_error() . " </p> ");

if (strcmp ( $sender, $addressee ) == 0) {
	echo " 	<h1>My profile</h1>";
} else {
	echo "<h1>" . $studentInfo['name']. " " . $studentInfo['surname'] ." profile</h1>";
}

//PROFILE INFO
$picture = $studentInfo['picture'];
if (strcmp($picture, "nopicture.jpg") ==0 || strcmp($picture, "nopicture.png") ==0 )
	$picture = "fileuploads/nopicture.jpg";
else
	$picture = "fileuploads/users/" . $addressee ."/". $picture;

echo "	<div id='studentinfo'>
			<p id='info'><img id='profilepicture' src='". $picture."'></p>
			<p id='info'>Name: ". $studentInfo['name']. " </p>
			<p id='info'>Surname: ". $studentInfo['surname']. " </p>
			<p id='info'>Email: ". $studentInfo['email']. " </p>
			<p id='info'>Telephone number: ". $studentInfo['phone']. " </p>
			<p id='info'>Address: ". $studentInfo['address']. "</p>
		</div>";

//COMMENTS

$queryWall = mysql_query ( "SELECT * FROM wall WHERE addressee='". $addressee."' ORDER BY date DESC");
if(!$queryWall)
	die ( "<p id='errorsql'>Error: " . mysql_error ()." </p>");

echo "	<div id='wall'>

			<div id='commentDiv'>
				<p><textarea id='comment' rows='4' cols='100' placeholder='What are you thinking?'></textarea></p>
				<p><input type='button' class='button' value='Leave a comment' onclick=\"storeComment('$addressee')\"/></p>
			</div>
			
			<div id='othercommentsDiv'>";
			while ($wall = mysql_fetch_array($queryWall)){
				echo "
					<div>
						<table id='commenttable'>
							<tr>
								<td><p id='commentposted'>Posted on</p></td>
								<td><p id='commentdate'>" . $wall['date'] ."</p></td>
								<td><p id='commentby'>By</p></td>
								<td><p id='commentsender'>" . $wall['sender'] ."</p></td>
							</tr>
							<tr>
								<td colspan='4'><p id='comment'>". $wall['message']."</p></td>
							</tr>
						</table>
					</div>";
			}
		echo"
			</div>
				
		</div>";

mysql_close();


?>