var XMLHttpRequestCounter = new XMLHttpRequest();
XMLHttpRequestCounter.onreadystatechange = function() {
	if (XMLHttpRequestCounter.readyState == 4) {
		var objCounter = document.getElementById('counter');
		var counterXML = XMLHttpRequestCounter.responseText;
		objCounter.innerHTML = counterXML;
	}
}

function showCounter() {
	XMLHttpRequestCounter.open("GET", "count/showcounter.php", true);
	XMLHttpRequestCounter.send();
}

function increaseCounter() {
	XMLHttpRequestCounter2 = new XMLHttpRequest();
	XMLHttpRequestCounter2.open("GET", "count/increasecounter.php", true);
	XMLHttpRequestCounter2.send();
}

function initializeCounter() {
	setInterval(showCounter, 3000);
}

window.onload = showCounter();
window.onload = increaseCounter();
window.onload = initializeCounter();
