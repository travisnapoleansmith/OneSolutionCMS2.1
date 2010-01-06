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
	$listidnumber = Array();
	$listidnumber['PageID'] = 101;
	
	if ($_GET['PageID']){
		$listidnumber['PageID'] = $_GET['PageID'];
	}
	$listidnumber['ObjectID'] = 1;
	$listdatabase = Array();
	$listdatabase['List'] = 'List';
	
	$databases = &$GLOBALS['Databases'];
	
	$list = new XhtmlList($listdatabase, $databases);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('    ');

	$listidnumber['ObjectID'] = 2;
	
	$listoutput = $list->getOutput();
	
	$list1 = new XhtmlList($listdatabase, $databases);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('    ');
	
	$listoutput1 = $list1->getOutput();
	
	$listidnumber['ObjectID'] = 3;
	
	$list2 = new XhtmlList($listdatabase, $databases);
	$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list2->FetchDatabase ($listidnumber);
	$list2->CreateOutput('    ');
	
	$listoutput2 = $list2->getOutput();
	
	print "  $listoutput";
	print "  $listoutput1";
	print "  $listoutput2";
	//print "\n";
	//print_r($list);
	
?>