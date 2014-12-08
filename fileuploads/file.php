<?php
include_once '../user/control.php';
controlUser();

$email = $_SESSION['email'];
echo "
			<form id='upload'>
				<h1>Profile picture upload</h1>
				<p>File:* <input id='file' type='file' name='file'></p>
				<input type='button' class='button' value='Upload' onclick=\"sendFile('$email')\">
			</form>";
?>