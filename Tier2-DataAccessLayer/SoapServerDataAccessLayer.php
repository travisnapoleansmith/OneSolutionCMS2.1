<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	// General Settings
	require_once "$HOME/Configuration/settings.php";

	$TOKENKEY = $GLOBALS['SETTINGS']['TIER CONFIGURATION']['TOKENKEY'];
	$TOKEN = $_GET['Token'];

	/*
	require_once "../Libraries/GlobalLayer/GoogleOAuth/OAuthStore.php";
	require_once "../Libraries/GlobalLayer/GoogleOAuth/OAuthServer.php";
	//require_once "../Libraries/GlobalLayer/GoogleOAuth/OAuthRequester.php";

	$Options = array('consumer_key' => "ABC1234", 'consumer_secret' => "1234ABC", 'token_secret' => "DOG");

	$Store = OAuthStore::instance("2Leg", "Options");

	$Server = new OAuthServer();

	$Authorized == false;
	try {
		if ($Server->verifyIfSigned()) {
			$Authorized = true;
		}
	} catch (OAuthException2 $E) {

	}

	if ($Authorized === true) {
		print "DO THIS\n";
	} else {
		print "THIS ONE\n";
	}
	$Token = $Server->requestToken();
	$HOLD = $Store->getSecretsForSignature(NULL, NULL);
	print_r($HOLD);
	//print_r($Store);
	//print_r($Server);
	*/
	/*
	if ($TOKEN === $TOKENKEY) {
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

		try {

			$ServerLocation = $sitelink . '/Tier2-DataAccessLayer/';

			$Server = new SoapServer(NULL, array('uri' => $ServerLocation, 'soap_version' => 'SOAP_1_2'));

			$Server->setClass('DataAccessLayer');
			$Server->setPersistence(SOAP_PERSISTENCE_SESSION);

			$Server->handle();

		} catch (SoapFault $E) {
			error_log("SOAP ERROR: ". $E->getMessage());
		}

	} else {
		//header('WWW-Authenticate: Basic realm="My Realm"');
		header('HTTP/1.0 401 Unauthorized');
		//echo 'Text to send if user hits Cancel button';
		exit;
	}
	*/
?>