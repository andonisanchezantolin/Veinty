function cell(verify,elem) {
	if (verify) {
		elem.style.borderColor = "green";
		document.getElementById('error'+elem.name).innerHTML='';
	} else {
		elem.style.borderColor = "red";
	}
}

function verifyNameOrSurname(elem) {
	reElem = new RegExp(/^([A-Z]|Ñ)([a-z]|ñ){2,}(\s([A-Z]|Ñ)([a-z]|ñ){2,}){0,}$/);
	var verify = reElem.test(elem.value);
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to start with a capital letter. Also, it has to contain at least 2 more letters.</p>";
		return false;
	}
}

function verifyEmail(elem) {
	reElem = new RegExp(/^[a-z]{4,}[0-9]{3}@ikasle\.ehu\.es$/);
	var verify = reElem.test(elem.value);
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to be a student email formed by lowercase letters: student000@ikasle.ehu.es.</p>";
		return false;
	}
}

function verifyPassword(elem) {
	reElem = new RegExp(/^(.){8,}$/);
	var verify = reElem.test(elem.value);
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to have eight characters.</p>";
		return false;
	}
}

function verifyPhone(elem) {
	reElem = new RegExp(/^(\+[0-9]{2})?[0-9]{9}$/);
	var verify = reElem.test(elem.value);
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to be (+34)612345678, example: +34612345678 or 612345678 .</p>";
		return false;
	}
}

function verifyAddress(elem) {
	var verify = true;
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to be correct address.</p>";
		return false;
	}
}

function verifyBirthdate(elem) {
	reElem = new RegExp(/^[0-9]{4}(\/[0-9]{2}){2}$/);
	var verify = reElem.test(elem.value);
	cell(verify,elem);
	if (verify)
		return true;
	else{
		document.getElementById('error'+elem.name).innerHTML="<p id='expresionerror'>It has to follow the pattern YYYY/MM/DD, e.g.: 1992/04/03.</p>";
		return false;
	}
}

function sameElem(elem1, elem2) {
	if (elem1.value != elem2.value) {
		elem1.style.borderColor = "red";
		elem2.style.borderColor = "red";
		document.getElementById('error'+elem2.name).innerHTML="<p id='expresionerror'>The "+ elem1.name +"s are diferents.</p>";
		return false;
	} else {
		elem1.style.borderColor = "green";
		elem2.style.borderColor = "green";
		document.getElementById('error'+elem2.name).innerHTML='';
		return true;
	}		
}

function verifyStudent(name, surname, email, repeatEmail, password,
		repeatPassword, phone, address, birthdate) {
	if (verifyNameOrSurname(name) && verifyNameOrSurname(surname)
			&& verifyEmail(email) && verifyEmail(repeatEmail)
			&& sameElem(email, repeatEmail)
			&& verifyPassword(password)
			&& sameElem(password, repeatPassword)
			&& verifyPhone(phone) && verifyAddress(address) 
			&& verifyBirthdate(birthdate))
		return true;
	else
		return false;
}