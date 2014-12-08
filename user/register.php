<?php
include_once 'control.php';
controlGuests();
echo "<h1>Sing in:</h1>
		
        <table id='signintable'>
       		<tr id='signrow'>
        		<td><input type='text' class='input-text' id='name' name='name' placeholder='Name*' onblur='verifyNameOrSurname(this)'/></td>
			</tr>
			<tr id='errorname'>
			</tr>
			<tr id='signrow'>
        		<td><input type='text' class='input-text' id='surname' name='surname'  placeholder='Surname*' onblur='verifyNameOrSurname(this)'/></td>
        	</tr>
  			 <tr id='errorsurname'>
			</tr>
       		<tr id='signrow'>
        		<td><input type='text' class='input-text' id='email' name='email' placeholder='Write your university email*' onblur='verifyEmail(this)'/></td>
       		</tr>
       		<tr id='erroremail'>
			</tr>
        	<tr id='signrow'>
        		<td><input type='text' class='input-text' id='repeatEmail' name='repeatEmail' placeholder='Rewrite your university email*' onblur='verifyEmail(this)'/></td>
       		</tr>
        	<tr id='errorrepeatEmail'>
			</tr>
        	<tr id='signrow'>
        		<td><input type='password' class='input-text' id='password' name='password'  placeholder='Password*' onblur='verifyPassword(this)'/></td>
        	</tr>
        	<tr id='errorpassword'>
			</tr>
        	<tr id='signrow'>
        		<td><input type='password' class='input-text' id='repeatPassword' name='repeatPassword' placeholder='Repeat password*' onblur='verifyPassword(this)'/></td>
        	</tr>
        	<tr id='errorrepeatPassword'>
			</tr>
        	<tr id='signrow'>
       			<td><input type='text' class='input-text' id='phone' name='phone' maxlength='12'  placeholder='(+34)612345678*' onblur='verifyPhone(this)'/></td>
       		</tr>
       		<tr id='errorphone'>
			</tr>
       		<tr id='signrow'>
       			<td><input type='text' class='input-text' id='address' name='address' placeholder='City, Street, House Number' onblur='verifyAddress(this)'/></td>
       		</tr>
			<tr id='erroraddress'>
			</tr>
       		<tr id='signrow'>
       			<td><input type='text' class='input-text' id='birthdate' name='birthdate' maxlength='10' placeholder='YYYY/MM/DD*' onblur='verifyBirthdate(this)'/></td>
       		</tr>
			<tr id='errorbirthdate'>
			</tr>
        </table> 
		<input type='button' class='button' value='Sign in' onclick='signinSystem()'>";
?>
