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
	$listdatabase['NoAttributes'] = TRUE;
	$databases = &$GLOBALS['Tier6Databases'];
	
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	
	$list = new XhtmlUnorderedList($listdatabase, $databases);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('    ');

	$listidnumber['ObjectID'] = 2;
	
	$listoutput = $list->getOutput();
	
	$list1 = new XhtmlUnorderedList($listdatabase, $databases);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('    ');
	
	$listoutput1 = $list1->getOutput();
	
	$listidnumber['ObjectID'] = 3;
	
	$list2 = new XhtmlUnorderedList($listdatabase, $databases);
	$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'List');
	$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list2->FetchDatabase ($listidnumber);
	$list2->CreateOutput('    ');
	
	$listoutput2 = $list2->getOutput();
	
	$listidnumber = Array();
	$listidnumber['PageID'] = 1;
	
	/*if ($_GET['PageID']){
		$listidnumber['PageID'] = $_GET['PageID'];
	}*/
	$listidnumber['ObjectID'] = 1;
	
	$listdatabase = Array();
	$listdatabase['MainMenuNew'] = 'MainMenuNew';
	$listdatabase['NoAttributes'] = TRUE;
	$databases = &$GLOBALS['Tier6Databases'];
	
	$list3 = new XhtmlUnorderedList($listdatabase, $databases);
	$list3->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MainMenuNew');
	$list3->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list3->FetchDatabase ($listidnumber);
	$list3->CreateOutput('    ');
	//print_r($list3);
	
	$listoutput3 = $list3->getOutput();
	
	print "  $listoutput";
	print "  $listoutput1";
	print "  $listoutput2";
	print "  $listoutput3";
	
	//$demo = new XMLReader();
	//$demo->xml($listoutput3);
	//$demo->read();
	//$hold = $demo->readInnerXML();
	//print_r($hold);
	//print "\n";
	//print_r($list);
	
?>