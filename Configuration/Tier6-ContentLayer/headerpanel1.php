<?php
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
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
	$listidnumber = Array();
	$listidnumber['PageID'] = 1;
	
	if ($_GET['PageID']){
		$listidnumber['PageID'] = $_GET['PageID'];
	}
	
	$listidnumber['ObjectID'] = 1;
		
	$listdatabase = Array();
	$listdatabase['HeaderPanel1'] = 'HeaderPanel1';
	
	$databaseoptions = Array();
	$Writer = $GLOBALS['Writer'];
	
	$GLOBALS['Writer']->startElement('div');
	$GLOBALS['Writer']->writeAttribute('id', 'header');
	
	$Tier6Databases = $GLOBALS['Tier6Databases'];
	
	$list = new XhtmlMenu($listdatabase, $databaseoptions, $Tier6Databases);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'HeaderPanel1');
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('   ');
	$listidnumber['ObjectID'] = 2;
	
	$list1 = new XhtmlMenu($listdatabase, $databaseoptions, $Tier6Databases);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'HeaderPanel1');
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('   ');
	
	$GLOBALS['Writer']->endElement(); // ENDS DIV
?>