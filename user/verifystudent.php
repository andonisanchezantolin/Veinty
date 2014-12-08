<?php
include_once 'verifysecurepasswordclient.php';

function verifyEmail($elem) {
	$regularExpresionEmail = array (
			'options' => array (
					'default' => null,
					'regexp' => "/[a-z]{4,}[0-9]{3}@ikasle\.ehu\.es/" 
			) 
	);
	$isCorresctEmail = filter_var ( $elem, FILTER_VALIDATE_REGEXP, $regularExpresionEmail );
	if ($isCorresctEmail == false) {
		echo "<p id='errorfield'>Error: Student email < $elem > is wrong, e.g.: 'alumno000@ikasle.ehu.es'.</p>";
		return false;
	} else
		return true;
}
function verifyNameOrSurname($elem) {
	$regularExpresionNameOrSurname = array (
			'options' => array (
					'default' => null,
					'regexp' => "/([A-Z]|Ñ)([a-z]|ñ){2,}(\s([A-Z]|Ñ)([a-z]|ñ){2,}){0,}/" 
			) 
	);
	$isCorresctNameOrSurname = filter_var ( $elem, FILTER_VALIDATE_REGEXP, $regularExpresionNameOrSurname );
	if ($isCorresctNameOrSurname == false) {
		echo "<p id='reg' >Error: Either student name or surname < $elem > is wrong, e.g.: 'Name'.</p>";
	} else
		return true;
}
function verifyPassword($elem) {
	$regularExpresionPassword = array (
			'options' => array (
					'default' => null,
					'regexp' => "/(.){8,}/" 
			) 
	);
	$isCorresctPassword = filter_var ( $elem, FILTER_VALIDATE_REGEXP, $regularExpresionPassword );
	if ($isCorresctPassword == false) {
		return false;
		echo "<p id='errorfield' >Error: Student password is wrong, it has to contain at least 8 characteres.</p>";
	} else
		return true;
}
function verifyPhone($elem) {
	$regularExpresionPhone = array (
			'options' => array (
					'default' => null,
					'regexp' => "/(\+[0-9]{2})?[0-9]{9}/" 
			) 
	);
	$isCorresctPhone = filter_var ( $elem, FILTER_VALIDATE_REGEXP, $regularExpresionPhone );
	if ($isCorresctPhone == false) {
		echo "<p id='errorfield'> Error: Student phone number < $elem > is wrong, e.g.: '(+34)612345678'.</p>";
		return false;
	} else
		return true;
}

function verifyBirthdate($elem) {
	$regularExpresionBirthdate = array (
			'options' => array (
					'default' => null,
					'regexp' => "/[0-9]{4}(\/[0-9]{2}){2}/" 
			) 
	);
	$isCorresctBirthdate = filter_var ( $elem, FILTER_VALIDATE_REGEXP, $regularExpresionBirthdate );
	if ($isCorresctBirthdate == false) {
		echo "<p id='errorfield'>Error: Student birthdate < $elem > is wrong, e.g.: '1990/01/01'.</p>";
	} else
		return verifyDate($elem);
}

function verifyDate($elem){
	$year = substr($elem, 0, 4);
	$month = substr($elem, 5, 2);
	$day = substr($elem, 8, 2);
	if(checkdate($month, $day, $year))
		return true;
	else {	
		echo "<p id='errorfield'>Error: Student birthdate < $elem > does not exist, e.g.: '1990/01/01'.</p>";
		return false;
	}
}

function samePass($elem1, $elem2) {
	if (strcmp ( $elem1, $elem2 ) == 0)
		return true;
	else {
		echo "<p id='errorfield'>Error: Student password are diferrent.</p>";
	}
}
function sameEmail($elem1, $elem2) {
	if (strcmp ( $elem1, $elem2 ) == 0)
		return true;
	else {
		echo "<p id='errorfield'>Error: Student email are diferrent.</p>";
	}
}
function verifyStudent($name, $surname, $email, $repeatEmail, $password, $repeatPassword, $phone, $address, $birthdate) {
	if (verifyNameOrSurname ( $name ) && verifyNameOrSurname ( $surname ) 
			&& verifyEmail ( $email ) && verifyEmail ( $repeatEmail ) 
			&& samePass ( $email, $repeatEmail ) && verifyPassword ( $password ) 
			&& isSecurePass( $password ) 
			&& sameEmail ( $password, $repeatPassword ) 
			&& verifyPhone ( $phone ) && verifyBirthdate ( $birthdate ))
		return true;
	else
		return false;
}

?>