<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	// General Settings
	require_once "$HOME/Configuration/settings.php";
	
	if (!($_GET['Token'] === 'ABC123')) {
		//header('WWW-Authenticate: Basic realm="My Realm"');
		header('HTTP/1.0 401 Unauthorized');
		//echo 'Text to send if user hits Cancel button';
		exit;
		//print_r($_SERVER);
	} else {
		// All Tier Abstract
		require_once "$HOME/ModulesAbstract/LayerModulesAbstract.php";
	
		// Tiers Modules Abstract
		require_once "$HOME/ModulesAbstract/Tier2DataAccessLayer/Tier2DataAccessLayerModulesAbstract.php";
	
		// Tiers Interface Includes
		require_once "$HOME/ModulesInterfaces/Tier2DataAccessLayer/Tier2DataAccessLayerModulesInterfaces.php";
	
		// Tiers Includes
		require_once "$HOME/Tier2-DataAccessLayer/ClassDataAccessLayer.php";
	
		// Tier 2 Modules
		require_once "$HOME/Modules/Tier2DataAccessLayer/Core/MySqlConnect/ClassMySqlConnect.php";
	
		// Tier 2 Data Access Layer Settings
		require_once "$HOME/Configuration/Tier2DataAccessLayerSettings.php";
	
		$Tier2Databases = &new DataAccessLayer();
	
		/*function TESTING ($Test) {
			$ServerLocation = $GLOBALS['ServerLocation'];
			$Array = $_GET;
			//$Array = $_SERVER;
			//$Array = get_headers($ServerLocation);
			//$Array = $_POST;
			return $Array;
		}*/
	
		$ServerLocation = $sitelink . '/Tier2-DataAccessLayer/';
		//print_r($Tier2Databases);
		//print "$ServerLocation\n";
		$Server = new SoapServer(NULL, array('uri' => $ServerLocation, 'soap_version' => 'SOAP_1_2'));
		//$Server->addFunction('TESTING');
	
		$Server->setObject($Tier2Databases);
		// CREATE A SOAP_Service_Secure CLASS FOR TOKEN AUTHENTICATION AND DataAccessLayerSettings to be enforced.
		// Make Soap_Secure_Server take an Tier2Database Object to initialize it with.
		$Server->handle();
		//$VAR = get_headers('http://atpaversion3.travisnapoleansmith.com/Tier2-DataAccessLayer/');
		//$VAR = get_headers($ServerLocation);
	}
?>