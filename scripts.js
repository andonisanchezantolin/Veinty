XMLHttpRequestObject = new XMLHttpRequest();
XMLHttpRequestObject.onreadystatechange = function() {
	if (XMLHttpRequestObject.readyState == 4) {
		var obj = document.getElementById('addDiv');
		obj.innerHTML = XMLHttpRequestObject.responseText;
	}
}

XMLHttpRequestObjectIndex = new XMLHttpRequest();
XMLHttpRequestObjectIndex.onreadystatechange = function() {
	if (XMLHttpRequestObjectIndex.readyState == 4) {
		var objIndex = document.getElementById('indexDiv');
		objIndex.innerHTML = XMLHttpRequestObjectIndex.responseText;
	}
}

// Session functions

function login() {
	XMLHttpRequestObject.open("GET", "user/login.php");
	XMLHttpRequestObject.send(null);
}

function signin() {
	XMLHttpRequestObject.open("GET", "user/register.php");
	XMLHttpRequestObject.send(null);
}

function loginStatus() {
	XMLHttpRequestObject.open("GET", "user/loginstatus.php");
	XMLHttpRequestObject.send(null);
}

function profiles() {
	XMLHttpRequestObject.open("GET", "user/profiles.php");
	XMLHttpRequestObject.send(null);
}

function logout() {
	cleanmenu();
	XMLHttpRequestObject.open("GET", "user/logout.php");
	XMLHttpRequestObject.send(null);
	var time = setTimeout(function(){aboutus(); },3000);
	setTimeout(function(){clearTimeout(time); },3000);;
}

// Displayers

function aboutus() {
	XMLHttpRequestObject.open("GET", "config/aboutus.php");
	XMLHttpRequestObject.send(null);
	getmenu();
}

function getmenu() {
	XMLHttpRequestObjectIndex.open("GET", "config/indexbuttons.php");
	XMLHttpRequestObjectIndex.send(null);
}

function cleanmenu() {
	XMLHttpRequestObjectIndex.open("GET", "config/clear.php");
	XMLHttpRequestObjectIndex.send(null);
}

function uploadimage() {
	XMLHttpRequestObject.open("GET", "fileuploads/file.php");
	XMLHttpRequestObject.send(null);
}

function viewprofile(email) {
	XMLHttpRequestObject.open("POST", "user/profile.php");
	XMLHttpRequestObject.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	XMLHttpRequestObject.send('email=' + email);
}

function viewprofiles(email) {
	XMLHttpRequestObject.open("POST", "user/profiles.php");
	XMLHttpRequestObject.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	XMLHttpRequestObject.send('email=' + email);
}

function chargemyprofile(myemail){
	var time = setTimeout(function(){viewprofile(myemail); },3000);
	setTimeout(function(){clearTimeout(time); getmenu() },3000);
}

// Charge different pages according to the user: loginstatus(loged-admin), myprofile(loged-student) 
// or login(if user and password do no exist)
function canlogin(email){
	var state = document.getElementById('state').value;
	if (state==1)
		if(email=='admin')
			loginStatus();
		else
			viewprofile(email);
	else
		login();
	getmenu();
}

function loginSystem() {
	cleanmenu();
	var email = document.getElementById('email').value;
	var pass = document.getElementById('pass').value;

	var menssagepost = 'email=' + email + '&pass=' + pass;
	XMLHttpRequestObject.open("POST", "user/logindone.php");
	XMLHttpRequestObject.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	XMLHttpRequestObject.send(menssagepost);
	
	var time = setTimeout(function(){canlogin(email); },3000);
	setTimeout(function(){clearTimeout(time); },3000);	
}

function signinSystem() {
	var name = document.getElementById('name');
	var surname = document.getElementById('surname');
	var email = document.getElementById('email');
	var repeatEmail = document.getElementById('repeatEmail');
	var password = document.getElementById('password');
	var repeatPassword = document.getElementById('repeatPassword');
	var phone = document.getElementById('phone');
	var address = document.getElementById('address');
	var birthday = document.getElementById('birthdate');

	if (verifyStudent(name, surname, email, repeatEmail, password,
			repeatPassword, phone, address, birthday)) {
		var messagepost = 'name=' + name.value + '&surname=' + surname.value
				+ '&email=' + email.value + '&repeatEmail=' + repeatEmail.value
				+ '&password=' + password.value + '&repeatPassword='
				+ repeatPassword.value + '&phone=' + phone.value + '&address='
				+ address.value + '&birthdate=' + birthdate.value;

		XMLHttpRequestObject.open("POST", "user/insertstudent.php");
		XMLHttpRequestObject.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		XMLHttpRequestObject.send(messagepost);
	}
}

// Other functions

function storeComment(addressee) {
	var comment = document.getElementById("comment").value;
	XMLHttpRequestObject.open("POST", "user/storeComment.php");
	XMLHttpRequestObject.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	var messagepost = 'addressee=' + addressee + '&comment=' + comment;
	XMLHttpRequestObject.send(messagepost);
	chargemyprofile(addressee);
}

function search() {
	var search = document.getElementById("searchstudent");
	if (search.value != '') {
		XMLHttpRequestObject.open("POST", "user/profiles.php");
		XMLHttpRequestObject.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		XMLHttpRequestObject.send('search=' + search.value);
	}
}

function sendFile(email){
	var formdata = new FormData();
	var file = document.getElementById('file');
	formdata.append('file', file.files[0]);
	XMLHttpRequestObject.open("POST", "fileuploads/pictureprocessor.php",true);
	XMLHttpRequestObject.send(formdata);
	chargemyprofile(email);
}

// Charge of main menu buttons and my profile(loged-student), login status(loged-admin) or about(do not loged)
function istheresession(){
	var email = document.getElementById('loged').value;
	if (email==0)
		aboutus();
	else if(email=='admin')
		loginStatus();
	else
		viewprofile(email);
}

//Load main after a few miliseconds, because hidden element with id 'loged' need to charge previusly.
getmenu(); 
var time = setTimeout(function(){istheresession(); }, 1500);
setTimeout(function(){clearTimeout(time);  }, 1500);


