<?php
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
	$contentidnumber['PageID'] = 1;
	$contentidnumber['ObjectID'] = 0;
	//$contentidnumber['RevisionID'] = 0;
	$contentidnumber['CurrentVersion'] = 'true';
			
	if ($_GET['PageID']){
		$contentidnumber['PageID'] = $_GET['PageID'];
	}
	
	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
		unset($contentidnumber['CurrentVersion']);
	}
	
	if ($_GET['CurrentVersion']){
		$contentidnumber['CurrentVersion'] = $_GET['CurrentVersion'];
	}

	if ($_GET['printpreview']) {
		$contentidnumber['printpreview'] = TRUE;
	} else {
		$contentidnumber['printpreview'] = FALSE;
	}
	
	$contentdatabase = Array();
	$contentdatabase['Content'] = 'Content';
	$contentdatabase['ContentLayerTables'] = 'ContentLayerTables';
	$contentdatabase['ContentPrintPreview'] = 'ContentPrintPreview';
	$contentdatabase['ContentLayerModules'] = 'ContentLayerModules';
		
	//$databases = &$GLOBALS['Tier6Databases'];
	$databaseoptions = NULL;
	
	$content = new XhtmlContent($contentdatabase, $databaseoptions);
	$content->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'Content');
	$content->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$content->FetchDatabase ($contentidnumber);
	$content->CreateOutput('    ');
	
	//$contentoutput = $content->getOutput();

	//print "$contentoutput";
	
?>