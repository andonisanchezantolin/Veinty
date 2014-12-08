
<?php
session_start();
// Buttons for users who are not logged.
echo "<ul id=menulist>";
if (! isset ( $_SESSION ['type'] )){
	echo "
			<li id ='menu' class='button'  value='Login' onclick='login()'>Login</li>
			<li id ='menu' class='button'  value='Sign in' onclick='signin()'>Sign in</li>
			<li id='menu' class='button' value='Index' onclick='aboutus()'>About Us</li>
			<input type='hidden' id='loged' name='loged' value=0></input>	
			";
}


//Buttons for students and admin.
else {
	$email = $_SESSION['email'];
	if (strcmp($email, 'admin')==0){
		echo "	<li id='menu' class='button' onclick=\"loginStatus()\">Login status</li>";
	}
	else {
		echo "	<li id='menu' class='button' onclick=\"viewprofile('$email')\">My profile</li>
				<li id='menu' class='button' onclick='uploadimage()'>Upload Image</li>";
	}
	echo "
			 <li id='menu' class='button' onclick='profiles()'>Other profiles</li>
			 <li id='menu' class='button' onclick='logout()'>Logout</li>
			 <li id='menu'> <account>$email</account> </li>
			 <input type='hidden' id='loged' name='loged' value='".$_SESSION['email']."'></input>
	 	";
}

echo "	</ul>";


?>