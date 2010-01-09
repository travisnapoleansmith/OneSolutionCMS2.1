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
	
	$headerdatabase = Array();

	if ($_GET['NewsID']){
		$idnumber['PageID'] = $_GET['NewsID'];
		$headerdatabase['NewsPageAttributes'] = 'NewsPageAttributes';
		$headername = 'NewsPageAttributes';
	} else {
		$headerdatabase['NewsPageAttributesYearMonth'] = 'NewsPageAttributesYearMonth';
		$headername = 'NewsPageAttributesYearMonth';
	}
	
	if ($_GET['StoryYear'] & $_GET['StoryMonth']) {
		$idnumber['PageID'] = $_GET['StoryYear'] . $_GET['StoryMonth'];
	} else if ($_GET['StoryYear']) {
		$idnumber['PageID'] = $_GET['StoryYear'];
	} else if ($_GET['StoryMonth']) {
		$idnumber['PageID'] = $_GET['StoryMonth'];
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
	
	$databases = &$GLOBALS['Databases'];
	
	$header = new XhtmlHeader($headerdatabase, $databases);
	$header->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $headername);
	$header->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$header->FetchDatabase ($idnumber);
	
	$header->setSiteName($sitename);
	
	$header->CreateOutput ($printpreview, $stylesheet);
	$headeroutput = $header->GetOutput();
	if ($headeroutput) {
		print "$headeroutput";
		print "\n";
	} else {
		//print "I AM HERE!";
		//header("HTTP/1.0 404 Not Found");
	}
	
?>