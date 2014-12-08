<?php

include_once 'control.php';
controlGuests();

echo "
<h1>Login:</h1>
<table id='logintable' >
	<tr id='loginrow'>
		<td><input type='text' id='email' name='email'
			placeholder='Enter your email'/></td>
	</tr>
	<tr id='loginrow'>
		<td><input type='password' name='pass' id='pass'
			placeholder='********'/>
		</td>
	</tr>
</table>
</br>

<input type='button' class='button' value='Login' onclick='loginSystem()'>";
?>
