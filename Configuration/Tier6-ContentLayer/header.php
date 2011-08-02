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
	$idnumber = Array();
	$idnumber['PageID'] = 1;
	if ($_GET['PageID']){
		$idnumber['PageID'] = $_GET['PageID'];
	}
	
	if (isset($_GET['RevisionID'])){
		$idnumber['RevisionID'] = $_GET['RevisionID'];
	} else {
		$idnumber['CurrentVersion'] = 'true';
	}
	
	if ($_GET['Theme']){
		$idnumber['Theme'] = $_GET['Theme'];
	}
	// Fetch PrintPreview Flag
	if ($_GET['printpreview']){
		$printpreview = $_GET['printpreview'];
	} else {
		$printpreview = FALSE;
	}
	
	// Fetch Userdefined StyleSheet
	if ($_GET['StyleSheet']){
		$stylesheet = $_GET['StyleSheet'];
	} else {
		$stylesheet = FALSE;
	}
	// Prints Out Header Information On Page ID
	$headerdatabase = Array();
	$headerdatabase['PageAttributes'] = 'PageAttributes';
	$headerdatabase['ContentLayerTheme'] = 'ContentLayerTheme';
	
	$databaseoptions = Array();
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$header = new XhtmlHeader($headerdatabase, $databaseoptions, $Tier6Databases);
	$header->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'PageAttributes');
	$header->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$header->FetchDatabase ($idnumber);
	
	$header->setSiteName($sitename);
	
	$header->CreateOutput ($printpreview, $stylesheet);
	
?>