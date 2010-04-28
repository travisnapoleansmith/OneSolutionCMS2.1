<?php
	require_once ('Configuration/includes.php');
	if (isset($_POST['Login'])) {
		// Fetch Current Page ID - Based On ID Number
		$loginidnumber = Array();
		$loginidnumber['PageID'] = 2;
		if ($_GET['PageID']){
			$loginidnumber['PageID'] = $_GET['PageID'];
		}
		
		$databaseoptions = NULL;
		$Tier5Databases->setPageID($loginidnumber['PageID']);
		$hold = $Tier5Databases->pass('FormValidation', 'FORM', $_POST);
		if ($hold['Error']) {
			if (session_name()) {
				session_unregister('UserAuthentication');
			}
			session_name('UserAuthentication');
			
			session_start();
			$_SESSION['POST'] = $hold;
			header("Location: session.php?SessionID=UserAuthentication");
		} 
		$hold = NULL;
		//$hold = $Tier4Databases->pass('UserAccounts', 'AUTHENTICATE', $_POST);
		/*if ($hold['Error']) {
			if (session_name()) {
				session_unregister('UserAuthentication');
			}
			session_name('UserAuthentication');
			
			session_start();
			$_SESSION['POST']['UserAccounts'] = $hold;
			header("Location: session.php?SessionID=UserAuthentication");
		}*/
		
		//print_r($hold);
		/*print_r($_POST);*/
		print "I AM HERE\n";
	} else {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="PHP Secured"');
		exit('Unauthorized!');
	}
?>