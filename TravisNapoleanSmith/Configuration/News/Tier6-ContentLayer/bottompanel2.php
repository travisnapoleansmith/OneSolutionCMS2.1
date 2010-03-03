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
	$listidnumber['PageID'] = 1;
	$listidnumber['ObjectID'] = 0;
	
	$listdatabase = Array();
	
	if ($_GET['NewsID']){
		$listidnumber['PageID'] = $_GET['NewsID'];
		$listdatabase['NewsMenuBottomPanel2'] = 'NewsMenuBottomPanel2';
		$listname = 'NewsMenuBottomPanel2';
	} else {
		$listdatabase['NewsMenuBottomPanel2YearMonth'] = 'NewsMenuBottomPanel2YearMonth';
		$listname = 'NewsMenuBottomPanel2YearMonth';
	}
	
	if ($_GET['StoryYear'] & $_GET['StoryMonth']) {
		$listidnumber['PageID'] = $_GET['StoryYear'] . $_GET['StoryMonth'];
	} else if ($_GET['StoryYear']) {
		$listidnumber['PageID'] = $_GET['StoryYear'];
	} else if ($_GET['StoryMonth']) {
		$listidnumber['PageID'] = $_GET['StoryMonth'];
	}
	
	$databases = &$GLOBALS['Tier6Databases'];
	
	$list = new XhtmlMenu($listdatabase, $databases);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $listname);
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('   ');

	$listidnumber['ObjectID'] = 1;
	
	$listoutput = $list->getOutput();
	
	$list1 = new XhtmlMenu($listdatabase, $databases);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $listname);
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('   ');
	
	$listidnumber['ObjectID'] = 2;
	
	$listoutput1 = $list1->getOutput();
		
	$list2 = new XhtmlMenu($listdatabase, $databases);
	$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $listname);
	$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list2->FetchDatabase ($listidnumber);
	$list2->CreateOutput('   ');
	
	$listidnumber['ObjectID'] = 3;
	
	$listoutput2 = $list2->getOutput();
			
	$list3 = new XhtmlMenu($listdatabase, $databases);
	$list3->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], $listname);
	$list3->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list3->FetchDatabase ($listidnumber);
	$list3->CreateOutput('   ');
	
	$listidnumber['ObjectID'] = 4;
	
	$listoutput3 = $list3->getOutput();
	
	print "  $listoutput";
	print "  $listoutput1";
	print "  $listoutput2";
	print "  $listoutput3";
	//print "\n";
	
?>