<?php
function isSecurePass($password){
	if (isset($password))
	{
		$webServicePath = 'http://veinty.esy.es/webservice/verifysecurepasswordservice.php';
		//$webServicePath = 'http://localhost/SarVeinty(hosting)/webservice/verifysecurepasswordservice.php';
		require_once('../lib/nusoap.php');
		require_once('../lib/class.wsdlcache.php');
		
		//create nusoap client with SOAP service
		$soapclient = new nusoap_client($webServicePath, false);
		$ticket='00001';
		
		$functionName = 'checker';
		
		//call to WebService function checker and save response
		$response = $soapclient->call($functionName,array('password'=>$password,'ticket'=>$ticket));
		
		if(strcmp($response, 'SECURE PASSWORD')==0)
			return true;
		else if (strcmp($response, 'INSECURE PASSWORD')==0){
			echo "<p id='errorfield'>Error: Student password is insecure.</p>";
			return false;
		}else {
			echo "<p id='errorfield'>Error: Service is unauthorizer, please contact with the administrator.</p>";
			return false;
		}
	}
}
?>