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
	$listdatabase['MenuTopPanel2'] = 'MenuTopPanel2';
	
	$databaseoptions = NULL;
	
	$credentaillogonarray = $GLOBALS['credentaillogonarray'];
	$Writer = $GLOBALS['Writer'];
	
	//$Writer->startElement('div');
		//$Writer->writeAttribute('id', 'TopPanel2');
		//$Writer->writeAttribute('class', 'TopPanel2');
	
	$list = new XhtmlMenu($listdatabase, $databaseoptions);
	$list->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list->FetchDatabase ($listidnumber);
	$list->CreateOutput('   ');

	$listidnumber['ObjectID'] = 1;
		
	$list1 = new XhtmlMenu($listdatabase, $databaseoptions);
	$list1->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list1->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list1->FetchDatabase ($listidnumber);
	$list1->CreateOutput('     ');
	
	$listidnumber['ObjectID'] = 2;
			
	$list2 = new XhtmlMenu($listdatabase, $databaseoptions);
	$list2->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list2->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list2->FetchDatabase ($listidnumber);
	$list2->CreateOutput('     ');
	
	$listidnumber['ObjectID'] = 3;
				
	$list3 = new XhtmlMenu($listdatabase, $databaseoptions);
	$list3->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list3->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list3->FetchDatabase ($listidnumber);
	$list3->CreateOutput('     ');
	
	$listidnumber['ObjectID'] = 4;
		
	$list4 = new XhtmlMenu($listdatabase, $databaseoptions);
	$list4->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list4->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list4->FetchDatabase ($listidnumber);
	$list4->CreateOutput('     ');
	
	$listidnumber['ObjectID'] = 5;
		
	$list5 = new XhtmlMenu($listdatabase, $databaseoptions);
	$list5->setDatabaseAll ($credentaillogonarray[0], $credentaillogonarray[1], $credentaillogonarray[2], $credentaillogonarray[3], 'MenuTopPanel2');
	$list5->setHttpUserAgent($_SERVER['HTTP_USER_AGENT']);
	$list5->FetchDatabase ($listidnumber);
	$list5->CreateOutput('     ');
	
	$listidnumber['ObjectID'] = 6;
	
	//$Writer->endElement(); // ENDS DIV
?>