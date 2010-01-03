<?php
	//print "TESTING\n";
	require_once ("Modules/Tier6ContentLayer/XhtmlContent/ClassXhtmlContent.php");
	require_once ("Configuration/Tier3ProtectionLayerDatabaseSettings.php");
	require ("Configuration/settings.php");
	
	// Fetch Current Page ID - Based on filename
	//$pagename = $_SERVER['PHP_SELF'];
	//$directory = dirname($_SERVER['PHP_SELF']);
	//$directory .= '/';
	//$pagename = str_replace($directory, ' ', $pagename);
	//$pagename = trim($pagename);
	//if ($pagename[0] == '/') {
		//$pagename[0] = '';
		//$pagename = trim($pagename);
	//}
	
	// Fetch Current Page ID - Based On ID Number
	$contentidnumber = Array();
	// MUST LOOK AT FIXING P PROBLEM WITH LINKS!
	$contentidnumber['PageID'] = 1;
		
	if ($_GET['PageID']){
		$contentidnumber['PageID'] = $_GET['PageID'];
	}
	
	$contentidnumber['ObjectID'] = 0;
	
	if ($_GET['printpreview']) {
		$contentidnumber['printpreview'] = TRUE;
	} else {
		$contentidnumber['printpreview'] = FALSE;
	}
	
	$contentdatabase = Array();
	$contentdatabase['Content'] = 'Content';
	$contentdatabase['ContentLayerTables'] = 'ContentLayerTables';
	$contentdatabase['ContentPrintPreview'] = 'ContentPrintPreview';
		
	$databases = &$GLOBALS['Databases'];
	
	$content = new XhtmlContent($contentdatabase, $databases);
	$content->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Content');
	$content->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$content->FetchDatabase ($contentidnumber);
	$content->CreateOutput('    ');
	
	$contentoutput = $content->getOutput();

	print "$contentoutput";
	
?>