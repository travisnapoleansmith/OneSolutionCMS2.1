<?php
	require_once ('Configuration/includes.php');
	//print_r($_POST);
	if (isset($_POST['Login'])) {
		//print "I AM Logged In\n";
		//print_r($_POST);
		//print_r($Tier5Databases);
		// Fetch Current Page ID - Based On ID Number
		$loginidnumber = Array();
		$loginidnumber['PageID'] = 2;
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$databaseoptions = NULL;
		$Tier5Databases->setPageID($loginidnumber['PageID']);
		$hold = $Tier5Databases->pass('FormValidation', 'FORM', $_POST);
		print_r ($hold);
		print "\n";
		//print_r($Tier5Databases->getModules('FormValidation'));
	} else {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="PHP Secured"');
		exit('Unauthorized!');
	}
?>