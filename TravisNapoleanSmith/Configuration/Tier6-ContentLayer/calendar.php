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
	$calendaridnumber = Array();
	$calendaridnumber['PageID'] = 1;
	$calendaridnumber['ObjectID'] = 1;
	
	if ($_GET['PageID']){
		$calendaridnumber['PageID'] = $_GET['PageID'];
	}
	
	$calendardatabase = Array();
	$calendardatabase['XhtmlCalendarTable'] = 'XhtmlCalendarTable';
	$calendardatabase['Day'] = NULL;
	$calendardatabase['Month'] = NULL;
	$calendardatabase['Year'] = NULL;
	
	$databases = &$GLOBALS['Tier6Databases'];
	
	$calendartable = new XhtmlCalendarTable($calendardatabase, $databases);
	$calendartable->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XhtmlCalendarTable');
	$calendartable->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$calendartable->FetchDatabase ($calendaridnumber);
	$calendartable->CreateOutput(NULL);
	$output = $calendartable->getOutput();
	
	/*$calendaridnumber['PageID'] = 2;
	$calendartable2 = new XhtmlCalendarTable($calendardatabase, $databases);
	$calendartable2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XhtmlCalendarTable');
	$calendartable2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$calendartable2->FetchDatabase ($calendaridnumber);
	$calendartable2->CreateOutput(NULL);
	$output2 = $calendartable2->getOutput();*/
	//print_r($calendartable);
	print "$output\n";
	//print "$output2\n";
?>