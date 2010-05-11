<?php	
	//error_reporting('E_ERROR');
	// Includes all files
	require_once ('Configuration/includes.php');
	
	// Fetch idnumber For Current Page
	$idnumber = 1;
	if ($_GET['PageID']){
		$idnumber = $_GET['PageID'];
	}

	$idnumberkeep = $idnumber;

	$Tier6Databases->setDatabaseTableName('ContentLayer');
	
	if ($_GET['printpreview']) {
		$printpreview = TRUE;
	} else {
		$printpreview = FALSE;
	}
	
	$Tier6Databases->setPrintPreview($printpreview);
	
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	$contentidnumber['PageID'] = $idnumber;
	$contentidnumber['RevisionID'] = 0;
	$contentidnumber['CurrentVersion'] = 'true';
	$contentidnumber['Enable/Disable'] = 'Enable';
	$contentidnumber['Status'] = 'Approved';
	
	$Tier6Databases->FetchDatabase($contentidnumber);
	$Tier6Databases->CreateOutput(NULL);
	
	$output = $Writer->flush();
	if ($output) {
		print "$output\n";
	} else {
		header("HTTP/1.0 404 Not Found");
	}
?>
