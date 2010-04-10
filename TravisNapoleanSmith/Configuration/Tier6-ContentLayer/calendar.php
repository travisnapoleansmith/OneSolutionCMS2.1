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
	
	$databaseoptions = array();
	$databaseoptions['Day'] = NULL;
	$databaseoptions['Month'] = NULL;
	$databaseoptions['Year'] = NULL;
	
	$calendartable = new XhtmlCalendarTable($calendardatabase, $databaseoptions);
	$calendartable->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'XhtmlCalendarTable');
	$calendartable->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$calendartable->FetchDatabase ($calendaridnumber);
	$calendartable->CreateOutput(NULL);
	
	$output = $GLOBALS['Writer']->flush();
	print "$output";
	
?>