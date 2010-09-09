<?php
	$sessionname = $_GET['SessionID'];

	if ($sessionname) {
		session_name($sessionname);
	} 
	session_start();
	
	// Includes all files
	require_once ('Configuration/includes.php');
	
	$printpreview = NULL;

	$Tier6Databases->setDatabaseTableName('AdministratorContentLayer');
	
	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	} else {
		$printpreview = FALSE;
	}
	
	$Tier6Databases->setPrintPreview($printpreview);
	
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['Enable/Disable'] = 'Enable';
	$contentidnumber['Status'] = 'Approved';
	
	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$contentidnumber['CurrentVersion'] = 'true';
	}
	
	$Tier6Databases->FetchDatabase($contentidnumber);
	$Tier6Databases->CreateOutput(NULL);
		
	$output = $Writer->flush();
	if ($output) {
		print "$output\n";
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>
