<?php
	$HOME = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
	// General Settings
	require_once "$HOME/Configuration/settings.php";
	
	$TOKENKEY = $GLOBALS['SETTINGS']['TIER CONFIGURATION']['TOKENKEY'];
	
	//session_start();
	
	$Options = array('consumer_key' => "CONSUMER KEY", 'consumer_secret' => "CONSUMER SECRET");
	/*
	require_once "../Libraries/GlobalLayer/GoogleOAuth/OAuthStore.php";
	require_once "../Libraries/GlobalLayer/GoogleOAuth/OAuthRequester.php";
	
	OAuthStore::instance("2Leg", $Options);
	
	$Url = 'http://atpaversion3.travisnapoleansmith.com/Tier2-DataAccessLayer/SoapServerDataAccessLayer.php';
	$Method = 'GET';
	$Parameters = NULL;
	
	$Request = new OAuthRequester($Url, $Method, $Parameters);
	print_r($Request);
	*/
	$Location = 'http://atpaversion3.travisnapoleansmith.com/Tier2-DataAccessLayer/SoapServerDataAccessLayer.php?Token=' . $TOKENKEY;
	$Uri = 'http://atpaversion3.travisnapoleansmith.com/';
	$Client = new SoapClient(NULL, array('location' => $Location, 
										'uri' => $Uri, 
										'soap_version' => SOAP_1_2));
	
	
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	
	$Client->createDatabaseTable('ContentLayer');
	$Client->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], NULL);
	$Client->buildModules('DataAccessLayerModules', 'DataAccessLayerTables', 'DataAccessLayerModulesSettings');
	
	$return = $Client->getDatabasename();
	//$return = $Client->getDatabaseTable();
	print_r($return);
	
	//$return = $Client->TESTING();
	//print_r($return);
	print "HERE\n";
	
	/////print "HERE\n";
?>
