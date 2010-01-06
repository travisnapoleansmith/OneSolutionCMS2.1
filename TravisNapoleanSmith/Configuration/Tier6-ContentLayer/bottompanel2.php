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
	
	if ($_GET['PageID']){
		$listidnumber['PageID'] = $_GET['PageID'];
	}
	if ($_GET['idnumber']) {
		$listidnumber['PageID'] = $_GET['idnumber'];
	}
	$listidnumber['ObjectID'] = 0;
	$listdatabase = Array();
	$listdatabase['MenuBottomPanel2'] = 'MenuBottomPanel2';
	
	$databases = &$GLOBALS['Databases'];
	
	$list = new XhtmlMenu($listdatabase, $databases);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel2');
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('   ');

	$listidnumber['ObjectID'] = 1;
	
	$listoutput = $list->getOutput();
	
	$list1 = new XhtmlMenu($listdatabase, $databases);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel2');
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('   ');
	
	$listidnumber['ObjectID'] = 2;
	
	$listoutput1 = $list1->getOutput();
		
	$list2 = new XhtmlMenu($listdatabase, $databases);
	$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel2');
	$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list2->FetchDatabase ($listidnumber);
	$list2->CreateOutput('   ');
	
	$listidnumber['ObjectID'] = 3;
	
	$listoutput2 = $list2->getOutput();
			
	$list3 = new XhtmlMenu($listdatabase, $databases);
	$list3->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuBottomPanel2');
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
	//print_r($list);
	
?>