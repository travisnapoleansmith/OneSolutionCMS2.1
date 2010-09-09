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
	$contentidnumber['PageID'] = 10;
	$contentidnumber['ObjectID'] = 0;
			
	if ($_GET['PageID']){
		$contentidnumber['PageID'] = $_GET['PageID'];
	}
	
	if (isset($_GET['RevisionID'])){
		$contentidnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$contentidnumber['CurrentVersion'] = 'true';
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
	$contentdatabase['Content'] = 'AdministratorContent';
	$contentdatabase['ContentLayerTables'] = 'ContentLayerTables';
	$contentdatabase['ContentPrintPreview'] = NULL;
	$contentdatabase['ContentLayerModules'] = 'ContentLayerModules';
		
	$databaseoptions = array();
	if (is_array($_SESSION['POST']['Error'])) {
		$databaseoptions['Insert'] = $_SESSION['POST']['Error'];
	}

	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$content = new XhtmlContent($contentdatabase, $databaseoptions, $Tier6Databases);
	$content->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'AdministratorContent');
	$content->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$content->FetchDatabase ($contentidnumber);
	$content->FetchDatabase ($contentidnumber);
	//$content->CreateOutput('    ');
	
	//$contentoutput = $content->getOutput();
	//if ($contentoutput) {
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-top');
		$Writer->fullEndElement();
		
		//$Writer->writeRaw($contentoutput);
		$content->CreateOutput('    ');
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-bottom');
		$Writer->fullEndElement();
	//} else {
		/*$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-top');
		$Writer->fullEndElement();
		
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-middle-empty');
		$Writer->fullEndElement();
		
		$Writer->startElement('div');
		$Writer->writeAttribute('id', 'main-content-bottom-empty');
		$Writer->fullEndElement();
	}*/
	//print "$contentoutput";
	
	
?>